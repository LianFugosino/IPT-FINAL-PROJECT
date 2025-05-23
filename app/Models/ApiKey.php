<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    /** @use HasFactory<\Database\Factories\ApiKeyFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'secret_key',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
