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
        .initaitive-card {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            width: 300px;
            padding: 15px;
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }
        .initaitive-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .initaitive-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .initaitive-title {
            font-size: 1.4rem;
            margin: 0 0 10px 0;
            color: #333;
        }
        .initaitive-description {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
            min-height: 60px;
        }
        .initaitive-info {
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

    <h1 style="text-align: center; margin-bottom: 30px;">initaitives List</h1>

    <div class="projects-container">
        @foreach ($initaitives as $initaitive)
            <div class="initaitive-card">
               @if ($initaitive->getFirstMedia('image_initaitive'))
    <img 
        src="{{ $initaitive->getFirstMediaUrl('image_initaitive') }}" 
        alt="Project Image" 
        style="width: 100%; max-width: 500px; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" 
    />
@else
    <div style="width: 100%; max-width: 500px; height: 300px; background-color: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
        No Image Available
    </div>
@endif

                <h2 class="initaitive-title">{{ $initaitive->title }}</h2>

                <p class="initaitive-description">{{ $initaitive->description }}</p>

                <div class="initaitive-info budget">target Amount: {{ $initaitive->target_amount }} SAR</div>
                <div class="initaitive-info budget">current  Amount: {{ $initaitive->current_amount }} SAR</div>
                <div class="initaitive-info">Start Date: {{ $initaitive->start_date }}</div>
                <div class="initaitive-info">End Date: {{ $initaitive->end_date }}</div>
                <div class="initaitive-info">status: {{ $initaitive->status }}</div>
            </div>
        @endforeach
    </div>

</body>
</html>
