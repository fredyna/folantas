<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DataKemacetan extends Model
{
    use LogsActivity;

    protected $table = 'data_kemacetan';
    protected $guarded = [];
}
