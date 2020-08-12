@extends('userinterface.layouts.master')
@section('page-title')
Spotlex
@endsection
@section('content')
 <section class="account_main login_sec">
        <div class="container">
            <div class="account-form login-form">

                       @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                    @endif
                <div class="account-form-inn">
                    <div class="account-title">
                        <h3>SIGN IN</h3>
                    </div>
                    <div class="account-from-block">
                        <form method="POST" action="{{ route('user/userLogin') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email address" />
                            </div>
                            <div class="form-group">
                                <input type="Password" name="password" class="form-control" placeholder="Password" />
                            </div>

                            <div class="form-group account-from-btn-block">
                                <button class="btn primary_btn nm_btn">SIGN IN</button>
                                <a data-target="#resetpass" data-toggle="modal" href="#resetpass" class="link-btn">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="resetpass" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background: #ffffff">
                <div class="modal-header">
                    <h4 class="modal-title">Reset password</h4>
                    <button type="button" onclick="resetForm(this)" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="reset_password" onkeydown="return event.key != 'Enter';" method="POST">
                 @csrf
                <div class="form-group">
                    <input type="text" name="reset_pass_email" class="form-control" placeholder="Enter email to reset your password">
                </div>
                 <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                </div>
                 <div class="alert alert-success print-success-msg" style="display:none">
                        <ul></ul>
                </div>
                 <div style="display: none;" id="sending_reset_email" class="col-sm-12">
                    <div class="threedotspineer">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                        <p style="text-align: center;">please wait...</p>
                </div>
                <div class="form-group account-from-btn-block">
                    <button type="button" class="btn primary_btn nm_btn" style="margin-left: 33%;" onclick="resetUserPassword(this)" id="reset_button" >Reset</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>

        // show error message function
function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each(msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
        function printErrorIfNotArray (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
                $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
        }
        function printSuccessmessage(msg) {
            $(".print-success-msg").find("ul").html('');
            $(".print-success-msg").css('display','block');
            $(".print-success-msg").find("ul").append('<li>'+msg+'</li>');
        }
        function resetForm(){
            $("#reset_button").attr("disabled", false);
            $(".print-error-msg").hide();
            $(".print-success-msg").hide();
        }

          function resetUserPassword() {
             $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: '/user/forgetpassword', //Make sure your URL is correct
                    dataType: 'json', //Make sure your returning data type dffine as json
                    data: {
                        'email':$("input[name=reset_pass_email]").val(),
                    },
                    beforeSend: function(){
                        $(".print-error-msg").hide();
                        $(".print-success-msg").hide();
                        $("#reset_button").attr("disabled", true);
                        $('#sending_reset_email').show();
                    },
                    success: function(response){
                       if($.isEmptyObject(response.error) && response.status === true){
                        $("#reset_button").attr("disabled", false);
                        $('#sending_reset_email').hide();
                        $("#reset_button").attr("disabled", false);
                            printSuccessmessage(response.message);
                        }else if(response.array =='no' && response.status === false){
                            printErrorIfNotArray(response.message);
                            $('#sending_reset_email').hide();
                             $("#reset_button").attr("disabled", false);
                        }else if(response.status == 'exception'){
                         printErrorMsg(response.message);
                         $('#sending_reset_email').hide();
                          $("#reset_button").attr("disabled", false);
                        }
                        else{
                        printErrorMsg(response.error);
                        $('#sending_reset_email').hide();
                         $("#reset_button").attr("disabled", false);
                            }
                    },
                    error:function(response){   
                         printErrorMsg(response.error);
                         $('#sending_reset_email').hide();
                          $("#reset_button").attr("disabled", false);
                    },
                    done: function (data) {
                        $('#sending_reset_email').hide();
                         $("#reset_button").attr("disabled", false);
                    }
                });
            }
    </script>
    @endsection
