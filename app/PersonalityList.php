<?php

namespace App;

class PersonalityList extends DatabaseModel
{
    protected $table = 'master_personalities';

    public function getStatusMagnificationsAttributes($value)
    {
        return json_decode($value);
    }
}
