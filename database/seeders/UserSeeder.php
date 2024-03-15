<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\JabatanModel;
use App\Models\BiodataModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $users = [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'password' => bcrypt('admin'),
                ],

            ];

            foreach ($users as $user) {
                User::create($user);
            }

            $jabatans = [
                [
                    'kode' => 'BP',
                    'nama_jabatan' => 'Bendahara Pengeluaran',
                ],
                [
                    'kode' => 'BPP',
                    'nama_jabatan' => 'Bendahara Pengeluaran Pembantu',
                ],
                [
                    'kode' => 'KPA',
                    'nama_jabatan' => 'Kuasa Pengguna Anggaran',
                ],
                [
                    'kode' => 'PA',
                    'nama_jabatan' => 'Pengguna Anggaran',
                ],
                [
                    'kode' => 'PPK',
                    'nama_jabatan' => 'Pejabat Pembuat Komitmen',
                ],
                [
                    'kode' => 'PPTK',
                    'nama_jabatan' => 'Pejabat Pelaksana Teknis Kegiatan',
                ],
            ];

            foreach ($jabatans as $jabatan) {
                JabatanModel::create($jabatan);
            }

            // $biodatas = [
            //     [
            //         'user_id' => 2,
            //         'jabatan_id' => 2,
            //         'nama' => 'Bp',
            //         'email' => 'bp@example.com',
            //         'nip' => '123456789012',
            //         'tgl_lahir' => '1990-01-01',
            //         'alamat' => 'Alamat 1',
            //     ],
            //     [
            //         'user_id' => 3,
            //         'jabatan_id' => 3,
            //         'nama' => 'Bpp',
            //         'email' => 'bpp@example.com',
            //         'nip' => '123456789013',
            //         'tgl_lahir' => '1990-01-02',
            //         'alamat' => 'Alamat 2',
            //     ],
            //     [
            //         'user_id' => 4,
            //         'jabatan_id' => 4,
            //         'nama' => 'Kpa',
            //         'email' => 'kpa@example.com',
            //         'nip' => '123456789014',
            //         'tgl_lahir' => '1990-01-02',
            //         'alamat' => 'Alamat 2',
            //     ],
            //     [
            //         'user_id' => 5,
            //         'jabatan_id' => 5,
            //         'nama' => 'Pa',
            //         'email' => 'pa@example.com',
            //         'nip' => '123456789015',
            //         'tgl_lahir' => '1990-01-02',
            //         'alamat' => 'Alamat 2',
            //     ],
            //     [
            //         'user_id' => 6,
            //         'jabatan_id' => 6,
            //         'nama' => 'Ppk',
            //         'email' => 'ppk@example.com',
            //         'nip' => '123456789016',
            //         'tgl_lahir' => '1990-01-02',
            //         'alamat' => 'Alamat 2',
            //     ],
            //     [
            //         'user_id' => 7,
            //         'jabatan_id' => 7,
            //         'nama' => 'Pptk',
            //         'email' => 'pptk@example.com',
            //         'nip' => '123456789017',
            //         'tgl_lahir' => '1990-01-02',
            //         'alamat' => 'Alamat 2',
            //     ],
            // ];

            // foreach ($biodatas as $biodata) {
            //     BiodataModel::create($biodata);
            // }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
