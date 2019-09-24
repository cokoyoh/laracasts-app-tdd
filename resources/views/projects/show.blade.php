@extends('layouts.app')

@section('content')
    <header class="flex items-center py-4 mb-6">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-700 text-sm font-normal">
                <a href="/projects" class="text-gray-700 text-sm font-normal no-underline">My Projects</a> / {!! $project->title !!}
            </p>

            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main>
       <div class="lg:flex -m-3">
           <div class="lg:w-3/4 px-3 mb-6">
               <div class="mb-8">
                   <h3 class="text-lg text-gray-700 font-normal mb-3">Tasks</h3>

                   <div class="card mb-3">Lorem ipsum.</div>
                   <div class="card mb-3">Lorem ipsum.</div>
                   <div class="card mb-3">Lorem ipsum.</div>
                   <div class="card">Lorem ipsum.</div>

                   {{-- Tasks--}}
               </div>

              <div>
                  <h3 class="text-lg text-gray-700 font-normal mb-3">General Notes</h3>

                  {{-- General Notes--}}
                  <textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
              </div>
           </div>

           <div class="lg:w-1/4 px-3 mt-8">
               @include('projects.partials.card')
           </div>

       </div>
    </main>

@endsection
