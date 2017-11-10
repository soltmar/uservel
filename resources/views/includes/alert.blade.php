@if(!empty($alerts))
    @if(isset($alerts['type']))
        @include('uservel::includes.alert_content', ['alert' => $alerts])
    @else
        @foreach($alerts as $alert)
            @include('uservel::includes.alert_content', ['alert' => $alert])
        @endforeach
    @endif
@endif