@if ($paginator->hasPages())
    <nav class="pagination-bar" aria-label="{{ __('Pagination Navigation') }}">
        <ul class="pagination">
            <li class="page-item">
                @if ($paginator->onFirstPage())
                    <span class="page-link" aria-label="{!! __('pagination.previous') !!}">&laquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" title="{!! __('pagination.previous') !!}">&laquo;</a>
                @endif
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="">{{ $element }}</span>
                    </span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item">
                            @if ($page == $paginator->currentPage())
                                <span class="page-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach
            <li class="page-item">
            </li>
            <li class="page-item">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link" title="{!! __('pagination.next') !!}">&raquo;</a>
                @else
                    <span class="page-link" aria-label="{!! __('pagination.next') !!}">&raquo;</span>
                @endif
            </li>
        </ul>
    </nav>
@endif
