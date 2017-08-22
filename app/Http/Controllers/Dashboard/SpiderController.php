<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpiderSiteModel;
use App\Models\SpiderSiteTypeModel;

class SpiderController extends Controller
{

    protected $view_prefix = 'dashboard.spider.';
    /**
     * Spider site list
     */
    public function site_type(){
        $data = SpiderSiteTypeModel::all()->toArray();
        return view($this->view_prefix.'site_type', ['data_list' => $data]);
    }

    public function siteTypeStore(Request $request){
        $SpiderSiteTypeModel = new SpiderSiteTypeModel();
        $SpiderSiteTypeModel->name = $request->name;
        if($id = $request->id){
            $SpiderSiteTypeModel->where('id', $id)->update(['name' => $request->name]);
        }else{
            $SpiderSiteTypeModel->save();
        }
        return back();
    }

    /**
     * soft delete site type
     */
    public function siteTypeDelete(Request $request){
        return response()->json(['state' => !$request->id ? false :( SpiderSiteTypeModel::destroy($request->id) ? true : false )]);
    }

    /**
     * spider site
     */
    public function home(){
        $site_list = SpiderSiteModel::paginate(15);
        return view($this->view_prefix.'home', ['site_list' => $site_list]);
    }

    public function siteStore(Request $request){
        $SpiderSiteModel = new SpiderSiteModel();
        $data = $request->all();

        $filldata  = function($model, $data) {
            $model->fill($data);
            $model->base_filter = json_encode($model->rebuildFilter($data['base_filter']));
            $model->info_filter = json_encode($data['info_filter']['title'][0] ? $model->rebuildFilter($data['info_filter']) : '');
        };

        if($data['id'] && $site = SpiderSiteModel::find($data['id'])){
            $filldata($site, $data);
            $site->save();
        }else{
            $filldata($SpiderSiteModel, $data);
            $SpiderSiteModel->save();
        }
        return back();
    }

    /**
     * site details
     */
    public function site_details($id = 0){
        $type_list = SpiderSiteTypeModel::all()->toArray();
        $site_data = '';

        if($id){
            $site_data = SpiderSiteModel::find($id)->toArray();
            $site_data['base_filter'] = SpiderSiteModel::debuildFilter($site_data['base_filter']);
            $site_data['info_filter'] = SpiderSiteModel::debuildFilter($site_data['info_filter']);
        }

        return view($this->view_prefix.'site_details', ['type_list' => $type_list, 'data' => $site_data]);
    }
}
