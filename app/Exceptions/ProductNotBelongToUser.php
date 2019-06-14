<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongToUser extends Exception
{
    public function render()
    {
        return [
          'errors' => 'Product not belong to user'
        ];
    }
}

// php artisan make:exception ProductNotBelongToUser
