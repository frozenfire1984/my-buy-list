<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name", "description", "is_secret"];

    public function items() {
        return $this->hasMany(Item::class);
    }

}
