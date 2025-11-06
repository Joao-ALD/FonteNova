<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Middleware to handle cookie encryption.
 *
 * This middleware is responsible for encrypting outgoing cookies and decrypting
 * incoming ones, providing a secure way to store data on the client-side.
 * The $except property can be used to disable encryption for specific cookies.
 */
class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
