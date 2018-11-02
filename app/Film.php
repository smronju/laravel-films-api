<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    protected $fillable = ['name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'genre'];

    public static function boot() {
        parent::boot();

        static::creating(function($activity) {
            $slug = Str::slug($activity->name);
            $count = static::whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();
            $activity->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
