<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'recipient',
        'decryption_key',
        'created_at',
        'expires_at',
        'is_read'
    ];

    protected $dates = ['expires_at'];
}
