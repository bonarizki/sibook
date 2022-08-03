<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['menu_name','category_id','price','menu_file_name'];
    protected $with = ['Category'];

    public function Category()
    {
        return $this->hasOne(Category::class,'id','category_id')->withTrashed();
    }
}
