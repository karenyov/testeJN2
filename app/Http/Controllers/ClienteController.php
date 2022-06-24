<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ClienteResource as ClienteResource;
use App\Repositories\ClienteRepositoryInterface as ClienteRepositoryInterface;
use App\Http\Requests\ClienteRequest;

use Illuminate\Http\Request;

class ClienteController extends BaseController
{

    private $clienteRepository;
  
    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->clienteRepository->all();
        return $this->sendResponse(ClienteResource::collection($clientes), 'Clientes carregados com sucesso.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 	Cadastro de novo cliente.
     *
     * @param \App\Http\Requests\ClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = $this->clienteRepository->create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'placa' => $request->placa,
        ]);

        if ($cliente)
            return $this->sendResponse(new ClienteResource($cliente), 'Cliente criado com sucesso.');

        return $this->sendError('Erro. Problema ao salvar os dados.');
    }

    /**
     * 	Consulta de dados de um cliente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);
  
        if (is_null($cliente)) {
            return $this->sendError('Cliente não encontrado.');
        }
   
        return $this->sendResponse(new ClienteResource($cliente), 'Cliente encontrado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Edição de um cliente já existente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        $input = $request->all();

        $cliente = $this->clienteRepository->find($id);   
        $cliente->nome = $input['nome'];
        $cliente->telefone = $input['telefone'];
        $cliente->cpf = (int) $input['cpf'];
        $cliente->placa = $input['placa'];
        $cliente->save();
   
        if (new ClienteResource($cliente))
            return $this->sendResponse(new ClienteResource($cliente), 'Cliente alterado com sucesso.');

        return $this->sendError('Erro. Problema ao salvar os dados.');
    }

    /**
     * Remoção de um cliente existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if ($cliente->delete())
            return $this->sendResponse([], 'Cliente deletado com sucesso.');

        return $this->sendError('Erro. Problema ao deletar os dados.');
    }

    /**
     * Consulta de todos os clientes cadastrados na base, onde o último número da placa do carro é igual ao informado.
     * 
     *  @param  int  $id
     */
    public function finalPlaca($id) 
    {
        $clientes = $this->clienteRepository->findByFinalPlaca($id);
        return $this->sendResponse(ClienteResource::collection($clientes), 'Clientes carregados com sucesso.');
    }
}
