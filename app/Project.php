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
    public function getUserTickets($id){
        return $this->tickets()->whereHas('members', function($query) use($id){
            $query->where('user_id',$id);
        })->get();

    }
}
