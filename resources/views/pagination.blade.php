<div class="card-footer d-flex justify-content-center" >
    <ul class="pagination pagination-sm m-0 text-center {{$class}}">
        <li class="{{ ($list->currentPage() == 1) ? ' disabled' : '' }} page-item">
            <a class="page-link" href="{{ $list->url($list->currentPage()-1) }}">&laquo;</a>
        </li>
        @for ($i = 1; $i <= $list->lastPage(); $i++)
            <li class="{{ ($list->currentPage() == $i) ? ' active' : '' }} page-item">
                <a class="page-link" href="{{url('/'.$page_link.'?page='.$i)}}" value="{{$i}}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($list->currentPage() == $list->lastPage()) ? ' disabled' : '' }} page-item">
            <a href="{{ $list->url($list->currentPage()+1) }}" class="page-link">&raquo;</a>
        </li>
    </ul>
</div>