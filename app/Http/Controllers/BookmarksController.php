<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Folder;
use App\Models\Note;

class BookmarksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = 10;
        $userid = Auth::user()->id;
        $bookmarks = Bookmark::where('user_id',$userid)->paginate($perpage);

        return view('bookmarks.index',compact('bookmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addLawToDefaultFolder($lawid){
        
        $userid = Auth::user()->id;
        $folder = Folder::where('user_id',$userid)->where('status','DEFAULT')->first();
        if(empty($folder)){
            //Create default folder 
            $tmpFolder = [];
            $tmpFolder['user_id'] = $userid;
            $tmpFolder['parent_id'] = 0;
            $tmpFolder['level_id'] = 0;
            $tmpFolder['seq'] = 1;
            $tmpFolder['name'] = 'DEFAULT';
            $tmpFolder['status'] = 'DEFAULT';
            $folder=Folder::create($tmpFolder);
        }

        //check have bookmark or not IN DEFAUT;
        $chk = Bookmark::where('user_id',$userid)->where('folder_id',$folder->id)->where('law_id',$lawid)->count();
        if($chk == 0){
            $maxseq = Bookmark::where('user_id',$userid)->where('folder_id',$folder->id)->max('seq');
            $tmpBookmark = [];
            $tmpBookmark['user_id'] = $userid;
            $tmpBookmark['folder_id'] = $folder->id;
            $tmpBookmark['law_id'] = $lawid;
            $tmpBookmark['seq'] = $maxseq + 1;

            $folder=Bookmark::create($tmpBookmark);
        }

        return redirect('/bookmarks')->with('success', 'Add Bookmark Complete');   

    }

    public function addLawToFolder($lawid){
        
    }

    public function addLawToFolderAction($lawid){
        
    }

    public function addDekaToDefaultFolder($dekaid){
        
        $userid = Auth::user()->id;
        $folder = Folder::where('user_id',$userid)->where('status','DEFAULT')->first();
        if(empty($folder)){
            //Create default folder 
            $tmpFolder = [];
            $tmpFolder['user_id'] = $userid;
            $tmpFolder['parent_id'] = 0;
            $tmpFolder['level_id'] = 0;
            $tmpFolder['seq'] = 1;
            $tmpFolder['name'] = 'DEFAULT';
            $tmpFolder['status'] = 'DEFAULT';
            $folder=Folder::create($tmpFolder);
        }

        //check have bookmark or not IN DEFAUT;
        $chk = Bookmark::where('user_id',$userid)->where('folder_id',$folder->id)->where('deka_id',$dekaid)->count();
        if($chk == 0){
            $maxseq = Bookmark::where('user_id',$userid)->where('folder_id',$folder->id)->max('seq');
            $tmpBookmark = [];
            $tmpBookmark['user_id'] = $userid;
            $tmpBookmark['folder_id'] = $folder->id;
            $tmpBookmark['deka_id'] = $dekaid;
            $tmpBookmark['seq'] = $maxseq + 1;

            $folder=Bookmark::create($tmpBookmark);
        }

        return redirect('/bookmarks')->with('success', 'Add Bookmark Complete');   

    }

    public function addNote($bookmarkid){
        $bookmarkdata = Bookmark::findOrFail($bookmarkid);
        $userid = Auth::user()->id;
        $note = Note::where('bookmark_id',$bookmarkid)->where('user_id',$userid )->first();

        return view('bookmarks.editnote',compact('bookmarkdata','note'));
    }

    public function addNoteAction(Request $request , $bookmarkid){
        $input = $request->all();

        $userid = Auth::user()->id;
        $note = Note::where('bookmark_id',$bookmarkid)->where('user_id',$userid )->first();

        $tmp = [];
        $tmp['user_id'] = $userid;
        $tmp['bookmark_id'] = $bookmarkid; 
        $tmp['start_index'] = 0;
        $tmp['end_index']= 0;
        $tmp['select_word'] = '';
        $tmp['seq'] = 1;
        $tmp['note'] = $input['note'];

        if(empty($note)){
            $note = Note::create($tmp);
        }else{
            $note->update($tmp);
        }

        return redirect('/bookmarks')->with('success', 'Add Note Complete'); 
    }
}
