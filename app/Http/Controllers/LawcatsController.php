<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbLawcat;
use App\Models\TbApp;

class LawcatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mainlaw_id, Request $request)
    {
        $keyword = $request->query('search');

        $perpage = 10;

        $dataappObj = TbLawcat::where('app_id', $mainlaw_id)->where('i_parent_id', 0);
        if (!empty($keyword)) {
            $dataappObj = $dataappObj->where('c_name', 'like', '%' . $keyword . '%');
        }


        $dataapps = $dataappObj->orderBy('i_seq', 'asc')->paginate($perpage);

        return view('admin.lawcats.index', compact('dataapps', 'mainlaw_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mainlaw_id)
    {
        $tbapp = TbApp::findOrFail($mainlaw_id);

        $tbLawCat = TbLawcat::where('app_id', $mainlaw_id)->where('i_parent_id', 0)->orderBy('i_seq', 'ASC')->get();

        return view('admin.lawcats.create', compact('tbapp', 'tbLawCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($mainlaw_id, Request $request)
    {
        $input = $request->all();

        $input['app_id'] = $mainlaw_id;

        if (empty($input['i_parent_id'])) {
            $input['i_parent_id'] = 0;

            $input['i_level'] = 0;

        } else {

            $parentCat = TbLawcat::findOrFail($input['i_parent_id']);

            $input['i_level'] = $parentCat->i_level + 1;
        }




        TbLawcat::create($input);

        return redirect('/admin/lawcats/' . $mainlaw_id . '/data/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mainlaw_id, $id)
    {
        $tbapp = TbApp::findOrFail($mainlaw_id);

        $tbLawCat = TbLawcat::where('app_id', $mainlaw_id)->where('i_parent_id', 0)->orderBy('i_seq', 'ASC')->get();

        $lawcat = TbLawcat::findOrFail($id);

        return view('admin.lawcats.edit', compact('tbapp', 'tbLawCat', 'lawcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $mainlaw_id, $id)
    {
        $input = $request->all();

        if(empty($input['i_parent_id'])){
            $input['i_parent_id'] = 0;
            $input['app_id'] = $mainlaw_id;
            $input['i_level'] = 1;
        }else{
             $parentCat = TbLawcat::findOrFail($input['i_parent_id']);
            $input['app_id'] = $mainlaw_id;
            $input['i_level'] = $parentCat->i_level + 1;
        }

        $lawcat = TbLawcat::findOrFail($id);
        $lawcat->update($input);

        return redirect('/admin/lawcats/' . $mainlaw_id . '/data/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mainlaw_id,$id)
    {
        $lawdata = TbLawcat::findOrFail($id);

        $lawdata->delete();

        return redirect('/admin/lawcats/'.$mainlaw_id.'/data/');
    }

    public function viewcat($catid)
    {
        $catdata = TbLawcat::findOrFail($catid);

        // dd($catdata->laws);
        return view('admin.lawcats.view', compact('catdata'));
    }
    public function parent($mainlaw_id, $id)
    {
        $perpage = 10;
        $dataapps = TbLawcat::where('app_id', $mainlaw_id)->where('i_parent_id', $id)->orderBy('i_seq', 'asc')->paginate($perpage);

        return view('admin.lawcats.index', compact('dataapps', 'mainlaw_id', 'id'));
    }

    public function sub($mainlaw_id, $id)
    {
        $perpage = 10;
        $dataapps = TbLawcat::where('app_id', $mainlaw_id)
            ->where('i_parent_id', $id)
            ->orderBy('i_seq', 'asc')->paginate($perpage);

        return view('admin.lawcats.sub', compact('dataapps', 'mainlaw_id', 'id'));
    }
}
