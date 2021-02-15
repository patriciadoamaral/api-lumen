<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Documentação API usando Swagger",
 *     version="1.0.0",
 *     title="API Lumen",
 * )
 */
/**
 * @OA\Tag(
 *     name="user",
 *     description="Operations about user",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about store",
 *         url="http://swagger.io"
 *     )
 * )
 */
class Controller extends BaseController
{
    //
}
