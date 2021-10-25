<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory;
    use Sluggable;


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        // when saved get title field as sluggable
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    /**
     * A post belong to one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Method to get excerpt from body
     * @return 140 caracters
     */
    public function getGetExcerptAttribute()
    {
        return substr($this->body, 0, 140);
    }
}
