<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-3 bg-[#148d3a] hover:bg-[#10722f] text-white font-semibold text-sm rounded-xl transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-[#148d3a] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>