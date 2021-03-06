<div class="card" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3 ">
        <a href="{!! $project->path() !!}" class="text-black no-underline">{!! $project->title !!}</a>
    </h3>

    <div class="text-gray-600 mb-4">{!! Str::limit($project->description, 100) !!}</div>

    @can('manage', $project)
        <footer>
            <form action="{!! $project->path() !!}" method="post" class="text-right">
                @csrf
                @method('delete')


                <button type="submit" class="text-xm">Delete</button>
            </form>
        </footer>
    @endcan
</div>
