<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Mantenimiento\CatProducto;

class ProductoController extends BaseController
{
  public function index(): string
  {
    $producto = new Producto();
    $data['productos'] = $producto->listar();
    return view('productos/listar', $data);
  }

  public function crear(): string
  {
    $catModel = new CatProducto();
    $data['categorias'] = $catModel->listar();
    return view('productos/crear', $data);
  }

  public function editar($id = null)
  {
    $producto = new Producto();
    $datosProducto = $producto->where('id', $id)->first();
    if (!$datosProducto) return redirect()->to(base_url('/'));

    $data['producto'] = $datosProducto;
    $catModel = new CatProducto();
    $data['categorias'] = $catModel->listar();

    return view('productos/editar', $data);
  }

  public function saveDB()
  {
    $producto = new Producto();
    $producto->crear(
      $this->request->getPost(),
      $this->request->getFile('imagen')
    );
    return redirect()->to(base_url('/'));
  }

  public function updateDB($id = null)
  {
    $producto = new Producto();
    $producto->actualizar(
      $id,
      $this->request->getPost(),
      $this->request->getFile('imagen')
    );
    return redirect()->to(base_url('/'));
  }

  public function deleteDB($id = null)
  {
    $producto = new Producto();
    $producto->eliminar($id);
    return redirect()->to(base_url('/'));
  }
}
