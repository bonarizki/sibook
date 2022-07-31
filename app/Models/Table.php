<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = [
        'table_code',
        'table_name'
    ];

    public function Order()
    {
        return $this->hasOne(Order::class,'table_id','id')->latest();
    }
}