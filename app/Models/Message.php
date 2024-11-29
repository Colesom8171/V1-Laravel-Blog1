<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'content', 'is_read'];
    //protected $fillable = ['sender_id', 'receiver_id', 'content'];
    public $timestamps = true; // Esto es lo predeterminado, pero verifica si está explícito

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function users(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}

