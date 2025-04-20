<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TbApp;
use App\Models\TbLawcat;
use App\Models\TbLawdatum;

use function PHPUnit\Framework\isEmpty;

class SelectedLawsController extends Controller
{
    function index($main_id, Request $request)
    {
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);
        $mainCats = TbLawcat::where('app_id', $main_id)
            ->where('i_parent_id', 0)
            ->orderBy('i_seq')
            ->get();
        // var_dump($mainCats);
        $mainLaws = TbLawdatum::where('app_id', $main_id)
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);


        $searchTxt =  $request->get('searchTxt');
        $splitTxt = explode(',', $searchTxt); //split text in array 


        if ($request->get('searchTxt')) {
            $mainCats = TbLawcat::where('app_id', $main_id)
                // ->where('i_parent_id', 0)
                ->where(function ($query) use ($splitTxt) {
                    foreach ($splitTxt as $word) {
                        $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                        $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                    }
                })
                ->orderBy('i_seq')
                ->get();
        }

        return view('selectlaw.dashboard', compact(
            'mainapp',
            'mainCats',
            'mainLaws',
            'searchTxt'
        ));
    }

    function indexcat($main_id, $catId, Request $requst)
    {

        // var_dump($main_id);
        // var_dump($catId);
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);
        $selectCat = TbLawcat::findOrFail($catId);
        $mainCats = TbLawcat::where('app_id', $main_id)
            ->where('i_parent_id', $catId)
            ->orderBy('i_seq')
            ->get();
        // var_dump($selectCat);
        $mainLaws = TbLawdatum::where('i_lawcat', $catId)
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);
        // var_dump($mainLaws);
        return view('selectlaw.dashboard', compact(
            'mainapp',
            'mainCats',
            'mainLaws',
            'selectCat'
        ));
    }


    // public function indexCatHierarchy($main_id, $catId = null, Request $request)
    public function indexCatHierarchy(Request $request, $main_id, $catId = null)
    {


        $parameters = explode('/', $catId);
        $firstParameter = reset($parameters);
        $lastParameter = end($parameters);
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);


        $selectCat = TbLawcat::findOrFail($lastParameter);


        if (!isEmpty($lastParameter)) {
            $selectCat = TbLawcat::findOrFail($lastParameter);
        }

        $mainCats = TbLawcat::where('app_id', $main_id)
            // ->where('i_parent_id', 0)
            ->orderBy('i_seq')
            ->get();

        $mainLaws = TbLawdatum::where('i_lawcat', end($parameters))
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);

        // dd($searchTxt);

        return view('selectlaw.dashboardHierarchy', compact(
            'mainapp',
            'mainCats',
            'mainLaws',
            'selectCat',
            'parameters'
        ));
    }

    public function indexCatSection($main_id, Request $request)
    {
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);
        $searchTxt =  $request->get('searchTxt');
        $splitTxt = explode(',', $searchTxt); //split text in array 


        $mainLaws = TbLawdatum::where('app_id', $main_id)
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);


        if ($request->get('searchTxt')) {
            $mainLaws = TbLawdatum::where(function ($query) use ($splitTxt) {
                foreach ($splitTxt as $word) {
                    $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                    $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                    $query->orWhere('short_note', 'LIKE', '%' . $word . '%');
                }
            })->orderBy('i_no')
                ->orderBy('i_subno')
                ->paginate(30)
                ->appends([
                    'searchTxt' => $searchTxt,

                ]);
        }

        return view('selectlaw.dashboardSection', compact(
            'mainapp',
            'mainLaws',
            'searchTxt',
        ));
    }

    function nonmemberindex($main_id, Request $request)
    {
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);
        $mainCats = TbLawcat::where('app_id', $main_id)
            ->where('i_parent_id', 0)
            ->orderBy('i_seq')
            ->get();
        // var_dump($mainCats);
        $mainLaws = TbLawdatum::where('app_id', $main_id)
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);


        $searchTxt =  $request->get('searchTxt');
        $splitTxt = explode(',', $searchTxt); //split text in array 


        if ($request->get('searchTxt')) {
            $mainCats = TbLawcat::where('app_id', $main_id)
                // ->where('i_parent_id', 0)
                ->where(function ($query) use ($splitTxt) {
                    foreach ($splitTxt as $word) {
                        $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                        $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                    }
                })
                ->orderBy('i_seq')
                ->get();
        }

        return view('selectlaw.nonmemberdashboard', compact(
            'mainapp',
            'mainCats',
            'mainLaws',
            'searchTxt'
        ));
    }

    public function nonmemberindexCatHierarchy(Request $request, $main_id, $catId = null)
    {


        $parameters = explode('/', $catId);
        $firstParameter = reset($parameters);
        $lastParameter = end($parameters);
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);


        $selectCat = TbLawcat::findOrFail($lastParameter);


        if (!isEmpty($lastParameter)) {
            $selectCat = TbLawcat::findOrFail($lastParameter);
        }

        $mainCats = TbLawcat::where('app_id', $main_id)
            // ->where('i_parent_id', 0)
            ->orderBy('i_seq')
            ->get();

        $mainLaws = TbLawdatum::where('i_lawcat', end($parameters))
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);

        // dd($searchTxt);

        return view('selectlaw.nonmemberdashboardHierarchy', compact(
            'mainapp',
            'mainCats',
            'mainLaws',
            'selectCat',
            'parameters'
        ));
    }

    public function nonmemberindexCatSection($main_id, Request $request)
    {
        $perpage = 30;
        $mainapp = TbApp::findOrFail($main_id);
        $searchTxt =  $request->get('searchTxt');
        $splitTxt = explode(',', $searchTxt); //split text in array 


        $mainLaws = TbLawdatum::where('app_id', $main_id)
            ->orderBy('i_no')
            ->orderBy('i_subno')
            ->paginate($perpage);


        if ($request->get('searchTxt')) {
            $mainLaws = TbLawdatum::where(function ($query) use ($splitTxt) {
                foreach ($splitTxt as $word) {
                    $query->orWhere('c_name', 'LIKE', '%' . $word . '%');
                    $query->orWhere('c_desc', 'LIKE', '%' . $word . '%');
                    $query->orWhere('short_note', 'LIKE', '%' . $word . '%');
                }
            })->orderBy('i_no')
                ->orderBy('i_subno')
                ->paginate(30)
                ->appends([
                    'searchTxt' => $searchTxt,

                ]);
        }

        return view('selectlaw.nonmemberdashboardSection', compact(
            'mainapp',
            'mainLaws',
            'searchTxt',
        ));
    }
}
