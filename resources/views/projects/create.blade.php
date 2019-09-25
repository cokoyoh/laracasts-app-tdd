@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="card w-1/2">
            <form method="post" action="/projects">
                @csrf

                <h1 class="text-gray-700 mb-4 text-lg">Create a Project</h1>

                <div class="mb-4">
                    <label for="title" class="text-gray-700 mb-6">Title</label>

                    <div class="">
                        <input type="text" class="w-full card" name="title" placeholder="Title">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="text-gray-700 mb-4">Description</label>

                    <div class="">
                        <textarea class="w-full card" name="description" placeholder="Description" rows="5"> </textarea>
                    </div>
                </div>

                <div class="">
                    <div class="flex content-center ">
                        <button type="submit" class="button mr-5">Create Project</button>
                        <a href="/projects" class="py-2 text-gray-500">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
