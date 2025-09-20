<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBot extends Controller
{
         public function index(){
        return view('chatbot');
    }
}
