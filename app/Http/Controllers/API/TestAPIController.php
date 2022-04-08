<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\APIBaseController;
use Illuminate\Http\Request;
use App\Models\Test;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestAPIController extends APIBaseController
{

    /**
     * @OA\GET (
     *   path="/test",
     *   summary="Get Test Data.",
     *   tags={"Test"},
     *   @OA\Response(
     *     response=200,
     *     description="Response.",
     *     @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     description="API title response.",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="descriptione",
     *                     description="API descriptione response.",
     *                     type="string"
     *                 )
     *                 ),
     *             ),
     *         ),
     *   ),
     * ),
     */

    ########### Get Data ############
    public function index()
    {
        $data = Test::all()->toArray();
        if (!$data) {
            return $this->sendError('Data not found');
        }

        #Decryption
        foreach ($data as $one) {
            $one['title'] = $this->encrypter->decryptString($one['title']);
            $one['description'] = $this->encrypter->decryptString($one['description']);
            $finalData[] = $one;
        }

        return $this->sendResponse($finalData, 'Data retrieved successfully');
    }



    /**
     * @OA\POST (
     *   path="/test/create",
     *   summary="Create Test Data.",
     *   tags={"Test"},
     *   @OA\RequestBody(
     *    required=false,
     *    description="Enter Data",
     *    @OA\JsonContent(
     *       @OA\Property(property="title", type="string", format="text", example="test title"),
     *       @OA\Property(property="description", type="string", format="text", example="test description")
     *    ),
     * ),
     *   @OA\Response(
     *     response=200,
     *     description="Response.",
     *     @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     description="status.",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     description="null.",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     description="message.",
     *                     type="string"
     *                 )
     *                 ),
     *             ),
     *         ),
     *   ),
     * ),
     */

    ########## Store Data ###########
    public function store(Request $request)
    {
        $data = $request->all();

        // dd($data);

        $validator = Validator::make($data, [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse($data, $validator->errors()->first());
        }

        $validatedData = $validator->validated();

        #Encryption
        $toSave['title'] = $this->encrypter->encryptString($validatedData['title']);
        $toSave['description'] = $this->encrypter->encryptString($validatedData['description']);

        $status = Test::create($toSave);

        if (!$status) {
            return $this->sendError("Data saving Failed");
        } else {
            return $this->sendResponse(null, 'Successfully saved Data');
        }
    }
}
