<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TbLawdatum;
use App\Models\TbLawcat;

class CoreLawsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = 10;

        $keyword = $request->query('search');

        if(!empty($keyword)){
            $laws = TbLawdatum::where('c_name','like','%'.$keyword.'%')
            ->orWhere('c_desc','like','%'.$keyword.'%')
            ->orWhere('c_comment','like','%'.$keyword.'%')
            ->orWhere('i_no',$keyword)
            ->paginate($perpage);
        }else{
            $laws = TbLawdatum::orderBy('i_id','desc')->paginate($perpage);
        }

        return view('admin.corelaws.index',compact('laws'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.corelaws.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        TbLawdatum::create($input);

        return redirect('/admin/corelaws');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lawdata = TbLawdatum::findOrFail($id);

        return view('admin.corelaws.view',compact('lawdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lawdata = TbLawdatum::findOrFail($id);

        $tbapp = $lawdata->mainlaw;

        $tbLawCat = TbLawcat::where('app_id',$tbapp->id)->where('i_parent_id',0)->orderBy('i_seq','ASC')->get();

        return view('admin.corelaws.edit',compact('tbapp','tbLawCat','lawdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $lawdata = TbLawdatum::findOrFail($id);
        $lawdata->update($input);

        return redirect('/admin/corelaws');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lawdata = TbLawdatum::findOrFail($id);
        $lawdata->delete();

        return redirect('/admin/corelaws');
    }
}
