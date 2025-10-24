<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for handling the display of the course page.
 */
class CursoController extends Controller
{
    /**
     * Display the course page.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('curso');
    }
}
