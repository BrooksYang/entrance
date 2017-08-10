<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Contracts\RoleInterface;
use BrooksYang\Entrance\Traits\EntranceRoleTrait;
use Illuminate\Database\Eloquent\Model;

class EntranceRole extends Model implements RoleInterface
{
    use EntranceRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

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
