<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slidesimg extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'slidesimg';
    protected $fillable = [
        'unid ',
        'slidesimg_img',
        'slidesimg_desc',
        'slidesimg_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}

