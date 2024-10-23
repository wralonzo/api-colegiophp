<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class NotasModel extends Model
{
    protected $table      = 'notas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['alumno', 'clase', 'nota', 'estado', 'created_at', 'updated_at'];

    public function getAll()
    {
        try {
            $this->select('notas.id,
            notas.alumno,
            notas.nota,
            notas.clase,
            notas.created_at,
            clase.id as idClase,
            clase.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('clase', 'clase.id = notas.clase');
            $this->join('alumno', 'alumno.id = notas.alumno');
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }

    public function getAllByUser($idUser)
    {
        try {
            $this->select('notas.id,
            notas.alumno,
            notas.nota,
            notas.clase,
            notas.created_at,
            clase.id as idClase,
            clase.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('clase', 'clase.id = notas.clase');
            $this->join('alumno', 'alumno.id = notas.alumno');
            $this->where('alumno.user', $idUser);
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }
}
