<?php

namespace App\Http\Controllers;

use App\Models\TbLawdatum;
use App\Models\Keymap;
use Illuminate\Http\Request;

class LawsController extends Controller
{
    public function viewlaw($lawid)
    {
        $lawdata = TbLawdatum::findOrFail($lawid);
        $keymaps = Keymap::where('app_id', $lawdata->app_id)->get();

        //  dd($keymaps);

        return view('laws.view', compact(
            'lawdata',
            'keymaps'
        ));
    }

    public function sharelawview($lawid, $lawno)
    {
        $lawdata = TbLawdatum::where('i_id',$lawid)->where('i_no',$lawno)->first();
        $keymaps = Keymap::where('app_id', $lawdata->app_id)->get();

        // dd($keymaps);

        return view('laws.shareview', compact(
            'lawdata',
            'keymaps'
        ));
    }

    public function nonmember_viewlaw($lawid)
    {
        $lawdata = TbLawdatum::findOrFail($lawid);
        $keymaps = Keymap::where('app_id', $lawdata->app_id)->get();

        //  dd($keymaps);

        return view('laws.nonmemberview', compact(
            'lawdata',
            'keymaps'
        ));
    }
}
