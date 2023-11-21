<?php

namespace App\Http\Requests;

 use Illuminate\Contracts\Validation\Validator;
 use Illuminate\Http\Exceptions\HttpResponseException;
 use Symfony\Component\HttpFoundation\JsonResponse;

trait ValidateJsonResponse
{
     /***
     * @param Validator $validator
     * @author tuantv
     * @updated_at 30/05/2023
     * @return JsonResponse Error
     */
    public function failedValidation(Validator $validator)
    {
        $exception = new HttpResponseException(
            response()->json([
                'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
                'data' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );

        throw $exception;
    }

}
