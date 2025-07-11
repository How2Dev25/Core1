@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
        {{-- Items count --}}
        <div class="text-sm text-gray-500">
            Showing <span class="font-medium">{{ $paginator->firstItem() }}</span>
            to <span class="font-medium">{{ $paginator->lastItem() }}</span>
            of <span class="font-medium">{{ $paginator->total() }}</span> results
        </div>

        {{-- Pagination controls --}}
        <div class="join">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="join-item btn btn-sm" disabled>
                    <i class='bx bx-chevron-left'></i> Prev
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm">
                    <i class='bx bx-chevron-left'></i> Prev
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button class="join-item btn btn-sm btn-disabled">{{ $element }}</button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="join-item btn btn-sm btn-active">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="join-item btn btn-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm">
                    Next <i class='bx bx-chevron-right'></i>
                </a>
            @else
                <button class="join-item btn btn-sm" disabled>
                    Next <i class='bx bx-chevron-right'></i>
                </button>
            @endif
        </div>
    </div>
@endif