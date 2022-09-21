<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Advertiser extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name'];

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
}
