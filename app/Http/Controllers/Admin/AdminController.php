<?php
namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index() {
        //TODO rework this
        $questions = Question::with('category')->get();

        return view('admin', compact($questions));
    }

    public function questions(Request $request) {
        return view('admin/questions', [
            'params' => \GuzzleHttp\json_encode($request->input(), JSON_FORCE_OBJECT)
        ]);
    }

    public function question($id) {
        if (!$question = Question::find($id)) {
            abort(404, 'The question you requested doesn\'t exist.');
        }
        return view('admin/question', [
            'question' => \GuzzleHttp\json_encode($question->toArray(), JSON_FORCE_OBJECT)
        ]);
    }

    public function createQuestion() {
        return view('admin/question');
    }
}