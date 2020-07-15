<?php

use Illuminate\Database\Seeder;
use App\Csv;

class MasterVersionsTableSeeder extends Seeder
{
    private $tableName = 'master_versions';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new Csv($this->tableName);
        $csv->csvMasterInsert();
    }
}
