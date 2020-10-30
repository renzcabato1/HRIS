<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $connection = 'hr_portal';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function employee_info()
    {
        return Employee::where('user_id', auth()->user()->id)->get()->first();
    }
    
    public function role_info()
    {
        return UserRole::where('user_id',auth()->user()->id)->get();
    }
  
}
