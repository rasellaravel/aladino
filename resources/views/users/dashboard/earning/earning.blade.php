@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
@endsection

@section('otherCss')

</style>
@endsection

<!-- basic-info -->
@section('content')

<!-- calculation -->

<?php

    $pending_balance = DB::table('buyed_products')->where('seller_id',Auth()->user()->id)->where('status',0)->orWhere('status',1)->sum('total_price');
    $withdrawals  = DB::table('money_withdrawals')->where('user_id',Auth()->user()->id)->sum('amount');
    $net_income  = DB::table('buyed_products')->where('seller_id',Auth()->user()->id)->where('status',2)->sum('total_price');
    if($net_income){
         $aviable_for_withdrawals = $net_income - $withdrawals;
    }   
?>

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body flexbox-b">
                    <div class="easypie mr-4" data-percent="73" data-bar-color="#18C5A9" data-size="80" data-line-width="8">
                        <span class="easypie-data text-success" style="font-size:28px;"><i class="la la-money"></i></span>
                    </div>
                    <div>
                        <h3 class="font-strong text-success">
                            <?php
                                if($net_income){
                                    echo '$'.$net_income;
                                }else{
                                    echo '$0';
                                }
                            ?>
                        </h3>
                        <div class="text-muted">NET INCOME</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body flexbox-b">
                    <div class="easypie mr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                        <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                    </div>
                    <div>
                        <h3 class="font-strong text-pink">
                            <?php
                                if($pending_balance){
                                    echo '$'.$pending_balance;
                                }else{
                                    echo '$0';
                                }
                            ?>
                        </h3>
                        <div class="text-muted">PENDING CLEARANCE</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body flexbox-b">
                    <div class="easypie mr-4" data-percent="42" data-bar-color="#5c6bc0" data-size="80" data-line-width="8">
                        <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-money"></i></span>
                    </div>
                    <div>
                        <h3 class="font-strong text-primary">
                            <?php
                                if($withdrawals){
                                    echo '$'.$withdrawals;
                                }else{
                                    echo '$0';
                                }
                            ?>
                        </h3>
                        <div class="text-muted">WITHDROWN</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body flexbox-b">
                    <div class="easypie mr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                        <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                    </div>
                    <div>
                        <h3 class="font-strong text-pink">
                            <?php
                                if($net_income){
                                    echo '$'.$aviable_for_withdrawals;
                                }else{
                                    echo '$0';
                                }
                            ?>
                        </h3>
                        <div class="text-muted">AVIABLE FOR WITHDRON</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('otherScript')
    <script src="{{asset('users/assets/vendors/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('users/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
     <script src="{{asset('users/assets/js/scripts/dashboard_ecommerce.js')}}"></script>
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



