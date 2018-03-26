<?php

namespace App\Business;

use App\Models\ContactModel;
use Carbon\Carbon;

class ContactBusiness
{
    public function create($request, $customer)
    {
        $data = [
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'customer' => $customer,
        ];
        return ContactModel::create($data);
    }
    function list($customer) {
        $contacts = ContactModel::findAll($customer);
        return $contacts;
        if ($contacts->isEmpty()) {
            return response()->json([
                'message' => 'No records found',
            ], 404);
        }

        return response()->json($contacts, 200);
    }
    public function getById($id)
    {
        $contact = ContactModel::getById($id);

        if ($contact->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return response()->json($contact, 200);
    }
    public function update($request, $customer, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'customer' => $customer,
        ];

        //Check if the contact exists
        if (ContactModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return ContactModel::updateContact($data, $id);
    }
    public function delete($customer, $id)
    {
        $data = ['id' => $id, 'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')];

        //Check if the contact exists
        if (ContactModel::getById($id)->isEmpty()) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return ContactModel::deleteContact($data);
    }
}
