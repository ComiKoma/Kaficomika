
    <div class="col-lg-4 col-md-6 my-4">
        <div class="card h-100">
            <a href="{{route('product.show', [$p->id])}}"><img class="card-img-top" src="{{$p->pImg ? asset('assets/img/product/' . $p->pImg) : asset('assets/img/default.jpg')}}" alt="{{$p->pName}}"></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{route('product.show', [$p->id])}}">{{$p->pName}}</a>
                    <p class="card-text"><small class="text-muted">{{$p->pEngName}}</small></p>
                </h4>
                <h5>{{$p->price}} din.</h5>
            </div>
{{--
            <button class="btn btn-outline-secondary" data-id="{{$p->id}}">Dodaj u korpu</button>
--}}

        </div>
    </div>

