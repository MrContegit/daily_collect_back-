<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $primarykey = 'id_trans';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $filable = [
        'id_trans',
        'montant',
        'type_trans',
        'id_client',
        "id_user",
        
    ];
}
