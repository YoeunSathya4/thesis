@if ($paginator->hasPages())
        <div class="pagination-holder">
               <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <!-- <li><span><i class="fa fa-angle-left"></i></span></li> -->
                        <li><a href="#" aria-label="Previous">Prev</a></li>
                    @else
                        <!-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left"></i></a></li> -->
                        <li><a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">Prev</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li><a href="#">{{ $element }}</a></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    
                                    <li class="active"><a href="#">{{ $page }}</a></li>
                                @else
                                    <!-- <li><a class="button small grey" href="{{ $url }}">{{ $page }}</a></li> -->
                                    <li><a href="#">{{ $page }}</a></li>

                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <!-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li> -->
                        <li><a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">Next</a></li>
                    @else
                        <!-- <li><span><i class="fa fa-angle-right"></i></span></li> -->
                        <li><a href="#" aria-label="Next">Next</a></li>
                    @endif
                </ul>
        </div>
@endif
