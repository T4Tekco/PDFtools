<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function createToken(string $name, array $abilities = ['*'])
    {
        return $this->createToken($name, $abilities);
    }
    public function login($user,$pass){
        return DB::select('SELECT UserID, `FistName`, `LastName`, `userName`, `passWord`, `role` FROM `user` WHERE  userName = ? and passWord = ?',[$user,$pass]);
    }
    public function getoneuser($id){
        return DB::select('SELECT UserID, `FistName`, `LastName`, `userName`, `passWord`, `role` FROM `user` WHERE  UserID = ? ',[$id]);
    }
    public function getalluser(){
        return DB::select('SELECT UserID, `FistName`, `LastName`, `userName`, `passWord`, `role` FROM `user` ',[]);
    }
    
}