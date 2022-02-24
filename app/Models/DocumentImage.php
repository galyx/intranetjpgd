<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitacao_id',
        'name',
        'path',
        'link',
    ];
}
