<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tickets(){
        return $this->belongsToMany('Bugger/Ticket');
    }
}
