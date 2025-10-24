<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

/**
 * Middleware to validate signed URLs.
 *
 * This middleware ensures that incoming requests with a signed URL have a
 * valid signature, protecting against URL manipulation. The $except property
 * can be used to ignore certain query string parameters when validating the
- * signature.
 */
class ValidateSignature extends Middleware
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'fbclid',
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}
