<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TbLawcat;
use Illuminate\Http\Request;
use App\Models\TbLawdatum;
use App\Models\TbDekaLaw;
use App\Models\TbDeka;

class LawDatasController extends Controller
{
    public function getAllLawData($appid)
    {
        // Fetch all law data from the database
        $lawData = TbLawdatum::where('app_id', $appid)
            ->orderBy('i_no', 'asc')
            ->get(['i_no', 'i_subno', 'c_name', 'c_desc', 'c_comment', 'c_url', 'i_lawcat', 'i_lawno']);

        // Return the data as a JSON response
        return response()->json($lawData, 200);
    }

    public function getAllLawCategory($appid)
    {
        // Fetch all law categories from the database
        $lawCategories = TbLawcat::where('app_id', $appid)
            ->orderBy('i_seq', 'asc')
            ->get();

        // Return the data as a JSON response
        return response()->json($lawCategories, 200);
    }

    public function getDekaMap($appid)
    {
        // Fetch all law categories from the database
        $lawListId = TbLawdatum::where('app_id', $appid)->pluck('i_id');

        $dekamap = TbDekaLaw::where('lawdata_id', $lawListId)
            ->get();

        // Return the data as a JSON response
        return response()->json($dekamap, 200);
    }

    public function getDekaData($appid)
    {
        // Fetch all law categories from the database
        $lawListId = TbLawdatum::where('app_id', $appid)->pluck('i_id');

        $dekaListId = TbDekaLaw::where('lawdata_id', $lawListId)
            ->pluck('deka_id');

        $dekadata = TbDeka::where('id', $dekaListId)
            ->get();

        // Return the data as a JSON response
        return response()->json($dekadata, 200);
    }
}
