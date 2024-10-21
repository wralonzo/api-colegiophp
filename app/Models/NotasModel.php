<?php

namespace App\Models;

use CodeIgniter\Model;

class NotasModel extends Model
{
    protected $table      = 'notas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['alumno', 'clase', 'nota', 'estado', 'created_at', 'updated_at'];
}
