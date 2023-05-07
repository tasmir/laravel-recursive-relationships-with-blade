@if($type == 'li')
    <div class="space">
        @foreach($data as $key => $value)
            <{{$type}}>{{$value->item}}</{{$type}}>
            @if(count($value->items) > 0 && !empty($value->items))
                @include('chield', ['data' => $value->items, 'type' => $type])
            @endif
        @endforeach
    </div>
@elseif($type == 'option')
    @foreach($data as $key => $value)
        <{{$type}} @if($type == 'option') value="{{$value->id}}" data-parent="{{$value->parent}}" data-space="1" @endif>{{$value->item}}</{{$type}}>
        @if(count($value->items) > 0 && !empty($value->items))
            @include('chield', ['data' => $value->items, 'type' => $type])
        @endif
    @endforeach
@endif
