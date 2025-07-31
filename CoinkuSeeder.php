<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CoinkuSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // 1. Cek apakah user sudah ada
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', 'admin@gmail.com')->first();

        if (!$user) {
            // 2. Jika belum, buat user baru
            $userModel->insert([
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT)
            ]);

            // Ambil ulang user
            $user = $userModel->where('email', 'admin@gmail.com')->first();
        }

        // 3. Cek apakah dompet sudah ada
        $walletModel = new \App\Models\WalletModel();
        $wallet = $walletModel->where('user_id', $user['id'])->first();

        if (!$wallet) {
            // Buat dompet baru
            $walletModel->insert([
                'user_id' => $user['id'],
                'name'    => 'Dompet Utama',
                'balance' => 1000000,
                'type'    => $faker->randomElement(['simpan', 'keluar']),
            ]);

            // Ambil ulang wallet ID
            $wallet = $walletModel->where('user_id', $user['id'])->first();
        }

        // 4. Buat transaksi dummy jika belum ada
        $transactionModel = new \App\Models\TransactionModel();
        $transaksiSudahAda = $transactionModel->where('user_id', $user['id'])->first();

        if (!$transaksiSudahAda) {
            for ($i = 0; $i < 10; $i++) {
                $transactionModel->insert([
                    'user_id'   => $user['id'],
                    'wallet_id' => $wallet['id'],
                    'jenis'     => $i % 2 == 0 ? 'pemasukan' : 'pengeluaran',
                    'kategori'  => $faker->randomElement(['Makanan', 'Belanja', 'Gaji']),
                    'nominal'   => $faker->numberBetween(10000, 500000),
                    'catatan'   => $faker->sentence(),
                    'tanggal'   => $faker->date(),
                ]);
            }
        }
    }
}
