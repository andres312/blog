<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
//use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    use HasFactory;
    use Sluggable;
    // accept massive fields
    protected $fillable = [
        'title',
        'body',
        'iframe',
        'image',
        'user_id'
    ];


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
     * Get excerpt from body
     * @return 140 caracters
     */
    public function getGetExcerptAttribute()
    {
        return substr($this->body, 0, 140);
    }
    /**
     * Get url image from storage php artisan store:link
     * @return url image url
     */
    public function getGetImageAttribute()
    {
        if ($this->image) {
            return url("storage/$this->image");
            //return Storage::disk('public')->url($this->image);
        }

    }
}
