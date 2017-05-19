<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    //
    public function authors() {
      return $this->hasMany('App\Models\Author');
    }
}
