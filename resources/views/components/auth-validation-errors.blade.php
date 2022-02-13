@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-xl text-red-600">
            {{ __('Whoops! Algo salio mal.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-xl text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
