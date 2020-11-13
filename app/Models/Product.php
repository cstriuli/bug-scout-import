<?php

namespace App\Models;

use App\Models\Company;
use App\Models\CompanyProductPivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)
            ->using(CompanyProductPivot::class)
            ->withPivot([
                'published',
            ]);
    }
}
