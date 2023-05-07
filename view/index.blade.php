@php
    $p = 'select';
    $type = 'option';

//    $p = 'ul';
//    $type = 'li';

@endphp

<{{$p}} id="{{$p}}s">
@foreach($data as $key => $value)
    <{{$type}} @if($type == 'option') value="{{$value->id}}" data-parent="{{$value->parent}}" data-space="0" @endif>{{$value->item}} ({{count($value->items) ?? 0}})</{{$type}}>
    @if(count($value->items) > 0)
            @include('chield', ['data' => $value->items, 'type' => $type])
    @endif
@endforeach
    </{{$p}}>



<style>
    .space {
        margin-left: 15px;
    }
</style>

<script>
    const select = document.getElementById("selects");
    const options = select.querySelectorAll("option");
    const spaceMaker = (amount) => { let text = ''; for (let i = 1; i <= amount; i++) { /*if(i==amount){text+='&rArr;'} else {text+='='} */ text += '&nbsp;&nbsp;'; } return text; };
    options.forEach(option => {
        const parent = option.dataset.parent;
        if( parent !== 'undefined') {
            console.log(option.value, option.dataset.parent)
            let parentOption = select.querySelector(`option[value='${parent}']`);
            if(parentOption !== null) {
                parentSpace = parentOption.dataset.space;
                let spaceNumber = Number(parentSpace)+Number(1);
                option.dataset.space= spaceNumber;
                option.innerHTML = spaceMaker(spaceNumber)+option.innerText;
            }

        }
    });
</script>
