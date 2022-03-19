<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public $table="regions";
    public $primaryKey ="idR";
    public $incrementing=true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const PRIMARY_KEY = 'idR';

  









}
