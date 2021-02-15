<?php
namespace App\Models;

class ValidationTransaction
{
    const RULE_TRANSACTION = [
        'value' => 'required',
        'payer' => 'required',
        'payee' => 'required'
    ];
}