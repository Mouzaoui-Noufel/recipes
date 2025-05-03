@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-4">
        <div class="inline-flex space-x-2 text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 border rounded text-gray-400 bg-white dark:bg-gray-800 dark:border-gray-600 cursor-not-allowed">
                    {{ __('Prev') }}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border rounded text-gray-700 bg-white hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                    {{ __('Prev') }}
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1 border rounded text-gray-500 bg-white dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 border rounded bg-blue-500 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 border rounded text-gray-700 bg-white hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border rounded text-gray-700 bg-white hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                    {{ __('Next') }}
                </a>
            @else
                <span class="px-3 py-1 border rounded text-gray-400 bg-white dark:bg-gray-800 dark:border-gray-600 cursor-not-allowed">
                    {{ __('Next') }}
                </span>
            @endif
        </div>
    </nav>
@endif
