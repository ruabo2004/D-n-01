<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // public function addStudents()
    // {
     
    //     $students = [
    //         ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'date_of_birth' => '2000-01-01'],
    //         ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'date_of_birth' => '2001-02-02'],
    //         ['name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com', 'date_of_birth' => '2002-03-03'],
    //     ];

   
    //     foreach ($students as $data) {
    //         Student::create($data);
    //     }

    //     return "Thêm dữ liệu thành công!";
    // }

    public function create()
    {
        return view('admin.student.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email',
            'date_of_birth' => 'required|date',
        ]);
    
        try {
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
            ]);
    
    
            return redirect()->route('student.index')->with('success', 'Thêm sinh viên thành công!');
        } catch (\Exception $e) {
            // Gửi chi tiết lỗi qua view bằng cách đính kèm thông báo từ $e->getMessage()
            return redirect()->back()->withErrors(['error' => 'Thêm sinh viên không thành công. Lỗi: ' . $e->getMessage()]);
        }
    }
    
    
    

    public function index()
    {
        $students = Student::all(); 
        return view('admin.student.index', compact('students')); 
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email,' . $id,
            'date_of_birth' => 'required|date',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('student.index')->with('success', 'Thông tin sinh viên được cập nhật thành công.');
    }

    // Xóa sinh viên khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Sinh viên đã bị xóa thành công.');
    }

    public function getAllStudentsJson()
    {
        $students = Student::all();
        return response()->json($students);
    }


    public function getStudentsWithCourses()
    {
        $students = Student::with('courses')->get();
        return response()->json($students);
    }
}
 