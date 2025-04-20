<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TbLawdatum;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $question = Question::findOrFail($id);
        $lawdatum = TbLawdatum::findOrFail($question->lawdata_id);
        return view('admin.questions.edit', compact('question', 'lawdatum', 'id'));
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
        $question = Question::findOrFail($id);
        $question->update($input);

        return redirect('/admin/questionslaw/' . $question->lawdata_id);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByLaw($lawdata_id,Request $request)
    {
        $keyword = $request->query('search');

        $perpage = 10;
        $lawdatum = TbLawdatum::findOrFail($lawdata_id);
        $dataquestions = $lawdatum->questions()->paginate($perpage);
        return view('admin.questions.index',compact('lawdata_id','dataquestions','lawdatum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByLaw($lawdata_id)
    {
        $lawdatum = TbLawdatum::findOrFail($lawdata_id);
        return view('admin.questions.create', compact('lawdata_id', 'lawdatum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeByLaw($lawdata_id,Request $request)
    {
        $input = $request->all();
        $input['lawdata_id'] = $lawdata_id;
        $input['i_seq'] = 0;

        Question::create($input);

        return redirect('/admin/questionslaw/' . $lawdata_id );
    }
}
