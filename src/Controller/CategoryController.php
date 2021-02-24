<?php

namespace App\Controller;

use App\Model\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController
{
    public function index()
    {
//           $categories = \App\Model\Category::withTrashed()->get();
            $categories = \App\Model\Category::paginate(3);

   //        $categories = \App\Model\Category::onlyTrashed()->get();

//           $categories = \App\Model\Category::get();



        return view('category/table', compact('categories'));
    }

    public function create()
    {

        $category = new Category();

        return view('category/form', compact('category'));
    }

    public function store()
    {

        $data = request()->all();

       $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:categories,title'],
            'slug' => ['required', 'unique:categories,slug']
        ]);
       $error = $validator ->errors();
       if (count($error) >0){
           $_SESSION['data'] = $data;
           $_SESSION['errors'] = $error ->toArray();

           return new RedirectResponse($_SERVER['HTTP_REFERER']);}



        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text' => "Category \" {$data['title']}\" succesfully saved.",
        ];

        return new RedirectResponse('/categories');
    }


    public function edit($id)
    {
        $category = \App\Model\Category::find($id);

        return view('category/form', compact('category'));
    }

    public function update($id)
    {
        $category = \App\Model\Category::find($id);

        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:categories,title,' . $id],
            'slug' => ['required','unique:categories,slug,' . $id],
        ]);

        $error = $validator ->errors();
        if (count($error) >0){
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error ->toArray();

            return new RedirectResponse($_SERVER['HTTP_REFERER']);}



        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text' => "Category \" {$data['title']}\" succesfully updated.",
        ];

        return new RedirectResponse('/categories');
    }

    public function destroy($id)
    {
        $category = \App\Model\Category::find($id);
        $category->delete();

        return new RedirectResponse('/categories');
    }
}
