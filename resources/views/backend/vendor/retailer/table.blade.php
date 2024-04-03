<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Customer Info</th>
            <th class="text-center" colspan="2">Kyc Details</th>
            <th class="text-center"> Kyc Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list as $key=>$data)
            <tr>
                <td class="text-center">{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                <td>
                    <b>Name: </b>{{$data->User->name}} <br>
                    <b>Phone: </b>{{$data->User->phone}}
                </td>
                <td>
                    @if ($data->retailerKyc != null)
                        <b>Shop Name:</b> {{$data->retailerKyc->shop_name}} <br>
                        <b>Owner Name:</b> {{$data->retailerKyc->owner_name}} <br>
                        <a href="{{asset('public/uploads/retailer_kyc/'.$data->retailerKyc->shop_front_image)}}" target="_blank">
                            <img src="{{asset('public/uploads/retailer_kyc/'.$data->retailerKyc->shop_front_image)}}" alt="Shop Front Images" title="Shop Front Images" height="100px" width="150px">
                        </a>
                    @endif
                </td>
                <td>
                    @if ($data->retailerKyc != null)
                        <b>Address:</b> {{$data->retailerKyc->shop_full_address}} <br>
                        <b>Other Document:</b> {{$data->retailerKyc->other_document}} <br>
                        <a href="{{asset('public/uploads/retailer_kyc/'.$data->retailerKyc->other_document_file)}}" target="_blank">
                            <img src="{{asset('public/uploads/retailer_kyc/'.$data->retailerKyc->other_document_file)}}" alt="Other Document File" title="Other Document File" height="100px" width="150px"> 
                        </a>
                    @endif
                </td>
                <td class="text-center">
                    @if($data->kyc_status == 0)
                        <span class="badge badge-info">Not Upload</span>
                    @elseif ($data->kyc_status == 1)
                        <span class="badge badge-primary">Pending</span>
                    @elseif ($data->kyc_status == 2)
                        <span class="badge badge-success">Approved</span>
                    @elseif ($data->kyc_status == 3)
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{route('vendor.retailers.show',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-info btn-sm mr-1 mb-1">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('vendor.retailer-kyc.edit',$data->id).'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">
                        <i class="fas fa-edit"></i>
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
