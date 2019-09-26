@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-normal mb-10 text-center">Edit your Project</h1>

    <form method="post"
          action="{!! $project->path() !!}"
          class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-6 rounded shadow">

        @method('patch')

        @include('projects.partials.form', [
            'buttonText' => 'Update Project'
        ])
    </form>
@endsection
