<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{
    /**
     *  スネークケース → キャメルケース
     *
     * @param string $name
     * @return string
     */
    public function snakeToCamel($name)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }

    /**
     * キャメルケース → スネークケース
     *
     * @param string $name
     * @return string
     */
    public function camelToSnake($name)
    {
        return strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($name)));
    }
}
