<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Management</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 25px;
            color: #222;
        }

        .add-btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f8fafc;
        }

        .actions a, .actions button {
            padding: 7px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .edit {
            background: #f59e0b;
            color: white;
        }

        .delete {
            background: #dc2626;
            color: white;
        }

        .message {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Courses Management</h1>

    <a href="{{ route('courses.create') }}" class="add-btn">
        + Add New Course
    </a>

    @if(session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Total Students</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>${{ number_format($course->price, 2) }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ $course->students_count }}</td>

                    <td class="actions">
                        <a href="{{ route('courses.edit', $course) }}"
                           class="edit">Edit</a>

                        <form action="{{ route('courses.destroy', $course) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty">
                        No courses found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $courses->links() }}

</div>

</body>
</html>