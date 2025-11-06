<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for handling the 'About Us' page.
 */
class SobreController extends Controller
{
    /**
     * Display the 'About Us' page.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
       return view ('sobre');
    }
}
