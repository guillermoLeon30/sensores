@php
	$firstPage = 1;
    if ($maxPages > $paginator->lastPage()) {
        $maxPages = $paginator->lastPage();
        $offset = 0;
    }
@endphp

@if($paginator->hasPages())
	<ul class="pagination">
		<!-- Botón para navegar a la primera página -->
		@if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->url($firstPage) }}">&laquo;&laquo;</a></li>
        @endif

        <!-- Botón para navegar a la página anterior -->
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
        @endif

        <!-- Mostrar la numeración de las páginas, partiendo de la página actual hasta el maximo definido en $maxPages -->
        @if($paginator->currentPage() <= $maxPages - $offset)
        	@for($i = $firstPage; $i<=$maxPages; $i++)
        		@if($i == $paginator->currentPage())
        			<li class="active"><span>{{ $i }}</span></li>
        		@else
        			<li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        		@endif
        	@endfor
        @endif

        @if(($paginator->currentPage() > $maxPages - $offset) && ($paginator->currentPage() <= $paginator->lastPage() - $offset))
            @php
                if ($maxPages == $paginator->lastPage()) 
                    $offset = $paginator->lastPage()-1;
            @endphp

        	@for($i = $paginator->currentPage()-$offset; $i<=$paginator->currentPage(); $i++)
        		@if($i == $paginator->currentPage())
        			<li class="active"><span>{{ $i }}</span></li>
        		@else
        			<li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        		@endif
        	@endfor

            @if($maxPages != $paginator->lastPage())
                @for($i = $paginator->currentPage()+1; $i<=$paginator->currentPage()+$offset; $i++)
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endfor
            @endif

            @php
                if ($maxPages == $paginator->lastPage()) 
                    $offset = 0;
            @endphp
        @endif

        @if($paginator->currentPage() > $paginator->lastPage() - $offset)
        	@for($i = $paginator->lastPage()-$maxPages+1; $i<=$paginator->lastPage(); $i++)
        		@if($i == $paginator->currentPage())
        			<li class="active"><span>{{ $i }}</span></li>
        		@else
        			<li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        		@endif
        	@endfor
        @endif

        <!-- Botón para navegar a la página siguinete -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif

        <!-- Botón para navegar a la última página -->
         @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">&raquo;&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;&raquo;</span></li>
        @endif
        
	</ul>
@endif()