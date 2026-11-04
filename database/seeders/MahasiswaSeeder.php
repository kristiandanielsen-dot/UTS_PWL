<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [
            ['23100013', 'RYAN FEBRIANTO'],
            ['23100001', 'KELIO XENELLY'],
            ['23100002', 'ALVIN VALENTINO'],
            ['23100006', 'DHAVID BHERTUS'],
            ['23100007', 'ALDO RIVALDI'],
            ['23100009', 'FELIX FILBERT'],
            ['23100010', 'VITA'],
            ['23100011', 'CELLO FIBRYAN GIRL'],
            ['23100015', 'WENDI'],
            ['23100017', 'BRYAN HENRILSEN'],
            ['23100018', 'FERNANDO JOCEVINE'],
            ['23100021', 'STEVEN EDMUND PRATAMA'],
            ['23100022', 'JACKY FERNANDO'],
            ['23100023', 'STENLY KURNIAWAN'],
            ['23100027', 'RONNEY PANGNATHAN'],
        ];

        foreach ($mahasiswa as $item) {
            DB::table('mahasiswas')->insertOrIgnore([
                'id' => (string) Str::uuid(),
                'NIM' => $item[0],
                'name' => $item[1],
                'jurusan' => 'Sistem dan Teknologi Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
