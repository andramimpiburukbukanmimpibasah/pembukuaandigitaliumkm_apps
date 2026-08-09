@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#115468] focus:ring-2 focus:ring-[#115468] rounded-xl py-2.5 px-3.5 shadow-sm']) }}>