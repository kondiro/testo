<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    public $table="etudiants";
    public $primaryKey ="idE";
    public $incrementing=true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const PRIMARY_KEY = 'idE';

}
