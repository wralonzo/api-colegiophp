<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AlumnoModel extends Model
{
    protected $table      = 'alumno';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'user', 'status', 'created_at', 'updated_at'];


    /**
     * Método para obtener alumnos por clase con INNER JOIN.
     *
     * @param int $claseId ID de la clase para filtrar alumnos.
     * @return array Lista de alumnos asignados a la clase.
     */
    public function getAlumnosPorClase($claseId)
    {
        try {
            // Selecciona los campos que se desean obtener
            $this->select('alumno.id, alumno.name, clasealumno.estado, clasealumno.aprobado');

            // Realiza el join entre las tablas alumno y clasealumno
            $this->join('clasealumno', 'alumno.id = clasealumno.alumno');

            // Filtra por el ID de la clase
            $this->where('clasealumno.clase', $claseId);

            // Ejecuta la consulta y obtiene los resultados
            $result = $this->get()->getResultArray();

            // Retorna los resultados como array
            return $result;
        } catch (Exception $e) {
            // Maneja cualquier excepción que ocurra
            return ['error' => 'Error al obtener los alumnos por clase: ' . $e->getMessage()];
        }
    }
}
