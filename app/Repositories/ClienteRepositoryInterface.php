<?php
namespace App\Repositories;

use App\Cliente;
use Illuminate\Support\Collection;

interface ClienteRepositoryInterface
{
   public function all(): Collection;

   public function findByFinalPlaca($digito): Collection;
}