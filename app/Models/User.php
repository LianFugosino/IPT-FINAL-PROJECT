<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'role',
        'password'
    ];

    public function api_keys()
    {
        return $this->hasMany(ApiKey::class);
    }

    public function borrow_records()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
