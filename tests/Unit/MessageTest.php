<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    // Test for message encryption and decryption
    public function test_message_encryption_and_decryption(): void
    {
        $messageData = [
            'message' => Crypt::encrypt('This is a secret message'),
            'recipient' => 'John Doe',
            'expires_at' => now()->addMinutes(10),
            'is_read' => false
        ];

        $message = Message::create($messageData);

        $response = $this->postJson("/api/messages/{$message->id}/read");

        $decryptedMessage = Crypt::decrypt($message->message);

        $response->assertStatus(200)
                ->assertJsonFragment(['message' => $decryptedMessage]);
    }

    // Test for expired message
    public function test_message_expiry(): void
    {
        // Message data banaya jisme expiry pehle ho chuki hai
        $messageData = [
            'message' => Crypt::encrypt('This message has expired'),
            'recipient' => 'Jane Doe',
            'expires_at' => now()->subMinutes(5), // Expired 5 minutes ago
            'is_read' => false
        ];

        // Message ko database mein store kiya
        $message = Message::create($messageData);

        // Read request post ki
        $response = $this->postJson("/api/messages/{$message->id}/read");

        // Check for 404 status and appropriate error message
        $response->assertStatus(404)
                ->assertJson(['error' => 'Message has expired or already read']);
    }

    public function test_message_already_read(): void
    {
        // Message create kiya aur is_read ko true set kiya
        $messageData = [
            'message' => Crypt::encrypt('This message has already been read'),
            'recipient' => 'Jane Doe',
            'expires_at' => now()->addMinutes(10),
            'is_read' => true, // Message already read
        ];

        $message = Message::create($messageData);

        // Read request send ki
        $response = $this->postJson("/api/messages/{$message->id}/read");

        // Assert ke response ka status 404 ho aur error message aaye
        $response->assertStatus(404)
                ->assertJson(['error' => 'Message has expired or already read']);
    }

    public function test_env_encryption_key(): void
    {
        // Assert karein ke .env se decryption key successfully load ho gayi
        $decryptionKey = env('ENCRYPTION_KEY');

        $this->assertNotNull($decryptionKey, 'Decryption key should not be null');
    }

}
