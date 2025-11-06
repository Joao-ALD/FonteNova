<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for handling the gallery page.
 */
class GaleriaController extends Controller
{
    /**
     * Display the gallery page.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('galeria');
    }
}