<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseModel extends Model
{
    protected $table      = 'clase';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'grado', 'user'];
}
