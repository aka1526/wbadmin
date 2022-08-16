<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'uploadfile';
    protected $fillable = [
        'unid',
        'ref_unid',
        'img_group',
        'img_path',
        'img_name',
        'img_extention',
        'img_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time',
        ];
    }

