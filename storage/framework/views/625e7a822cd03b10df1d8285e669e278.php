<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management</title>

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

        .add-btn, .courses-btn {
            display: inline-block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .add-btn {
            background: #2563eb;
        }

        .courses-btn {
            background: #64748b;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            margin: 15px 0 25px;
            flex-wrap: wrap;
        }

        .filter-form input,
        .filter-form select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            flex: 1;
            min-width: 180px;
        }

        .search-btn, .reset-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .search-btn {
            background: #2563eb;
        }

        .reset-btn {
            background: #64748b;
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

        .empty {
            text-align: center;
            padding: 25px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Students Management</h1>

    <a href="<?php echo e(route('students.create')); ?>" class="add-btn">
        + Add New Student
    </a>

    <a href="<?php echo e(route('courses.index')); ?>" class="courses-btn">
        Manage Courses
    </a>

    <?php if(session('success')): ?>
        <div class="message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Search and Filter -->
    <form action="<?php echo e(route('students.index')); ?>" method="GET" class="filter-form">

        <input
            type="text"
            name="search"
            placeholder="Search by name, email or phone..."
            value="<?php echo e(request('search')); ?>"
        >

        <select name="course_id">
            <option value="">All Courses</option>

            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($course->id); ?>"
                    <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>
                    <?php echo e($course->title); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button type="submit" class="search-btn">
            Search
        </button>

        <a href="<?php echo e(route('students.index')); ?>" class="reset-btn">
            Reset
        </a>

    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($student->id); ?></td>
                    <td><?php echo e($student->name); ?></td>
                    <td><?php echo e($student->email); ?></td>
                    <td><?php echo e($student->phone ?? 'N/A'); ?></td>
                    <td><?php echo e($student->course->title); ?></td>

                    <td class="actions">

                        <a href="<?php echo e(route('students.edit', $student)); ?>"
                           class="edit">Edit</a>

                        <form action="<?php echo e(route('students.destroy', $student)); ?>"
                              method="POST"
                              style="display:inline;">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="delete"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>

                        </form>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="empty">
                        No students found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>

    <?php echo e($students->links()); ?>


</div>

</body>
</html><?php /**PATH D:\training-center\resources\views/students/index.blade.php ENDPATH**/ ?>