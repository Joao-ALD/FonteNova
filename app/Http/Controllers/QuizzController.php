<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for handling the quiz page.
 */
class QuizzController extends Controller
{
    /**
     * Display the quiz page.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('quizz');
    }
}
