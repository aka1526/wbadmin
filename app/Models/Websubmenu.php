<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websubmenu extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'websubmenu';
    protected $fillable = [
        'unid',
        'menu_ref_unid',
        'submenu_th_name',
        'submenu_en_name',
        'submenu_url',
        'submenu_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}


