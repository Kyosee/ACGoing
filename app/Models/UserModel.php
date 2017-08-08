<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

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

    /**
     * user profile
     */
    public function profile(){
        return $this->hasOne('App\Models\UserProfileModel', 'user_id');
    }

    /**
     * get passsword hash
     * @param  string $password user password
     * @return string           password hash string
     */
    public static function getPasswordHash($password){
        return \Hash::make($password);
    }

    /**
     * verfiy password equal hash
     * @param  string $password input password
     * @param  string $hash     password hash string
     * @return int              empty or 1
     */
    public static function verifyPasswordHash($password, $hash){
        return \Hash::check($password, $hash);
    }

    /**
     * create user
     * @param  request $data input data
     * @return boolean
     */
    public function createNewUser($data){
        $this->email = $data['email'];
        $this->password = self::getPasswordHash($data['password']);
        if($this->save()){
            $this->where('id', $this->id)->update(['nickname' => 'ACG_'.$this->id]);
            $this->profile()->create(['user_id' => $this->id]);
            return true;
        }else{
            return false;
        }
    }
}
