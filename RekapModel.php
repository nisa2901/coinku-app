<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapModel extends Model
{
    protected $table = 'rekap'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array'; // atau 'object' jika ingin pakai object
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'tanggal', 'jenis', 'kategori', 'nominal', 'deskripsi'
        // Tambahkan kolom lain yang sesuai dengan tabel 'rekap'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method untuk mendapatkan semua data rekap
    public function getRekapData()
    {
        return $this->orderBy('tanggal', 'DESC')->findAll(); // bisa ditambahkan filter sesuai kebutuhan
    }

    // Tambahkan method tambahan jika dibutuhkan, seperti filter per bulan, tahun, dll.
}
