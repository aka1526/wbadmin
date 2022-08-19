<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'partners';
    protected $fillable = [
        'unid ',
        'partners_logo',
        'partners_name',
        'partners_url',
        'partners_status',
        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}

