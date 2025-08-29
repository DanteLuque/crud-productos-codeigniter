<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rol = session('user.rol') ?? null;

        if (!$rol) {
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión');
        }

        if (!in_array($rol, $arguments)) {
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder a esta sección');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nada >:D porque... si pasó es porque tiene permisos bajo su rol xd
    }
}
