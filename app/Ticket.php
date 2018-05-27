<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function members(){
        return $this->hasMany('Bugger\User');
    }
    public function project(){
        return $this->belongsTo('Bugger\Project');
    }
    public function tags(){
        return $this->hasMany('Bugger\Tag');
    }
}
