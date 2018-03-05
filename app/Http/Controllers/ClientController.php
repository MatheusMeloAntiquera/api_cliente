<?php

namespace App\Http\Controllers;

use App\ClientModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function create(Request $request)
    {
        $data['client'] = [
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'cellphone' => $request->input('cellphone'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')];

        $data['address'] = [
            'city' => $request->input('city'),
            'address' => $request->input('address', null),
            'number' => $request->input('number', null),
            'complement' => $request->input('complement', null),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        return response()->json(['message' => ClientModel::createClient($data)], 201);
    }

    function list() {

        $clients = ClientModel::findAll();

        if ($clients->isEmpty()) {
            return response()->json([
                'message' => 'No records found',
            ], 404);
        }

        return response()->json($clients);
    }

    public function getById($id)
    {
        $client = ClientModel::getById($id);

        if ($client->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return response()->json($client, 200);

    }

    public function update(Request $request, $id)
    {
        $data['client'] = [
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'cellphone' => $request->input('cellphone'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];

        $data['address'] = [
            'city' => $request->input('city'),
            'address' => $request->input('address', null),
            'number' => $request->input('number', null),
            'complement' => $request->input('complement', null),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        //Check if the client exists
        if (ClientModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $data['id'] = $id;

        //Melhorar o tratamento de erros
        return response()->json(ClientModel::updateClient($data));
    }

    public function delete($id)
    {
        //Check if the client exists
        if (ClientModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $data = ['id' => $id, 'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')];
        return response()->json(ClientModel::deleteClient($data));
    }
}
