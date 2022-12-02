<?php

namespace App\Http\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

class ApiResponse
{
	/**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
	public function success($data, string $message = null, int $code = 200)
	{
		return response()->json([
		    'statusCode'=>1000,
			'status' => 1,
			'message' => $message,
			'data' => ['data'=>$data]
		], $code);
	}

	/**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	public function error($data = null,string $message = null,  int $code)
	{
		return response()->json([
            'statusCode'=>0,
			'status' => 0,
			'message' => $message,
			'data' => ['data'=>$data]
		], $code);

	}

}
