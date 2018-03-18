<?php

namespace App\Http\Controllers;

use App\Business\CustomerBusiness;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerBusiness;
    public function __construct(CustomerBusiness $customerBusiness)
    {
        $this->customerBusiness = $customerBusiness;
    }

    public function create(Request $request)
    {
        return $this->customerBusiness->create($request);
    }

    function list() {

        return $this->customerBusiness->list();
    }

    public function getById($id)
    {
        return $this->customerBusiness->getById();
    }

    public function update(Request $request, $id)
    {
        //Melhorar o tratamento de erros
        return $this->customerBusiness->update($request, $id);
    }

    public function delete($id)
    {
        return $this->customerBusiness->delete($id);
    }
}
