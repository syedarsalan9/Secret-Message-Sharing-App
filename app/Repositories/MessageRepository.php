<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Contracts\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
{
    public function store(array $data): array
    {
        return Message::create($data)->toArray();
    }

    public function findById(int $id): Message
    {
        return Message::findOrFail($id);
    }

    public function delete(int $id): bool
    {
        return Message::destroy($id);
    }
}
