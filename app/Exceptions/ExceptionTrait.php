<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

trait ExceptionTrait
{
    public function apiException($request, Exception $e)
    {
        if ($this->isModel($e)) {
            return $this->modelResponse();
        }

        if ($this->isHttp($e)) {
            return $this->httpResponse();
        }

        return parent::render($request, $e);
    }

    protected function isModel(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse()
    {
        return response()->json(
            [
                'errors' => 'Model not found in API',
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    protected function httpResponse()
    {
        return response()->json(
            [
                      'errors' => 'Incorrect route',
            ],
            Response::HTTP_NOT_FOUND
        );
    }
}
