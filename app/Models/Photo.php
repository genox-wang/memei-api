<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Photo
 *
 * @property-read \App\Models\Photo $card
 * @mixin \Eloquent
 * @property int $id
 * @property int $card_id
 * @property string $key
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo whereCardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Photo whereKey($value)
 */
class Photo extends Model
{
  public $timestamps = false;

    public function card()
    {
      return $this->belongsTo('App\Models\Card');
    }
}
