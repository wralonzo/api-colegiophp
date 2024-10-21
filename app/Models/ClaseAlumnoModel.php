<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseAlumnoModel extends Model
{
    protected $table      = 'clasealumno';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['alumno', 'clase', 'estado', 'aprobado', 'created_at', 'updated_at'];
}
