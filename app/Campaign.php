<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'goal_price', 'image_name', 'story', 'deadline'];
}
