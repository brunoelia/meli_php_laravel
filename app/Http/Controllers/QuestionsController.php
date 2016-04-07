<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\ApiMeli;

class QuestionsController extends Controller
{
    protected $meli;

    public function __construct() 
    {
      $this->meli = new ApiMeli();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $data['questions'] = Question::orderBy('id','desc')->get();

      return view('list-questions',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function reply($id)
    {
      $data['question'] = Question::find($id);

      return view('question-reply',$data);
    }

    public function sendReply(Request $request, $id)
    {
      $data = $request->all();
      $data['question_id'] = $id;

      if (Question::answer($data))
      {
        $this->meli->pushAnswer($id);
      }

      return redirect('/question');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      if (Question::destroy($id))
      {
        $this->meli->deleteQuestion($id);
      }

      return redirect('/question');
    }
}
