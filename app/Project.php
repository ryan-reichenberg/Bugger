<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function members(){
        return $this->belongsToMany('Bugger\User');
    }
    public function tickets(){
        return $this->hasMany('Bugger\Ticket');
    }
}
