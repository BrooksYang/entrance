<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Traits\EntranceGroupTrait;
use BrooksYang\Entrance\Traits\KeywordSearchTrait;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use EntranceGroupTrait, KeywordSearchTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'order',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('entrance.groups_table');
    }
}
