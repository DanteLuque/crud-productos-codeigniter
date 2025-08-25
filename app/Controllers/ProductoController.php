<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Mantenimiento\CatProducto;

class ProductoController extends BaseController
{
  public function index(): string
  {
    $data['header'] = view('Layouts/header');
    $data['footer'] = view('Layouts/footer');

    $producto = new Producto();
    $data['productos'] = $producto->orderBy('id', 'ASC')->findAll();

    return view('productos/listar', $data);
  }

  public function crear(): string
  {
    $data['header'] = view('Layouts/header');
    $data['footer'] = view('Layouts/footer');

    $catModel = new CatProducto();
    $data['categorias'] = $catModel->where('deleted_at', null)->findAll();

    return view('productos/crear', $data);
  }

  public function editar($id = null)
  {
    $producto = new Producto();
    $datosProducto = $producto->where('id', $id)->first();

    if (!$datosProducto) {
      return $this->response->redirect(base_url('/'));
    } else {
      $data['header'] = view('Layouts/header');
      $data['footer'] = view('Layouts/footer');
      $data['producto'] = $datosProducto;

      $catModel = new CatProducto();
      $data['categorias'] = $catModel->where('deleted_at', null)->findAll();

      return view('productos/editar', $data);
    }
  }

  public function saveDB()
  {
    $producto = new Producto();

    $imagen = $this->request->getFile('imagen');
    $imagenNombre = null;

    if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
      $newNameImage = $imagen->getRandomName();
      $imagen->move(FCPATH . 'uploads/', $newNameImage);
      $imagenNombre = $newNameImage;
    }

    $registro = [
      'nombre'       => $this->request->getPost('nombre'),
      'imagen'       => $imagenNombre,
      'descripcion'  => $this->request->getPost('descripcion'),
      'precio'       => (float) $this->request->getPost('precio'),
      'descuento'    => (int) ($this->request->getPost('descuento') ?? 0),
      'categoria_id' => (int) $this->request->getPost('categoria_id')
    ];

    $producto->insert($registro);
    return $this->response->redirect(base_url('/'));
  }

  public function softDeleteDB($id = null)
  {
    $producto = new Producto();
    $datosProducto = $producto->find($id);

    if (!$datosProducto) {
      return redirect()->to(base_url('/'));
    }

    if (!empty($datosProducto['imagen'])) {
      $uploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR;
      $trashDir  = FCPATH . 'trash' . DIRECTORY_SEPARATOR;

      if (!is_dir($trashDir)) {
        mkdir($trashDir, 0755, true);
      }

      $oldPath = $uploadDir . $datosProducto['imagen'];
      $newPath = $trashDir . $datosProducto['imagen'];

      if (is_file($oldPath)) {
        rename($oldPath, $newPath);
      }
    }

    $producto->delete($id);
    return redirect()->to(base_url('/'));
  }


  public function deleteDB($id = null)
  {
    $producto = new Producto();
    $datosProducto = $producto->find($id);

    if ($datosProducto && !empty($datosProducto['imagen'])) {
      $rutaImagen = FCPATH . 'uploads/' . $datosProducto['imagen'];
      if (is_file($rutaImagen)) {
        unlink($rutaImagen);
      }
    }

    $producto->delete($id);
    return $this->response->redirect(base_url('/'));
  }

  public function updateDB($id = null)
  {
    $producto = new Producto();
    $actual = $producto->find($id);

    if (!$actual) return redirect()->to(base_url('/'));

    $data = [
      'nombre'       => $this->request->getPost('nombre'),
      'descripcion'  => $this->request->getPost('descripcion'),
      'precio'       => (float) $this->request->getPost('precio'),
      'descuento'    => (int) ($this->request->getPost('descuento') ?? 0),
      'categoria_id' => (int) $this->request->getPost('categoria_id')
    ];

    $imagen = $this->request->getFile('imagen');
    if ($imagen && $imagen->isValid() && $imagen->getSize() > 0) {
      $newName = $imagen->getRandomName();
      $uploadDir = FCPATH . 'uploads';
      $imagen->move($uploadDir, $newName);

      $data['imagen'] = $newName;

      if (!empty($actual['imagen'])) {
        $old = $uploadDir . DIRECTORY_SEPARATOR . $actual['imagen'];
        if (is_file($old)) @unlink($old);
      }
    }

    $producto->update($id, $data);
    return redirect()->to(base_url('/'));
  }
}
