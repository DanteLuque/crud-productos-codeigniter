<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Mantenimiento\CatProducto;

class ProductoController extends BaseController
{
  public function index(): string
  {
    $producto = new Producto();
    $user = session('user');

    if ($user && isset($user['vendedor_id'])) {
      $data['productos'] = $producto->obtenerPorVendedorId($user['vendedor_id']);
    } else {
      $data['productos'] = $producto->listar();
    }

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
    $datosProducto = $producto->obtenerPorId($id);
    if (!$datosProducto) return redirect()->to(base_url('/'));

    $data['producto'] = $datosProducto;
    $catModel = new CatProducto();
    $data['categorias'] = $catModel->listar();

    return view('productos/editar', $data);
  }

  public function detail($id = null)
  {
    $producto = new Producto();
    $datosProducto = $producto->obtenerPorId($id);
    if (!$datosProducto) return redirect()->to(base_url('/'));

    $data['producto'] = $datosProducto;
    $catModel = new CatProducto();
    $data['categoria'] = $catModel->obtenerPorId($datosProducto['categoria_id']);

    return view('productos/detail', $data);
  }

  public function saveDB()
  {
    helper('validation');
    $errors = runValidation('producto', $this->request);
    if (!empty($errors)) return redirect()->back()->withInput()->with('errors', $errors);

    try {
      $producto = new Producto();
      $data = $this->request->getPost();
      $data['vendedor_id'] = session('user')['vendedor_id'];

      $producto->crear($data, $this->request->getFile('imagen'));

      return redirect()->to(base_url('/'))->with('success', 'Producto creado correctamente');
    } catch (\Throwable $e) {
      return redirect()->back()->withInput()->with('error', 'Hubo un error: ' . $e->getMessage());
    }
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
