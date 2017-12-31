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

    public function create()
    {
    	return view('tokens.create');
    }

    public function store(Request $request)
    {
    	$name = $request->input('name');
    	$slug = $request->input('slug');
    	$variable = $request->input('variable');

    	$data = [
    		'name' => $name,
    		'slug' => $slug,
    		'variable' => $variable
    	];

    	$token = Token::create($data);

    	if(! $token) {
    		return response()->json(['result' => 'error'], 500);
    	}

    	return response()->json([
    		'result' => $token
    	]);


    }
}
