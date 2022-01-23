<?php

namespace App\Models;

use App\Helpers\Enums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Doc extends Model
{
    protected $table = 'doc';

    const TYPE_DOC = 'doc';
    const TYPE_CV = 'cv';

    protected $dates = ['publish_at'];

    protected $casts = [
        'content' => 'array',
        'parsed_content' => 'array',
    ];

    protected $fillable = [
        'title', 'description', 'content',
    ];

    public function getMorphClass()
    {
        return Enums::key('types.DOC');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'doc_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'doc_category', 'doc_id', 'category_id');
    }

    public function docCategory()
    {
        return $this->hasMany('App\Models\DocCategory', 'doc_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'item', 'tag_link');
    }

    public function docTop()
    {
        return $this->hasOne('App\Models\DocTop', 'top_id');
    }

    public function formatContent()
    {
        $this->parsed_content = $this->content;
        $len = Redis::llen('eetree:wikikeys');
        $wikiUrl = config('eetree.wikiUrl');
        if ($len && $len > 0) {
            for ($i = 0; $i < $len; $i++) {
                $keyword = Redis::lindex('eetree:wikikeys', $i);
                if (!empty($keyword)) {
                    $this->parsed_content = static::addTag($this->parsed_content, $keyword, $wikiUrl);
                }
            }
        }
    }

    public function findNode($id, $node = null)
    {
        if ($node === null) {
            $node = $this->content['root'];
        }
        if ($node['data']['id'] == $id) {
            return $node;
        } elseif (!empty($node['children'])) {
            foreach ($node['children'] as $childNode) {
                if ($childNode) {
                    $find = $this->findNode($id, $childNode);
                    if ($find) {
                        return $find;
                    }
                }
            }
        }
        return false;
    }

    public static function addTag($data, $keyword, $wikiUrl)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($key !== 'text' && !is_array($value)) {
                    continue;
                }
                $data[$key] = static::addTag($value, $keyword, $wikiUrl);
            }
            return $data;
        } else {
            return preg_replace('/' . $keyword . '(?![^<]*<\/a>)/', sprintf('<a href="' . $wikiUrl . '" target="_blank">%s</a>', $keyword, $keyword), $data);
        }
    }

    public static function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!preg_match('/^[0-9a-zA-Z]+$/', $key)) {
                    unset($data[$key]);
                    continue;
                }
                $data[$key] = static::clean($value);
            }
            return $data;
        } else {
            return $data;
            // return \Purifier::clean($data, 'mindmap');
        }
    }
}
