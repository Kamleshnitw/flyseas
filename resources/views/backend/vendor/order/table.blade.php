<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Total Product</th>
            <th>Total Amount</th>
            <th>Grand Amount</th>
            <th>Payment Type</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list as $key=>$data)
            <tr>
                <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                <td>{{$data->order_id}}</td>
                <td>{{count(json_decode($data->product_details))}}</td>
                <td>{{$data->total_amount}}</td>
                <td>{{$data->grand_amount}}</td>
                <td>{{$data->payment_type}}</td>
                <td>{{$data->order_status}}</td>
                <td>
                    <a href="{{route('vendor.orders.show', encrypt($data->id)).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                        <i class="fas fa-eye"></i>
                    </a>
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
