<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'lojista_id',
        'type_document',
        'document_number',
        'document_number_rg',
        'full_name',
        'phone1',
        'phone2',
        'phone3',
        'postal_code',
        'address',
        'home_number',
        'address2',
        'city',
        'state',
        'complement',
    ];

    public function fotos()
    {
        return $this->hasMany(ClientFoto::class, 'client_id');
    }
}
