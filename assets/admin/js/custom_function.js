var global = 
{ 
	base_url : 'http://localhost/myciproject/',
	file_url : '',
    environment : 'prod', //prod
};

$(document).ready(function(){
	var LoginAjx, AdminAjx;
	var remember = $.cookie('remember');
    if ( remember == 'true' ) {
        var u_name = $.cookie('u_name');
        var password = $.cookie('password');
        // autofill the fields
        $('.account-form #u_name').val(u_name);
        $('.account-form #password').val(password);
        $('.account-form #remember_me').attr('checked' , remember);
    }
	var admin = {
		params: {

		},
		fn: {
			login: function(e){
				e.preventDefault();
	            if(LoginAjx){
	                LoginAjx.abort();
	            }
	            $(".errors").hide().remove();
	            $(".error-message").hide().remove();
	            var u_name = $("#u_name");
	            var u_nameVal = $.trim(u_name.val());

	            var password = $("#password");
	            var passwordVal = $.trim(password.val());

	            var hasError = false;

	            if(u_nameVal == '') {
	            	u_name.after('<span class="error-message">This is required field</span>');
	            	hasError = true;
	            }

	            if(passwordVal == '') {
	            	password.after('<span class="error-message">This is required field</span>');
	            	hasError = true;
	            }

	            var data_get = {u_name: u_nameVal, password: passwordVal};
	            if(hasError == false){
	            	if ($('#remember_me').attr('checked')) {
						$.cookie('u_name', u_nameVal, { expires: 365 });
						$.cookie('password', passwordVal, { expires: 365 });
						$.cookie('remember', true, { expires: 365 });
					} else {
						$.cookie('username', '');
						$.cookie('password', '');
						$.cookie('remember', false);
					}

				}
				LoginAjx = $.ajax({
					url: global.base_url+"admin/login",
                    type: "post",
                    data: data_get,
                    dataType: 'json',
                    success: function(data){
                    	console.log(data);
                    	if(data.status == false){
                            if(data.error.u_name != undefined) {
                                $('#u_name').after('<span class="error-message">'+data.error.u_name+'.</span>');
                                $('#u_name').focus();
                                hasError = true;
                            }
                            if(data.error.password != undefined) {
                                $('#password').after('<span class="error-message">'+data.error.email+'.</span>');
                                $('#password').focus();
                                hasError = true;
                            }
                            if(data.error != '') {
                                $('#password').after('<span class="error-message">'+data.error+'.</span>');
                                hasError = true;
                            }
                        }else{
                            window.location.href = global.base_url+"admin/dashboard";
                        }
                    },
                    error: function(err){
                    	console.log(err);

                    }
				});
			},
			create_user: function(e){
				e.preventDefault();
	            if(AdminAjx){
	                AdminAjx.abort();
	            }
	            var errLocation = [];
	            var uname = $('#uname');
	            var f_name = $('#f_name');
	            var l_name = $('#l_name');
	            var email = $('#email');
	            var password = $('#password');
	            var c_password = $('#c_password');
	            var phone = $('#phone');
	            var uname_val = $.trim(uname.val());
	            var f_name_val = $.trim(f_name.val());
	            var l_name_val = $.trim(l_name.val());
	            var email_val = $.trim(email.val());
	            var password_val = $.trim(password.val());
	            var c_password_val = $.trim(c_password.val());
	            var phone_val = $.trim(phone.val());
	            $(".errors").hide().remove();
                var hasError = false;
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(uname_val == ''){
	            	uname.after('<div class="errors">You forgot to enter username.</div>');
	                errLocation.push('uname');
                }
                if(f_name_val == ''){
	            	f_name.after('<div class="errors">You forgot to enter first name.</div>');
	                errLocation.push('f_name');
                }
                if(l_name_val == ''){
	            	l_name.after('<div class="errors">You forgot to enter last name.</div>');
	                errLocation.push('l_name');
                }
                


			}
		}
	};

	$(document).delegate("#login_btn",'click',function(e){
        admin.fn.login(e);
    });
    $(document).delegate("#user_submit_btn",'click',function(e){
        admin.fn.create_user(e);
    });

});