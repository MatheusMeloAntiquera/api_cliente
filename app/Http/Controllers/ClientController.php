<?php

namespace api_cliente\Http\Controllers;
use api_cliente\ClientModel;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function create(Request $request){
        
        $data = [
            'name' => $request->input('name'),
            'fone' => $request->input('fone'),
            'cellphone' => $request->input('cellphone'),
            'city' => $request->input('city'),
            'address' => $request->input('address', NULL),
            'number' => $request->input('number', NULL),
            'complement' => $request->input('complement',NULL ),
                                               
        ];
        
       return ClientModel::createClient($data);
    }
}
