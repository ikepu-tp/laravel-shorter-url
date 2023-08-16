<?php

namespace ikepu_tp\ShorterUrl\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    public $casts = [
        "name" => "encrypted",
        "link" => "encrypted",
    ];

    public $fillable = [
        "linkId",
        "name",
        "link"
    ];

    public function getRouteKeyName()
    {
        return "linkId";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }
}
