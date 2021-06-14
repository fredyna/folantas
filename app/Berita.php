<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Berita extends Model
{
    use LogsActivity;
    
    protected $table = 'berita';
    protected $guarded = [];
}
