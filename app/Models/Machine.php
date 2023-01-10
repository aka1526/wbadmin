<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'machine';
    protected $fillable = [
        'unid ',
        'mc_group',
        'mc_name',
        'mc_img',
        'mc_total',

        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}


 