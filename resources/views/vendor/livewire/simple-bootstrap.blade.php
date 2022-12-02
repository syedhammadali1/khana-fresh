<div>
    @if ($paginator->hasPages())
        <nav aria-label="Page navigation example">

            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page">@lang('pagination.previous')</span>
                    </li>
                @else
                    @if (method_exists($paginator, 'getCursorName'))
                        <li class="page-item">
                            <a dusk="previousPage" class="page"
                                wire:click="setPage('{{ $paginator->previousCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                                wire:loading.attr="disabled" rel="prev">@lang('pagination.previous')</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a
                                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="page" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled" rel="prev">@lang('pagination.previous')
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if (method_exists($paginator, 'getCursorName'))
                        <li class="page-item">
                            <a dusk="nextPage" class="page"
                                wire:click="setPage('{{ $paginator->nextCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                                wire:loading.attr="disabled" rel="next">@lang('pagination.next')</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a
                                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="page" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled" rel="next">@lang('pagination.next')</a>
                        </li>
                    @endif
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="page">@lang('pagination.next')</a>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
