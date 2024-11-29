<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogTag extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';

    protected $fillable = [
        'blog_id',
        'tag_id',
    ];
    /*
    public function blog_tags(): HasMany
    {
        return $this->hasMany(BlogTag::class);
    }
    */
}
