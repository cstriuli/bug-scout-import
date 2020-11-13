<?php

namespace App\Models;

use App\Models\Product;
use App\Models\CompanyProductPivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(CompanyProductPivot::class)
            ->withPivot([
                'published',
            ]);
    }
}
