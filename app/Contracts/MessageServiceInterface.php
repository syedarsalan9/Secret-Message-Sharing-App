<?php

namespace App\Contracts;

interface MessageServiceInterface
{
    public function storeMessage(array $data): array;
    public function getMessageById(int $id): array;
    public function deleteMessage(int $id): void;
    public function readMessage(int $id): string;
}
