<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function links()
    {
        return $this->belongsToMany(Link::class, 'link_tags');
    }
}
