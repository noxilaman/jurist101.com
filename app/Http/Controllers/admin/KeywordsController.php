<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Keymap;
use App\Models\TbApp;


class KeywordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $app_id)
    {
        $perpage = 10;

        $tbapp = TbApp::findOrFail($app_id);

        $keymapObj = Keymap::where('app_id',$app_id);
        
        $keyword = $request->query('search');

        if(!empty($keyword)){
            $keymapObj = $keymapObj->where('key','like','%'.$keyword.'%')->orWhere('desc','like','%'.$keyword.'%');
        }

        $keymaps = $keymapObj->paginate($perpage);

        return view('admin.keymaps.index',compact('keymaps','tbapp'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($app_id)
    {
        $tbapp = TbApp::findOrFail($app_id);
        return view('admin.keymaps.create',compact('tbapp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$app_id)
    {
        $input = $request->all();
        $input['app_id'] = $app_id;
        Keymap::create($input);

        return redirect(route('adminkeymaps.index',[$app_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($app_id,$id)
    {
        $keymap = Keymap::findOrFail($id);
        return view('admin.keymaps.show',compact('keymap'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($app_id,$id)
    {
        $keymap = Keymap::findOrFail($id);
        return view('admin.keymaps.edit',compact('keymap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$app_id, $id)
    {
        $input = $request->all();
        $input['app_id'] = $app_id;
        $keymap = Keymap::findOrFail($id);
        $keymap->update($input);

        return redirect(route('adminkeymaps.index',[$app_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($app_id,$id)
    {
        $lawdata = Keymap::findOrFail($id);
        $lawdata->delete();
        return redirect(route('adminkeymaps.index',[$app_id]));
    }
}
