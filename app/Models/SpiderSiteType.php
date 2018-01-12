<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpiderSiteType extends Model
{
    use SoftDeletes;

    protected $table = 'spider_site_type';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    public function getSite(){
        return $this->belongsTo('App\Models\SpiderSite', 'site_type_id');
    }
}
