<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\WalletModel;

class Transaction extends BaseController
{
    public function create()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $walletModel = new WalletModel();
        $userId = session()->get('user_id');


        $wallets = $walletModel->where('user_id', $userId)->findAll();
        
        return view('transaction/create', ['wallets' => $wallets]);
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'jenis'     => 'required|in_list[pemasukan,pengeluaran]',
            'kategori'  => 'required|max_length[100]',
            'nominal'   => 'required|numeric',
            'wallet_id' => 'required|is_natural_no_zero',
            'tanggal'   => 'required|valid_date',
            'catatan'   => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }

        $transactionModel = new TransactionModel();

        $transactionModel->save([
            'user_id'   => session()->get('user_id'),
            'wallet_id' => $this->request->getPost('wallet_id'),
            'jenis'     => $this->request->getPost('jenis'),
            'kategori'  => $this->request->getPost('kategori'),
            'nominal'   => $this->request->getPost('nominal'),
            'catatan'   => $this->request->getPost('catatan'),
            'tanggal'   => $this->request->getPost('tanggal'),
        ]);

        return redirect()->to('/dashboard')->with('success', 'Transaksi berhasil disimpan.');
    }
}
