<?php

namespace App;

class BookList extends DatabaseModel
{
    protected $table = 'master_books';

    public function getSkillIdsAttribute($value)
    {
        return json_decode($value);
    }

    public function getBaseStatsAttribute($value)
    {
        return json_decode($value);
    }
}
