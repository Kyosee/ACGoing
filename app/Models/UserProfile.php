<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = ['id', 'user_id'];

    protected $table = 'user_profile';
}
