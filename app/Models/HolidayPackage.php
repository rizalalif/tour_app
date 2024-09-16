<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HolidayPackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['itenerary'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function itenerary(): HasMany
    {
        return $this->hasMany(Itenerary::class);
    }
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
