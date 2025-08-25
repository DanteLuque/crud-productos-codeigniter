<?php
namespace App\Controllers;

use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Provincia;
use App\Models\Ubigeo\Distrito;

class UbigeoController extends BaseController
{
    public function departamentos()
    {
        $model = new Departamento();
        return $this->response->setJSON($model->listar());
    }

    public function provincias($departamentoId)
    {
        $model = new Provincia();
        return $this->response->setJSON($model->listarPorDepartamento((int)$departamentoId));
    }

    public function distritos($provinciaId)
    {
        $model = new Distrito();
        return $this->response->setJSON($model->listarPorProvincia((int)$provinciaId));
    }
}
