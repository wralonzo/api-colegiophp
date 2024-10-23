<?php

namespace App\Controllers;

use App\Models\NotasModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\UsersModel;

class NotasController extends ResourceController
{
    protected $modelName = 'App\Models\NotasModel';
    protected $format    = 'json';

    // Métodos similares a AlumnoController...
    public function index()
    {
        try {
            $data = [];
            $parametro = $this->request->getGet('idUser');
            $userModel = new UsersModel();
            $user = $userModel->find($parametro);
            if ($user) {
                if ($user['role'] == 'Padre') {
                    $data = $this->model->getAllByUser($user['id']);
                }
                $data = $this->model->getAll();
                return $this->respond($data, 200);
            } else {
                $data = $this->model->getAll();
                return $this->respond($data, 200);
            }

            return $this->respond($data, 200);
        } catch (Exception $e) {
            return $this->failServerError('Error al obtener los recursos: ' . $e->getMessage());
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
