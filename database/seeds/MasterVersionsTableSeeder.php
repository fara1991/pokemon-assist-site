<?php

use Illuminate\Database\Seeder;
use App\Csv;

class MasterVersionsTableSeeder extends Seeder
{
    protected $columnList;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->columnList = $this->getHead();
        $csv = new Csv();
        $csv->findCsvList('master_versions');
    }

    private function getHead() {
        return ['id', 'version_id', 'name', 'short_name',];
    }
}
