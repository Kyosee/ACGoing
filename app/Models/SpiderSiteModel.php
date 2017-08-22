<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiderSiteModel extends Model
{
    protected $table = 'spider_site';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'site_name', 'site_url', 'site_type_id'
    ];

    /**
     * json decode some filter
     * @param  Array  $site site data
     * @return Array
     */
    public function rebuildData($site){
        foreach ($site as $key => $value) {
            $site[$key]['base_filter'] = json_decode($value['base_filter'], true);
            $site[$key]['info_filter'] = json_decode($value['info_filter'], true);
        }
        return $site;
    }

    /**
     * rebuild user input filter array
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public static function rebuildFilter($filter){
        $new_array = [];
        foreach ($filter['title'] as $key => $value) {
            $new_array[$value] = $filter['content'][$key];
        }
        return $new_array;
    }

    /**
     *
     */
    public static function debuildFilter($filter){
        $filter = json_decode($filter, true);
        if(!$filter){
            return false;
        }

        $new_array = [];

        foreach ($filter as $key => $value) {
            $new_array['title'][] = $key;
            $new_array['content'][] = $value;
        }
        return $new_array;
    }
}
