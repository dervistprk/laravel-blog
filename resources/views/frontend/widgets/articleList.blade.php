@if(count($articles) > 0)
    @foreach($articles as $article)
        <div class="post-preview" style="margin-top: 20px;">
            <a href="{{route('single', [$article->category->slug, $article->slug])}}">
                <h2 class="post-heading">{{$article->title}}</h2>
                <img data-src="{{URL::asset($article->image)}}" alt="article-image" class="lazyload" loading="lazy" width="700" height="350">
            </a>
            <p class="post-preview"><b>{!! $article->sub_title !!}</b></p>
            <span class="post-meta">
                Kategori : <a href="{{route('category', $article->category->slug)}}">{{$article->category->name}}</a>
                <span class="float-end">Oluşturulma Tarihi : {{$article->created_at->diffForHumans()}}</span>
            </span>
        </div>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
    <div style="margin-top: 10px;">{{$articles->links()}}</div>
@else
    <div class="alert alert-danger text-center" style="margin-top: 45px;">
        <p>
        <h6>Kayıtlı makale bulunamadı.</h6>
        </p>
    </div>
@endif
