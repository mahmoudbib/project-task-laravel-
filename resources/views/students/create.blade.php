<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button, .back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #64748b;
            color: white;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Student</h1>

    <form action="{{ route('students.store') }}" method="POST">

        @csrf

        <label>Student Name</label>
        <input type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Phone (Optional)</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        @error('phone')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Select Course</label>

        <select name="course_id">
            <option value="">Choose a Course</option>

            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
            @endforeach

        </select>

        @error('course_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Save Student</button>

        <a href="{{ route('students.index') }}" class="back">
            Back
        </a>

    </form>

</div>

</body>
</html>