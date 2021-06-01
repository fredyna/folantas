<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use SoftDeletes, LogsActivity;
    protected $guarded = [];

    public function users()
    {
        return $this->hasToMany(User::class);
    }
}
