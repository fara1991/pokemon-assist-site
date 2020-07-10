<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debug extends Model
{
    public function start()
    {
        eval(\Psy\sh());
    }
}
