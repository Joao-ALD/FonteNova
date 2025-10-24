<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Middleware to trim whitespace from request strings.
 *
 * This middleware automatically trims whitespace from all incoming request
 * string fields, which helps to prevent issues with user input. The $except
 * property can be used to prevent trimming on specific fields, such as
 * passwords.
 */
class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
