@csrf
<div class="field mb-6">
    <label for="title" class="label text-sm mb-2 block">Title</label>

    <div class="control">
        <input type="text"
               class="input bg-transparent border border-gray-300 rounded p-2 text-sm w-full"
               value="{!! $project->title !!}"
               name="title"
               required
               placeholder="On to the next project idea...">
    </div>
</div>

<div class="field mb-6">
    <label for="description" class="label text-sm mb-2 block">Description</label>

    <div class="control">
        <textarea
            class="input bg-transparent border border-gray-300 rounded p-2 text-sm w-full"
            rows="5"
            name="description"
            required
            placeholder="Europa...">
            {!! $project->description !!}
        </textarea>
    </div>
</div>

<div class="field mb-6">
    <button type="submit" class="button mr-5">{!! $buttonText !!}</button>
    <a href="{!! $project->path() !!}" class="py-2 text-gray-500">Cancel</a>
</div>

@if($errors->any())
<div class="field">
    @foreach($errors->all() as $error)
        <li class="text-sm text-red-700">{!! $error !!}</li>
    @endforeach
</div>
@endif
