@if(count($articles) > 0)
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single', [$article->category->slug, $article->slug])}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <img data-src="{{$article->image}}" alt="article-image" class="lazyload" loading="lazy" width="700" height="350">
            </a>
            <p class="post-meta">
                Kategori : <a href="{{route('category', $article->category->slug)}}">{{$article->category->name}}</a>
                <span class="float-end">Oluşturulma Tarihi : {{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
    {{$articles->links()}}
@else
    <div class="alert alert-danger text-center">
        <p>
            <h6>Bu kategoride kayıtlı makale bulunamadı.</h6>
        </p>
    </div>
@endif
