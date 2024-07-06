@if($message = session('message'))
    <x-alert typr="success" dismissible >
{{--        {{ $component->icon() }}--}}
        {{$message}}
    </x-alert>
@endif
