@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'border-gray-600 focus:border-indigo-300 text-2xl bg-gray-200 py-4 rounded-md shadow-sm  focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
