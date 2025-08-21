<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Projects List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            margin: 20px;
            padding: 0;
        }
        .projects-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .project-card {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            width: 300px;
            padding: 15px;
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .project-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .project-title {
            font-size: 1.4rem;
            margin: 0 0 10px 0;
            color: #333;
        }
        .project-description {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
            min-height: 60px;
        }
        .project-info {
            font-size: 0.9rem;
            color: #444;
            margin-bottom: 6px;
        }
        .budget {
            font-weight: bold;
            color: #1a73e8;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center; margin-bottom: 30px;">Projects List</h1>

    <div class="projects-container">
        @foreach ($projects as $project)
            <div class="project-card">
               @if ($project->getFirstMedia('image_project'))
    <img 
        src="{{ $project->getFirstMediaUrl('image_project') }}" 
        alt="Project Image" 
        style="width: 100%; max-width: 500px; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" 
    />
@else
    <div style="width: 100%; max-width: 500px; height: 300px; background-color: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
        No Image Available
    </div>
@endif

                <h2 class="project-title">{{ $project->title }}</h2>

                <p class="project-description">{{ $project->description }}</p>

                <div class="project-info budget">Budget: {{ $project->budget }} USD</div>
                <div class="project-info">Start Date: {{ $project->start_date }}</div>
                <div class="project-info">End Date: {{ $project->end_date }}</div>
            </div>
        @endforeach
    </div>

</body>
</html>
