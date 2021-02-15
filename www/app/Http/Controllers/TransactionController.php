<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    private $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     path="/transaction",
     *     tags={"transaction"},
     *     summary="Make transaction",
     *     description="",
     *     operationId="createUser",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation",
     *             content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                          "success": "Enviado"
     *                     }
     *                 )
     *             )
     *          }

     *     ),
     *     @OA\RequestBody(
     *         description="Create user object",
     *         required=true,
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                          "value": 1.00,
     *                          "payer": 4,
     *                          "payee": 5
     *                     }
     *                 )
     *             )
     *          }
     *     )
     * )
     */
    public function transaction(Request $request)
    {
        try {
            return $this->service->transaction($request->all());
        } catch (\Exception $e) {
            return response()->json(["error"=>$e->getMessage()]);
        }
    }
    
}
