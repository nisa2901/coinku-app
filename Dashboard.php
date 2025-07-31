<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\WalletModel;
use Carbon\Carbon;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek jika belum login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Ambil data user & filter dari request
        $userId   = session()->get('user_id');
        $filter   = $this->request->getGet('filter') ?? 'hari';
        $walletId = $this->request->getGet('wallet');

        $transactionModel = new TransactionModel();
        $walletModel      = new WalletModel();

        // Filter user_id
        $query = $transactionModel->where('user_id', $userId);

        // Filter dompet jika dipilih
        if ($walletId) {
            $query->where('wallet_id', $walletId);
        }

        // Inisialisasi tanggal hari ini
        $today = Carbon::today();

        // Gunakan kolom 'tanggal' dari tabel transactions
        switch ($filter) {
            case 'hari':
                $query->where('tanggal', $today->toDateString());
                break;

            case 'minggu':
                $startOfWeek = $today->copy()->startOfWeek()->toDateString();
                $endOfWeek   = $today->copy()->endOfWeek()->toDateString();
                $query->where('tanggal >=', $startOfWeek);
                $query->where('tanggal <=', $endOfWeek);
                break;

            case 'bulan':
                $query->where('MONTH(tanggal)', $today->month);
                $query->where('YEAR(tanggal)', $today->year);
                break;

            case 'tahun':
                $query->where('YEAR(tanggal)', $today->year);
                break;
        }

        // Ambil transaksi
        $transactions = $query->findAll();

        // Hitung pemasukan dan pengeluaran
        $pemasukan = 0;
        $pengeluaran = 0;

        foreach ($transactions as $t) {
            if ($t['jenis'] === 'pemasukan') {
                $pemasukan += $t['nominal'];
            } elseif ($t['jenis'] === 'pengeluaran') {
                $pengeluaran += $t['nominal'];
            }
        }

        // Hitung saldo
        $saldo = $pemasukan - $pengeluaran;

        // Ambil dompet
        $wallets = $walletModel->where('user_id', $userId)->findAll();

        // Kirim data ke view
        return view('dashboard/index', [
            'pemasukan'    => $pemasukan,
            'pengeluaran'  => $pengeluaran,
            'saldo'        => $saldo,
            'wallets'      => $wallets,
            'walletId'     => $walletId ?? null,
            'filter'       => $filter,
            'transactions' => $transactions
        ]);
    }
}
