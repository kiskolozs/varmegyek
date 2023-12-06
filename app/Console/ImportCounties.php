<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Varmegye;
 
class ImportCounties extends Command
{
    protected $signature = 'app:import-counties {filename} {database_name?}';
    protected $description = 'CSV-ből importál az adatbázisba.';
 
    public function handle()
    {
        $filename = $this->argument('filename');
        $databaseName = $this->argument('database_name') ?? config('database.default');
 
        $csvData = $this->getCsvData($filename);
 
        if (!$csvData) {
            return;
        }
 
        foreach ($csvData as $row) {
            $this->importCounty($row, $databaseName);
        }
 
        $this->info('Sikeresen imporálta!');
    }
 
    private function getCsvData($filename, $withHeader = true)
    {
        if (!file_exists($filename)) {
            echo "$filename nem található";
            return false;
        }
 
        $csvfile = fopen($filename, 'r');
        $header = fgetcsv($csvfile);
 
        if (!$withHeader) {
            $lines = [];
        } else {
            $lines[] = $header;
        }
 
        while (!feof($csvfile)) {
            $line = fgetcsv($csvfile);
            $lines[] = $line;
        }
 
        fclose($csvfile);
        return $lines;
    }
   
    private function turncate ($table)
    {
        try
        {
            DB::statement("TURNCATE TABLE $table;");
            $this->info("$table table has been turncated.");
        }
        catch(Exeption $e)
        {
            $this->error($e->getMessage());
        }
    }
 
    private function importCounty($row, $databaseName)
    {
   
        if (is_array($row)) {
          $countyName = $row[0];
            if (!empty($countyName)) {            
            $existingCounty = Varmegye::find(['name' => $countyName]);
 
            if (!$existingCounty) {
                // If it doesn't exist, insert it into the database
             
                Varmegye::create(['name' => $countyName]);
                $this->info('Vármegye hozzáadva: ' . $countyName);
            } else {
                // If it already exists, log it
                $this->info('Már létezik: ' . $countyName);
            }
        } else {
            // Log a warning if the county name is empty
            $this->warn('Ures a varmegye.');
        }
    } else {
        // Log a warning if $row is not a valid array
        $this->warn('HIbas sor.');
    }
   
 
    /*
    * The name and signature of the console command.
    *
    * @var string
    */
 
   /**
    * The console command description.
    *
    * @var string
    */
}
 
}