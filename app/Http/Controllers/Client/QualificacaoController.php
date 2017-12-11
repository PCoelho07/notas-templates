<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\ClientQualification;

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

    public function store(Request $request)
    {
    	$idClient = $request->input('client_id');
    	$idTemplate = $request->input('template_id');
    	$idRole = $request->input('role_id');

    	$clientQualification = new ClientQualification;
    	$clientQualification->client_id = $idClient;
    	$clientQualification->role_id = $idRole;
    	$clientQualification->template_id = $idTemplate;


    	$clientQualification->save();
    	
    }

    public function getAll()
    {
    	$clients = Client::with(['roles', 'templates'])->get();

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
