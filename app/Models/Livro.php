<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
	
	protected $primaryKey = 'codl';
	protected $fillable = ['titulo', 'editora', 'edicao', 'ano_publicacao', 'valor', 'isbn'];
	
	protected static function boot()
	{
		parent::boot();

		static::deleting(function ($livro) {
			$livro->assuntos()->detach();
		});
	}

	public function assuntos()
    {
	    return $this->belongsToMany(Assunto::class, 'livro_assuntos');
    }
	
	public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autores')->using(LivroAutor::class);
    }	
	
    public function getValorAttribute($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }


    public function setValorAttribute($value)
    {
		$this->attributes['valor'] = str_replace(',', '.', str_replace('R$', '', $value));
    }	
	
}
