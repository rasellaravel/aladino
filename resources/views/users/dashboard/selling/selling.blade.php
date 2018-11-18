@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('otherCss')

</style>
@endsection
@section('content')
<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <a href="{{url('user/couriers/all')}}" class="btn btn-secondary btn-fix">Show Supported Couriers</a>
            </div>
            <div class="ibox-tools">
                <a class="ibox-remove"><i class="ti-close"></i></a>
            </div>
        </div>
    </div>
</div>

  <div class="container">
    <div class="ibox">
        <div class="ibox-body">
            <h5 class="font-strong mb-4">ORDERS LIST</h5>
            <div class="flexbox mb-4">
                <div class="flexbox">
                    <label class="mb-0 mr-2">Type:</label>
                    <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">
                        <option value="">All</option>
                        <option>Shipped</option>
                        <option>Completed</option>
                        <option>Pending</option>
                        <option>Canceled</option>
                    </select>
                </div>
                <div class="input-group-icon input-group-icon-left mr-3">
                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                </div>
            </div>
           
            <div class="table-responsive row" id="TableRefresh">
             <?php
               $get_order = DB::table('buyed_products')->distinct()->where('seller_id',Auth()->user()->id)->orderBy('id','DESC')->get(['order_id']);
            ?>
                <table class="table table-bordered table-hover" id="orders-table">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th class="no-sort">Tracking Code</th>
                            <th class="no-sort">Parcel</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($get_order)
                    <?php $i=0; ?>
                    @foreach($get_order as $order)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                <a href="{{url('user/product/selling/view',$order->order_id)}}">#{{$order->order_id}}</a>
                            </td>
                            <?php
                                $buyed_products = DB::table('buyed_products')->where('order_id',$order->order_id)->orderBy('id','DESC')->first();
                                $buyer_info = DB::table('user_different_addresses')->where('id',$buyed_products->buyer_address_id)->first();
                            ?>
                            <td>{{$buyer_info->f_name}} {{$buyer_info->l_name}}</td>
                            <?php
                                $price = DB::table('buyed_products')->where('order_id',$order->order_id)->get();
                                $total_price = 0;
                                foreach ($price as $key => $price) {
                                   $total_price = $total_price + $price->total_price;
                                }
                            ?>
                            <td>${{$total_price}}</td>
                            <td>
                                <span class="badge badge-success badge-pill">
                                    <?php
                                        if($buyed_products->status==0){
                                            echo 'pending..';
                                        }else if($buyed_products->status==1){
                                            echo 'shipped';
                                        }else if($buyed_products->status==2){
                                            echo 'completed';
                                        }else{
                                            echo'Canceled';
                                        }
                                    ?>
                                </span>
                            </td>
                            <td>Paid</td>
                            <?php
                                $buyed_date = \Carbon\Carbon::parse($buyed_products->created_at)->format('d/m/Y');
                            ?>
                            <td>{{$buyed_date}}</td>
                            <td>
                               <!--  <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a> -->
                               @if($buyed_products->tracking_code)
                               <a data-toggle="modal" id="{{$order->order_id}}" href="javascript:void(0)" onclick="showTracking(this.id);"><u>{{$buyed_products->tracking_code}}</u></a>
                               @else
                               <a data-toggle="modal" id="{{$order->order_id}}" href="javascript:void(0)" onclick="trackingModal(this.id);"><u>Add Tracking</u></a>
                               @endif
                            </td>
                            
                            <td>
                                @if($buyed_products->tracking_code)
                                <a href="{{url('user/product/shipping/checkpoint',[$buyed_products->tracking_code,$buyed_products->tracking_slug])}}"><u>View Parcel</u></a>
                                @else
                                No Tracking
                                @endif

                            </td>
                            
                        </tr>
                        @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- start tracking model -->
