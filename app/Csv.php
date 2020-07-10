<?php

namespace App;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Csv extends Model
{
    public function findCsvList($tableName)
    {
        echo 'start';
        (new \App\Debug())->start();
        // csv読み込み
        $file = database_path() . '/masters/master_versions.csv';
        //$file = 'https://docs.google.com/spreadsheets/d/1815gXNaSav2GtUi0ve2ZEVMcTgcga3w5aZQL6-RhyVs/edit#gid=0';
        // SQL文作成
        echo $file;
        $config = new LexerConfig();
        $config->setDelimiter(',');
        $list = [];
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function (array $row) use (&$list) {
            $list[] = $row;
        });


        $lexer->parse($file, $interpreter);
        foreach ($list as $row) {
            echo $row[0];
            echo $row[1];
            echo $row[2];
            echo $row[3];
        }


    }
}
