<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BdDivision extends Model
{
    protected $table = 'bd_divisions';

    protected $fillable = [
        'name',
        'name_bn',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(
            BdDistrict::class,
            'division_id'
        );
    }
}