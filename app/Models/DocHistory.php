<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocHistory extends Model
{
    protected $table = 'doc_history';

    protected $fillable = [
        'doc_id', 'description',
    ];
}
