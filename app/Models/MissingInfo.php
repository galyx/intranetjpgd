<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitacao_id',
        'field',
        'reason',
        'status',
    ];
}
