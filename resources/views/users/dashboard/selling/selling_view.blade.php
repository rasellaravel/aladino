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
    <div class="d-flex align-items-center mb-5">
                    <span class="mr-4 static-badge badge-pink"><i class="ti-shopping-cart-full"></i></span>
                    <div>
                    <?php
                        $buyer_address = DB::table('user_different_addresses')->where('id',$buyed_single_product->buyer_address_id)->first(); 
                        $buyed_date = \Carbon\Carbon::parse($buyed_single_product->created_at)->format('d/m/Y');
                    ?>
                        <h5 class="font-strong">Order #{{$order_id}}</h5>
                        <div class="text-light">{{$buyer_address->f_name}} {{$buyer_address->l_name}}, {{$buyed_date}}, 
                        <?php
                            if($buyed_single_product->status==0){
                                echo 'pending..';
                            }else if($buyed_single_product->status==1){
                                echo 'shipped';
                            }else if($buyed_single_product->status==2){
                                echo 'completed';
                            }else{
                                echo'Canceled';
                            }

                        ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <h5 class="font-strong mb-5">Products List</h5>
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-default thead-lg">
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Shipping</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; $total = 0; ?>
                                    @foreach($buyed_product as $product)
                                        <?php $i++;?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <img class="mr-3" src="{{asset('users/product-image/'.$product->product_image)}}" alt="image" width="60" /></td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->product_qty}}</td>
                                            <td>${{$product->single_price}}</td>
                                            <td>${{$product->shipping_cost}}</td>
                                            <td>${{$product->total_price}}</td>
                                        </tr>
                                        <?php 
                                            $total = $total + $product->total_price;
                                        ?>
                                    @endforeach   
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <div class="text-right" style="width:300px;">
                                        <!-- <div class="row mb-2">
                                            <div class="col-6">Subtotal Price</div>
                                            <div class="col-6">$1265</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">Discount 5%:</div>
                                            <div class="col-6">-$63.25</div>
                                        </div> -->
                                        <div class="row font-strong font-20">
                                            <div class="col-6">Total Price:</div>
                                            <div class="col-6">
                                                <div class="h3 font-strong">${{$total}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-xl-6">
                        <div class="ibox">
                            <div class="ibox-body">
                                <h5 class="font-strong mb-4">Order Information</h5>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Total Price</div>
                                    <div class="col-8 h3 font-strong text-pink mb-0">${{$total}}</div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Date</div>
                                    <div class="col-8">{{$buyed_date}}</div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Delivered</div>
                                    <div class="col-8"><?php
                                    if($buyed_single_product->delivared_date){
                                        echo $buyed_single_product->delivared_date;
                                    }else{
                                        echo 'Not Delivered';
                                    }
                                    ?></div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Status</div>
                                    <div class="col-8">
                                        <span class="badge badge-success badge-pill">
                                            <?php
                                                if($buyed_single_product->status==0){
                                                    echo 'pending..';
                                                }else if($buyed_single_product->status==1){
                                                    echo 'shipped';
                                                }else if($buyed_single_product->status==2){
                                                    echo 'completed';
                                                }else{
                                                    echo'Canceled';
                                                }

                                            ?>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="ibox">
                        <?php
                            $about_buyer = DB::table('users')->where('id',$buyed_single_product->buyer_id)->first();
                             $about_seller_shop = DB::table('shops')->where('id',$buyed_single_product->seller_shop_id)->first();
                        ?>
                            <div class="ibox-body">
                                <h5 class="font-strong mb-4">Buyer Information</h5>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Seller</div>
                                    <div class="col-8">{{$about_buyer->name}}</div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Address</div>
                                    <div class="col-8">{{$about_buyer->address}}</div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-4 text-light">Email</div>
                                    <div class="col-8">{{$about_buyer->email}}</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-4 text-light">Phone</div>
                                    <div class="col-8">{{$about_buyer->phone}}</div>
                                </div>
                            </div>
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



