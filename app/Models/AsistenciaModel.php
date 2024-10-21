<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $table      = 'asistencia';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['clase', 'alumno', 'estado', 'created_at', 'updated_at'];
}
