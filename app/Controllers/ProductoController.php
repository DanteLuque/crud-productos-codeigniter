<?php

namespace App\Controllers;

use App\Models\Producto;

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

      return view('productos/editar', $data);
    }
  }

  public function saveDB()
  {
    $producto = new Producto();

    $nombre = $this->request->getVar('nombre');
    $descripcion = $this->request->getVar('descripcion');
    $precio = $this->request->getVar('precio');
    $descuento = $this->request->getVar('descuento');

    $imagen = $this->request->getFile('imagen');

    if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
      $newNameImage = $imagen->getRandomName();
      $imagen->move('../public/uploads/', $newNameImage);
      $imagenNombre = $newNameImage;
    } else {
      $imagenNombre = null;
    }

    $registro = [
      'nombre' => $nombre,
      'imagen' => $imagenNombre,
      'descripcion' => $descripcion,
      'precio' => $precio,
      'descuento' => $descuento
    ];

    $producto->insert($registro);
    return $this->response->redirect(base_url('/'));
  }


  public function deleteDB($id = null)
  {
    $producto = new Producto();

    $datosProducto = $producto->where('id', $id)->first();

    if ($datosProducto['imagen'] != '' && $datosProducto['imagen'] != null) {
      $rutaImagen = '../public/uploads/' . $datosProducto['imagen'];
      if (file_exists($rutaImagen))
        unlink($rutaImagen); //eliminando archivo fisico del servidor
    }

    $producto->where('id', $id)->delete($id);

    return $this->response->redirect(base_url('/'));
  }

  public function updateDB($id = null)
  {
    $producto = new Producto();
    $actual = $producto->find($id);

    if (!$actual) return redirect()->to(base_url('/'));
    
    $data = [
      'nombre'     => $this->request->getPost('nombre'),
      'descripcion' => $this->request->getPost('descripcion'),
      'precio'     => (float) $this->request->getPost('precio'),
      'descuento'  => (int) ($this->request->getPost('descuento') ?? 0),
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
