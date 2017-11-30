<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use App\Client;
use App\Country;
use App\State;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $childrenResponsibles = [
        1 => 'Próprio(a)',
        2 => 'Cônjuge',
        3 => 'Ambos cônjuges',
        4 => 'Outros',
        5 => 'Sem declaração',
    ];

    protected $cpfcnpjStatus = [
        1 => 'Inscrito no CPF/CNPJ',
        2 => 'Sem CPF/CNPJ - Decisão Judicial',
        3 => 'Sem CNPJ - Operação anterior à IN 200',
        4 => 'Sem CPF - Operação anterior à IN 190',
    ];

    protected $civilStatus = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'União Estável',
        4 => 'Viúvo',
        5 => 'Separado Consensualmente',
        6 => 'Separado Judicialmente',
        7 => 'Divorciado',
    ];

    protected $documentTypes = [
        1 => 'RG',
        2 => 'RNE',
        3 => 'CNH',
        4 => 'Passaporte',
        5 => 'Carteira funcional',
    ];

    protected $propertyRegimes = [
        1 => 'Comunhão parcial de bens',
        2 => 'Comunhão universal de bens antes da Lei 6.515/77',
        3 => 'Comunhão universal de bens na vigência da Lei 6.515/77',
        4 => 'Separação total de bens',
        5 => 'Separação obrigatória de bens',
        6 => 'Participação final nos aquestos',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name')->get();

        return view('clients.index')->with(
            compact('clients')
        );
    }

    public function show($cpfcnpj)
    {
        if (strlen($cpfcnpj) != 11 && strlen($cpfcnpj) != 14) {
            return ;
        }

        $cpfcnpj = Client::maskDocument($cpfcnpj);

        return Client::where('cpfcnpj', $cpfcnpj)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client               = new Client;
        $cpfcnpjStatus        = $this->cpfcnpjStatus;
        $documentTypes        = $this->documentTypes;
        $civilStatus          = $this->civilStatus;
        $propertyRegimes      = $this->propertyRegimes;
        $childrenResponsibles = $this->childrenResponsibles;
        $countries            = Country::all();
        $states               = State::all();

        return view('clients.create')->with(
            compact(
                'client',
                'cpfcnpjStatus',
                'documentTypes',
                'civilStatus',
                'propertyRegimes',
                'childrenResponsibles',
                'countries',
                'states'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                => 'required|max:150',
            'cpfcnpj'             => 'nullable|cpf_cnpj',
            'document_type'       => 'required',
            'document_number'     => 'required',
            'born_in'             => 'nullable|date_format:d/m/Y',
            'status_cpfcnpj'      => 'required',
            'street_name'         => 'required|max:40',
            'building_number'     => 'required|max:6',
            'complement'          => 'nullable|max:20',
            'neighborhood'        => 'nullable|max:20',
            'zip_code'            => 'nullable|max:8',
            'city'                => 'required|max:30',
            'state'               => 'required|max:2',
            'document_expires_in' => 'nullable|date_format:d/m/Y'
        ]);

        $client = new Client(
            $request->except([
                'born_in',
                'document_expires_in',
                'married_in'
            ])
        );

        $client->born_in = ! is_null($client->born_in)
            ? Carbon::createFromFormat('d/m/Y', $request->born_in)
            : null;

        $client->document_expires_in = ! is_null($client->document_expires_in)
            ? Carbon::createFromFormat('d/m/Y', $request->document_expires_in)
            : null;

        $client->married_in = ! is_null($client->married_in)
            ? Carbon::createFromFormat('d/m/Y', $request->married_in)
            : null;

        $client->save();

        \Session::flash(
            'message',
            'Cliente cadastrado com sucesso'
        );

        return redirect('clients');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $cpfcnpjStatus        = $this->cpfcnpjStatus;
        $documentTypes        = $this->documentTypes;
        $civilStatus          = $this->civilStatus;
        $propertyRegimes      = $this->propertyRegimes;
        $childrenResponsibles = $this->childrenResponsibles;
        $countries            = Country::all();
        $states               = State::all();

        return view('clients.edit')->with(
            compact(
                'client',
                'cpfcnpjStatus',
                'documentTypes',
                'civilStatus',
                'propertyRegimes',
                'childrenResponsibles',
                'countries',
                'states'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name'                => 'required|max:150',
            'cpfcnpj'             => 'nullable|cpf_cnpj',
            'document_type'       => 'required',
            'document_number'     => 'required',
            'born_in'             => 'nullable|date_format:d/m/Y',
            'status_cpfcnpj'      => 'required',
            'street_name'         => 'required|max:40',
            'building_number'     => 'required|max:6',
            'complement'          => 'nullable|max:20',
            'neighborhood'        => 'nullable|max:20',
            'zip_code'            => 'nullable|max:8',
            'city'                => 'required|max:30',
            'state'               => 'required|max:2',
            'document_expires_in' => 'nullable|date_format:d/m/Y',
        ]);

        $input = $request->all();

        $input['born_in'] = ! is_null($request->born_in)
            ? Carbon::createFromFormat('d/m/Y', $request->born_in)
            : null;

        $input['document_expires_in'] = ! is_null($request->document_expires_in)
            ? Carbon::createFromFormat('d/m/Y', $request->document_expires_in)
            : null;

        $input['married_in'] = ! is_null($request->married_in)
            ? Carbon::createFromFormat('d/m/Y', $request->married_in)
            : null;

        $client->update($input);

        \Session::flash(
            'message',
            'Cliente editado com sucesso'
        );

        return redirect('clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        \Session::flash('message', 'Cliente deletado com sucesso');

        return redirect('clients');
    }
}
