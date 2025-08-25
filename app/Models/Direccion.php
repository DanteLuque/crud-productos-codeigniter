<?php

namespace App\Models;

class Direccion extends BaseModel
{
    protected $table      = 'direcciones';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cliente_id',
        'vendedor_id',
        'ubigeo',
        'direccion',
        'referencia',
        'lat',
        'lng',
    ];

    public function crear(array $data): int
    {
        return $this->insert($data, true);
    }

    public function actualizar(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function eliminar(int $id): bool
    {
        return $this->delete($id);
    }

    public function listarPorCliente(int $clienteId): array
    {
        return $this->where('cliente_id', $clienteId)->findAll();
    }

    public function listarPorVendedor(int $vendedorId): array
    {
        return $this->where('vendedor_id', $vendedorId)->findAll();
    }
}
