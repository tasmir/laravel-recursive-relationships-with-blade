
# Laravel Recursive Relationships With Blade File

Instruction for laravel elequent recursive relationship with necessary files and code.

## migrations
```bash
Schema::create('items', function (Blueprint $table) {
    $table->id();
    $table->string("item")->nullable();
    $table->string("parent")->nullable();
    $table->timestamps();
});
```

## Models

Item.php

```bash
class Item extends Model
{
    protected $guarded =['id', 'created_at', 'updated_at'];

    public function items() {
        return $this->hasMany(Item::class, 'parent', 'id')->with('items');
    }
}
```

## Controllers

ItemController.php

```bash
use App\Models\Item;

class ItemController extends Controller
{
    public function index() {
        $data = Item::whereNull("parent")->with('items')->get();
        return view('test.index', compact('data'));
    }
}

```

## views

index.blade.php

```bash
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

```

chield.blade.php

```bash
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
```

style

```bash
.space {
    margin-left: 15px;
}
```

script

```bash
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
```
## Author
<p align="left">
<a href="https://github.com/tasmir" target="_blank" vartical-align="middle"><img src="https://avatars.githubusercontent.com/u/25658870?s=40&v=4">Tasmir Ahmed</a>
</p>

