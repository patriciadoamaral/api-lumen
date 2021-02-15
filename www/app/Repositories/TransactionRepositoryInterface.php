<?php

namespace App\Repositories;

use App\Models\User;

interface TransactionRepositoryInterface
{
    public function __construct(User $user);

	public function get($id);

    public function update($id, array $data);
}