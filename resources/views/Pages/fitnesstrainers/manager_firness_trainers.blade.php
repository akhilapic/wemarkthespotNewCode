@extends('layouts.admin')
@section('content')
<style>
    .btn_submit:disabled {
    background: #d66821;
    border-color: #d66821;
    opacity: 1;
}

.status_change_new .dropdown.bootstrap-select.form-select{
    border: none;
    padding: 0px;
    width: 150px;
}
.status_change_new select.form-select{
    width: 150px;
}
.status_change_new button.btn.dropdown-toggle.btn-light {
    background: #fff;
}
.bootstrap-select .dropdown-menu {
    min-width: 100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    overflow: visible !important;
}
</style>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Manage Business</h4>
        </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Manage Business</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <h4 class="card-title mb-0">Manage Business List</h4>             
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="">
                                <!-- Alert Append Box -->
                                <div class="result"></div>
                            </div>
                            <button  style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('fitness_trainer_delall') }}">Selected Delete</button>
                            <button  style="margin-bottom: 10px" class="btn btn-danger filterdata" data-url="{{ url('fitness_trainer_filter') }}" data-status='1'>Pending</button>
                            <button  style="margin-bottom: 10px" class="btn btn-primary filterdata" data-url="{{ url('fitness_trainer_filter') }}" data-status='2'>Approved</button>						
                            <button  style="margin-bottom: 10px" class="btn btn-warning filterdata" data-url="{{ url('fitness_trainer_filter') }}" data-status='3'>Rejected</button>
                            <div class="col-md-12">
                                <!-- <a href="{{url('add_workout_plan')}}" class="btn btn-success fa-pull-right btn-sm table_add_btn mx-2" data-bs-toggle="modal" data-bs-target="#add_workout_plan_modal" data-bs-whatever="@mdo">Add New Workout Plan</a> -->
                                <a style="display:none;" href="{{url('add_workout_plan')}}" class="btn btn-success fa-pull-right btn-sm table_add_btn mx-2"  data-bs-whatever="@mdo">Add New Workout Plan</a>
                            </div>
                            <table id="zero_config" class="table table-striped table-bordered" id="tbl">
                                <thead>
                                    <tr> 
                                        <th style=""><input type="checkbox" id="master"></th>
                                        <th>Sr. No.</th>
                                        <th><div style="width: 140px;">Name</div></th>
                                        <th>Email</th>
                                       <!--  <th><div style="width: 140px;">Mobile Number</div></th> -->
                                      <!--   <th>Gender</th>
                                        <th><div style="width: 140px;">Specialization</div></th> -->
                                        <Th>Business Type </Th>
                                        <th>Status</th>
                                        <th>Change Status</th>
                                        <th><div style="width: 140px;">Action</div></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach($fitnesstrainer as $item)
                                    <tr>
                                        <td style=""><input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email}}</td>
                                    <!--     <td>{{ $item->country_code}} {{ $item->phone}}</td> -->
                                        @if($item->business_type==1)
                                         <td>Online Only</td>
                                        @else
                                         <td>Physical Location</td>
                                        @endif
                                       
                                       <!--  <td>{{ $item->specialization }}</td>
                                        <Td>{{$item->address}} </Td> -->
                                        @if($item->status=='0')
                                        <td style="color:Red">Pending</td>
                                        
                                        @elseif($item->status=='1')
                                        <td style="color:Red">Pending</td>
                                        @elseif($item->status=='2')
                                        <td style="color:green;">Approved</td>
                                        @elseif($item->status=='3')
                                        <td style="color:orange;">Rejected</td>
                                        @endif
                                        <td class="status_change_new">

                                            <select onchange="statusnewchanges(this.value,{{$item->id}})" class="form-select" data-id="{{$item->id}}" >
                                                <option value="1" @if($item->status == "1") selected  @endif>Pending</option>
                                                <option value="2" @if($item->status == "2") selected  @endif>Approved</option>
                                                <option value="3" @if($item->status == "3") selected  @endif>Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table_action">
                                                <a href="{{ route('manage_business_view', $item->id) }}" data-id="{{ $item->id }}"  class="btn btn-success btn-sm list_view infoU"  data-bs-whatever="@mdo">
                                                    <i class="mdi mdi-eye"></i>
                                                </a> 
                                                <a style="display: none" href="{{ route('manage_business_edit', $item->id) }}" data-id="{{ $item->id }}" class="btn btn-info btn-sm list_edit"  data-bs-whatever="@mdo">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a> 
                                                <a href="{{ route('manage_business_del', $item->id) }}" onclick="return confirm('Are you sure delete this Business？')" class="btn btn-danger btn-sm">
                                                    <i class="mdi mdi-delete"></i>
                                                </a> 
                                            </div>
                                        </td>
                                <meta name="_token" content="{{ csrf_token() }}">
                                </tr>  
                                @endforeach
                                </tbody>
                              
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade done_message" id="b_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form class=""  method="post" action="javascript:void(0)" id="set_password_form_fitness_trainer">
                            @csrf
                            <div class="mb-3 col-md-12">
                                <input type="hidden" id="set_password_id" name ="id"/>
                                <input type="hidden"  name ="status" value="2"/>
                                <label for="Name" class="control-label">Notification:</label>
                               <!--  <input type="password" required="true" id="passowrd" name="password" class="form-control" id="recipient-name1"> -->
                               <p>Do you want to change the status to Approve?</p>

                             <!--    <div class="password_hints" id="pswd_info">
                                    <h4>Password must meet the following requirements:</h4>
                                    <ul>
                                        <li id="letter" class="invalid letter">At least <strong>one special character</strong></li>
                                        <li id="capital" class="invalid capital">At least <strong>one capital letter</strong></li>
                                        <li id="small" class="invalid small">At least <strong>one small letter</strong></li>
                                        <li id="number" class="invalid number">At least <strong>one number</strong></li>
                                        <li id="length" class="invalid length">Be at least <strong>8 characters</strong></li>
                                    </ul>
                                </div> -->

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success btn_submit loadingbtnap" type="button"  style="display: none" disabled>
                                          <span class="spinner-grow spinner-grow-sm n-success" role="status" aria-hidden="true"></span>
                                          Loading...
                                        </button>
                                    <button type="submit"  id="submit"  class="btn btn-success btn_submit btnapproved">Approve</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

 
    </div>
            <div class="modal fade done_message" id="b_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form class=""  method="post" action="javascript:void(0)" id="rejected_request">
                            @csrf
                            <div class="mb-3 col-md-12">
                                <input type="hidden" id="set_id" name ="id"/>
                                <input type="hidden"  name ="status" value="3"/>
                                <label for="Name" class="control-label">Reason:</label>
                                <input type="text" required="true" id="reason" name="reason" class="form-control" id="recipient-name1">
                         
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success btn_submit loadingbtn" type="button"   disabled>
                                            <span class="spinner-grow spinner-grow-sm n-success" role="status" aria-hidden="true"></span>Loading..
