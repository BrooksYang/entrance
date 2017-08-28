<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Contracts\ModuleInterface;
use BrooksYang\Entrance\Traits\EntranceModuleTrait;
use BrooksYang\Entrance\Traits\KeywordSearchTrait;
use Illuminate\Database\Eloquent\Model;

class Module extends Model implements ModuleInterface
{
    use EntranceModuleTrait, KeywordSearchTrait;

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
        'name', 'description', 'icon', 'group_id',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('entrance.modules_table');
    }
}
