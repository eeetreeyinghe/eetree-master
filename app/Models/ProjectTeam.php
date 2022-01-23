<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    protected $table = 'project_team';

    protected $guarded = ['id'];

    public function cloud()
    {
        return $this->belongsTo('App\Models\Cloud')->withDefault([
            'url' => '',
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getFromUser($section = '')
    {
        if ($this->user) {
            $this->name = $this->user->nickname;
            $this->description = $this->user->intro;
            if ($section == 'detail') {
                $this->cloud_url = $this->user->avatar;
                $this->user_url = route('user.home', ['user' => $this->user, 'tab' => 'projects']);
            } else {
                $this->cloud = (Object) [
                    'url' => $this->user->avatar,
                ];
            }
        }
    }
}
