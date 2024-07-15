<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom/post-idea.js"></script>
<script src="<?php echo base_url();?>assets/js/standalone/selectize.js"></script> 
<link href="<?php echo base_url();?>assets/css/selectize.default.css" rel="stylesheet">
<section class="form-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 blue-box">
                        <div class="flow-section">
                            <h3>How it Works</h3>
                            <hr>
                                <div class="img-section">
                                    <img src="<?php echo base_url(); ?>assets/images/postBusiness.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/developBusiness.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/UseViewham.svg"><b></b>
                                    <img src="<?php echo base_url(); ?>assets/images/executePlan.svg">
                                </div>
                                <div class="desc-section">
                                    <ul>
                                        <li>Post a Business Idea For Validation</li>
                                        <li>Develop Business Ideas with Proper Vision And Plan</li>
                                        <li>Use VIEWHAM To Gather Human & Financial Services</li>
                                        <li>Execute Plan with Passion</li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12 form-box">
                        <!-- Tabs -->
                        <div class="row">
                            <div class="top-btn">
				<a class="active">Post a Business Idea</a>
                            </div>
                            <!-- Accordions -->
                            <div class="content">
				<form id="post-idea" action="" method="post">
                                    <input type="hidden" name="session_exist" id='session_exist' value="<?php echo $session_exist;?>">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <textarea onkeypress="return AlphabetsOnly(this, event)" onkeyup="textAreaAdjust(this)" style="overflow:hidden" class="mdl-textfield__input" id="title" name="title" maxlength="180" required><?php if(isset($idea['IDEA_TITLE'])){echo $idea['IDEA_TITLE'];}?></textarea>
                                        <label class="mdl-textfield__label" for="title">Idea Title <sup class="red">*</sup></label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box">
                                        <label class="lsample" for="title">Industry <sup class="red">*</sup></label>
                                        <select style="width:100%" id="select-industry" name="industry" class="e2_2ss demo-default" placeholder="Select Industry" required>
                                            <option value="">Select a Industry...</option>
                                            <?php foreach($industries as $p){ ?>
                                            <option value="<?php echo $p['id']; ?>">
                                            <?php echo $p['industry']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="" for="description">Description</label>
                                    <div class="" style="margin-bottom:10px;">
                                        <textarea onkeyup="textAreaAdjust(this)" class="mdl-textfield__input content2" rows="3" name="description" id="editor1" required><?php if(isset($idea['DESCRIPTION'])){echo $idea['DESCRIPTION'];}?>
                                        </textarea>
                                    </div>
                                    <label>Approx Investment <sup class="red">*</sup></label>
                                    <div class="grey-form-box">Currency
                                        <div class="day-col">
                                            
                                            <select class="medium form-control currencyintitate " name="currency" id="currency" required>
                                                <option value="">Select</option>
                                                <option value="INR" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='INR' ){echo "selected";}}?>>India(₹)</option>
                                                <option value="USD" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='USD' ){echo "selected";}}?>>U.S. Dollar($)</option>
                                                <option value="EUR" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='EUR' ){echo "selected";}}?>>European Euro(€)</option>
                                                <option value="JPY" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='JPY' ){echo "selected";}}?>>Japanese (¥)</option>
                                                <option value="GBP" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='GBP' ){echo "selected";}}?>>British Pound (£)</option>
                                                <option value="CHF" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='CHF' ){echo "selected";}}?>>Swiss Franc (SFr)</option>
                                                <option value="CAD" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='CAD' ){echo "selected";}}?>>Canadian Dollar (C$)</option>
                                                <option value="AUD" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='AUD' ){echo "selected";}}?>>Australian (A$)</option>
                                                <option value="ZAR" <?php if(isset($idea[ 'CURRENCY'])){if($idea[ 'CURRENCY']=='ZAR' ){echo "selected";}}?>>South African Rand (R)</option>
                                            </select>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input" type="text" name="min_invest" id="min_invest" value="<?php if(isset($idea['MIN_INVESTMENT'])){echo $idea['MIN_INVESTMENT'];}?>" required>
                                                <label class="mdl-textfield__label" for="sample3">Min Investment</label>
                                            </div>
                                            <span class="hidden-xs">-</span>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input" greaterThan" data-min="min_invest" type="text" name="max_invest" id="max_invest" value="<?php if(isset($idea['MAX_INVESTMENT'])){echo $idea['MAX_INVESTMENT'];}?>" required>
                                                <label class="mdl-textfield__label" for="sample3">Max Investment</label>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Approx Returns <sup class="red">*</sup></label>
                                    <div class="grey-form-box">
                                        <div class="day-col">
                                            <select class="medium form-control returns" name="returns_type" id="returns_type">
                                                <option value="">Select</option>
                                                <option value="Daily" <?php if(isset($idea[ 'RETURNS_TYPE'])){if($idea[ 'RETURNS_TYPE']=='Daily' ){echo "selected";}}?>>Daily</option>
                                                <option value="Weekly" <?php if(isset($idea[ 'RETURNS_TYPE'])){if($idea[ 'RETURNS_TYPE']=='Weekly' ){echo "selected";}}?>>Weekly</option>
                                                <option value="Monthly" <?php if(isset($idea[ 'RETURNS_TYPE'])){if($idea[ 'RETURNS_TYPE']=='Monthly' ){echo "selected";}}?>>Monthly</option>
                                                <option value="Yearly" <?php if(isset($idea[ 'RETURNS_TYPE'])){if($idea[ 'RETURNS_TYPE']=='Yearly' ){echo "selected";}}?>>Yearly </option>
                                            </select>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input" type="text" name="min_return" id="min_return" value="<?php if(isset($idea['MIN_RETURNS'])){echo $idea['MIN_RETURNS'];}?>" required>
                                                <label class="mdl-textfield__label" for="sample3">Min Returns</label>
                                            </div>
                                            <span class="hidden-xs">-</span>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input greaterThan" data-min="min_return" type="text" value="<?php if(isset($idea['MAX_RETURNS'])){echo $idea['MAX_RETURNS'];}?>" name="max_return" id="max_return" required>
                                                <label class="mdl-textfield__label" for="sample3">Max Returns</label>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Breakeven Time <sup class="red">*</sup></label>
                                    <div class="grey-form-box">
                                        <div class="day-col">
                                            <select class="medium form-control breakeven" name="breakeven_type" id="breakeven_type" required>
                                                <option value="">Select</option>
                                                <option value="Days" <?php if(isset($idea[ 'BREAKEVEN_TYPE'])){if($idea[ 'BREAKEVEN_TYPE']=='Days' ){echo "selected";}}?>>Days</option>
                                                <option value="Months" <?php if(isset($idea[ 'BREAKEVEN_TYPE'])){if($idea[ 'BREAKEVEN_TYPE']=='Months' ){echo "selected";}}?>>Months</option>
                                                <option value="Years" <?php if(isset($idea[ 'BREAKEVEN_TYPE'])){if($idea[ 'BREAKEVEN_TYPE']=='Years' ){echo "selected";}}?>>Years </option>
                                            </select>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input" type="text" name="breakeven_min" id="breakeven_min" value="<?php if(isset($idea['MIN_BREAKEVEN'])){echo $idea['MIN_BREAKEVEN'];}?>" required>
                                                <label class="mdl-textfield__label" for="sample3">Min </label>
                                            </div>
                                            <span class="hidden-xs">-</span>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                <input class="mdl-textfield__input greaterThan" data-min="breakeven_min" type="text" name="breakeven_max" id="breakeven_max" value="<?php if(isset($idea['MAX_BREAKEVEN'])){echo $idea['MAX_BREAKEVEN'];}?>" required>
                                                <label class="mdl-textfield__label" for="sample3">Max </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Resources Required <sup class="red">*</sup></label>
                                    <div class="grey-form-box">
                                        <div id="field0qq">
                                            <?php if(isset($idea['resources'])){
                                            $peo = explode(",",$idea['resources']);
                                            $r_qty = explode(",",$idea['resources_qty']);
                                            foreach($peo as $key => $value){ ?>
                                                <div class="skillsadds">
                                                    <div id="" class="skillsadd  day-col" style="width: 75%;float: left;">
                                                        <select placeholder="Select Skill" class="combobox  e2_2 medium validate[required]" required name="resourse[]">
                                                            <option value=''>Select Skill</option>
                                                            <?php foreach($skils as $ind){ ?>
                                                            <option value="<?php echo $ind['ID']; ?>" <?php if($value==$ind[ 'ID']){echo "selected";}?>>
                                                                <?php echo $ind['SDESC']; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label input-box w-120">
                                                            <input class="form-control mdl-textfield__input" required name="rs_qnty[]" type="number" value="<?php echo $r_qty[$key]; ?>">
                                                        </div>
                                                        <span class="glyphicon glyphicon-remove text-danger"></span>
                                                    </div>
                                                </div>
                                            <?php } 
                                            } else{ ?>
                                                <div class="skillsadds">
                                                    <div id="" class="skillsadd  day-col" style="width: 75%;float: left;">
							<div style="float:left">
							<select placeholder="Select Skill" class="combobox  e2_2 medium"  required name="resourse[]">
                                                            <option value=''>Select Skill</option>
                                                            <?php foreach($skills as $ind){ ?>
                                                            <option value="<?php echo $ind['id']; ?>"><?php echo $ind['skill']; ?></option>
                                                            <?php } ?>
							</select>
							</div>
							<div style="float:left">
							<div  style="width:20%; margin-left:5%">
                                                            <input required class="form-control mdl-textfield__input small" name="rs_qnty[]" type="number" id="sample3">
							</div>
							</div>
							<span class="glyphicon glyphicon-remove text-danger"></span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="add-sec">
                                                <button type="button" id="addd" class="btn btn-primary small ">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="tags">Tags<sup class="red">*</sup></label>
                                    <div class="grey-form-box1">
                                        <select name="tags[]" id="sl" multiple="multiple" class="e2_2aaa mb-5  required" style="width:100%" tabindex="-1">
                                            <?php foreach($tags as $ind){ ?>
                                                    <option value="<?php echo $ind['id']; ?>">
                                                        <?php echo $ind['tag_name']; ?>
                                                    </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                       <!-- <button id="submit_idea" type="button" class="btn btn-primary sub pull-right">Submit</button>-->
									   <button id="submit_idea_delete" type="submit" class="btn btn-primary sub pull-right">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="page_name" id="page_name" value="<?php echo $this->uri->uri_string();?>">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
<?php $this->load->view('modals/signup_modal');?>
<?php $this->load->view('modals/signin_modal');?>
<?php $this->load->view('modals/mobile_otp');?>
<?php $this->load->view('modals/messages');?>



	<script type="text/javascript" src="<?php echo base_url()?>assets/dist/jquery.validate.js"></script>
	
<script type="text/javascript">
		/*$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
		} );*/
		
		$.validator.addMethod("greaterThan",

function (value, element, param) {
  var $element = $(element)
      , $min;
  if (typeof(param) === "string") {
      $min = $(param);
  } else {
  	  $min = $("#" + $element.data("min"));
  }
  if (this.settings.onfocusout) {
    $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
      $element.valid();
    });
  }
  return parseInt(value) > parseInt($min.val());
}, "Max must be greater than min");
		
		
		$.validator.addMethod('customphone', function (value, element) {
    return this.optional(element) || /^[0-9-+s()]{10}$/.test(value) ;
}, "Please enter a valid phone number");


$.validator.addMethod('tag', function (value, element) {
    return this.optional(element) || /^[0-9-+s()]{10}$/.test(value) ;
}, "Please enter a valid phone number");
		


		$( document ).ready( function () {
				
	
	$(document).on("change", ".select2-offscreen", function () {
        if (!$.isEmptyObject(validobj.submitted)) {
            validobj.form();
        }
    });
	
	  $(document).on("select2-opening", function (arg) {
        var elem = $(arg.target);
		
        if ($("#s2id_" + elem.attr("id") + "").hasClass("myErrorClass")) {
            //jquery checks if the class exists before adding.
            $(".select2-drop ").addClass("myErrorClass");
			$("#sl-error").show();
        } else {
            $(".select2-drop ").removeClass("myErrorClass");
			$("#sl-error").hide();
        }
    });
			
			  $.validator.setDefaults({
        ignore: []
    });
			var validobj = $( "#post-idea" ).validate( {
				rules: {
					title: "required",
					//'tags[]': {
					//	tag: true,						
					//},
					returns_type:"required",
					min_return: "required",
					max_invest: {
						required: true,
						greaterThan: true
					},
					//max_return: "required",
					breakeven_max: {
						required: true,
						greaterThan: true
					},
					max_return: {
						required: true,
						greaterThan: true
					},
					
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true,
						"remote" :
						  {
							  url: '<?php echo base_url()?>Home/isEmailAvailable',
							  type: "post",
							  data:
							  {
								  email: function()
								  {
									  return $('#signupForm :input[name="email"]').val();
								  }
							  }
						  }
						
					
					},
					phone: {
						required: true,
						customphone: true,
						"remote" :
						  {
							  url: '<?php echo base_url()?>Home/checkMobileExists',
							  type: "post",
							  data:
							  {
								  phone: function()
								  {
									  return $('#signupForm :input[name="phone"]').val();
								  }
							  }
						  }
					},
									
					agree: "required"
				},
				messages: {
					/*title: "required",
					returns_type: "required",
					min_return:"required",
					max_return:"required",
					remote: "Email already exists",
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: {
						required: "Please provide a email",
						email: "Please enter a valid email address",
						remote: "Email already exists",
					},
					phone: {
						required: "Please provide Mobile",
						//email: "Please enter a valid email address",
						remote: "Mobile already exists",
					},
					//email: "Please enter a valid email address",
					agree: "Please accept our policy"
					*/
				},
				/*errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}*/
				//onkeyup: false,
        errorClass: "myErrorClass",

        //put error message behind each form element
        errorPlacement: function (error, element) {
            var elem = $(element);
            error.insertAfter(element);
        },
				highlight: function (element, errorClass, validClass) {
            var elem = $(element);
			$("#sl-error").show();
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
			$("#sl-error").show();
        },

        //When removing make the same adjustments as when adding
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
				$("#sl-error").hide();
            } else {
                elem.removeClass(errorClass);
				$("#sl-error").hide();
            }
        },
		submitHandler: function () {
				//alert( "submitted!" );
				checkSession();
			}
			
			} );
	} );
	</script>	
<script type="text/javascript">
    CKEDITOR.replace( 'editor1',
        {
            toolbar :
            [
                { name: 'basicstyles', items : [ 'Bold','Italic' ] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList'] },
                
                        
                        

            ]
        });
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}
</script>
   <style>
   label.error{
	   color:red;
	   display: inline !important;
   }
</style>   