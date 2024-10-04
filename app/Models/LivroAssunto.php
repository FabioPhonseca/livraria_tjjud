<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LivroAssunto extends Pivot
{
	public $timestamps = false;
    protected $table = 'livro_assuntos';
}
