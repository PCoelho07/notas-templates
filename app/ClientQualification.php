<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientQualification extends Model
{
    protected $table = 'client_qualification';

    protected $fillable = [
    	'client_id', 'role_id', 'template_id', 'created_at', 'updated_at'
    ];
}
