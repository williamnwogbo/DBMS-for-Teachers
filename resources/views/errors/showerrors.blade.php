@if($errors->any())
    <ul class="alert alert-info" style="list-style: none;height: auto;">
        @foreach($errors->all() as $error)

            <div>{{ $error }}</div>

        @endforeach
    </ul>

@endif
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}" style="color: #000">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>