<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BdUpazila extends Model
{
    protected $table = 'bd_upazilas';

    protected $fillable = [
        'district_id',
        'name',
        'name_bn',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(
            BdDistrict::class,
            'district_id'
        );
    }
}