<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DataKecelakaan extends Model
{
    use LogsActivity;

    protected $table = 'data_kecelakaan';
    protected $guarded = [];
}
