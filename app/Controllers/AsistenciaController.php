<?php

namespace App\Controllers;

use App\Models\AsistenciaModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class AsistenciaController extends ResourceController
{
    protected $modelName = 'App\Models\AsistenciaModel';
    protected $format    = 'json';

    public function index()
    {
        try {
            $data = $this->model->findAll();
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener las asistencias: ' . $e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $data = $this->model->find($id);
            if (!$data) {
                return $this->failNotFound('Asistencia no encontrada');
            }
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener la asistencia: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true); 
            if ($this->model->insert($data)) {
                return $this->respondCreated($data);
            }
            return $this->failValidationErrors($this->model->errors());
        } catch (Exception $e) {
            return $this->failServerError('Error al crear la asistencia: ' . $e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true); 
            if (!$this->model->find($id)) {
                return $this->failNotFound('Asistencia no encontrada');
            }
            if ($this->model->update($id, $data)) {
                return $this->respond($data, 200);
            }
            return $this->failValidationErrors($this->model->errors());
        } catch (Exception $e) {
            return $this->failServerError('Error al actualizar la asistencia: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound('Asistencia no encontrada');
            }
            if ($this->model->delete($id)) {
                return $this->respondDeleted('Asistencia eliminada');
            }
            return $this->failServerError('Error al eliminar la asistencia');
        } catch (Exception $e) {
            return $this->failServerError('Error al eliminar la asistencia: ' . $e->getMessage());
        }
    }
}
