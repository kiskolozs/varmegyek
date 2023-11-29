<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCounties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-counties {fileName} {dataBase?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A megadott csv filet importálja a vármegyéket a megadott adatbazisba';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = $this->argument('fileName');
        $csvData = $this->getCsvData($fileName);
        var_dump($csvData);
        return 0;

        $schemaName = $this->argument('name') ?: config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";

        try {
            DB::statement($query);
            echo "$schemaName database has been created.";
        }
        catch (Exception $e) {
            $e->getMessage();
        }

        config(["database.connections.mysql.database" => $schemaName]);
    }
    private function getCsvData($fileName,$withHeader = true)
    {
        if (!file_exists($fileName)) {
            $this->error("A $fileName nem létezik!");
            return false;
        }
        $csvFIle = fopen($fileName,"r");
        $header = fgetcsv($csvFIle);
        if ($withHeader) {
            $line[] = $header;
        }
        else { $line = [];}
        while (!feof($csvFIle)) {
            $line = fgetcsv($csvFIle);
            $lines[] = $line;
        }
        fclose($csvFIle);
        return $lines;
        
    }
}
