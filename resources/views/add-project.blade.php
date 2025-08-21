<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Project</title>
</head>
<body>

    <h1 style="color: brown; padding: 0 30%;">Create Post</h1>

    {{-- عرض رسالة النجاح --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div style="border: 2px saddlebrown solid; font-size: 18px; margin: 20px; padding: 20px;">
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Project Title</label><br/>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Project Description</label><br/>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="budget">Project Budget</label><br/>
                <input type="number" name="budget" id="budget" class="form-control" value="{{ old('budget') }}" required>
            </div>

            <div class="form-group">
                <label for="start_date">Project Start Date</label><br/>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Project End Date</label><br/>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
            </div>

            <div class="form-group">
                <label for="status">Project Status</label><br/>
                <select name="status" id="status" class="form-control" required>
                    <option value="ongoing" @selected(old('status') == 'ongoing')>Ongoing</option>
                    <option value="completed" @selected(old('status') == 'completed')>Completed</option>
                    <option value="on_hold" @selected(old('status') == 'on_hold')>On Hold</option>
                    <option value="cancelled" @selected(old('status') == 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Project Image</label><br/>
                <input type="file" name="photo" id="image" class="form-control-file" accept="image/*">
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary">Add Project</button>
            </div>

        </form>
    </div>

</body>
</html>
