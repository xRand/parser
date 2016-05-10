<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    //get models for selected category
    public function getModels()
    {
        $category = Category::findById(Input::get('id'));
        $models = $category->ads()->groupBy('model')->get()->toArray();

        $html = '<option value="all">Any Model</option>';
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
        $categoryID = $input['category'];
        if($categoryID == 'all'){

            return redirect('/cars/all/all');
        } else {
            $category = Category::findById($categoryID);
            $categoryName = str_replace(' ', '-', $category->name);
            if(empty($input['model'])) {
                return redirect('/cars/' . $categoryName . '/all');
            }
            else {
              //  $model = str_replace(' ', '-', $request->model);
                return redirect('/cars/' . $categoryName . '/' . $input['model']);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($categoryName, $model = null)
    {
        $input = Input::get();
        $sortOption = Input::get('sort', 'price_asc');

        if($categoryName == 'all') {
            //$ads = Ad::all();
            $ads = [];
        } else {
            $categoryName = str_replace('-', ' ', $categoryName);
            $category = Category::findByName($categoryName);
            if($model == 'all') {
                $ads = $category->ads()->sort($sortOption)->paginate(15);
                //orderByRaw('CAST(price AS UNSIGNED) DESC, price')
            }
            else {
             //   $model = str_replace('-', ' ', $model);
                $ads = $category->ads()->where('model', $model)->sort($sortOption)->paginate(15);
            }
        }

        $categories = Category::all(); //for search bar
        return view('ads', compact('ads', 'categoryName', 'categories', 'sortOption'));

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
}
