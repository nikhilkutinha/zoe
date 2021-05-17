<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        "ip", 
        "country", 
        "browser", 
        "referer", 
        "platform",
        "link_id"
    ];

    /**
     * The link associated with this visitor.
     */

    public function link() {
        return $this->belongsTo(Link::class);
    }
}
