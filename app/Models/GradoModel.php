<?php

namespace App\Models;

use CodeIgniter\Model;

class GradoModel extends Model
{
    protected $table      = 'grado';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre'];
}
