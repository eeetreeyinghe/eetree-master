<?php

namespace App\Models;

use App\Helpers\Enums;
use App\Models\DocPublish;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocDraft extends Model
{
    use SoftDeletes;

    protected $table = 'doc_draft';

    protected $dates = ['last_edit_at', 'shared_at'];

    protected $casts = [
        'content' => 'array',
    ];

    protected $fillable = [
        'user_category_id', 'doc_id', 'publish_id', 'title', 'content',
    ];

    public function getMorphClass()
    {
        return Enums::key('types.DOC');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function doc()
    {
        return $this->belongsTo('App\Models\Doc');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'item', 'tag_link_draft');
    }

    public function docPublish()
    {
        return $this->belongsTo('App\Models\DocPublish');
    }

    public function setShare()
    {
        $this->share_id = 'share';
        $this->update([
            'share_id' => $this->share_id,
        ]);
    }

    public function setPublish($data)
    {
        if ($this->publish_id === 0) {
            $docPublish = new DocPublish;
            $docPublish->user_id = $this->user_id;
            $docPublish->review_remarks = '';
        } else {
            $docPublish = DocPublish::find($this->publish_id);
        }
        if ($this->doc_id > 0) {
            $docPublish->edit_history = $data['edit_history'];
        }
        $docPublish->status = DocPublish::STATUS_SUBMIT;
        $docPublish->title = $this->title;
        $docPublish->description = $data['description'];
        $docPublish->content = $this->content;
        $docPublish->type = $this->type;
        $docPublish->submit_at = Carbon::now();
        $docPublish->tags = $data['tags'];
        $docPublish->save();
        if ($this->publish_id === 0) {
            $this->update([
                'publish_id' => $docPublish->id,
            ]);
        }
    }
}
