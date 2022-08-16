<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'news';
    protected $fillable = [
        'unid ',
        'doc_type',
        'new_date',
        'img_thumb',
        'new_th_title',
        'new_th_detail',
        'new_en_title',
        'new_en_detail',
        'new_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}
