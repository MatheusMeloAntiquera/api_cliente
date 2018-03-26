<?php

namespace App\Http\Controllers;

use App\Business\ContactBusiness;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactBusiness;
    public function __construct()
    {
        $this->contactBusiness = new ContactBusiness;
    }

    public function create(Request $request, $customer)
    {
        return $this->contactBusiness->create($request, $customer);
    }
    function list($customer) {
        return $this->contactBusiness->list($customer);
    }
    public function getById($customer, $id)
    {
        return $this->contactBusiness->getById($id);
    }
    public function update(Request $request, $customer, $id)
    {
        return $this->contactBusiness->update($request, $customer, $id);
    }
    public function delete($customer, $id)
    {
        return $this->contactBusiness->delete($customer, $id);
    }

}
