<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class Rekap extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();

        // Ambil filter dari query string (misalnya: ?filter=pemasukan)
        $filter = $this->request->getGet('filter') ?? 'semua';

        // Ambil data total
        $pemasukan = $model->where('jenis', 'pemasukan')->selectSum('nominal')->first()['nominal'] ?? 0;
        $pengeluaran = $model->where('jenis', 'pengeluaran')->selectSum('nominal')->first()['nominal'] ?? 0;

        // Data dikirim ke view
        $data = [
            'title'       => 'Rekap Keuangan',
            'rekap_data'  => [
                'pemasukan'   => $pemasukan,
                'pengeluaran' => $pengeluaran
            ],
            'filter'      => $filter
        ];

        return view('rekap/index', $data);
    }
}
