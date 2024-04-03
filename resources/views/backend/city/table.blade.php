<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list as $key=>$data)
            <tr>
                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                <td class="text-center">{{$data->name}}</td>
                <td class="text-center">
                    @can('city-edit')
                        <a href="{{route('city.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                    @can('city-delete')
                        <a href="{{route('city.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this city?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endcan
                </td>
            </tr>
        @empty
            <tr class="footable-empty">
                <td colspan="11">
                <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {!! $list->appends(['key'=>$search])->links() !!}
</div>
