<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LivroAutor extends Pivot
{
	public $timestamps = false;
    protected $table = 'livro_autores';
}
