<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TbApp;

class AppDatasController extends Controller
{
    public function chkAllApp()
    {
        $lastupdateTbApp = TbApp::orderBy('updated_at','desc')->first();
        $version['version'] = $lastupdateTbApp->version;
        
        return response()->json($version,200);
    }

    public function chkAppVersion($appid)
    {
        $lastupdateTbApp = TbApp::findorFail($appid);
        $version['version'] = $lastupdateTbApp->version;
        
        return response()->json($version,200);
    }

    public function ListAllApp()
    {
        $allApp = TbApp::all();
        
        return response()->json($allApp,200);
    }
}
