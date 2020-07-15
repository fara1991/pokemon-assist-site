<?php

namespace App;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\InvalidDataSetException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class Csv extends Model
{
    private $tableName = '';
    private $columnList = [];
    private $csvData = [];

    /**
     * Csv constructor.
     * @param string $tableName
     * @param array $attributes
     */
    public function __construct($tableName, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->tableName = $tableName;
        $file = database_path() . "/masters/{$this->tableName}.csv";
        $this->validateFile($file);
        $this->columnList = (new DatabaseModel())->findColumnList($file);

        $this->csvData = $this->csvDataList($file);
        $this->validateData();
    }

    /**
     * csvデータをテーブルにInsert
     * マスタデータなので毎回データ全削除してからInsertして常に最新状態にする
     */
    public function csvMasterInsert()
    {
        DB::table($this->tableName)->truncate();
        DB::table($this->tableName)->insert($this->csvData);
    }

    /**
     * ファイルの存在チェック
     *
     * @param string $file
     */
    private function validateFile($file)
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException('指定のファイルが存在しない');
        }
    }

    /**
     * データチェック
     */
    private function validateData()
    {
        if (empty($this->csvData)) {
            throw new InvalidDataSetException('csvデータが存在しない');
        }
    }

    /**
     * データ一覧を取得
     *
     * @param string $file
     * @return array
     */
    private function csvDataList(string $file): array
    {
        // csv出力設定
        $config = new LexerConfig();
        $config
            ->setDelimiter(',')
            ->setFromCharset('UTF-8')
            ->setToCharset('UTF-8')
            ->setIgnoreHeaderLine(true);
        $lexer = new Lexer($config);

        // SQLパラメータ作成
        $queryValues = [];
        $interpreter = new Interpreter();
        $interpreter->addObserver(function (array $row) use (&$queryValues) {
            $list = [];
            for ($i = 0, $count = count($this->columnList); $i < $count; ++$i) {
                $columnName = $this->columnList[$i];
                $list[$columnName] = $this->setValue($row[$i]);
            }
            $queryValues[] = $list;
        });

        // csvを1行ずつ読み込みメモリを効率よく使う
        $lexer->parse($file, $interpreter);
        return $queryValues;
    }

    /**
     * テーブルに登録する形式にして値を設定
     *
     * @param int|string $value
     * @return bool
     */
    private function setValue($value)
    {
        if (strpos($value, ",") !== false) {
            $jsonValue = ['list' => explode(',', $value)];
            return json_encode($jsonValue, JSON_UNESCAPED_UNICODE);
        } else {
            return $value;
        }
    }
}
