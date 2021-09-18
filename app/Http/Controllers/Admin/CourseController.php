<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use App\Models\TmpImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Course\CourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $courses =  CourseResource::collection(Course::all());
   
            return Datatables::of($courses)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                $new_row = collect($row);
                $btn = "<a href='javascript:void(0)' class='text-decoration-none'
                onclick='c_edit(`#m_course`, `.c_form :input`, [`#m_course_title`, `Edit Course`], [`.btn_add_course`, `.btn_update_course`], $new_row, {rname:`course.create`, target:`#course_category`})'><i class='fas fa-edit'></i> Edit</a> |"; // param [modal ID, form ID, model instance]

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none text-danger' 
                onclick='c_destroy($new_row[id],`course.destroy`,`.course_dt`)'><i class='fas fa-trash'></i> Delete</a> "; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('course.index');
    }

    public function create()
    {
        return $this->res(['results' => Category::all() ]);
    }

    public function store(CourseRequest $request)
    {
        $form_data = $request->validated();

        if($request->image) 
        {
            $course = Course::create($form_data);

            $course->addMedia(storage_path('app/public/tmp/'. $request->image))->toMediaCollection('course_image'); // move the image from the storage disk to the new media disk

            TmpImage::where('filename', $request->image)->delete(); // get the tmp image from the db

            return $this->success(['message' => 'Course Added Successfully']);
        }

        $this->error('Image is required', 404);
    }

    public function show(Course $course)
    {
        $categories = Category::all();
        $other_courses = Course::where('id', '!=', $course->id)->latest()->take(6)->get();
        return view('course.show', compact('course', 'categories', 'other_courses'));
    }

    public function update(Course $course, CourseRequest $request)
    {
        $form_data = $request->validated();

        if($request->image)
        {
            $course->image->delete();
            $course->addMedia(storage_path('app/public/tmp/'. request('image')))->toMediaCollection('course_image');
            TmpImage::where('filename', $request->image)->delete(); // get the tmp image from the db
        }

        $course->update($form_data);
        return $this->res(['message' => 'Course Updated Successfully']);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return $this->res(['message' => 'Course Deleted Successfully']);
    }
}
