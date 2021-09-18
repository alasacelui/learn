<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Category::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $btn = "<a href='javascript:void(0)' class='text-decoration-none'
                onclick='c_edit(`#m_category`, `.category_form :input`, [`#m_category_title`, `Edit Category`], [`.btn_add_category`, `.btn_update_category`], $row)'><i class='fas fa-edit'></i> Edit</a> |"; // param [modal ID, form ID, model instance]

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none text-danger' 
                onclick='c_destroy($row->id,`category.destroy`,`.category_dt`)'><i class='fas fa-trash'></i> Delete</a> "; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('category.index');
    }

    public function store(CategoryRequest $request)
    {
        $form_data = $request->validated();


        Category::create($form_data);

        return $this->res(['message' => 'Category Added Successfully']);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $form_data = $request->validated();

        $category->update($form_data);

        return $this->res(['message' => 'Category Updated Successfully']);

    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->res(['message' => 'Category Deleted Successfully']);

    }
}
