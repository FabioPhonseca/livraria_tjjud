<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
	
	protected $table = 'autores';
	protected $primaryKey = 'codau';
	protected $fillable = ['nome'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($autor) {
            if ($autor->livros()->count() > 0) {
                throw new \Exception('Não é possível excluir um autor que possui livros associados.');
            }
        });
    }
	
	public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autores');
    }
}
