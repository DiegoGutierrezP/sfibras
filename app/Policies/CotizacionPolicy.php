<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cotizacion;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CotizacionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function createAsOC(User $user, Cotizacion $coti){

        return $coti->estado == 1? Response::allow()
            : Response::deny('Esta cotizacion no esta permitida');

     }
}
