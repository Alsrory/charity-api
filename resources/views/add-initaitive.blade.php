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
        <form action="{{ route('initaitives.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Initiative Title</label><br/>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Initiative Description</label><br/>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="target_amount"> target Amount of Initiative </label><br/>
                <input type="number" name="target_amount" id="target_amount" class="form-control" value="{{ old('target_amount') }}" required>
            </div>
           <div class="form-group">
                <label for="current_amount">current Amount of Initiative </label><br/>
                <input type="number" name="current_amount" id="current_amount" class="form-control" value="{{ old('current_amount') }}" required>
            </div>
            <div class="form-group">
                <label for="start_date"> Start Date</label><br/>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
            </div>

            <div class="form-group">
                <label for="end_date"> End Date</label><br/>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
            </div>

            <div class="form-group">
                <label for="status"> Status</label><br/>
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
