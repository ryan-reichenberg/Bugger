<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function tickets(){
        return $this->belongsToMany('Bugger\Ticket');
    }
    public function user(){
        return $this->belongsTo('Bugger\User');
    }
}
