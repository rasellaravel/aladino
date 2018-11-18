@extends('users.dashboard.layout')
@section('otherStyle')
<link href="{{asset('users/assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('otherCss')

@endsection
@section('content')
<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <a href="{{ URL::previous() }}" class="btn btn-secondary btn-fix">Back to Selling</a>
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
            <h5 class="font-strong mb-4"> </h5>
            <div class="flexbox mb-4">
                <div class="flexbox">
                    <label class="mb-0 mr-2">COURIERS LIST</label>
                   
                </div>
                <div class="input-group-icon input-group-icon-left mr-3">
                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                </div>
            </div>
            <div class="table-responsive row">
                <table class="table table-bordered table-hover" id="orders-table">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone </th>
                            <th>Slug</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                       @foreach($all_couriers['data']['couriers'] as $couriers)
                       <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$couriers['name']}}</td>
                            <td>{{$couriers['phone']}}</td>
                            <td>{{$couriers['slug']}}</td>
                        </tr>
                       @endforeach 
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
<script>
    function trackingModal(id){ 
     $('#trackingModal').modal('show');  
     $('#order_id_for_tracking').val(id);  
    }
</script>
<script type="text/javascript">
     $(document).ready(function(){
        $('#tracking_update').on('submit', function(){
            $.ajax({
                type:'POST',
                url:'{{url("user/selling/add/tracking")}}',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success:function(response){
                    console.log(response);            
                }
            });

            return false;
        });
        
    });
</script>
@endsection



