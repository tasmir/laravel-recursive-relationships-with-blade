<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    protected $guarded =['id', 'created_at', 'updated_at'];

    public function items() {
        return $this->hasMany(Item::class, 'parent', 'id')->with('items');
    }
}
