<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Direccion;

class ClienteController extends BaseController
{
    public function saveDB()
    {
        helper('validation');
        $errors = [];
        $errors = array_merge($errors, runValidation('usuario', $this->request));
        $errors = array_merge($errors, runValidation('cliente', $this->request));
        $errors = array_merge($errors, runValidation('direccion', $this->request));
        if (!empty($errors)) return redirect()->back()->withInput()->with('errors', $errors);
        
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $usuarioModel = new Usuario();
            $usuarioId = $usuarioModel->crear([
                'nombres'   => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'tipo_doi_id' => $this->request->getPost('tipo_doi_id'),
                'num_doi'   => $this->request->getPost('num_doi'),
                'username'  => $this->request->getPost('username'),
                'userpass'  => $this->request->getPost('userpass'),
                'premium'   => 0,
            ]);
            if (!$usuarioId) throw new \Exception("Error al crear usuario");

            $clienteModel = new Cliente();
            $clienteId = $clienteModel->crear([
                'usuario_id' => $usuarioId,
                'email'      => $this->request->getPost('email'),
                'telefono'   => $this->request->getPost('telefono'),
            ]);
            if (!$clienteId) throw new \Exception("Error al crear cliente");

            $direccionModel = new Direccion();
            $direccionId = $direccionModel->crear([
                'cliente_id' => $clienteId,
                'ubigeo'     => $this->request->getPost('distrito'),
                'direccion'  => $this->request->getPost('direccion'),
                'referencia' => $this->request->getPost('referencia'),
                'lat'        => $this->request->getPost('lat'),
                'lng'        => $this->request->getPost('lng'),
            ]);
            if (!$direccionId) throw new \Exception("Error al crear dirección");

            $db->transCommit();
            return redirect()->to('/auth/login')->with('success', 'Cliente registrado con éxito');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Hubo un error: ' . $e->getMessage());
        }
    }
}
