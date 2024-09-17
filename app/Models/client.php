<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $primarykey = 'id_client';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $filable = [
        'id_client',
        'nom_client',
        'prenom_client',
        'addresse_client',
        "telephone_client",
        "sexe_client",
        "age",
        "cni_client",
        "photo_client",
        "id_user"
    ];
}
