<?php

namespace App;

class Client extends Model
{
    protected $dates = [
        'born_in',
        'document_expires_in',
        'married_in',
        'created_at',
        'updated_at',
    ];

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class);
    }

    public static function maskDocument($number)
    {
        $number = str_split($number);
        $result = '';

        if (count($number) == 14) {
            $mask = str_split('##.###.###/####-##');
        }

        if (count($number) == 11) {
            $mask = str_split('###.###.###-##');
        }

        foreach ($mask as $position) {
            $result .= $position == '#' ? array_shift($number) : $position;
        }

        return $result;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Client\Role', 'client_qualification', 'client_id', 'role_id')->withTimestamps();
    }

    public function templates()
    {
        return $this->belongsToMany('App\Template', 'client_qualification', 'client_id', 'template_id')->withTimestamps();
    }

    public function getTableColumns() {
        return $this->getConnection()
                        ->getSchemaBuilder()
                        ->getColumnListing($this->getTable());
    }
}
