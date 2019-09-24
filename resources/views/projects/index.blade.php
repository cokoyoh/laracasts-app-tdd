@extends('layouts.app')

@section('content')
    <header class="flex items-center py-4">
        <div class="flex justify-between items-end w-full">
            <h3 class="text-gray-700 text-sm font-normal">My Projects</h3>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.partials.card')
            </div>
        @empty
            <div>No projects yet</div>
        @endforelse
    </div>

@endsection

