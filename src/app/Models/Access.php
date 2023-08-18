<?php

namespace ikepu_tp\ShorterUrl\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{
    use HasFactory, SoftDeletes;

    public $casts = [
        "user_agent" => "encrypted",
    ];

    protected $guarded = [
        "id", "created_at", "updated_at", "deleted_at",
    ];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
