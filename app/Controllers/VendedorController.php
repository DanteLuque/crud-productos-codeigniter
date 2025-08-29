<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Vendedor;
use App\Models\Direccion;

class VendedorController extends BaseController
{
    public function saveDB()
    {
        helper('validation');
        $errors = [];
        $errors = array_merge($errors, runValidation('usuario', $this->request));
        $errors = array_merge($errors, runValidation('vendedor', $this->request));
        $errors = array_merge($errors, runValidation('direccion', $this->request));
        if (!empty($errors)) return redirect()->back()->withInput()->with('errors', $errors);

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $usuarioModel = new Usuario();
            $usuarioId = $usuarioModel->crear([
                'nombres'   => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'username'  => $this->request->getPost('username'),
                'userpass'  => $this->request->getPost('userpass'),
                'premium'   => 0,
                'rol'       => 'VENDEDOR'
            ]);
            if (!$usuarioId) throw new \Exception("Error al crear usuario");

            $vendedorModel = new Vendedor();
            $vendedorId = $vendedorModel->crear([
                'usuario_id'        => $usuarioId,
                'email'             => $this->request->getPost('email'),
                'ruc'               => $this->request->getPost('ruc'),
                'telefono'          => $this->request->getPost('telefono'),
                'nombre_tienda'     => $this->request->getPost('nombre_tienda'),
                'descripcion'       => $this->request->getPost('descripcion'),
            ]);
            if (!$vendedorId) throw new \Exception("Error al crear Vendedor");

            $direccionModel = new Direccion();
            $direccionId = $direccionModel->crear([
                'vendedor_id' => $vendedorId,
                'ubigeo'     => $this->request->getPost('distrito'),
                'direccion'  => $this->request->getPost('direccion'),
                'referencia' => $this->request->getPost('referencia'),
                'lat'        => $this->request->getPost('lat'),
                'lng'        => $this->request->getPost('lng'),
            ]);
            if (!$direccionId) throw new \Exception("Error al crear dirección");

            $db->transCommit();
            return redirect()->to('/auth/login')->with('success', 'Vendedor registrado con éxito');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Hubo un error: ' . $e->getMessage());
        }
    }
}
