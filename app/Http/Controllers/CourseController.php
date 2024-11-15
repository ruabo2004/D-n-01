<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function create()
    {
        return view('admin.course.create');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Thêm khóa học mới
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('course.create')->with('success', 'Thêm khóa học thành công!');
    }
}
