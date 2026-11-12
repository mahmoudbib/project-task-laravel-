<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // عرض الطلاب مع البحث والفلترة
    public function index(Request $request)
    {
        $query = Student::with('course');

        // البحث عن طالب
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // الفلترة حسب الكورس
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        $courses = Course::all();

        return view('students.index', compact('students', 'courses'));
    }

    // صفحة إضافة طالب
    public function create()
    {
        $courses = Course::all();

        return view('students.create', compact('courses'));
    }

    // حفظ طالب جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'course_id' => 'required|exists:courses,id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    // عرض بيانات طالب
    public function show(Student $student)
    {
        $student->load('course');

        return view('students.show', compact('student'));
    }

    // صفحة تعديل طالب
    public function edit(Student $student)
    {
        $courses = Course::all();

        return view('students.edit', compact('student', 'courses'));
    }

    // تحديث بيانات طالب
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'phone' => 'nullable|string|max:20',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    // حذف طالب
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}