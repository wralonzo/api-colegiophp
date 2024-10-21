<?php

namespace App\Controllers;

use App\Models\ClaseModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ClaseController extends ResourceController
{
    protected $modelName = 'App\Models\ClaseModel';
    protected $format    = 'json';

    // Métodos similares a AlumnoController...
    public function index()
    {
        try {
            $data = $this->model->findAll();
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener los recurso: ' . $e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $data = $this->model->find($id);
            if (!$data) {
                return $this->failNotFound('Recurso no encontrado');
            }
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener el recurso: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true); // Obtiene datos como array
            if ($this->model->insert($data)) {
                return $this->respondCreated($data);
            }
            return $this->failValidationErrors($this->model->errors());
        } catch (Exception $e) {
            return $this->failServerError('Error al crear el recurso: ' . $e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true); // Obtiene datos como array
            if (!$this->model->find($id)) {
                return $this->failNotFound('Recurso no encontrado');
            }
            if ($this->model->update($id, $data)) {
                return $this->respond($data, 200);
            }
            return $this->failValidationErrors($this->model->errors());
        } catch (Exception $e) {
            return $this->failServerError('Error al actualizar el recurso: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound('Recurso no encontrado');
            }
            if ($this->model->delete($id)) {
                return $this->respondDeleted('Recurso eliminado');
            }
            return $this->failServerError('Error al eliminar el recurso');
        } catch (Exception $e) {
            return $this->failServerError('Error al eliminar el recurso: ' . $e->getMessage());
        }
    }
}
