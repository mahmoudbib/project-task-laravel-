<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>

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

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        textarea {
            height: 120px;
            resize: vertical;
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

    <h1>Add New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">

        @csrf

        <label>Course Title</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Price</label>
        <input type="number" name="price" step="0.01" min="0"
               value="{{ old('price') }}">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Duration</label>
        <input type="number" name="duration" min="1"
               value="{{ old('duration') }}">
        @error('duration')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Save Course</button>

        <a href="{{ route('courses.index') }}" class="back">
            Back
        </a>

    </form>

</div>

</body>
</html>