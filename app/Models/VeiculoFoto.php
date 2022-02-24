<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'name',
        'path',
        'link',
    ];
}
