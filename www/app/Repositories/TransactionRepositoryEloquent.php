<?php

namespace App\Repositories;

use App\Models\User;

class TransactionRepositoryEloquent implements TransactionRepositoryInterface
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }
    
}