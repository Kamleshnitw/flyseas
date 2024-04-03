<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Group Name</th>
            
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list as $key=>$data)
            <tr>
                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                <td class="text-center">{{$data->group_name}}</td>
                <td class="text-center d-flex">
                    @can('vendor-product-edit')
                        <a href="{{route('vendor.group-product.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                    @can('vendor-product-delete')
                        <form action="{{route('vendor.group-product.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class='btn btn-outline-danger btn-sm' onclick="return confirm('Are you sure you want to delete this group?');" style="width:32px;"><i class="fas fa-trash"></i></button>
                        </form>
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
