<?php

namespace Database\Seeders;

use App\Models\Helyseg;
use App\Models\Szalloda;
use App\Models\Tavasz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TravelSeeder extends Seeder
{
    public function run(): void
    {
        $helysegek = $this->readTsv('helyseg.txt', true);
        foreach ($helysegek as $sor) {
            if (count($sor) < 3) {
                continue;
            }

            Helyseg::updateOrCreate(
                ['az' => trim($sor[0])],
                ['nev' => trim($sor[1]), 'orszag' => trim($sor[2])]
            );
        }

        $szallodak = $this->readTsv('szalloda.txt', true);
        foreach ($szallodak as $sor) {
            if (count($sor) < 7) {
                continue;
            }

            Szalloda::updateOrCreate(
                ['az' => trim($sor[0])],
                [
                    'nev' => trim($sor[1]),
                    'besorolas' => (int) $sor[2],
                    'helyseg_az' => trim($sor[3]),
                    'tengerpart_tav' => (int) $sor[4],
                    'repter_tav' => (int) $sor[5],
                    'felpanzio' => (bool) (int) $sor[6],
                ]
            );
        }

        // A tavaszi ajánlatok ismételt seedeléskor sem sokszorozódnak meg.
        DB::table('tavasz')->delete();
        $ajanlatok = $this->readTsv('tavasz.txt', true);
        foreach ($ajanlatok as $sor) {
            if (count($sor) < 4) {
                continue;
            }

            Tavasz::create([
                'szalloda_az' => trim($sor[0]),
                'indulas' => str_replace('.', '-', trim($sor[1])),
                'idotartam' => (int) $sor[2],
                'ar' => (int) $sor[3],
            ]);
        }
    }

    /** @return array<int, array<int, string>> */
    private function readTsv(string $filename, bool $hasHeader): array
    {
        $path = database_path('data/'.$filename);
        if (! is_file($path)) {
            throw new RuntimeException('Hiányzó adatforrás: '.$path);
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new RuntimeException('Nem olvasható adatforrás: '.$path);
        }

        if ($hasHeader) {
            array_shift($lines);
        }

        $rows = [];
        foreach ($lines as $line) {
            $rows[] = str_getcsv(rtrim($line, "\r\n"), "\t", '"', '\\');
        }

        return $rows;
    }
}
