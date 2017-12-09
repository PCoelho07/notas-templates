<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class QualificacaoController extends Controller
{
    public function index()
    {
    	return view('client-qualificacao.qualificacao');
    }

    public function create()
    {
    	return view('client-qualificacao.create');
    }

    public function getAll()
    {
    	$clients = Client::with('roles')->get();

    	return response()->json([
    				'result' => $clients
    	]);
    }

    public function delete(Request $request)
    {
    	$id = $request->input('id');

    	$client = Client::find($id)->first();

    	if (! $client) {
    		return response()->json(['result' => "Error"], 500);
    	}

    	$client->delete();

    	return response()->json(['result' => 'Success']);
    }
}
