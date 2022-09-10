<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $casts = [
        'no_of_children' => 'array',
        'addresses' => 'array',
        'contact_numbers' => 'array',
    ];
}
