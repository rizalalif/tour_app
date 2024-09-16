<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Itenerary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function holiday_package(): BelongsTo
    {
        return $this->belongsTo(HolidayPackage::class);
    }
}
