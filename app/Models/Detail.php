<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [];
    protected $guarded = [];
    protected $with = [
        "Menu"
    ];

    public function Menu()
    {
        return $this->hasOne(Menu::class,'id','menu_id');
    }
}
