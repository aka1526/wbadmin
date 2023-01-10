<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';

    protected $primaryKey = "unid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'Customer';
    protected $fillable = [
        'unid ',
        'customer_group',
        'customer_name',
        'customer_middle',
        'customer_url','customer_logo'
        ,'customer_status',

        'create_by',
        'create_time',
        'modify_by',
        'modify_time'
    ];
}


