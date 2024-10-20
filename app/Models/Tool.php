<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['name', 'description', 'category'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
