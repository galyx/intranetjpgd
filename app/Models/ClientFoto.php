<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'path',
        'link',
    ];
}
