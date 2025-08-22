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
    $libro = new Libro();
    $datosLibro = $libro->where('id', $id)->first();

    if (!$datosLibro) {
      return $this->response->redirect(base_url('libros'));
    } else {
      $data['header'] = view('Layouts/header');
      $data['footer'] = view('Layouts/footer');
      $data['libro'] = $datosLibro;

      return view('libros/editar', $data);
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
    $libro = new Libro();
    $datosLibro = $libro->where('id', $id)->first();
    $nombre = $this->request->getVar('nombre');

    if ($imagen = $this->request->getFile('imagen')) {
      $newNameImage = $imagen->getRandomName();
      $imagen->move('../public/uploads/', $newNameImage);

      $newData = [
        'nombre' => $nombre,
        'imagen' => $newNameImage
      ];

      if ($datosLibro['imagen'] != '' && $datosLibro['imagen'] != null) {
        $rutaImagen = '../public/uploads/' . $datosLibro['imagen'];
        if (file_exists($rutaImagen))
          unlink($rutaImagen);
      }

      $libro->update($id, $newData);
      return $this->response->redirect(base_url('libros'));

    }
  }

}

