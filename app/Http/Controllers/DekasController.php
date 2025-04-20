<?php

namespace App\Http\Controllers;

use App\Models\TbDeka;
use Illuminate\Http\Request;

class DekasController extends Controller
{
    public function viewdeka($dekaid){
        $lawdata = TbDeka::findOrFail($dekaid);
        // dd($lawdata );
        return view('dekas.view',compact('lawdata'));
    }

    public function sharedekaview($dekaid, $dekano){
        $lawdata = TbDeka::where('id',$dekaid)->where('i_no',$dekano)->first();
        // dd($lawdata );
        return view('dekas.shareview',compact('lawdata'));
    }

    public function nonmember_viewdeka($dekaid){
        $lawdata = TbDeka::findOrFail($dekaid);
        // dd($lawdata );
        return view('dekas.nonmemberview',compact('lawdata'));
    }
    
}
