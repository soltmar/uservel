@if(!empty($alerts))
    @foreach($alerts as $alert)
        <div class="alert alert-{{ $alert['type'] }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {!! $alert['content'] !!}

            @if(!empty($alert['items']))
            <ul>
                @foreach($alert['items'] as $key => $item)
                    @if(!is_int($key))
                        <li><strong>{{ $key }}</strong> {!! $item !!}</li>
                    @else
                        <li>{!! $item !!}</li>
                    @endif
                @endforeach
            </ul>
            @endif
        </div>
    @endforeach
@endif