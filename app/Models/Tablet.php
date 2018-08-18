<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    protected $fillable=['type_id', 'manufacturer_id', 'name', 'description', 'price', 'image', 'slug'];

    public function type(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }
}
