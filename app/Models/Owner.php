<?php

namespace App\Models;

use App\Enums\AbuyogBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    use HasFactory;

    protected $casts = [
        'address' => AbuyogBarangay::class,
    ];

    public function permits(): HasMany
    {
        return $this->hasMany(Permit::class);
    }

    public function cfei(): HasMany
    {
        return $this->hasMany(Cfei::class);
    }

}
