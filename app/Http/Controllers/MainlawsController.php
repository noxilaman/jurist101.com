<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbApp;
use Illuminate\Support\Facades\Auth;

class MainlawsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);

        $keyword = $request->query('search');

        $perpage = 10;
        if(!empty($keyword)){
            $dataapps = TbApp::where('name','like','%'.$keyword.'%')->paginate($perpage);
        }else{
            $dataapps = TbApp::paginate($perpage);
        }
        
        $this->updateVersion();

        return view('admin.mainlaws.index',compact('dataapps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mainlaws.create');
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
       // dd( $input );
        $mainlaw = TbApp::create($input);

        return redirect('/admin/mainlaws');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainlaw = TbApp::findOrFail($id);
        // dd($roleList );
        return view('admin.mainlaws.view',compact('mainlaw'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainlaw = TbApp::findOrFail($id);
        // dd($roleList );
        return view('admin.mainlaws.edit',compact('mainlaw'));
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
        
        $mainlaw = TbApp::findOrFail($id);
        $mainlaw->update($input);
        return redirect('/admin/mainlaws');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainlaw = TbApp::findOrFail($id);
        $mainlaw->delete();

        return redirect('/admin/mainlaws');
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
