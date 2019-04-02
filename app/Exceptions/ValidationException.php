<?php
/**
 * Created by PhpStorm.
 * User: fevr
 * Date: 15.09.2018
 * Time: 21:53
 */

namespace App\Exceptions;


class ValidationException extends \Illuminate\Validation\ValidationException
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response($this->errors(), 400);
    }
}
