<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class FinancialController extends BaseController
{
    protected $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        // Ambil summary
        $summary = $this->transactionModel
                ->db->table('summary')
                ->where('id', 1)
                ->get()
                ->getRowArray();

        $data = [
            'title'  => 'Laporan Keuangan',
            'report' => [
                'period'     => 'bulan',
                'income'     => $summary['income'],
                'expense'    => $summary['expense'],
                'chart_data' => [] // bisa tambahkan nanti
            ]
        ];

        return view('financial/dashboard', $data);
    }

    public function update()
    {
        $income  = $this->request->getPost('income');
        $expense = $this->request->getPost('expense');

        // Simpan ke database via model
        $this->transactionModel->updateIncomeExpense($income, $expense);

        return redirect()->to('/financial')->with('message', 'Perubahan berhasil disimpan!');
    }

    public function getMonthlyReport()
    {
        return [
            'period'     => 'bulan',
            'income'     => $this->transactionModel->getMonthlyIncome(),
            'expense'    => $this->transactionModel->getMonthlyExpense(),
            'chart_data' => $this->transactionModel->getMonthlyChartData(),
        ];
    }
}
