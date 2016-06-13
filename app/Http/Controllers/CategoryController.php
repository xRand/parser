<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->count = $category->ads()->count();
        }
        return view('index', compact('categories'));
    }

    public function getModels()
    {
        $category = Category::findById(Input::get('id'));
        $models = $category->ads()->groupBy('model')->get()->toArray();

        $html = '<option value="all">Все модели</option>';
        if(empty($models)) {
            return $html;
        } else {
            foreach ($models as $model) {
                $html .= '<option>' . $model['model'] . '</option>';
            }
            return $html;
        }
    }

    public function search(){
        $input = Input::get();
        $keyword = $input['keyword'];
        $categoryID = $input['category'];
        if(!empty($keyword)) {
            $keywords = explode(' ', $keyword);
            if(empty($keywords[1]))  return redirect('/cars/' . $keywords[0] . '/all');
            else return redirect('/cars/' . $keywords[0] . '/' . $keywords[1]);
        }
        else if($categoryID == 'all'){
            return redirect('/cars/all');
        } else {
            $category = Category::findById($categoryID);
            $categoryName = str_replace(' ', '-', $category->name);
            if(empty($input['model'])) {
                return redirect('/cars/' . $categoryName . '/all');
            }
            else {
                return redirect('/cars/' . $categoryName . '/' . $input['model']);
            }
        }
    }

    public function show($categoryName, $model = null)
    {
        $sortOption = Input::get('sort', 'price_asc');
        $filterOptions = Input::except('sort');


        if($categoryName == 'all') {
            $ads = Ad::sort($sortOption)->paginate(15);
           foreach($ads as $ad){
               $ad->category = $ad->category->name;
           }

        } else {
            $categoryName = str_replace('-', ' ', $categoryName);
            $category = Category::findByName($categoryName);
            if($model == 'all') {
                $ads = $category->ads()
                                ->sort($sortOption)
                                ->filter($filterOptions)
                                ->paginate(15);
                //orderByRaw('CAST(price AS UNSIGNED) DESC, price')
            }
            else {
             //   $model = str_replace('-', ' ', $model);
                $ads = $category->ads()->where('model', $model)->sort($sortOption)->paginate(15);
            }
        }
        $categories = Category::all();
        return view('ads', compact('ads', 'categoryName', 'categories', 'sortOption', 'model', 'filterOptions'));

    }
}
