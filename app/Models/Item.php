<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;



    /*
     *
     *
     *  твой код             Laravel за кулисами
      ─────────────────    ──────────────────────────────
      Item::create([       $model = new Item()
        'name' => ...,     $model->fill(['name' => ..., 'price' => ...])
        'price' => ...,    $model->save()  →  INSERT INTO items ...
      ])                   return $model
     *
     *
     */

    protected $fillable = ["name", "price"];
}
