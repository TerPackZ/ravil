@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Навигация по страницам">
        <ul class="pagination-list">
            @if ($paginator->onFirstPage())
                <li><span class="pagination-item is-disabled" aria-disabled="true">←</span></li>
            @else
                <li><a class="pagination-item" href="{{ $paginator->previousPageUrl() }}" rel="prev">←</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="pagination-item is-ellipsis">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="pagination-item is-active" aria-current="page">{{ $page }}</span></li>
                        @else
                            <li><a class="pagination-item" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a class="pagination-item" href="{{ $paginator->nextPageUrl() }}" rel="next">→</a></li>
            @else
                <li><span class="pagination-item is-disabled" aria-disabled="true">→</span></li>
            @endif
        </ul>
    </nav>
@endif
