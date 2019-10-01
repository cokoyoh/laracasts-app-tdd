@if($errors->{$bag ?? 'default'}->any())
    <ul class="field mt-3 list-none">
        @foreach($errors->{$bag ?? 'default'}->all() as $error)
            <li class="text-sm text-red-700">{!! $error !!}</li>
        @endforeach
    </ul>
@endif
