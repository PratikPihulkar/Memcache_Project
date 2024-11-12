<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memcache extends Model
{
    use HasFactory;

    protected $table = 'movie';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'year',
        'date_published',
        'duration',
        'country',
        'worlwide_gross_income',
        'languages',
        'production_company'
    ];

    protected $dates = [
        'date_published'
    ];
}
