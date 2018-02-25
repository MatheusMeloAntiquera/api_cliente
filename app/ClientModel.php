<?php

namespace api_cliente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientModel extends Model
{
    protected $fillable = ['nome', 'telefone', 'celular', 'cliente', 'cidade',
      'logradouro','numero','complemento'];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public static function createClient($data){
        
        DB::beginTransaction();
        
        try{

            //Insere o Cliente
            $idClient = DB::table('cliente')->insertGetId([
                'nome' => $data['name'],
                'telefone' => $data['fone'],
                'celular' => $data['cellphone'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
           
            DB::table('endereco')->insert([
                'cliente' => $idClient,
                'cidade' => $data['city'],
                'logradouro' => $data['address'],
                'numero' => $data['number'],
                'complemento' => $data['complement'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            
            
            DB::commit();
                        
            return "ok";
        } 
        catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
}
