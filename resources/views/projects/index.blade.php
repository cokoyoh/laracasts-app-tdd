<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Birdboard</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>Birdboard</h1>

    @forelse($projects as $project)
        <li>
            <a href="{!! $project->path() !!}">{!! $project->title !!}</a>
        </li>
    @empty
        <li>No projects yet</li>
    @endforelse
</body>
</html>

