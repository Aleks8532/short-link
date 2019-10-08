<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $link_id
 * @property int $image_id
 * @property string $created_at
 * @property string $updated_at
 */
class VisitLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visit_log';

    /**
     * @var array
     */
    protected $fillable = ['link_id', 'image_id', 'created_at', 'updated_at'];

    public function images()
    {
        return $this->hasMany('App\Images');
    }
}
