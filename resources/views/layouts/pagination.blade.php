@if($paginator->hasPages())
 	@php 
	    $perpage=$paginator->perPage();
	    $pgno=$paginator->currentPage();
	    $start = (($perpage*$pgno)-($perpage-1));
	    $end =  $start + ($perpage-1);
	    $total = $paginator->total();
		if($end>$total){
        	$end=$total;
        }
    @endphp
	<nav class="d-flex justify-content-between " id="pagination-mobi">
	<div>
		<small>Showing {{$start}} - {{$end}} of {{$total}}</small>
	</div>
  		<ul class="pagination" id="paginate">
  	    @if($paginator->onFirstPage())
  			<li class="page-item prev"><a class="page-link disabled text-decoration-none" ><i class="fas fa-chevron-left"></i></a></li>
  		@else
  			<li class="page-item prev"><a class="page-link" href="{{$paginator->previousPageUrl()}}"><i class="fas fa-chevron-left"></i></a></li>
  		@endif
     	@foreach ($elements as $element)
           
            @if (is_string($element))
                 <li class="page-item"><a class="page-link " >{{ $element }}</a></li>
            @endif
            
            @if(is_countable($element) && count($element)>5)
            		@php $large = true; 
            		$count=count($element); 
            		@endphp            
            @else
            		@php $large = false; @endphp            
            @endif
	        @php 
	        $i = 0; 
	        $max=5;
	        @endphp
            @if (is_array($element))
                @foreach ($element as $page => $url)
            		@if ($large)
	            			@if ($i<$max)
			            		@if(($paginator->currentPage()-($max-3) >1) )
			            			@php $start = $paginator->currentPage()-2;  @endphp            
			            			@if(($paginator->currentPage()== $count) )
			            				@php $start = $paginator->currentPage()-($max-1);  @endphp            
			            			@endif
			            			@if(($paginator->currentPage()+1 == $count) )
			            				@php $start = $paginator->currentPage()-($max-2);  @endphp            
			            			@endif
			            		@else
			            			@php $start = 1;  @endphp            
			            		@endif

		            			@if ($page >= $start)
			            			@if ($page == $paginator->currentPage())
				                        <li class="page-item active"><a class="page-link text-decoration-none" >{{ $page }}</a></li>
				                    @else
				                        <li class="page-item"><a class="page-link text-decoration-none" href="{{ $url }}">{{ $page }}</a></li>
				                    @endif
		                    		@php $i++ @endphp
			                    @endif
		                    @endif

	            	@else
	                    @if ($page == $paginator->currentPage())
	                        <li class="page-item active"><a class="page-link text-decoration-none" >{{ $page }}</a></li>
	                    @else
	                        <li class="page-item"><a class="page-link text-decoration-none" href="{{ $url }}">{{ $page }}</a></li>
	                    @endif
	                @endif
                @endforeach
            @endif
        @endforeach
        @if($paginator->hasMorePages())
    		<li class="page-item next"><a class="page-link text-decoration-none" href="{{$paginator->nextPageUrl()}}"><i class="fas fa-chevron-right"></i></a></li>
    	@else
    		<li class="page-item next"><a class="page-link disabled" ><i class="fas fa-chevron-right"></i></a></li>
    	@endif
  		</ul>
	</nav>
@endif