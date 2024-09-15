<?php

namespace App\Contracts;

use App\Models\Message;
interface MessageRepositoryInterface
{
    public function store(array $data): array;
    public function findById(int $id): Message;
    public function delete(int $id): bool;
}
