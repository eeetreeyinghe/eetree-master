<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectProductDraft extends Model
{
    protected $table = 'project_product_draft';

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
