<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes;
    protected $table = 'laporan';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
