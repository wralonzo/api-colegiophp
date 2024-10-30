<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ClaseAlumnoModel extends Model
{
    protected $table      = 'clasealumno';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['alumno', 'clase', 'estado', 'aprobado', 'created_at', 'updated_at'];

    public function getAll()
    {
        try {
            $this->select('clasealumno.id,
            clasealumno.alumno,
            clasealumno.estado,
            clasealumno.clase,
            clasealumno.created_at,
            clasealumno.aprobado,
            grado.id as idClase,
            grado.nombre as nameClase,
            alumno.id as idAlumno,
            alumno.name as nameAlumno');
            $this->join('grado', 'grado.id = clasealumno.clase');
            $this->join('alumno', 'alumno.id = clasealumno.alumno');
            $result = $this->get()->getResultArray();
            return $result;
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }

    public function getGrado($id)
    {
        try {
            $this->select('clasealumno.id, grado.id as idClase, grado.nombre as gradoActual')
                ->join('clase', 'grado.id = clasealumno.clase')
                ->where('alumno.id', $id)
                ->orderBy('clasealumno.id', 'DESC')
                ->limit(1);

            return $this->get()->getRow();
        } catch (Exception $e) {
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }
}
