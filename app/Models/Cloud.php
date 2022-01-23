<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cloud extends Model
{
    protected $table = 'cloud';

    protected $guarded = ['id'];

    public function getUrlAttribute($value)
    {
        if ($this->fkey) {
            if ($this->storage === 'local') {
                return Storage::url($this->fkey);
            }
            return Storage::disk(config('eetree.cloud'))->getUrl($this->fkey);
        }
        return '';
    }
}
