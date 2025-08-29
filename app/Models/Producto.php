<?php

namespace App\Models;

class Producto extends BaseModel
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre',
        'imagen',
        'descripcion',
        'precio',
        'descuento',
        'categoria_id',
        'vendedor_id'
    ];

    public function listar(): array
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    public function obtenerPorId($id)
    {
        return $this->where('id', $id)->first();
    }

    public function obtenerPorVendedorId($vendedorId){
        return $this->where('vendedor_id',$vendedorId)->findAll();
    }

    public function crear(array $data, $imagenFile = null): int
    {
        if ($imagenFile && $imagenFile->isValid() && !$imagenFile->hasMoved()) {
            $newName = $imagenFile->getRandomName();
            $imagenFile->move(FCPATH . 'uploads/', $newName);
            $data['imagen'] = $newName;
        }

        $data['precio'] = (float) $data['precio'];
        $data['descuento'] = (int) ($data['descuento'] ?? 0);

        return $this->insert($data, true);
    }

    public function actualizar(int $id, array $data, $imagenFile = null): bool
    {
        $producto = $this->find($id);
        if (!$producto) return false;

        if ($imagenFile && $imagenFile->isValid() && $imagenFile->getSize() > 0) {
            $newName = $imagenFile->getRandomName();
            $imagenFile->move(FCPATH . 'uploads/', $newName);

            $data['imagen'] = $newName;

            if (!empty($producto['imagen'])) {
                $old = FCPATH . 'uploads/' . $producto['imagen'];
                if (is_file($old)) @unlink($old);
            }
        }

        $data['precio'] = (float) $data['precio'];
        $data['descuento'] = (int) ($data['descuento'] ?? 0);

        return $this->update($id, $data);
    }

    public function eliminar(int $id): bool
    {
        $producto = $this->find($id);
        if (!$producto) return false;

        if (!empty($producto['imagen'])) {
            $uploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR;
            $trashDir  = FCPATH . 'trash' . DIRECTORY_SEPARATOR;

            if (!is_dir($trashDir)) mkdir($trashDir, 0755, true);

            $oldPath = $uploadDir . $producto['imagen'];
            $newPath = $trashDir . $producto['imagen'];

            if (is_file($oldPath)) rename($oldPath, $newPath);
        }

        return $this->delete($id);
    }
}
