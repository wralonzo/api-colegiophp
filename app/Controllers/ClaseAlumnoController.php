<?php

namespace App\Controllers;

use App\Models\ClaseAlumnoModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ClaseAlumnoController extends ResourceController
{
    protected $modelName = 'App\Models\ClaseAlumnoModel';
    protected $format    = 'json';

    // Métodos similares a AlumnoController...
    public function index()
    {
        try {
            $data = $this->model->getAll();
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener los alumnos: ' . $e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $data = $this->model->find($id);
            if (!$data) {
                return $this->failNotFound('Alumno no encontrado');
            }
            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener el alumno: ' . $e->getMessage());
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
            return $this->failServerError('Error al crear el alumno: ' . $e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true); // Obtiene datos como array
            if (!$this->model->find($id)) {
                return $this->failNotFound('Alumno no encontrado');
            }
            if ($this->model->update($id, $data)) {
                return $this->respond($data, 200);
            }
            return $this->failValidationErrors($this->model->errors());
        } catch (Exception $e) {
            return $this->failServerError('Error al actualizar el alumno: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if (!$this->model->find($id)) {
                return $this->failNotFound('Alumno no encontrado');
            }
            if ($this->model->delete($id)) {
                return $this->respondDeleted('Alumno eliminado');
            }
            return $this->failServerError('Error al eliminar el alumno');
        } catch (Exception $e) {
            return $this->failServerError('Error al eliminar el alumno: ' . $e->getMessage());
        }
    }

        // Métodos similares a AlumnoController...
        public function indexGrado($id)
        {
            try {
                $data = $this->model->getGrado($id);
                return $this->respond($data, 200);
            } catch (Exception $e) {
                return $this->failServerError('Error al obtener los alumnos: ' . $e->getMessage());
            }
        }
}
