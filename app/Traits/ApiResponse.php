<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponse
{


protected function successResponse($data, $code) // receve data and code and return the response of them
{
    return response()->json(['data' => $data], $code);
}

protected function errorResponse($message, $code) // receve message of error and the code ande return the response of them
{
    return response()->json(['error' => $message, 'code' => $code], $code);
}

protected function showMessage($message, $code = 200)
{
    return $this->successResponse(['data' => $message,], $code);
}

protected function showAll(Collection $collection, $code = 200) // to show all the data
{
    if ($collection->isEmpty()) {
        return $this->successResponse(['data' => $collection], $code);
    }
    return $this->successResponse($collection, $code);
}


protected function showOne(Model $instance, $code = 200) // show one instance
{
    return $this->successResponse(['data' => $instance], $code);
}

}