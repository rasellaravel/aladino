@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('otherCss')

</style>
@endsection

<!-- basic-info -->
@section('content')
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
            <?php
               $all_order_id = array();
               $get_order = DB::table('buyed_products')->distinct()->orderBy('id','DESC')->get(['order_id']);
               // if($get_order){
               //  foreach ($get_order as $key => $order_array) {
               //      $all_order_id[] = $order_array->order_id;
               //  }
               // }

               //dd( $get_order);
               //$get_order = DB::raw("SELECT DISTINCT * FROM buyed_products");

              
            ?>
            <div class="table-responsive row">
                <table class="table table-bordered table-hover" id="orders-table">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Shop</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Buying Date</th>
                            <th>Tracking</th>
                            <th>Dalivared Date</th>
                            <!-- <th class="no-sort"></th> -->
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
                                <a href="{{url('user/buy/view',$order->order_id)}}">#{{$order->order_id}}</a>
                            </td>
                            <?php
                                $shop_item = DB::table('buyed_products')->where('order_id',$order->order_id)->orderBy('id','DESC')->first();
                                $shop_name = DB::table('shops')->where('id',$shop_item->seller_shop_id)->first();
                            ?>
                            <td>{{$shop_name->shop_name}}</td>
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
                                        if($shop_item->status==0){
                                            echo 'pending..';
                                        }else if($shop_item->status==1){
                                            echo 'shipped';
                                        }else if($shop_item->status==2){
                                            echo 'completed';
                                        }else{
                                            echo'Canceled';
                                        }
                                    ?>
                                </span>
                            </td>
                            <td>Paid</td>
                            <?php
                                $buyed_date = \Carbon\Carbon::parse($shop_item->created_at)->format('d/m/Y');
                            ?>
                            <td>{{$buyed_date}}</td>
                            <!-- <td>
                                <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                            </td> -->
                            <td>
                                @if($shop_item->tracking_code)
                                <u><a href="{{url('user/product/shipping/checkpoint',[$shop_item->tracking_code,$shop_item->tracking_slug])}}">{{$shop_item->tracking_code}}</a></u>
                                @else
                                    Not send yet
                                @endif
                            </td>
                            <td>
                                <?php
                                if($shop_item->delivared_date){
                                    echo date('d M Y',strtotime($shop_item->delivared_date));
                                }else{
                                    echo 'Not Delevared';
                                }
                                ?>
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
@endsection



