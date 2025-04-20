<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\TbDeka;
use App\Models\TbApp;
use App\Models\TbDekaLaw;
use App\Models\TbLawcat;
use App\Models\TbLawdatum;


class DekaLawsController extends Controller
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
        if (!empty($keyword)) {
            $dekas = TbDeka::where('i_no', $keyword)
                ->orWhere('i_subno', $keyword)
                ->orWhere('c_name', 'like', '%' . $keyword . '%')
                ->orderBy('id', 'DESC')
                ->paginate($perpage);
        } else {
            $dekas = TbDeka::orderBy('id', 'DESC')->paginate($perpage);
        }

        return view('admin.dekas.index', compact('dekas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dekas.create');
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

        $chk = TbDeka::where('i_no',$input['i_no'])->where('i_subno',$input['i_subno'])->count();

        if($chk == 0){
            TbDeka::create($input);
            return redirect('/admin/dekas')->with('success', 'Add Complete');
        }else{
            return redirect('/admin/dekas')->with('success', 'Duplicate ฎีกา');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $deka = TbDeka::findOrFail($id);
        // dd($roleList );
        return view('admin.dekas.view', compact('deka'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deka = TbDeka::findOrFail($id);
        // dd($roleList );
        return view('admin.dekas.edit', compact('deka'));
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
        // dd($input);
        $deka = TbDeka::findOrFail($id);
        $deka->update($input);

        return redirect('/admin/dekas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TbDeka::destroy($id);
        return redirect('/admin/dekas');
    }

    public function addLaw2Deka($id)
    {
        $listApp = TbApp::pluck('name', 'id');
        $deka = TbDeka::findOrFail($id);
        // dd($roleList );
        return view('admin.dekas.addlawdeka', compact('deka', 'listApp'));
    }

    public function addLaw2DekaAction($id, Request $request)
    {
        $input = $request->all();

        if (!empty($input['lawdata_id'])) {
            $lastdekalaw = TbDekaLaw::where('deka_id', $id)->orderBy('order', 'DESC')->first();
            if (empty($lastdekalaw)) {
                $input['order'] = 1;
            } else {
                $input['order'] = $lastdekalaw->seq + 1;
            }


            $input['deka_id'] = $id;

            TbDekaLaw::create($input);
        }


        return redirect('/admin/dekas/listlaw/' . $id);
    }

    public function listLaw2Deka($id)
    {
        $perpage = 10;
        $deka = TbDeka::findOrFail($id);
        $dekalaws = TbDekaLaw::where('deka_id', $id)->orderBy('order', 'ASC')->paginate($perpage);

        return view('admin.dekas.listlaw', compact('dekalaws', 'deka'));
    }

    public function deleteLaw2Deka($id,$dekaid)
    {

        TbDekaLaw::destroy($id);
        return redirect('/admin/dekas/listlaw/' . $dekaid);
    }

    public function getLawCat($i_app)
    {
        $tbLawCat = TbLawcat::where('app_id', $i_app)->where('i_parent_id', 0)->orderBy('i_seq', 'ASC')->get();
        $cats = [];
        foreach ($tbLawCat as $cat0) {
            $cats[] = ['name' => $cat0->c_name, 'id' => $cat0->i_id];
            if ($cat0->subcats()->count() > 0) {
                foreach ($cat0->subcats()->orderBy('i_seq', 'asc')->get() as $cat1) {
                    $cats[] = ['name' => "--" . $cat1->c_name, 'id' => $cat1->i_id];
                    if ($cat1->subcats()->count() > 0) {
                        foreach ($cat1->subcats()->orderBy('i_seq', 'asc')->get() as $cat2) {
                            $cats[] = ['name' => "----" . $cat2->c_name, 'id' => $cat2->i_id];
                            if ($cat2->subcats()->count() > 0) {
                                foreach ($cat2->subcats()->orderBy('i_seq', 'asc')->get() as $cat3) {
                                    $cats[] = ['name' => "------" . $cat3->c_name, 'id' => $cat3->i_id];
                                    if ($cat3->subcats()->count() > 0) {
                                        foreach ($cat3->subcats()->orderBy('i_seq', 'asc')->get() as $cat4) {
                                            $cats[] = ['name' => "--------" . $cat4->c_name, 'id' => $cat4->i_id];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return response()->json($cats);
    }
    public function getLaw($i_app, $parent_id)
    {
        $tbLawData = TbLawdatum::where('app_id', $i_app)->where('i_lawcat', $parent_id)->orderBy('i_no', 'ASC')->orderBy('i_subno', 'ASC')->get();
        $cats = [];
        foreach ($tbLawData as $law) {
            $cats[] = ['name' => $law->c_name, 'id' => $law->i_id];
        }

        return response()->json($cats);
    }

    public function getalllaw($i_app)
    {
        $tbLawData = TbLawdatum::where('app_id', $i_app)->orderBy('i_no', 'ASC')->orderBy('i_subno', 'ASC')->get();
        $cats = [];
        foreach ($tbLawData as $law) {
            $cats[] = ['name' => $law->c_name, 'id' => $law->i_id];
        }

        return response()->json($cats);
    }


}
