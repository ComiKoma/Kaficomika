<div class="greskaAdmin">
    @if(session()->has('success'))
        <div class="alert alert-success my-3">
            {{session()->get('success')}}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger my-3">
            {{session()->get('error')}}
        </div>
    @endif
</div>
