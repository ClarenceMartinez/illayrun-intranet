<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class buses extends Model
{
    use HasFactory;
    protected $table ="buses";

    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}
