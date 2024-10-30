<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AsistenciaModel extends Model
{
    protected $table      = 'asistencia';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['clase', 'alumno', 'estado', 'created_at', 'updated_at'];

    public function getAll()
    {
        try {
            $this->select('asistencia.id,
            asistencia.alumno,
            asistencia.estado,
            asistencia.clase,
            asistencia.created_at,
            clase.id as idClase,
            clase.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('clase', 'clase.id = asistencia.clase');
            $this->join('alumno', 'alumno.id = asistencia.alumno');
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }

    public function getAllByUser($idUser)
    {
        try {
            $this->select('asistencia.id,
            asistencia.alumno,
            asistencia.estado,
            asistencia.clase,
            asistencia.created_at,
            clase.id as idClase,
            clase.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('clase', 'clase.id = asistencia.clase');
            $this->join('alumno', 'alumno.id = asistencia.alumno');
            $this->where('alumno.user', $idUser);
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }

    public function getAllByAlumno($idUser)
    {
        try {
            $this->select('asistencia.id,
            asistencia.alumno,
            asistencia.estado,
            asistencia.clase,
            asistencia.created_at,
            clase.id as idClase,
            clase.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('clase', 'clase.id = asistencia.clase');
            $this->join('alumno', 'alumno.id = asistencia.alumno');
            $this->where('alumno.id', $idUser);
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }
}
