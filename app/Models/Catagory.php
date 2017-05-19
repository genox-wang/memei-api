<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catagory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catagory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catagory whereName($value)
 */
class Catagory extends Model
{
    public $timestamps = false;

    //
    public function authors() {
      return $this->hasMany('App\Models\Author');
    }
}
