<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ValidationUser;
use App\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function getAll()
    {
        return response()->json($this->repo->getAll(),Response::HTTP_OK);
    }

    public function get($id)
    {
        return response()->json($this->repo->get($id),Response::HTTP_OK);
    }

    public function create(array $data)
    {
        $validator = Validator::make($data, ValidationUser::RULE_USER);

        if ($validator->fails()) {
            return response()->json(["error"=>$validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        return response()->json($this->repo->create($data),Response::HTTP_CREATED);
    }

    public function update($id, array $data)
    {
                
        $validator = Validator::make($data, ValidationUser::RULE_USER);

        if ($validator->fails()) {
            return response()->json(["error"=>'Falha na validação dos dados'], Response::HTTP_BAD_REQUEST);
        }
        
        return response()->json($this->repo->update($id, $data),Response::HTTP_OK);
    }

    public function delete($id)
    {
        
        if($this->repo->delete($id)){
            return response()->json(["success"=>'Deletado com sucesso!'],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>'Não foi possível deletar.'],Response::HTTP_BAD_REQUEST);
        }
    }
}