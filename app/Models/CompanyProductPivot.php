<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Laravel\Scout\Searchable;

class CompanyProductPivot extends Pivot
{
    use Searchable;

    public $table = 'company_product';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Disable timestamps.
     */
    public $timestamps = false;


    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    public function searchableAs()
    {
        return 'company_product_index';
    }

    /**
     * Determine if the model should be searchable.
     *
     * @return bool
     */

    // @TODO comments the method below and the queue it's going to work.
    public function shouldBeSearchable()
    {
        return $this->published;
    }

    public function toSearchableArray()
    {
        $data = [
            'product_collection' => collect(['a', 'b', 'c', 'd', 'e']), // just for testing: real case it's a complex query with join/scopes and not categories.
            'product_name' => $this->product->name,
            'product_price' => $this->product->price,
            'company_name' => $this->company->name,
        ];

        $data = $this->transform($data);

        return $data;
    }
}
