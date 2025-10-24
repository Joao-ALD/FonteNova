<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Middleware to prevent requests during maintenance mode.
 *
 * When the application is in maintenance mode, this middleware will intercept
 * incoming requests and throw a MaintenanceModeException, effectively making
 * the application inaccessible. The $except property can be used to specify
 * URIs that should remain accessible.
 */
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
