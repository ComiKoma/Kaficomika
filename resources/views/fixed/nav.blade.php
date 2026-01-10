<div id="header">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="{{route('home')}}">K A F I C O M I K A</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                @foreach($linkovi as $link)
                <li class="nav-item nav-pills">
                    <a class="nav-link {{request()->routeIs($link->nav_href) ? 'active' : ''}}" href="{{route($link->nav_href)}}">{{$link->nav_link}}</a>
                </li>
                @endforeach
                @if(session()->has("admin"))
                @foreach($adminLink as $l)
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs($l->nav_href) ? 'active' : ''}}" href="{{route($l->nav_href)}}">{{$l->nav_link}}<span class="sr-only">(current)</span></a>
                </li>
                @endforeach
                @endif

            </ul>
            <ul class="nav navbar-nav ml-auto levo">
                @if(session()->has("user") || session()->has("admin"))
                <li><a href="{{route("user")}}" class="nav-link nav-pills">{{session("user") ? session("user")->uName : session("admin")->uName}}</a></li>
                <li><a href="{{route("logout")}}" class="nav-link nav-pills"> Odjava</a></li>
                @endif

                @if(!session()->has("user") && !session()->has("admin"))
                <li>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLRForm">Prijava<span class="sr-only"></span></a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
