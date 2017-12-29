<?php

namespace App\Http\Controllers\Admin;


use App\Question;
use App\Repository\Question as QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * @var Repository
     */
    private $repository;


    public function __construct(QuestionRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {
        //TODO rework this
        $questions = Question::with('category')->get();

        return view('admin', compact($questions));
    }

    public function questions(Request $request)
    {
        return view('admin/questions', [
            'params' => \GuzzleHttp\json_encode($request->input(), JSON_FORCE_OBJECT)
        ]);
    }

    public function question($id)
    {
        if (!$question = Question::where('id', $id)->with('answers')->first()) {
            abort(404, 'The question you requested doesn\'t exist.');
        }
        return view('admin/question', [
            'question' => \GuzzleHttp\json_encode($question->toArray())
        ]);
    }

    public function createQuestion()
    {
        return view('admin/question');
    }

    public function editQuestion(Request $request)
    {
        try {
            if ($request->input('id')) {
                ///update existing question
                if (!$question = Question::where('id', $request->input('id'))->with('answers')->first()) {
                    abort(404, 'This question doesn\'t exist.');
                }
                $this->repository->updateQuestion($question, $request->all());
            }
            else {
                $this->repository->createQuestion($request->input('id'), $request->all());
            }
        }
        catch (\Exception $exception) {
            $response = back();
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $response->withErrors($exception->validator);
            }
            return $response->withInput();
        }
    }
}