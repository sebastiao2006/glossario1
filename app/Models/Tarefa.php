<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'funcionario',
        'cliente',
        'tipo',
        'prioridade',
        'inicio',
        'prazo',
        'status'
    ];

    protected $casts = [
        'inicio' => 'date',
        'prazo' => 'date'
    ];
}