@extends("layouts.layout")
@section("content")
<div>
    <div>
        <div>
            @if(session()->has("cartItems") && count($session->get("cartItems")));

            <div class="panel-body">
                @foreach(session()->get('cartItems') as $i)
                    <div class="row" id="{{$i->id}}">
<div data-id="" data-price="{{}}"></div>
                        <button>Izbaci iz korpe</button>

                    </div>
                @endforeach
                <button>Placanje</button>
            </div>

                <div class="col-xs-9">
                    @php
                    foreach (session()->get('cartItems') as $item)
                        {
                            $totalPrice += $item->price * $item->quantity;
                        }
                    endforeach
                    @endphp

                </div>
            @endif
        </div>
    </div>
</div>
@endsection
