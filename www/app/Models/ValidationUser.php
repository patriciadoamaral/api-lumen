<?php
namespace App\Models;

class ValidationUser
{
    const RULE_USER = [
        'nome_completo' => 'required',
        'cpf' => 'required',
        'email' => 'required',
        'senha' => 'required',
        'carteira' => 'required'
    ];
}