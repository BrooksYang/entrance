<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Contracts\PermissionInterface;
use BrooksYang\Entrance\Traits\EntrancePermissionTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements PermissionInterface
{
    use EntrancePermissionTrait;

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
        'name', 'description', 'method', 'uri', 'module_id', 'icon', 'is_visible',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('entrance.permissions_table');
    }
}
