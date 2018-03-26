<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ContactModel extends Model
{
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = ['contact'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public static function create($data)
    {
        DB::beginTransaction();

        try {

            DB::table('contact')->insert($data);

            DB::commit();

            return response()->json(['message' => 'Inserted successfully'], 201);
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public static function findAll($customer)
    {
        return DB::table('contact')
            ->where('customer', $customer)
            ->where('deleted_at', null)
            ->get();

    }

    public static function getById($id)
    {
        return DB::table('contact')
            ->where('id', $id)
            ->where('deleted_at', null)
            ->get();
    }

    public static function updateContact(array $data, int $id)
    {
        DB::beginTransaction();

        try {

            DB::table('contact')
                ->where('id', $id)
                ->update($data);

            DB::commit();

            return response()->json(['message' => 'Updated successfully'], 200);
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public static function deleteContact($data)
    {
        DB::beginTransaction();

        try {

            DB::table('contact')->where('id', $data['id'])
                ->update(['deleted_at' => $data['deleted_at']]);

            DB::commit();

            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
