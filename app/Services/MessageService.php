<?php

namespace App\Services;

use App\Contracts\MessageRepositoryInterface;
use App\Contracts\MessageServiceInterface;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\MessageExpiredOrReadException;
use Exception;

class MessageService implements MessageServiceInterface
{
    protected MessageRepositoryInterface $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function storeMessage(array $data): array
    {
        // Encrypt the message before storing
        $data['message'] = Crypt::encrypt($data['message']);
        $data['is_read'] = false;

        return $this->messageRepository->store($data);
    }

    public function getMessageById(int $id): array
    {
        $message = $this->messageRepository->findById($id);
        return $message->toArray();
    }

    public function deleteMessage(int $id): void
    {
        $this->messageRepository->delete($id);
    }
    
    public function readMessage(int $id): string
    {
        $message = $this->messageRepository->findById($id);

        // Check for decryption key from environment
        $storedDecryptionKey = config('app.encryption_key');

        // Check if already read or expired
        if ($message->is_read || ($message->expires_at && $message->expires_at->isPast())) {
            throw new MessageExpiredOrReadException();
        }

        // Decrypt message using environment key
        $decryptedMessage = Crypt::decrypt($message->message, $storedDecryptionKey);
        $message->is_read = true;
        $message->save();

        return $decryptedMessage;
    }

}
