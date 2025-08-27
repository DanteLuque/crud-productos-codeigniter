<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Mantenimiento\TipoDoi;

class AuthController extends BaseController
{
    public function login(): string
    {
        return view('auth/login');
    }

    public function registrarCliente(): string
    {
        $tipoDoi = new TipoDoi();
        $data['tiposDoi'] = $tipoDoi->listar();
        return view('auth/register/cliente', $data);
    }

    public function registrarVendedor(): string
    {
        return view('auth/register/vendedor');
    }
}
