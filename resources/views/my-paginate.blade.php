@if ($paginator->hasPages())
    <div style="margin-left: auto; margin-right: auto">
        <nav aria-label="...">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item" aria-label="@lang('pagination.previous')">
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" tabindex="-1" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item" aria-current="page"><a class="page-link" style="background-color: #4c0ab8; color: white">
                                        <span>{{ $page }}</span>
                                    </a></li>
                            @else
                                <li class="page-item" ><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