</button>
                                    <button type="submit"  id="submit"  class="btn btn-success btn_submit btnokform">Ok</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


<script type="text/javascript">
    function statusnewchanges(val,id)
    {
        $("#reason").empty();
           var value =  val; //$(this).val();
            
                //id = $(this).attr("data-id");
                if (value == '2')
                {
                    //$("#passowrd").reset();
                    $("#set_password_id").val(id);
                    $("#b_password").modal('show');
                }
                else if(value=="3")
                {
                    $("#set_id").val(id);
                    $("#b_reject").modal('show');

                }
                else
                {
                     reason =$("#reason").val();
                    var formData = new FormData();
                    formData.append("id", id);
                    formData.append("status", value);
                    formData.append("reason",reason);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    jQuery.ajax({
                        url: host_url + "set_password_fitness_trainer",
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,
                                beforeSend: function(msg){
                            $(".loadingbtn").css("display","block");
                            $(".btnokform").hide();

                            },
                        success: function (data) {
                            var obj = JSON.parse(data);
                            if (obj.status == true) {
                                jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> " + obj.message + "</div>");

                                setTimeout(function () {
                                    jQuery('.result').html('');
                                    window.location = host_url + "manager_business";
                                }, 3000);
                            }
                            else {
                                if (obj.status == false) {
                                    jQuery('#name_error').html(obj.message);
                                    jQuery('#name_error').css("display", "block");
                                }
                            }
                        }
                    });
                }
    }
