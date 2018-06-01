<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function ticket(){
        return $this->belongsTo('Bugger\Ticket');
    }
    public function user(){
        return $this->belongsTo('Bugger\User');
    }
}
