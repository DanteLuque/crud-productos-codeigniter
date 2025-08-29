<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Vendedor;
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

    public function doLogin()
    {
        $usuarioModel = new Usuario();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('userpass');

        $usuario = $usuarioModel->obtenerPorUsername($username);
        if (!$usuario) return redirect()->back()->with('error', 'Usuario no encontrado');

        if (!password_verify($password, $usuario['userpass'])) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }

        $clienteModel = new Cliente();
        $vendedorModel = new Vendedor();

        $clienteId = null;
        $vendedorId = null;

        if ($usuario['rol'] === 'CLIENTE') {
            $clienteId = $clienteModel->obtenerPorUsuarioId($usuario['id'])['id'] ?? null;
        } elseif ($usuario['rol'] === 'VENDEDOR') {
            $vendedorId = $vendedorModel->obtenerPorUsuarioId($usuario['id'])['id'] ?? null;
        }
        $session = session();
        $session->set([
            'user' => [
                'id'         => $usuario['id'],
                'username'   => $usuario['username'],
                'nombres'    => $usuario['nombres'],
                'rol'        => $usuario['rol'],
                'cliente_id' => $clienteId,
                'vendedor_id' => $vendedorId,
            ],
            'isLoggedIn' => true,
        ]);


        return redirect()->to('/')->with('success', 'Bienvenido ' . $usuario['nombres']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Sesión cerrada correctamente');
    }
}
