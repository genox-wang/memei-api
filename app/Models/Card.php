<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Card
 *
 * @property-read \App\Models\Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photos
 * @mixin \Eloquent
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Card whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Card whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Card whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Card whereUpdatedAt($value)
 */
class Card extends Model
{
    public function author()
    {
      return $this->belongsTo('App\Models\Author');
    }

    public function photos()
    {
      return $this->hasMany('App\Models\Photo');
    }
}
