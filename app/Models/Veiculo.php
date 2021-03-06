<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'lojista_id',
        'particular',
        'renavam',
        'plate_car',
        'color_car',
        'year_fab_mod',
        'brand_model',
        'chassi_car',
    ];

    public function fotos()
    {
        return $this->hasMany(VeiculoFoto::class, 'veiculo_id');
    }
}
