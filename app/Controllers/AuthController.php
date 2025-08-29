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
        $datosCliente = $clienteModel->obtenerPorUsuarioId($usuario['id']);

        $vendedorModel = new Vendedor();
        $datosVendedor = $vendedorModel->obtenerPorUsuarioId($usuario['id']);

        // Guardar sesión
        $session = session();
        $session->set([
            'user_id'  => $usuario['id'],
            'username' => $usuario['username'],
            'rol' => $usuario['rol'],
            'cliente_id'  => $datosCliente['id'] ?? null,
            'vendedor_id' => $datosVendedor['id'] ?? null,
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/')->with('success', 'Bienvenido ' . $usuario['nombres']);
    }
}
