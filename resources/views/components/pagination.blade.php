{{--<ul class="custom-pagination">--}}
{{--    @for ($i = 1; $i <= $countPages; $i++)--}}
{{--        <li class="custom-pagination__page-item @if ($i == $currentPage) active @endif">--}}
{{--            <span class="custom-pagination__page-link">{{ $i }}</span>--}}
{{--        </li>--}}
{{--    @endfor--}}
{{--</ul>--}}

<ul class="custom-pagination">
    @php
        $start = max($currentPage - 2, 1);
        $end = min($currentPage + 2, $countPages);
    @endphp

    @if ($start > 1)
        <li class="custom-pagination__page-item">
            <span class="custom-pagination__page-link">1</span>
        </li>
        @if ($start > 2)
            <li class="custom-pagination__page-item disabled">
                <span class="custom-pagination__page-link">...</span>
            </li>
        @endif
    @endif

    @for ($i = $start; $i <= $end; $i++)
        <li class="custom-pagination__page-item @if ($i == $currentPage) active @endif">
            <span class="custom-pagination__page-link">{{ $i }}</span>
        </li>
    @endfor

    @if ($end < $countPages)
        @if ($end < $countPages - 1)
            <li class="custom-pagination__page-item disabled">
                <span class="custom-pagination__page-link">...</span>
            </li>
        @endif
        <li class="custom-pagination__page-item">
            <span class="custom-pagination__page-link">{{ $countPages }}</span>
        </li>
    @endif
</ul>
