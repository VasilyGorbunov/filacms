<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected static $unguarded = true;

    protected $casts = [
//        'created_at' => 'Carbon'
        'content' => 'array'
   ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function excerpt(): string
    {
        return Str::words(tiptap_converter()->asText($this->content), 40, '...');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
