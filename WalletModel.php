<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table = 'wallets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'name', 'balance', 'type'];
    

}
