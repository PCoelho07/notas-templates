<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Token;

class TokenController extends Controller
{
    public function getAll()
    {
    	$tokens = Token::all();

    	return response()->json(['result' => $tokens]);
    }
}
