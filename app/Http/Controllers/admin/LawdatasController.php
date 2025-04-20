<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TbLawdatum;
use App\Models\TbLawcat;
use App\Models\TbApp;

class LawdatasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mainlaw_id)
    {
        $tbapp = TbApp::findOrFail($mainlaw_id);

        $tbLawCat = TbLawcat::where('app_id',$mainlaw_id)->where('i_parent_id',0)->orderBy('i_seq','ASC')->get();

        return view('admin.laws.create',compact('tbapp','tbLawCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($mainlaw_id,Request $request)
    {
        $input = $request->all();
        $input['app_id'] = $mainlaw_id;
        TbLawdatum::create($input);

        $this->updateVersion(0);

        return redirect('/admin/laws/'.$mainlaw_id.'/data/'.$input['i_lawcat'].'/sub');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mainlaw_id,$id)
    {
        $tbapp = TbApp::findOrFail($mainlaw_id);

        $tbLawCat = TbLawcat::where('app_id',$mainlaw_id)->where('i_parent_id',0)->orderBy('i_seq','ASC')->get();

        $lawdata = TbLawdatum::findOrFail($id);

        return view('admin.laws.view',compact('tbapp','tbLawCat','lawdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mainlaw_id,$id)
    {
        $tbapp = TbApp::findOrFail($mainlaw_id);

        $tbLawCat = TbLawcat::where('app_id',$mainlaw_id)->where('i_parent_id',0)->orderBy('i_seq','ASC')->get();

        $lawdata = TbLawdatum::findOrFail($id);

        return view('admin.laws.edit',compact('tbapp','tbLawCat','lawdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($mainlaw_id,Request $request, $id)
    {
        $input = $request->all();
        $lawdata = TbLawdatum::findOrFail($id);
        $lawdata->update($input);

        $this->updateVersion($mainlaw_id);

        return redirect('/admin/laws/'.$mainlaw_id.'/data/'.$input['i_lawcat'].'/sub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mainlaw_id,$id)
    {
        $lawdata = TbLawdatum::findOrFail($id);
        $catid = $lawdata->i_lawcat;

        $lawdata->delete();


        return redirect('/admin/laws/'.$mainlaw_id.'/data/'.$catid.'/sub');
    }

    public function sub($mainlaw_id,$id)
    {
        $perpage = 10;
        $lawcat = TbLawcat::findOrFail($id);
        $dataapps = TbLawdatum::where('app_id',$mainlaw_id)
        ->where('i_lawcat',$id)
        ->orderBy('i_lawno','asc')->paginate($perpage);

        return view('admin.laws.index',compact('dataapps','id','mainlaw_id','lawcat'));
    }

    public function updateVersion($appid = 0){
        $lastupdateTbApp = TbApp::orderBy('updated_at','desc')->first();
        $currentVersion = $lastupdateTbApp->updated_at;
        if($appid == 0){
            TbApp::query()->update(['version' => $currentVersion]);
        }else{
            TbApp::where('id',$appid)->update(['version' => $currentVersion]);
        }
    }
}
