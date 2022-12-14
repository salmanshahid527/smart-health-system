<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

}
