<ul class="nav nav-tabs">
    <?php

    foreach($adminPageLinks as $h):
    ?>
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs($h->nav_href) ? 'active' : ''}}" href="{{route($h->nav_href)}}">{{$h->nav_link}}</a>
    </li>
    <?php endforeach; ?>
</ul>
