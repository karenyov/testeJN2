<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Cliente;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\ClienteRepositoryInterface;
use Illuminate\Support\Collection;

class ClienteRepository extends BaseRepository implements ClienteRepositoryInterface
{

   /**
    * ClienteRepository constructor.
    *
    * @param Cliente $model
    */
   public function __construct(Cliente $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function findByFinalPlaca($digito): Collection
   {
        return DB::table('clientes')
                ->where(DB::raw('SUBSTR(placa, LENGTH(placa))  '), '=' , $digito)->get();
   }
}