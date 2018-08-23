<div class="container"> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @php ($slides = $defaultData['slides'])
        @php($i = 1)
        @foreach($slides as $slide)
        <li data-target="#myCarousel" data-slide-to="{{$i++}}" class="@if($i++ == 1) active @else  @endif"></li>
        @endforeach
      
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    @php($i = 1)

    @foreach($slides as $slide)
      <div class="item @if($i++ == 1) active @else  @endif">
        <img src="{{ asset ('public/uploads/slide/image/'.$slide->image) }}" alt="Los Angeles" style="width:100%;">
      </div>
      @endforeach
      

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>