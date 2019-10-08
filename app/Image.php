<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $image_link
 * @property string $created_at
 * @property string $updated_at
 */
class Image extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['image_link', 'created_at', 'updated_at'];

}
