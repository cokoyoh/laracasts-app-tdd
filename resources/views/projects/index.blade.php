@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <a href="/projects/create">New Project</a>
    </div>

    @forelse($projects as $project)
        <li>
            <a href="{!! $project->path() !!}">{!! $project->title !!}</a>
        </li>
    @empty
        <li>No projects yet</li>
    @endforelse
@endsection

