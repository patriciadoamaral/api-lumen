<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ValidationTransaction;
use App\Repositories\TransactionRepositoryInterface;
use App\Exceptions\CustomValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class TransactionService
{
    private $repo;

    public function __construct(TransactionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    public function transaction(array $data)
    {
        //Verifica se recebeu todos os parâmetros necessários
        $validator = Validator::make($data, ValidationTransaction::RULE_TRANSACTION);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        //Verifica se usuários existem
        $payer = $this->repo->get($data['payer']);
        $payee = $this->repo->get($data['payee']);
        $value = $data['value'];
        
        if(!$payer || !$payee){            
            return response()->json(['error'=>'Pagador ou recebedor não encontrado.'], Response::HTTP_BAD_REQUEST);
        }

        //Se o pagador não for lojista e tiver valor disponível na carteira
        if(empty($payer->cnpj)){ 
            if ($payer->carteira >= $value){
                
                //Autorizar
                $data = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

                if($data->status() == 200){
                    
                    $this->repo->update($payer->id, [
                        "carteira" => $payer->carteira - $value
                    ]);
                    $this->repo->update($payee->id, [
                        "carteira" => $payee->carteira + $value
                    ]);
                        
                    //Notificar
                    return $this->notificar();

                }else{
                    return response()->json(['error'=>'Não autorizado.'], Response::HTTP_BAD_REQUEST);
                }

            }else{
                return response()->json(['error'=>'Saldo insuficiente.'], Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json(['error'=>'Lojista, não é permitido fazer transferência.'], Response::HTTP_BAD_REQUEST);
        }
        
    }

    public function notificar()
    {
        $data = Http::get('https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');
        if($data->status() == 200){
            $body = json_decode($data->body());
            return response()->json(['success'=>$body->message], Response::HTTP_OK);
        }else{
            return response()->json(['error'=>'Não foi possível enviar a notificação.'], Response::HTTP_BAD_REQUEST);
        }
    }

}