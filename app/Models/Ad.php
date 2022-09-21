<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'category_id',
        'type',
        'title',
        'description',
        'start_date'
    ];

    const TYPE_FREE = 'free';
    const TYPE_PAID = 'paid';

    protected $dates = ['start_date'];

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'ad_tag');
    }
}
