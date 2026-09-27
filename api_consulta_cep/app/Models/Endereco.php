<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $table='enderecos';

    protected $primaryKey = 'cep';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps=false;
    protected $fillable = [
        'cep',
        'logradouro',
        'bairro',
        'localidade',
        'uf',
    ];

}
