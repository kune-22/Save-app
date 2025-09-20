<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $filtable = ['user_id', 'url', 'title', 'is_favorite'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(tags::class, 'link_tags');
    }
}
