<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerlist extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'customerlist';
    protected $fillable = [
        'unid ',
        'cus_list','cus_name','cus_middle','cus_img','cus_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}



