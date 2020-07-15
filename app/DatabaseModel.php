<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseModel extends Model
{
    /**
     * カラム名を一覧取得
     *
     * @param string $file
     * @return array
     */
    public function findColumnList($file)
    {
        $f = fopen($file, 'r');
        $header = fgetcsv($f);
        fclose($f);

        return $header;
    }

    /**
     * eloquentで取得するカラム名をキャメルケースに変更
     *
     * @param array $outputColumnList
     * @return array
     */
    public function camelColumnNameList($outputColumnList = [])
    {
        $file = database_path() . "/masters/{$this->table}.csv";
        $columnList = $this->findColumnList($file);

        $convert = new Convert();
        $camelColumnList = [];
        foreach ($columnList as $column) {
            if (empty($outputColumnList) || in_array($column, $outputColumnList)) {
                $newColumnName = lcfirst($convert->snakeToCamel($column));
                $camelColumnList[] = "{$column} as {$newColumnName}";
            }
        }

        return $camelColumnList;
    }
}
