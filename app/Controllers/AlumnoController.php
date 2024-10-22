<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class AlumnoController extends ResourceController
{
    protected $modelName = 'App\Models\AlumnoModel';
    protected $format    = 'json';

    public function index()
    {
        try {
            $data = $this->model->findAll();
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
    // Método para obtener alumnos por clase
    public function alumnosPorClase()
    {
        try {
            $parametro = $this->request->getGet('clase');
            $result = $this->model->getAlumnosPorClase($parametro);

            if (empty($result)) {
                return $this->respond([], 200);
            }
            return $this->respond($result, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener los alumnos por clase: ' . $e->getMessage());
        }
    }
}