</script>


    <script>
        function statuschange(value,id)
        {
        host_url = "/development/wemarkthespot/";
         //   var value = $(this).val();
               
//                id = $(this).attr("data-id");
                if (value == '2')
                {
                    //$("#passowrd").reset();
                    $("#set_password_id").val(id);
                    $("#b_password").modal('show');
                }
                else if(value=="3")
                {
                    $("#set_id").val(id);
                    $("#b_reject").modal('show');

                }
                else
                {
                    var formData = new FormData();
                    reason =$("#reason").val();

                    formData.append("id", id);
                    formData.append("status", value);
                    formData.append('reason',reason);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    jQuery.ajax({
                        url: host_url + "set_password_fitness_trainer",
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,
                                beforeSend: function(msg){
        $(".loadingbtn").css("display","block");
        $(".btnokform").hide();

      },
                        success: function (data) {
                            var obj = JSON.parse(data);
                            if (obj.status == true) {
                                jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> " + obj.message + "</div>");

                                setTimeout(function () {
                                    jQuery('.result').html('');
                                    window.location = host_url + "manager_business";
                                }, 3000);
                            }
                            else {
                                if (obj.status == false) {
                                    jQuery('#name_error').html(obj.message);
                                    jQuery('#name_error').css("display", "block");
                                }
                            }
                        }
                    });
                }
        }
        $(function (e) {
 $(".loadingbtn").css("display","none");

            $('.filterdata').on('click', function (e) {
                var token = $('meta[name="_token"]').attr('content');
                $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    cache: false,
                    data: {
                        status: $(this).data('status')
                    },
                    dataType: "json",
                    success: function (data) {
                         $('#zero_config tbody').empty();
                        if (data.status == true) {
                           
                            result = data.data;
                       //     tr = '';
                            for (index in result)
                            {
                             //   console.log(result[index].id);
                               tr = '<tr>';
                                tr += ' <td style=""><input type="checkbox" class="sub_chk" data-id="' + result[index].id + '"></td>';
                                tr += '<td>' + result[index].id + '</td>';
                                tr += '<td>' + result[index].name + '</td>';
                                tr += '<td>' + result[index].email + '</td>';
                                if(result[index].business_type==1)
                                {
                                 tr += '<td>Online Only</td>';     
                                }
                                else
                                {
                                     tr += '<td>Physical Location</td>';   
                                }
                               
                            
                                if (result[index].status == '1' || result[index].status == '0')
                                {
                                    tr += '<td style="color:Red">Pending</td>';
                                }
                                else if (result[index].status == '2')
                                {
                                    tr += '<td style="color:green;">Approved</td>';
                                }
                                else
                                {
                                    tr += '<td style="color:orange;">Rejected</td>';
                                }
                                tr += '<td class="status_change_new">';
                                tr += '<select class="form-select" onchange="statuschange(this.value, ' + result[index].id + ')" data-id="' + result[index].id + '" >';
                                if (result[index].status == '1' || result[index].status == '0')
                                {
                                    tr += '<option value="1" selected >Pending</option>';
                                    tr += '<option value="2"  >Approved</option>';
                                    tr += '<option value="3"  >Reject</option>';
                                }
                                if (result[index].status == '2')
                                {
                                    tr += '<option value="1" >Pending</option>';
                                    tr += '<option value="2" selected >Approved</option>';
                                    tr += '<option value="3"  >Reject</option>';
                                }
                                if (result[index].status == '3')
                                {
                                    tr += '<option value="1" >Pending</option>';
                                    tr += '<option value="2"  >Approved</option>';
                                    tr += '<option value="3" selected  >Reject</option>';
                                }
                                tr += '</select>';
                                tr += '</td>';
                                tr += '<td>';
                                tr += '<div class="table_action">';


                                var fitness_trainer_view = "{{route('manage_business_view','" + result[index].id + "')}}";
                                var fitness_trainer_del = "{{route('manage_business_del','" + result[index].id + "')}}";

                                tr += '<a href="fitness_trainer_view/' + result[index].id + '" data-id = ' + result[index].id + ' class="btn btn-success btn-sm list_view infoU"  data-bs-whatever="@mdo"  data-bs-whatever="@mdo"><i class="mdi mdi-eye"></i></a>';

                                tr += '<a style="display:none" href="' + result[index].id + '" data-id = ' + result[index].id + ' class="btn btn-info btn-sm list_edit"  data-bs-whatever="@mdo"><i class="mdi mdi-lead-pencil"></i></a>';

                                str = "'Are you sure delete this user？'";

                                tr += '<a href="javascript:void(0)" data-id = ' + result[index].id + ' data-url = "fitness_trainer_del/' + result[index].id + '" onclick="return (confirm(' + str + '))" class="btn btn-danger btn-sm "><i class="mdi mdi-delete list_delete"></i></a>';

                                tr += '</div>';
                                tr += '</td>';
                                tr += '<tr>';
                                $('#zero_config tbody').append(tr);
                                //$("#tbody").append(tr);


                            }


                        }
                    },
                });

            });
        });
    </script>


    <script type="text/javascript">
        $(function () {
            $(".list_delete").on("click", function () {
                alert("list_delete");
            });
            // $(".list_delete").on("click",function(){
            // 	alert("S");
            // if (confirm('Are you sure delete this user？')) {
            //   		window.location.href= $(this).attr("data-url");
            // }
            // else
            // {
            // 	return false;
            // }

            // });

            $(".list_password").on("click", function () {
                id = $(this).attr("data-id");
                $("#passowrd").reset();
                $("#set_password_id").val(id);
                $("#b_password").modal('show');
            });

            $(".status_changes").on("change", function () {//not used
                var value = $(this).val();
              
                id = $(this).attr("data-id");
                if (value == '2')
                {
                    //$("#passowrd").reset();
                    $("#set_password_id").val(id);
                    $("#b_password").modal('show');
                }
                else if(value=="3")
                {
                    $("#set_id").val(id);
                    $("#b_reject").modal('show');

                }
                else
                {
                     reason =$("#reason").val();
                    var formData = new FormData();
                    formData.append("id", id);
                    formData.append("status", value);
                    formData.append("reason",reason);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    jQuery.ajax({
                        url: host_url + "set_password_fitness_trainer",
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,
                                beforeSend: function(msg){
        $(".loadingbtn").css("display","block");
        $(".btnokform").hide();

      },
                        success: function (data) {
                            var obj = JSON.parse(data);
                            if (obj.status == true) {
                                jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> " + obj.message + "</div>");

                                setTimeout(function () {
                                    jQuery('.result').html('');
                                    window.location = host_url + "manager_business";
                                }, 3000);
                            }
                            else {
                                if (obj.status == false) {
                                    jQuery('#name_error').html(obj.message);
                                    jQuery('#name_error').css("display", "block");
                                }
                            }
                        }
                    });
                }
            });

        })

         //------------------set_password_form_fitness_trainer-------------------------
