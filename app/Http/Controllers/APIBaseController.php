<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Encryption\Encrypter;


class APIBaseController extends Controller
{

    public function __construct()
    {
        #Encrypter
        $db_key  = config('app.db_key');
        $fromKey = base64_decode($db_key);
        $cipher = "aes-256-gcm";
        $this->encrypter = new Encrypter($fromKey, $cipher);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    public function sendError($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 403);
    }

    public function sendResponse($data, $message)
    {
        return Response::json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], 200);
    }
}
