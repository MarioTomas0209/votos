<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'type', 'image_url'];

    public function comparisons()
    {
        return $this->hasMany(Comparison::class, 'item1_id')->orWhere('item2_id');
    }


}
