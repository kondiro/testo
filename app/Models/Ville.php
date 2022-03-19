<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    public $table="villes";
    public $primaryKey ="id";
    public $incrementing=true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const PRIMARY_KEY = 'id';
}
