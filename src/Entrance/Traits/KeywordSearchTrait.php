<?php

namespace BrooksYang\Entrance\Traits;

trait KeywordSearchTrait
{
    /**
     * keyword search
     *
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%$keyword%");
    }
}