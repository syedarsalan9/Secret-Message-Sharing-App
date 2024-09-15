<?php

namespace App\Http\Controllers;

use App\Contracts\MessageServiceInterface;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected MessageServiceInterface $messageService;

    public function __construct(MessageServiceInterface $messageService)
    {
        $this->messageService = $messageService;
    }

    public function store(MessageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $message = $this->messageService->storeMessage($data);
        
        return response()->json(['message' => 'Message stored successfully.', 'data' => $message], 201);
    }

    public function get(int $id): JsonResponse
    {
        $message = $this->messageService->getMessageById($id);

        return response()->json(['data' => $message], 200);
    }

    public function delete(int $id): JsonResponse
    {
        $this->messageService->deleteMessage($id);
        
        return response()->json(['message' => 'Message deleted successfully.'], 200);
    }

    public function read($id)
    {
        try {
            $message = $this->messageService->readMessage($id);
            return response()->json(['message' => $message]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
