<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Encryption\Encrypter;


/**
 * @SWG\Swagger(
 *   basePath="/api/v2",
 *   @OA\Info(
 *     title="YHHF APIs",
 *     version="1.0",
 *   )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        #Encrypter
        $db_key  = config('app.db_key');
        $fromKey = base64_decode($db_key);
        $cipher = config('app.db_cipher');
        $this->encrypter = new Encrypter($fromKey, $cipher);
    }
}
