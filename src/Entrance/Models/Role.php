<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Contracts\RoleInterface;
use BrooksYang\Entrance\Traits\EntranceRoleTrait;
use BrooksYang\Entrance\Traits\KeywordSearchTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements RoleInterface
{
    use EntranceRoleTrait, KeywordSearchTrait;

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
        'name', 'description',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('entrance.roles_table');
    }
}
