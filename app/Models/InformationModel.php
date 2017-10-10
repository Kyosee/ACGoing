<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationModel extends Model
{
    protected $table = 'information';

    /**
     * information batch collection in database
     * @return [type] [description]
     */
    public function createInformation($informations){
        return $informations[1]['news'];
    }
}