$("#set_password_form_fitness_trainer").validate({
rules: {
    
    password: {required: true,},
    },
    messages: {
    password: {required: "Please enter password",},
},
    submitHandler: function(form) {
       var formData= new FormData(jQuery('#set_password_form_fitness_trainer')[0]);
    jQuery.ajax({
            url: host_url+"set_password_fitness_trainer",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
          beforeSend: function(msg){
            $(".loadingbtnap").css("display","block");
            $(".btnokform").hide();
            $(".btnapproved").hide();
        
      },
            success:function(data) { 
            var obj = JSON.parse(data);
            if(obj.status==true){
                jQuery('#name_error').html('');
                jQuery('#email_error').html('');
                jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
                setTimeout(function(){
                    jQuery('.result').html('');
                    window.location = host_url+"manager_business";
                }, 3000);
            }
            else{
                if(obj.status==false){
                    jQuery('#name_error').html(obj.message);
                    jQuery('#name_error').css("display", "block");
                }
            }
            }
        });
    }
});

        $("#rejected_request").validate({
rules: {
    
    reason: {required: true,},
    },
    messages: {
    reason: {required: "Please enter reason",},
},
    submitHandler: function(form) {
       var formData= new FormData(jQuery('#rejected_request')[0]);
    jQuery.ajax({
            url: host_url+"set_password_fitness_trainer",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(msg){
            $(".loadingbtn").css("display","block");
            $(".btnokform").hide();
        
      },

            success:function(data) { 
            var obj = JSON.parse(data);
            if(obj.status==true){
                jQuery('#name_error').html('');
                jQuery('#email_error').html('');
                jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
                setTimeout(function(){
                    jQuery('.result').html('');
                    window.location = host_url+"manager_business";
                }, 3000);
            }
            else{
                if(obj.status==false){
                    jQuery('#name_error').html(obj.message);
                    jQuery('#name_error').css("display", "block");
                }
            }
            }
        });
    }
});

    </script>

    <style>

        #pswd_info {
            position:absolute;
            bottom:-75px;
            bottom: -115px\9; /* IE Specific */
            right:55px;
            width:250px;
            padding:15px;
            background:#fefefe;
            font-size:.875em;
            border-radius:5px;
            box-shadow:0 1px 3px #ccc;
            border:1px solid #ddd;
        }
        #pswd_info h4 {
            margin:0 0 10px 0;
            padding:0;
            font-weight:normal;
        }
        #pswd_info::before {
            content: "\25B2";
            position:absolute;
            top:-12px;
            left:45%;
            font-size:14px;
            line-height:14px;
            color:#ddd;
            text-shadow:none;
            display:block;
        }
        .invalid {
            background:url(../images/invalid.png) no-repeat 0 50%;
            padding-left:22px;
            line-height:24px;
            color:#ec3f41;
        }
        .valid {
            background:url(../images/valid.png) no-repeat 0 50%;
            padding-left:22px;
            line-height:24px;
            color:#3a7d34;
        }
        #pswd_info {
            display:none;
        }
        .status_change button.btn.dropdown-toggle.btn-light {
            display: none;
        }
        .status_change select.status_change {
            position: relative;
        }
        .status_change select.status_change {
            position: relative !important;
            opacity: 1 !important;
            left: auto !important;
            width: 100% !important;
        }
        .status_change select.status_change {
            position: relative !important;
            opacity: 1 !important;
            left: auto !important;
            width: 100% !important;
            border: 1px solid #d9d9d9;
            padding: 4px 10px !important;
            border-radius: 5px;
        }
    </style>


    <script>
        $(document).ready(function () {

            $('#passowrd').keyup(function () {
                var pswd = jQuery(this).val();
                if (pswd.length < 8) {
                    jQuery('.length').removeClass('valid').addClass('invalid');
                } else {
                    jQuery('.length').removeClass('invalid').addClass('valid');
                }
                //validate letter
                if (pswd.match(/[?,=,.,*,!,#,$,%,&,?,@, ,"]/)) {
                    jQuery('.letter').removeClass('invalid').addClass('valid');
                } else {
                    jQuery('.letter').removeClass('valid').addClass('invalid');
                }

                //validate capital letter
                if (pswd.match(/[A-Z]/)) {
                    jQuery('.capital').removeClass('invalid').addClass('valid');
                } else {
                    jQuery('.capital').removeClass('valid').addClass('invalid');
                }

                //validate capital letter
                if (pswd.match(/[a-z]/)) {
                    jQuery('.small').removeClass('invalid').addClass('valid');
                } else {
                    jQuery('.small').removeClass('valid').addClass('invalid');
                }

                //validate number
                if (pswd.match(/\d/)) {
                    jQuery('.number').removeClass('invalid').addClass('valid');
                } else {
                    jQuery('.number').removeClass('valid').addClass('invalid');
                }
            }).focus(function () {
                $('#pswd_info').show();
            }).blur(function () {
                $('#pswd_info').hide();
            });

        });
    </script>

    @stop