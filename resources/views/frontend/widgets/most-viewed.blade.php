@if(isset($most_viewed))
    <h4 class="text-info text-center">En Çok Okunanlar</h4>
    @foreach($most_viewed as $most)
        <div class="list-group row-col-md-3">
            <a href="{{route('single', [$most->category->slug, $most->slug])}}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$most->title}}</h5>
                    <small class="text-muted">{{$most->category->name}}</small>
                </div>
                <small class="text-muted">{{$most->created_at->diffForHumans()}}</small>
            </a>
        </div>
    @endforeach
@endif
