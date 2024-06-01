<ul class="list-group" style="padding: 10px 0;width: 100%;">
    @if($records->count())
        @foreach($records as $item)
            <a href="" data-item="{{$item->id}}" class="item-search-row">
                <li class="list-group-item">{{ '('.$item->id.') '.$item->name }}</li>
            </a>
        @endforeach
    @else
        <li class="list-group-item" style="text-align:center">There are no records match your inputs.</li>
    @endif
</ul>
