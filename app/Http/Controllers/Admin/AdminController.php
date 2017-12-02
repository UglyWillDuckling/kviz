<?php
namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index() {
      //  DB::enableQueryLog();

        $questions = Question::with('category')->get();

        return view('admin', compact($questions));
    }

    public function questions(Request $request) {
        return view('admin/questions', [
            'params' => \GuzzleHttp\json_encode($request->input())
        ]);
    }
}