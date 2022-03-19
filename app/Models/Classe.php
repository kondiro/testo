<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;



    public $table="classes";
    public $primaryKey ="idC";
    public $incrementing=true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const PRIMARY_KEY = 'idC';
}
