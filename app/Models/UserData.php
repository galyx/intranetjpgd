<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'phone1',
        'phone2',
        'postal_code',
        'address',
        'home_number',
        'address2',
        'city',
        'state',
        'complement',
    ];
}
