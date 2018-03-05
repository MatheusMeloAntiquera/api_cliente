<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ClientModel extends Model
{
    protected $fillable = ['nome', 'telefone', 'celular', 'cliente', 'cidade',
        'logradouro', 'numero', 'complemento'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = ['cliente'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public static function createClient($data)
    {

        DB::beginTransaction();

        try {

            $idClient = DB::table('client')->insertGetId($data['client']);

            //Melhorar isso futuramente
            $data['address']['client'] = $idClient;
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
        $clients = DB::table('client as cli')
            ->select('cli.id as client_id', 'cli.name as client_name', 'telephone', 'cellphone'
                , 'add.city', 'add.address', 'add.number', 'add.complement')
            ->join('address as add', 'add.client', '=', 'cli.id')
            ->join('city', 'city.id', '=', 'add.city')
            ->where('cli.deleted_at', null)
            ->get();

        return $clients;
    }

    public static function getById($id)
    {
        //Melhorar futuramente com o business
        $client = DB::table('client as cli')
            ->select('cli.id as client_id', 'cli.name as client_name', 'telephone', 'cellphone'
                , 'add.city', 'add.address', 'add.number', 'add.complement')
            ->join('address as add', 'add.client', '=', 'cli.id')
            ->join('city', 'city.id', '=', 'add.city')
            ->where('cli.deleted_at', null)
            ->where('cli.id', $id)
            ->get();

        return $client;
    }

    //Melhorar
    public static function updateClient(array $data = [])
    {
        DB::beginTransaction();

        try {

            $idClient = DB::table('client')->where('id', $data['id'])
                ->update($data['client']);

            //Melhorar isso futuramente
            DB::table('address')
                ->where('client', $data['id'])
                ->update($data['address']);

            DB::commit();

            return "Updated successfully ";
        } catch (QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public static function deleteClient($data)
    {
        DB::beginTransaction();
        $deleted_at = $data['deleted_at'];
        try {

            $idClient = DB::table('client')->where('id', $data['id'])
                ->update(['deleted_at' => $deleted_at]);

            //Melhorar isso futuramente
            DB::table('address')
                ->where('client', $data['id'])
                ->update(['deleted_at' => $deleted_at]);

            DB::commit();

            return "Deleted successfully ";
        } catch (QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
