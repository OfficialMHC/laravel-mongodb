<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $connection = "mongodb";

    protected $guarded = [];

    

    public function scopeLikeSearch($query, $field)
    {
        $query->when(request()->filled($field), function($q) use ($field) {
            $q->where($field, 'LIKE', '%' . request()->$field . '%');
        });
    }
}