<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
    ];

    // Relación con el modelo Medicamento
    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class, 'id_categoria', 'id');
    }
}
