<?php
namespace App\Http\Controllers\Api;

use App\Category as CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Category extends Controller
{
    public function index() {
        return CategoryModel::all();
    }

    public function category($id) {
        return CategoryModel::find($id);
    }
}