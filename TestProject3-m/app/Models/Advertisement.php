<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertisement extends Model
{
    /** @use HasFactory<\Database\Factories\AdvertisementFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'email',
        'category_id',
        'user_id'
    ];

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
