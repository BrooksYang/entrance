<?php

namespace BrooksYang\Entrance\Models;

use BrooksYang\Entrance\Contracts\ModuleInterface;
use BrooksYang\Entrance\Traits\EntranceModuleTrait;
use Illuminate\Database\Eloquent\Model;

class EntranceModule extends Model implements ModuleInterface
{
    use EntranceModuleTrait;

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
        $this->table = config('entrance.modules_table');
    }
}
