<?php

namespace Bugger;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'priority'
    ];
    public function members(){
        return $this->belongsToMany('Bugger\User');
    }
    public function project(){
        return $this->belongsTo('Bugger\Project');
    }
    public function tags(){
        return $this->belongsToMany('Bugger\Tag');
    }
}
