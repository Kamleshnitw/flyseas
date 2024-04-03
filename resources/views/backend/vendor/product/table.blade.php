<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Image</th>
            {{-- <th class="text-center">Is Featured</th>
            <th class="text-center">Is Active</th> --}}
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list as $key=>$data)
            <tr>
                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                <td class="text-center">{{$data->product_name}}</td>
                <td class="text-center"><img src="{{asset('public/'.api_asset($data->thumbnail[0]))}}" style="height: 50px;width: 50px;"></td>
                {{-- <td class="text-center">
                    @if($data->is_feature)
                        <a href="{{route('products.featured',$data->group_id).'?is_feature=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to not feature this product?');"><span class="badge bg-success">Feaured</span></a>
                    @else
                        <a href="{{route('products.featured',$data->group_id).'?is_feature=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to feature this product?');"><span class="badge bg-danger">Not Feaured</span></a>
                    @endif
                </td> --}}
                {{-- <td class="text-center">
                    @if($data->is_active)
                        <a href="{{route('products.show',$data->group_id).'?is_active=0&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to deactive this category?');"><span class="badge bg-success">Actived</span></a>
                    @else
                        <a href="{{route('products.show',$data->group_id).'?is_active=1&key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to active this category?');"><span class="badge bg-danger">Deactived</span></a>
                    @endif
                </td> --}}
                <td class="text-center">
                    @can('vendor-product-edit')
                        <a href="{{route('vendor.products.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                    @can('vendor-product-delete')
                        <a href="{{route('vendor.products.destroy',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" onclick="return confirm('Are you sure you want to delete this product?');"  class="btn btn-outline-danger btn-sm mb-1" style="width:32px;">
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
