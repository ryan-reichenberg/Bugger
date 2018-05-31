<?php

namespace Bugger;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fName', 'lName','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets(){
        return $this->belongsToMany('Bugger\Ticket');
    }
    public function projects(){
        return $this->belongsToMany('Bugger\Project');
    }
    public function anyIssuesRegistered(){
        foreach ($this->projects as $project){
            if($project->tickets->count() > 0){
                return true;
            }
        }
        return false;
    }
    public function getFullName(){
        return $this->fName . ' ' . $this->lName;
    }
}
