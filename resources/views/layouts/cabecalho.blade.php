<div class="d-flex align-items-center mb-3">
    @if(!empty($rote))
        @if(!empty($param))
            <a class="btn btn-dark btn-sm text-white me-2" href="{{ route($rote, $param) }}">
                <i class="fas fa-chevron-left fa-2x"></i>
            </a>
        @else
            <a class="btn btn-dark btn-sm text-white me-2" href="{{ route($rote) }}">
                <i class="fas fa-chevron-left fa-2x"></i>
            </a>
        @endif
    @endif
    <h3 class="text-light mb-0">{{ $title }}</h3>
</div>
