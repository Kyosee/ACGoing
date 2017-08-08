<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    protected $guarded = ['id', 'user_id'];

    protected $table = 'user_profile';
}
