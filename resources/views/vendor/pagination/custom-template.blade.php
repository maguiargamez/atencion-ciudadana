@if ($paginator->hasPages())
    <div class="pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <a class="prevposts-link" aria-label="@lang('pagination.previous')"><i class="fa fa-caret-left"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="prevposts-link" aria-label="@lang('pagination.previous')"><i class="fa fa-caret-left"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>

                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="current-page" aria-current="page" >{{ $page }}</a>
                        @else
                            <a href="{{ $url }}"  >{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
            @else
                <a  class="disabled" rel="next" aria-label="@lang('pagination.next')" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
            @endif

    </div>
@endif
