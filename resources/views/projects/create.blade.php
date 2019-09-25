@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="card w-3/4">
            <form method="post" action="/projects">
                @csrf

                <h1 class="text-gray-700 mb-4 text-lg">Create a Project</h1>

                <div>
                    <label for="title" class="text-gray-700 font-normal text-lg">Title</label>

                    <div class="">
                        <input type="text" class="w-full card mt-3 mb-3" name="title" placeholder="Title...">
                    </div>
                </div>

                <div>
                    <label for="description" class="text-gray-700 mb-3 text-lg">Description</label>

                    <div class="">
                        <textarea class="w-full card mt-3 mb-3" name="description" placeholder="Description..." rows="5"> </textarea>
                    </div>
                </div>

                <div>
                    <div class="flex content-center mt-4 ">
                        <button type="submit" class="button mr-5">Create Project</button>
                        <a href="/projects" class="py-2 text-gray-500">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
