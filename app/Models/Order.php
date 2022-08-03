<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Detail;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [];
    protected $guarded = [];
    protected $with = [
        "Detail",
        "Table",
        "User"
    ];

    public function Detail()
    {
        return $this->hasMany(Detail::class,'order_id','id')->withTrashed();
    }

    public function Table()
    {
        return $this->hasOne(Table::class,'id','table_id')->withTrashed();
    }

    public function User()
    {
        return $this->hasOne(User::class,'id','user_id')->withTrashed();
    }
}
