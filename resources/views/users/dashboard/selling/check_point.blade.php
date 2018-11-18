@extends('users.dashboard.layout')
@section('otherStyle')
@endsection
@section('otherCss')
<style type="text/css">

.checkpoints {
    position: relative;
}

.checkpoints__help {
    position: relative;
    z-index: 3;
    border-top: 1px solid #ddd
}

.checkpoint {
    position: relative;
    margin: 0;
    padding: 15px 0
}

.checkpoint p {
    margin-bottom: 0
}

.checkpoints__list {
    list-style: none;
    margin: 0;
    padding: 0
}

.checkpoints__list .hint {
    color: #95a5a6
}

.checkpoints__list:after {
    position: absolute;
    display: block;
    width: 1px;
    top: 0;
    left: 133px;
    bottom: 0;
    content: "";
    background-color: #ddd;
    z-index: 1
}

.checkpoint__time {
    float: left;
    width: 101px;
    text-align: right
}

.checkpoint__content {
    margin-left: 163px;
    padding-right: 10px;
    min-height: 55px
}

.checkpoint__content strong {
    line-height: 24px
}

.checkpoint__courier-name {
    margin: 0 5px;
    padding: 4px;
    background-color: #ecf0f1;
    border-radius: 3px;
    color: #95a5a6
}

.checkpoint__icon {
    position: absolute;
    left: 116px;
    top: 15px;
    width: 36px;
    height: 36px;
    line-height: 28px;
    font-size: 14px;
    text-align: center;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 18px;
    z-index: 10
}

.checkpoint__icon.outfordelivery,
.checkpoint__icon.delivered,
.checkpoint__icon.attemptfail,
.checkpoint__icon.exception,
.checkpoint__icon.expired,
.checkpoint__icon.pending,
.checkpoint__icon.inforeceived {
    background-repeat: no-repeat;
    border: none
}

.checkpoint__icon.intransit:before {
    content: "";
    display: block;
    background-color: #ddd;
    width: 12px;
    height: 12px;
    position: absolute;
    border-radius: 12px;
    left: 11px;
    top: 11px;
    z-index: 9
}
.checkpoints__toggler {
    border-top: 1px solid #ddd
}

@media (min-width: 768px) {
    .checkpoint__time {
        width: 118px
    }
    .checkpoint__icon {
        left: 133px
    }
    .checkpoints__list:after {
        left: 150px
    }
    .checkpoint__content {
        margin-left: 187px
    }
}

</style>
@endsection
@section('content')
<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <a href="{{url('user/product/selling')}}" class="btn btn-secondary btn-fix">Back Selling</a>
            </div>
            <div class="ibox-tools">
                <a class="ibox-remove"><i class="ti-close"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title text-center">
                <p>
                    <?php
                    if($tracking_info){
                        echo $tracking_info['data']['tracking']['tracking_number'];
                    }
                    ?>    
                </p>
            </div>
            <div class="ibox-tools">
                <a class="ibox-remove"><i class="ti-close"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-1">
                    <img src="{{asset('users/assets/img/lietuvos-pastas.svg')}}" class="img-fluid">
                </div>
                <div class="col-md-11">
                    <h4>
                    <?php
                        if($courier){
                            echo $courier['data']['couriers']['0']['name'];
                        }
                    ?> 
                    </h4>
                    <p>
                    <?php
                        if($courier){
                            echo $courier['data']['couriers']['0']['phone'];
                        }
                    ?> 
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center" style="background-color: 
                        <?php
                        if($last_check_point){
                            if($last_check_point['data']['tag']=='Delivered'){
                                echo'#1b8e0d';
                            }else{
                                echo'#1a0cec85';
                            }
                        }
                        ?>
                    ;padding: 18px; margin-top: 15px;color: white;">
                        <?php
                            if($last_check_point){
                                echo $last_check_point['data']['tag'];
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="checkpoints_container_wrapper" class="checkpoints">
                        <ul id="checkpoints_container" class="checkpoints__list">
                        @foreach($tracking_info['data']['tracking']['checkpoints'] as $check_points)
                            <li class="checkpoint">
                                <div class="checkpoint__time"><strong><!-- Aug 31, 2018 -->
                                    <?php
                                        echo date("M d, Y ", strtotime($check_points['checkpoint_time']));
                                    ?>

                                </strong>
                                    <div class="hint">
                                    <?php
                                        $date = date("H:i a", strtotime($check_points['checkpoint_time']));
                                        if($date=='00:00 am'){
                                            echo '12:00 am';
                                        }else{
                                           echo $date; 
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="checkpoint__icon intransit"></div>
                                <div class="checkpoint__content"><strong>{{$check_points['message']}}<span class="checkpoint__courier-name">
                                    <?php
                                        if($courier){
                                            echo $courier['data']['couriers']['0']['name'];
                                        }
                                    ?> 
                                </span></strong>
                                    <div class="hint">{{$check_points['location']}}</div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('otherScript')

@endsection

@section('otherJs')


@endsection



