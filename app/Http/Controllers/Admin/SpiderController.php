<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpiderSite;
use App\Models\SpiderSiteType;

class SpiderController extends Controller
{

    protected $view_prefix = 'Admin.spider.';
    /**
     * Spider site list
     */
    public function site_type(){
        $data = SpiderSiteType::all()->toArray();
        return view($this->view_prefix.'site_type', ['data_list' => $data]);
    }

    public function siteTypeStore(Request $request){
        $SpiderSiteType = new SpiderSiteType();
        $SpiderSiteType->name = $request->name;
        if($id = $request->id){
            $SpiderSiteType->where('id', $id)->update(['name' => $request->name]);
        }else{
            $SpiderSiteType->save();
        }
        return back();
    }

    /**
     * soft delete site type
     */
    public function siteTypeDelete(Request $request){
        return response()->json(['state' => !$request->id ? false :( SpiderSiteType::destroy($request->id) ? true : false )]);
    }

    /**
     * spider site
     */
    public function home(){
        $site_list = SpiderSite::paginate(15);
        return view($this->view_prefix.'home', ['site_list' => $site_list]);
    }

    public function siteStore(Request $request){
        $SpiderSite = new SpiderSite();
        $data = $request->all();

        $filldata  = function($model, $data) {
            $model->fill($data);
            $model->base_filter = json_encode($model->rebuildFilter($data['base_filter']));
            $model->info_filter = json_encode($data['info_filter']['title'][0] ? $model->rebuildFilter($data['info_filter']) : '');
        };

        if($data['id'] && $site = SpiderSite::find($data['id'])){
            $filldata($site, $data);
            $site->save();
        }else{
            $filldata($SpiderSite, $data);
            $SpiderSite->save();
        }
        return back();
    }

    /**
     * site details
     */
    public function site_details($id = 0){
        $type_list = SpiderSiteType::all()->toArray();
        $site_data = '';

        if($id){
            $site_data = SpiderSite::find($id)->toArray();
            $site_data['base_filter'] = SpiderSite::debuildFilter($site_data['base_filter']);
            $site_data['info_filter'] = SpiderSite::debuildFilter($site_data['info_filter']);
        }

        return view($this->view_prefix.'site_details', ['type_list' => $type_list, 'data' => $site_data]);
    }
}
