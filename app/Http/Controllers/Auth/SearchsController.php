<?php

namespace App\Http\Controllers;

use App\Models\TbLawcat;
use App\Models\TbLawdatum;
use App\Models\TbApp;
use App\Models\TbDeka;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SearchsController extends Controller
{
    public function index(Request $request)
    {
        $mainappRws = TbApp::all();

        $mainapps = [];

        foreach ($mainappRws as $mainapp) {
            $mainapps[$mainapp->group_app][] = $mainapp;
        }

        return view('searchs.index', compact('mainapps'));
    }
    public function seachAction($key, Request $request)
    // public function seachAction(Request $request)

    {
        //lawCat



        $lawcats = [];
        if (Cache::has('c_lawcat_' . $key)) {
            $lawcats = Cache::get('c_lawcat_' . $key);
        } else {
            $lawcats = TbLawcat::where('c_name', 'like', '%' . $key . '%')
                ->orWhere('c_desc', 'like', '%' . $key . '%')
                ->orderBy('app_id', 'asc')
                ->get();
            Cache::put('c_lawcat_' . $key, $lawcats);
        }
        //Lawdata
        $lawdatas = [];
        if (Cache::has('c_lawdatas_' . $key)) {
            $lawdatas = Cache::get('c_lawdatas_' . $key);
        } else {
            $lawdatas = TbLawdatum::where('c_name', 'like', '%' . $key . '%')
                ->orWhere('c_desc', 'like', '%' . $key . '%')
                ->orWhere('i_no', $key)
                ->orWhere('i_subno', $key)
                ->get();
            Cache::put('c_lawdatas_' . $key, $lawdatas);
        }
        //daka
        $dekadatas = [];
        if (Cache::has('c_dakadatas_' . $key)) {
            $dekadatas = Cache::get('c_dakadatas_' . $key);
        } else {
            $dekadatas = TbDeka::where('c_name', 'like', '%' . $key . '%')
                ->orWhere('c_desc', 'like', '%' . $key . '%')
                ->orWhere('i_no', $key)
                ->orWhere('i_subno', $key)
                ->orderBy('i_subno', 'DESC')
                ->orderBy('i_no', 'DESC')
                ->get();
            Cache::put('c_dakadatas_' . $key, $dekadatas);
        }
        $dataall = [];
        foreach ($lawcats as $item) {
            if (isset($item->mainlaw->name)) {
                $dataall['cat'][$item->mainlaw->name][] = $item;
            }
        }
        foreach ($lawdatas as $item) {
            if (isset($item->mainlaw->name)) {
                $dataall['law'][$item->mainlaw->name][] = $item;
            }
        }
        //  dd($dataall);
        return view('searchs.result', compact('lawcats', 'lawdatas', 'dekadatas', 'dataall', 'key'));
    }

    public function advancesearch(Request $request)
    {
        $searchTxt =  $request->get('searchTxt');
        $splitTxt = explode(',', $searchTxt); //split text in array 
        $perPage = 20;

        

        $allLawsObj = TbLawdatum::where(function ($query) use ($splitTxt) {
            foreach ($splitTxt as $word) {
                $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                $query->orWhere('short_note', 'LIKE', '%' . $word . '%');
                $query->orWhere('i_no', $word );
                $query->orWhere('i_subno',  $word );
            }
        });

        $allLawsResultObj = clone($allLawsObj);
        $allLawsCatObj = clone($allLawsObj);

        // dd($allLawsResultObj);
        $allLaws = $allLawsResultObj->paginate($perPage, ['*'], 'allLawPage')->appends(['searchTxt' => $searchTxt]);

        $aryaLaws = TbLawdatum::where(function ($query) use ($splitTxt) {
            foreach ($splitTxt as $word) {
                $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                $query->orWhere('short_note', 'LIKE', '%' . $word . '%');
            }
        })->paginate($perPage, ['*'], 'aryaPage')->appends(['searchTxt' => $searchTxt]);

        $dekaLaws = TbDeka::where(function ($query) use ($splitTxt) {
            foreach ($splitTxt as $word) {
                $query->orWhere('i_no', $word );
                $query->orWhere('i_subno',  $word );
                $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                $query->orWhere('c_comments', 'LIKE', '%' . $word . '%');
            }
        })->paginate($perPage, ['*'], 'dekaPage')->appends(['searchTxt' => $searchTxt]);


        return view('searchs.advanceSearch', compact(
            'allLaws',
            'searchTxt',
            'dekaLaws'
        ));
    }

    public function advancesearchaction(Request $request)
    {

        $input = $request->all();
        //lawCat

        $key = $input['search'];
        $lawcats = [];
        $lawdatas = [];
        $dekadatas = [];
        if ($input['typedata'] == "" || $input['typedata'] == "law") {
            $TbLawcatObj = new TbLawcat();
            $TbLawdatumObj = new TbLawdatum();
            if (!empty($key)) {
                $TbLawcatObj = $TbLawcatObj->where('c_name', 'like', '%' . $key . '%')
                    ->orWhere('c_desc', 'like', '%' . $key . '%');

                $TbLawdatumObj = $TbLawdatumObj->where('c_name', 'like', '%' . $key . '%')
                    ->orWhere('c_desc', 'like', '%' . $key . '%');
            }
            if (!empty($input['mainapp'])) {
                $TbLawcatObj = $TbLawcatObj->where('app_id', $input['mainapp']);

                $TbLawdatumObj = $TbLawdatumObj->where('app_id', $input['mainapp']);
            }
            $lawcats = $TbLawcatObj->orderBy('app_id', 'asc')->get();
            $lawdatas = $TbLawdatumObj->get();
        }
        if ($input['typedata'] == "" || $input['typedata'] == "deka") {
            $TbDekaObj = new TbDeka();
            if (!empty($key)) {
                $TbDekaObj = $TbDekaObj->where('c_name', 'like', '%' . $key . '%')
                    ->orWhere('c_desc', 'like', '%' . $key . '%');
            }
            $dekadatas = $TbDekaObj->orderBy('i_subno', 'DESC')
                ->orderBy('i_no', 'DESC')
                ->get();
        }


        // if (Cache::has('c_lawcat_advance_' . $key )) {
        //     $lawcats = Cache::get('c_lawcat_advance_' . $key );
        // } else {
        //     $lawcats = TbLawcat::where('c_name','like','%'.$key.'%')
        //     ->orWhere('c_desc','like','%'.$key.'%')
        //     ->orderBy('app_id','asc')
        //     ->get();
        //     Cache::put('c_lawcat_advance_' . $key , $lawcats);
        // }
        // //Lawdata

        // if (Cache::has('c_lawdatas_advance_' . $key )) {
        //     $lawdatas = Cache::get('c_lawdatas_advance_' . $key );
        // } else {
        //     $lawdatas = TbLawdatum::where('c_name','like','%'.$key.'%')
        //     ->orWhere('c_desc','like','%'.$key.'%')
        //     ->get();
        //     Cache::put('c_lawdatas_advance_' . $key , $lawdatas);
        // }
        //daka

        // if (Cache::has('c_dakadatas_advance_' . $key )) {
        //     $dekadatas = Cache::get('c_dakadatas_advance_' . $key );
        // } else {
        //     $dekadatas = TbDeka::where('c_name','like','%'.$key.'%')
        //     ->orWhere('c_desc','like','%'.$key.'%')
        //     ->orderBy('i_subno','DESC')
        //     ->orderBy('i_no','DESC')
        //     ->get();
        //     Cache::put('c_dakadatas_advance_' . $key , $dekadatas);
        // }
        $dataall = [];
        foreach ($lawcats as $item) {
            if (isset($item->mainlaw->name)) {
                $dataall['cat'][$item->mainlaw->name][] = $item;
            }
        }
        foreach ($lawdatas as $item) {
            if (isset($item->mainlaw->name)) {
                $dataall['law'][$item->mainlaw->name][] = $item;
            }
        }

        return view('searchs.result', compact('lawcats', 'lawdatas', 'dekadatas', 'dataall', 'key'));
    }
}
