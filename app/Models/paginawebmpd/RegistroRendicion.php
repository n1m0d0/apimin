<?php

namespace App\Models\paginawebmpd;

use Illuminate\Database\Eloquent\Model;

class RegistroRendicion extends Model
{
    protected $connection= 'registro';
    protected $table = 'registro_rendicion';
    public $timestamps = false;
    protected $guarded = ['id'];
    
}
    