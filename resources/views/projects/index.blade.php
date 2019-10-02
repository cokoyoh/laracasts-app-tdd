@extends('layouts.app')

@section('content')
    <header class="flex items-center py-4">
        <div class="flex justify-between items-end w-full">
            <h3 class="text-gray-700 text-sm font-normal">My Projects</h3>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.partials.card')
            </div>
        @empty
            <div>No projects yet</div>
        @endforelse
    </main>

    <modal name="hello-world" classes="p-10 card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>

        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="text-sm block mb-2">Title</label>
                    <input type="text" id="title" name="title"
                           class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                    >
                </div>

                <div class="mb-4">
                    <label for="description" class="text-sm block mb-2">Description</label>
                    <textarea id="description" name="description"
                           class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                              rows="5"
                    ></textarea>
                </div>
            </div>

            <div class="flex-1 ml-4">
                <div class="mb-4">
                    <label class="text-sm block mb-2">Let's add some tasks</label>
                    <input type="text"
                           class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                           placeholder="Task 1"
                    >

                    <button class="button text-xs mt-2 inline-flex items-center">
                        Add New Task Field
                    </button>
                </div>
            </div>
        </div>

        <footer class="flex justify-end">
            <button class="button-outlined mr-4 text-xs">Cancel</button>
            <button class="button text-xs">Create Project</button>
        </footer>

    </modal>

    <a href="" @click.prevent="$modal.show('hello-world')">Show Modal</a>

@endsection

