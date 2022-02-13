@props(['for'])

@error($for)
    {{-- <span {{ $attributes->merge(['class' => 'invalid-feedback']) }} role="alert">
        <strong>{{ $message }}</strong>
    </span> --}}
    <span class="flex items-center font-medium tracking-wide text-red-500 text-xl mt-2 ml-1">{{$message}}</span>
@enderror
