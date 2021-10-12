@if(isset($categories))
    <div class="col-md-3" style="margin-top: 45px;">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>
            <div class="list-group">
                @foreach($categories as $category)
                    <a @if(Request::segment(2)!=$category->slug) href=" {{route('category', $category->slug)}}" @endif class="list-group-item @if(Request::segment(2)==$category->slug || Request::segment(1)==$category->slug) active @endif">{{$category->name}}
                        <span class="badge bg-warning float-end">{{$category->articleCount()}}</span></a>
                @endforeach
            </div>
        </div>
    </div>
@endif
