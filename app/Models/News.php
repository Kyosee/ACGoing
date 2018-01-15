<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';

    /**
     * News batch collection in database
     * @return [type] [description]
     */
    public function createNews($News){
        return $News[1]['news'];
    }
}
