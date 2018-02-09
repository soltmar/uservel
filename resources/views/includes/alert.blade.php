@if(!empty($alerts))
    @if(isset($alerts['type']))
        @include('uservel::includes.alert_content', ['alert' => $alerts])
    @else
        @foreach($alerts as $alert)
            @include('uservel::includes.alert_content', ['alert' => $alert])
        @endforeach
    @endif
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif