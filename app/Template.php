<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';

    protected $fillable = [
    	'client_roles_id', 'text_template', 'created_at', 'updated_at', 'nome', 'tokens'
    ];

    protected $casts = [
    	'tokens' => 'array',
    ];

 	public function roles()
   	{
   		return $this->belongsTo('App\Client\Role', 'client_roles_id');
   	}   
}
