<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CustomerModel extends Model
{

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = ['customer'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public static function createCustomer($data)
    {

        DB::beginTransaction();

        try {

            $idCustomer = DB::table('customer')->insertGetId($data['customer']);

            //Melhorar isso futuramente
            $data['address']['customer'] = $idCustomer;
            DB::table('address')->insert($data['address']);

            DB::commit();

            return "ok";
        } catch (QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public static function findAll()
    {
        //Melhorar futuramente com o business
        $customers = DB::table('customer as cus')
            ->select('cus.id as customer_id', 'cus.name as customer_name', 'telephone', 'cellphone'
                , 'add.city', 'add.address', 'add.number', 'add.complement')
            ->join('address as add', 'add.customer', '=', 'cus.id')
            ->join('city', 'city.id', '=', 'add.city')
            ->where('cus.deleted_at', null)
            ->get();

        return $customers;
    }

    public static function getById($id)
    {
        //Melhorar futuramente com o business
        $customer = DB::table('customer as cus')
            ->select('cus.id as customer_id', 'cus.name as customer_name', 'telephone', 'cellphone'
                , 'add.city', 'add.address', 'add.number', 'add.complement')
            ->join('address as add', 'add.customer', '=', 'cus.id')
            ->join('city', 'city.id', '=', 'add.city')
            ->where('cus.deleted_at', null)
            ->where('cus.id', $id)
            ->get();

        return $customer;
    }

    //Melhorar
    public static function updateCustomer(array $data = [])
    {
        DB::beginTransaction();

        try {

            $idCustomer = DB::table('customer')->where('id', $data['id'])
                ->update($data['customer']);

            //Melhorar isso futuramente
            DB::table('address')
                ->where('customer', $data['id'])
                ->update($data['address']);

            DB::commit();

            return "Updated successfully ";
        } catch (QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public static function deleteCustomer($data)
    {
        DB::beginTransaction();
        $deleted_at = $data['deleted_at'];
        try {

            $idCustomer = DB::table('customer')->where('id', $data['id'])
                ->update(['deleted_at' => $deleted_at]);

            //Melhorar isso futuramente
            DB::table('address')
                ->where('customer', $data['id'])
                ->update(['deleted_at' => $deleted_at]);

            DB::commit();

            return "Deleted successfully ";
        } catch (QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
