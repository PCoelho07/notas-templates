<?php

namespace App\Client;

use App\Model;

class Role extends Model
{
    protected $table = 'client_roles';


    public function templates()
    {
    	return $this->hasMany('App\Template', 'client_roles_id');
    }

    public function clients()
    {
    	return $this->belongsToMany('App\Client\Role', 'client_qualification', 'role_id', 'client_id');;
    }
}
