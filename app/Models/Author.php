<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Author
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Card[] $cards
 * @property-read \App\Models\Category $category
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $avatar
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Author whereName($value)
 */
class Author extends Model
{
    public $timestamps = false;
    //
    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }

    public function cards()
    {
      return $this->hasMany('App\Models\Card');
    }
}
