<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'lojista_id',
        'client_id',
        'veiculo_id',
        'observacao',
        'despachante_observacao',
        'gravame',
        'purchase_change_address2',
        'valor_orcamento',
        'status',
    ];

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class, 'solicitacao_id');
    }

    public function missingInfos()
    {
        return $this->hasMany(MissingInfo::class, 'solicitacao_id');
    }

    public function documentImages()
    {
        return $this->hasMany(DocumentImage::class, 'solicitacao_id');
    }

    public function lojista()
    {
        return $this->hasOne(User::class, 'id', 'lojista_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function veiculo()
    {
        return $this->hasOne(veiculo::class, 'id', 'veiculo_id');
    }
}