<div class="container">
    <div class="modal fade login" id="trackingModal">
      <div class="modal-dialog login animated">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="font-size: 16px;">Insert Tracking Code</h4>
            </div>
            <div class="modal-body"> 
                <div class="insert_loading" style="position:fixed;top:10%;left:30%;z-index: 9999;display: none">
                   <img src="{{asset('users/loading.gif')}}"> 
                </div> 
                <div class="box">
                    <div class="content">
                        <form method="post" id="tracking_update">
                           <div class="row">
                                <input type="hidden" id="order_id_for_tracking" name="order_id_for_tracking" value="">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                    <input class="form-control form-control-line" type="text" placeholder="Tracking Number" id="tracing_code" name="tracing_code" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                    <input class="form-control form-control-line" type="text" placeholder="Title" id="tracking_title" name="title" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                      <select class="form-control form-control-line" name="couriers" id="tracking-slug">
                                      @foreach($all_couriers['data']['couriers'] as $couriers)
                                          <option value="{{$couriers['slug']}}"
                                          
                                          >{{$couriers['name']}}</option>
                                      @endforeach    
                                      </select>
                                     </div>
                                </div>
                                 <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                                     <button type="submit" data-dismiss="modal" class="btn btn-secondary btn-fix">Back</button>
                                </div>
                           </div>
                       </form>
                    </div>
                </div>
            </div>       
          </div>
      </div>
    </div>
</div>

<!-- end tracking model -->

<!-- start tracking model -->
<div class="container">
    <div class="modal fade login" id="showTracking">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="font-size: 16px;">Existing Tracking Details</h4>
                </div>
                <div class="modal-body">
                    <div class="delete_loading" style="position:fixed;top:10%;left:30%;z-index: 9999; display: none">
                        <img src="{{asset('users/loading.gif')}}">
                    </div>
                    <div class="box">
                        <div class="content">
                            <form method="post" id="deletingTracking">
                            <input type="hidden" name="showingTrackingId" id="showingTrackingId">
                            <input type="hidden" name="showingTrackingSlug" id="showingTrackingSlug">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-head-purple table-border-purple mb-5">
                                            <thead>
                                                <tr>
                                                    <th>Tracking Code</th>
                                                    <th>Title</th>
                                                    <th>Sending From</th>
                                                </tr>
                                            </thead>
                                            <tbody id="swoingTracking">
                                                
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary mr-2">Delete Tracking</button>
                                        <button type="submit" data-dismiss="modal" class="btn btn-secondary btn-fix">Back</button>
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end tracking model -->
@endsection
@section('otherScript')
 <script src="{{asset('users/assets/vendors/dataTables/datatables.min.js')}}"></script>
@endsection

@section('otherJs')
 <!-- '''''''''''''''''''''''''Data Table''''''''''''''''''''''''''''''-->
    <script>
        $(function() {
            $('#orders-table').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });

            var table = $('#orders-table').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(4).search($(this).val()).draw();
            });
        });
    </script>
    

 <!-- '''''''''''''''''''''''''Ajax Header ''''''''''''''''''''''''''''''-->
<script type="text/javascript">
   $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
</script>
<script>
    function trackingModal(id){ 
         $('#order_id_for_tracking').val(id);
         $('#trackingModal').modal('show');    
    }
     function showTracking(id){ 
         $('#showTracking').modal('show');
         $.ajax({
                type:'POST',
                url:'{{url("user/selling/show/tracking")}}',
                data: {id:id},
                success:function(response){
                    $('#showingTrackingId').val(id);
                    $('#showingTrackingSlug').val(response.tracking_slug);
                    $('#swoingTracking').html(response.html);        
                }
           }); 

    }
</script>
<script type="text/javascript">
     $(document).ready(function(){
        $('#deletingTracking').on('submit', function(){
            $('.delete_loading').css('display','block');
            $.ajax({
                type:'POST',
                url:'{{url("user/selling/delete/tracking")}}',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    
                    $("#TableRefresh").load(location.href+" #TableRefresh>*","");

                    $('#showTracking').modal('hide');
                    $('.delete_loading').css('display','none');          
                }
            });

            return false;
        });
        
    });
</script>
<script type="text/javascript">
     $(document).ready(function(){
        $('#tracking_update').on('submit', function(){
            $('.insert_loading').css('display','block');
            $.ajax({
                type:'POST',
                url:'{{url("user/selling/add/tracking")}}',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    
                    $("#TableRefresh").load(location.href+" #TableRefresh>*","");
                    $('#trackingModal').modal('hide');
                    $('.insert_loading').css('display','none');        
                }
            });

            return false;
        });
        
    });
</script>
@endsection



