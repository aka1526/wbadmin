<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webmenu extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'webmenu';
    protected $fillable = [
        'unid',
        'menu_th_name',
        'menu_en_name',
        'menu_url',
        'menu_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}


