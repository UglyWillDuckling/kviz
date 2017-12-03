<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question as QuestionModel;
use App\Helper\Question as Helper;
use App\Repository\Question as Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Question extends Controller
{
    private $helper;
    private $repository;

    public function __construct(Helper $helper,Repository $repository)
    {
        $this->helper = $helper;
        $this->repository = $repository;
    }

    public function index(Request $request) {
       $questions = $this->repository->getQuestions($request->input(), $request->input('per_page'));
       $result = $this->helper->buildResponse($questions);

       return [
            'result' => $result,
            'success' => sizeof($questions) ? true : false
       ];
   }

   public function question($id) {
       return QuestionModel::find($id);
   }
}