<?php

namespace App\Business;

use App\Models\CustomerModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerBusiness
{
    public function create($request)
    {
        $data['customer'] = [
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

        return response()->json(['message' => CustomerModel::createCustomer($data)], 201);
    }

    function list() {

        $customers = CustomerModel::findAll();

        if ($customers->isEmpty()) {
            return response()->json([
                'message' => 'No records found',
            ], 404);
        }

        return response()->json($customers);
    }

    public function getById($id)
    {
        $customer = CustomerModel::getById($id);

        if ($customer->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return response()->json($customer, 200);

    }

    public function update(Request $request, $id)
    {
        $data['customer'] = [
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

        //Check if the customer exists
        if (CustomerModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $data['id'] = $id;

        //Melhorar o tratamento de erros
        return response()->json(CustomerModel::updateCustomer($data));
    }

    public function delete($id)
    {
        //Check if the customer exists
        if (CustomerModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $data = ['id' => $id, 'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')];
        return response()->json(CustomerModel::deleteCustomer($data));
    }
}
