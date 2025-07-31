<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_id', 'wallet_id', 'jenis', 'nominal', 'kategori', 'deskripsi', 'tanggal'
    ];

    // Tambahan untuk aktifkan timestamp otomatis
    protected $useTimestamps    = true; // Aktifkan created_at & updated_at
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // Optional: untuk default sort by waktu terbaru
    protected $orderBy          = ['created_at' => 'DESC'];
    
}
