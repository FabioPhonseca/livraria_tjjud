<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;
	
	protected $primaryKey = 'codas';
	protected $fillable = ['descricao']; 
	
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($assunto) {
            if ($assunto->livros()->count() > 0) {
                throw new \Exception('Não é possível excluir um assunto que possui livros associados.');
            }
        });
    }
	
	public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assuntos');
    }
	
}
