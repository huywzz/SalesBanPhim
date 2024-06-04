{{-- <div class="paginate-container">
    <div class="paginate-container-row">
        <div class="paginate-container-col">
            <ul>
                <li><a href=""><i class="fa-solid fa-chevron-left"></i></a></li>
                <li class="active"><span>1</span></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
                <li><a href=""><i class="fa-solid fa-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
</div> --}}

@if ($paginator->hasPages())
    <div class="paginate-container">
        <div class="paginate-container-row">
            <div class="paginate-container-col">
                <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="disabled" aria-disabled="true">
                            <span aria-hidden="true"><i class="fa-solid fa-caret-left"></i></span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}"><i class="fa-solid fa-caret-left"></i></a>
                        </li>
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
                                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-caret-right"></i></a>
                        </li>
                    @else
                        <li class="disabled" aria-disabled="true">
                            <span aria-hidden="true"><i class="fa-solid fa-caret-right"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
