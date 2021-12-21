@extends('layouts.admin')
@section('content')
       <link rel="stylesheet" href="{{asset('/assets/build/css/intlTelInput.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/build/css/demo.css')}}">

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Business Details</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Business Details</li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		
		<div class="col-12">
			<div class="card">
				<div class="border-bottom title-part-padding">
					<h4 class="card-title mb-0">Edit Business Details</h4>
				</div>
				<div class="card-body min_height">
					<form name="manage_business_edit" id="manage_business_edit" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
							<div class="mb-3 col-md-4">
								<input type="hidden" name="id" value="{{$fitnesstrainer->id}}">
								<label for="Name" class="control-label" >Name:<span style="color:red">*</span></label>
								<input type="text" id="name" value="{{$fitnesstrainer->name}}"  name="name" class="form-control">
							</div>
							<div class="mb-3 col-md-4">
								<label for="Email" class="control-label">Email:<span style="color:red">*</span></label>
								<input type="email" id="email" name="email" value="{{$fitnesstrainer->email}}"  class="form-control">
								{{-- allready exit error --}}
								<label id="email_error" class="error"></label>
							</div>
							<!-- <div class="mb-3 col-md-4" style="display:none;">
								<label for="Email" class="control-label">Password:</label>
								<input type="text" id="password"  name="password" value=""  class="form-control">
								{{-- allready exit error --}}
								<label id="email_error" class="error"></label>
							</div> -->
							<div class="mb-3 col-md-3"style="">
								<label for="username" class="control-label">Mobile Number:<span style="color:red">*</span></label>
								 <input type="hidden" id="country_code" value="{{$fitnesstrainer->country_code}}"  name="country_code"/>
								<input type="text" id="phone" name="phone" value="{{$fitnesstrainer->phone}}"   class="form-control">
								{{-- allready exit error --}}
								<label id="name_error" class="error"></label>
							</div>
                          
							<div class="mb-3 col-md-3">
								<label for="password" class="control-label">Business Name:</label>
								<input type="text" id="business_name" value="{{$fitnesstrainer->business_name}}"  class="form-control"  name="business_name"/>
							</div>
							<div class="mb-3 col-md-3">
								<label for="password" class="control-label">Location:</label>
								<input type="text" id="location" value="{{$fitnesstrainer->location}}"  class="form-control"  name="location"/>
							</div>
							<div class="mb-3 col-md-3">
								<label for="password" class="control-label">Opening Hours:</label>
								<input type="time" id="opeing_hour" value="{{$fitnesstrainer->opeing_hour}}"  class="form-control"  name="opeing_hour"/>
							</div>
							<div class="mb-3 col-md-3">
								<label for="password" class="control-label">Closing Hours:</label>
								<input type="time" id="closing_hour" value="{{$fitnesstrainer->closing_hour}}"  class="form-control"  name="closing_hour"/>
							</div>
							<div class="mb-3 col-md-3">
                           <div><label class="form-label">Select Business Type</label></div>
                           <div class="form-check form-check-inline">

            			<input class="form-check-input" @if($fitnesstrainer->business_type=='1') checked @endif type="radio" checked  name="business_type" id="inlineRadio1" value="1" >
                			 
                              <label class="form-check-label" for="inlineRadioOptions">Online Only</label>
                           </div>
                           <div class="form-check form-check-inline">
                          
                           	  <input class="form-check-input" @if($fitnesstrainer->business_type=='2') checked @endif type="radio" name="business_type" id="inlineRadio2" value="2">
                            
                              <label class="form-check-label" for="inlineRadioOptions">Physical Location</label>
                           </div>
                        </div>

							<!-- <div class="mb-3 col-md-3"style="display:none;">
								<label for="password" class="control-label">Gender:</label>
								<select id="gender" name="gender" class="form-control">
									<option value=''>Select Gender</option>
									<option value='Male'  @if($fitnesstrainer->gender == 'Male') selected  @endif  >Male</option>
									<option value='Female' @if($fitnesstrainer->gender == 'Female') selected  @endif >Female</option>
								</select>
							</div> -->

							<!-- <div class="mb-3 col-md-3 form-group"style="display:none;">
								<label for="specialization" class="control-label">Specialization: <span style="color:red">*</span></label>
								<input type="text" id="specialization" name="specialization[]"  value=""class="form-control">
							</div> -->
						<!-- 	<div class="mb-3 col-md-4"style="display:none;">
								<label for="password" class="control-label">Education:</label>
								<input type="text" id="education" name="education"  value=""class="form-control">
							</div>
							<div class="mb-3 col-md-4"style="display:none;">
								<label for="password" class="control-label">Location/Address:<span style="color:red">*</span></label>
								<textarea rows="3" cols="5" class="form-control" placeholder="Location/Address" ></textarea>
							</div> -->
							<!-- <div class="mb-3 col-md-4"style="display:none;">
								<label for="password" class="control-label">Bio:<span style="color:red">*</span></label>
								<textarea rows="3" cols="5" class="form-control" placeholder="Bio" name="bio" required>{{$fitnesstrainer->bio}}</textarea>
							</div> -->
							<!-- <div style="display:none"> 
								<h5>Change Password</h5>
									<div class="row">
										<div class="mb-3 col-md-4">
											<label for="password" class="control-label">Current Password:</label>
											<input type="text" id="gender" name="old_password"  value="" placeholder="Current Password"    class="form-control">
										</div>
										<div class="mb-3 col-md-4">
											<label for="password" class="control-label">New Password:</label>
											<input type="text" id="new_password" name="new_password" placeholder="New Password"  class="form-control">
										</div>
										<div class="mb-3 col-md-4">
											<label for="password" class="control-label">Confirm Password:</label>
											<input type="text" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control">
										</div>
							</div>

									<div class="mb-3 col-md-6"style="display:none;">
								<label for="username" class="control-label">Upload Document:</label>
								<img src="" height="150" width="100" class="form-control" />
								<input type="hidden" name="upload_doc" name ="old_upload_doc" value=>
								<input type="file" name="upload_doc" class="form-control">
							</div>


							</div> -->
						</div>
						<a type="button" href="{{ url('manager_business') }}" class="btn btn-dark fa-pull-left mt-3">Back</a>
						 <input type="submit"  value="Save" class="btn btn-success btn_submit_tranning fa-pull-right mt-3"> 
					</form>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <script src="{{ asset('assets/js/customvalidation.js') }}"></script>

  <!--   <script src="{{asset('assets/build/js/intlTelInput.js')}}"></script> -->
    <script type="text/javascript">
    	$(function(){
    		$(".btn_submit_tranning").on("click",function(){
		country_code =$(".iti__selected-flag").attr("title");
		
	if(typeof country_code !== "undefined")
		{
			const myArr = country_code.split(": ");
			c_code =myArr[1];
			$("#country_code").val(c_code);
		}
        
       //   console.log($("#country_code").val());
    
      });
    	});
    </script>
    <script>
    	
 $("#manage_business_edit").validate({
rules: {
	name:{required:true,},
	},
	messages: {
		name: {required: "Please enter name",},
	},
	submitHandler: function(form) {
	   var formData= new FormData(jQuery('#manage_business_edit')[0]);
	   alert('hh');
	jQuery.ajax({
			url: host_url+"manage_business_editt",
			type: "post",
			cache: false,
			data: formData,
			processData: false,
			contentType: false,
			
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
   <script>
   	
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
<script type="text/javascript">
var AmsifySuggestags;

(function(factory) {
	if(typeof module === 'object' && typeof module.exports === 'object') {
		factory(require('jquery'), window, document);
	} else {
		factory(jQuery, window, document);
	}
}
(function($, window, document, undefined) {
	
	AmsifySuggestags = function(selector) {
		this.selector = selector;
		this.settings = {
			type              : 'bootstrap',
			tagLimit          : -1,
			suggestions       : [],
			suggestMatch 	  : {},
			suggestionsAction : {timeout: -1, minChars:2, minChange:-1, delay:100, type: 'GET'},
			defaultTagClass   : '',
			classes           : [],
			backgrounds       : [],
			colors            : [],
			whiteList         : false,
			afterAdd          : {},
			afterRemove       : {},
			//My changes
			trimValue         : false,
			dashspaces        : false,
			lowercase         : false,
			selectOnHover     : true,
			triggerChange     : false,
			noSuggestionMsg   : '',
			showAllSuggestions: false,
			keepLastOnHoverTag: true,
			printValues 	  : true,
			checkSimilar 	  : true,
			delimiters 		  : [],
			showPlusAfter 	  : 0
		};
		this.method        = undefined;
		this.name          = null;
		this.defaultLabel  = 'Type here';
		this.classes       = {
			sTagsArea     : '.amsify-suggestags-area',
			inputArea     : '.amsify-suggestags-input-area',
			inputAreaDef  : '.amsify-suggestags-input-area-default',
			focus         : '.amsify-focus',
			sTagsInput    : '.amsify-suggestags-input',
			listArea      : '.amsify-suggestags-list',
			list          : '.amsify-list',
			listItem      : '.amsify-list-item',
			itemPad       : '.amsify-item-pad',
			inputType     : '.amsify-select-input',
			tagItem       : '.amsify-select-tag',
			plusItem 	  : '.amsify-plus-tag',
			colBg         : '.col-bg',
			removeTag     : '.amsify-remove-tag',
			readyToRemove : '.ready-to-remove',
			noSuggestion  : '.amsify-no-suggestion',
			showPlusBg 	  : '.show-plus-bg'
		};
		this.selectors     = {
			sTagsArea     : null,
			inputArea     : null,
			inputAreaDef  : null,
			sTagsInput    : null,
			listArea      : null,
			list          : null,
			listGroup     : null,
			listItem      : null,
			itemPad       : null,
			inputType     : null,
			plusTag 	  : null
		};
		this.isRequired = false;
		this.ajaxActive = false; 
		this.tagNames   = [];
		this.delayTimer = 0;
		this.blurTgItems= null;
	};
	AmsifySuggestags.prototype = {
	   /**
		* Merging default settings with custom
		* @type {object}
		*/
		_settings : function(settings) {
			this.settings = $.extend(true, {}, this.settings, settings);      
		},

		_setMethod : function(method) {
			this.method = method;
		},

		_init : function() {
			if(this.checkMethod()) {
				this.name = ($(this.selector).attr('name'))? $(this.selector).attr('name')+'_amsify': 'amsify_suggestags';
				this.createHTML();
				this.setEvents();
				$(this.selector).hide();
				this.setDefault();
			}
		},

		createHTML : function() {
			var HTML                  = '<div class="'+this.classes.sTagsArea.substring(1)+'"></div>';
			this.selectors.sTagsArea  = $(HTML).insertAfter(this.selector);
			var labelHTML             = '<div class="'+this.classes.inputArea.substring(1)+'"></div>';
			this.selectors.inputArea  = $(labelHTML).appendTo(this.selectors.sTagsArea);
			this.defaultLabel         = ($(this.selector).attr('placeholder') !== undefined)? $(this.selector).attr('placeholder'): this.defaultLabel;
			var sTagsInput            = '<input type="text" class="'+this.classes.sTagsInput.substring(1)+'" placeholder="'+this.defaultLabel+'">';
			this.selectors.sTagsInput = $(sTagsInput).appendTo(this.selectors.inputArea).attr('autocomplete', 'off');
			if($(this.selector).attr('required')) {
				$(this.selector).removeAttr('required');
				this.isRequired = true;
				this.updateIsRequired();
			}
			var listArea              = '<div class="'+this.classes.listArea.substring(1)+'"></div>';
			this.selectors.listArea   = $(listArea).appendTo(this.selectors.sTagsArea);
			$(this.selectors.listArea).width($(this.selectors.sTagsArea).width()-3);
			var list                  = '<ul class="'+this.classes.list.substring(1)+'"></ul>';
			this.selectors.list       = $(list).appendTo(this.selectors.listArea);
			this.updateSuggestionList();
			this.fixCSS();
		},

		updateIsRequired : function() {
			if(this.isRequired) {
				if(this.tagNames.length){
					$(this.selectors.sTagsInput).removeAttr('required');
				} else {
					$(this.selectors.sTagsInput).attr('required', 'required');
				}
			}
		},

		updateSuggestionList : function() {
			$(this.selectors.list).html('');
			$(this.createList()).appendTo(this.selectors.list);
		},

		setEvents : function() {
			var _self = this;
			$(this.selectors.inputArea).attr('style', $(this.selector).attr('style')).addClass($(this.selector).attr('class'));
			this.setTagEvents();
			if(window !== undefined) {
				$(window).resize(function(){
					$(_self.selectors.listArea).width($(_self.selectors.sTagsArea).width()-3);
				});
			}
			this.setSuggestionsEvents();
			this.setRemoveEvent();
		},

		setTagEvents : function() {
			var _self = this;
			$(this.selectors.sTagsInput).focus(function(){
			   /**
				* Show all suggestions if setting set to true
				*/
				if(_self.settings.showAllSuggestions) {
					_self.suggestWhiteList('', 0, true);
				}
				$(this).closest(_self.classes.inputArea).addClass(_self.classes.focus.substring(1));
				if(_self.settings.type == 'materialize') {
					$(this).css({
						'border-bottom': 'none',
						'-webkit-box-shadow': 'none',
						'box-shadow': 'none',
					});
				}
				_self.checkPlusAfter();
			});
			$(this.selectors.sTagsInput).blur(function(){
				$(this).closest(_self.classes.inputArea).removeClass(_self.classes.focus.substring(1));
				if(!$(this).val()) {
					$(_self.selectors.listArea).hide();
				}
				_self.checkPlusAfter(true);
			});
			$(this.selectors.sTagsInput).keyup(function(e){
				var keycode = (e.keyCode ? e.keyCode : e.which);
				var key 	= '';
				if(e.key) {
					key = e.key;
				} else {
					if(keycode == '13') {
						key = 'Enter';
					} else if(keycode == '188') {
						key = ',';
					}
				}
				/**
				 * Mobile browser fix
				 */
				if(keycode == 229 && key == 'Unidentified' && /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()) && $(this).val()[$(this).val().length - 1] == ',')
				{
					key = ',';
				}
				var isDelimiter = ($.inArray(key, _self.settings.delimiters) !== -1)? true: false;
				if(key == 'Enter' || key == ',' || isDelimiter) {
					var value = $.trim($(this).val().replace(/,/g , ''));
					if(isDelimiter) {
						$.each(_self.settings.delimiters, function(dkey, delimiter) {
							value = $.trim(value.replace(delimiter, ''));
						});
					}
					$(this).val('');
					_self.addTag(_self.getValue(value));
					if(_self.settings.showAllSuggestions) {
						_self.suggestWhiteList('', 0, true);
					}
				} else if(keycode == '8' && !$(this).val()) {
					var removeClass = _self.classes.readyToRemove.substring(1);
					if($(this).hasClass(removeClass)) {
						$item = $(this).closest(_self.classes.inputArea).find(_self.classes.tagItem+':last');
						_self.removeTagByItem($item, false);
					} else {
						$(this).addClass(removeClass);
					}
					$(_self.selectors.listArea).hide();
					if(_self.settings.showAllSuggestions) {
						_self.suggestWhiteList('', 0, true);
					}
				} else if((_self.settings.suggestions.length || _self.isSuggestAction()) && ($(this).val() || _self.settings.showAllSuggestions)) {
					$(this).removeClass(_self.classes.readyToRemove.substring(1));
					_self.processWhiteList(keycode, $(this).val());
				}
			});
			$(this.selectors.sTagsInput).keypress(function(e){
				var keycode = (e.keyCode ? e.keyCode : e.which);
				if(keycode == 13) {
					return false;
				}
			});
			$(this.selectors.sTagsArea).click(function(){
				$(_self.selectors.sTagsInput).focus();
			});
		},

		setSuggestionsEvents : function() {
			var _self = this;
			if(this.settings.selectOnHover) {
				$(this.selectors.listArea).find(this.classes.listItem).hover(function(){
					$(_self.selectors.listArea).find(_self.classes.listItem).removeClass('active');
					$(this).addClass('active');
					$(_self.selectors.sTagsInput).val($(this).text());
				}, function() {
					$(this).removeClass('active');
					if(!_self.settings.keepLastOnHoverTag) {
						$(_self.selectors.sTagsInput).val('');
					}
				});
			}
			$(this.selectors.listArea).find(this.classes.listItem).click(function(){
				_self.addTag($(this).data('val'));
				$(_self.selectors.sTagsInput).val('').focus();
			});
		},

		isSuggestAction : function() {
			return (this.settings.suggestionsAction && this.settings.suggestionsAction.url);
		},

		getTag : function(value) {
			if(this.settings.suggestions.length) {
				var tag = value;
				$.each(this.settings.suggestions, function(key, item){
					if(typeof item === 'object' && item.value == value) {
						tag = item.tag
						return false;
					}
					else if(item == value) {
						return false; 
					}
				});
				return tag;
			}
			return value;
		},

		getValue : function(tag) {
			if(this.settings.suggestions.length) {
				var value = tag;
				var lower = tag.toString().toLowerCase();
				$.each(this.settings.suggestions, function(key, item){
					if(typeof item === 'object' && item.tag.toString().toLowerCase() == lower) {
						value = item.value
						return false;
					}
					else if(item.toString().toLowerCase() == lower) {
						return false; 
					}
				});
				return value;
			}
			return tag;
		},

		processAjaxSuggestion : function(value, keycode) {
			var _self           = this;
			var actionURL    	= this.getActionURL(this.settings.suggestionsAction.url);
			var params          = {existingTags: this.tagNames, existing: this.settings.suggestions, term: value};
			var ajaxConfig      = (this.settings.suggestionsAction.callbacks)? this.settings.suggestionsAction.callbacks: {};
			var ajaxFormParams  = {
				url : actionURL,
			};
			if(this.settings.suggestionsAction.type == 'GET') {
				ajaxFormParams.url = ajaxFormParams.url+'?'+$.param(params);
			} else {
				ajaxFormParams.type = this.settings.suggestionsAction.type;
				ajaxFormParams.data = params;
			}
			if(this.settings.suggestionsAction.timeout !== -1) {
				ajaxFormParams['timeout'] = this.settings.suggestionsAction.timeout*1000;
			}
			if(this.settings.suggestionsAction.beforeSend !== undefined && typeof this.settings.suggestionsAction.beforeSend == "function") {
				ajaxFormParams['beforeSend'] = this.settings.suggestionsAction.beforeSend;
			}
			ajaxFormParams['success'] = function(data) {
				if(data && data.suggestions) {
					_self.settings.suggestions = $.merge(_self.settings.suggestions, data.suggestions);
					_self.settings.suggestions = _self.unique(_self.settings.suggestions);
					_self.updateSuggestionList();
					_self.setSuggestionsEvents();
					_self.suggestWhiteList(value, keycode);
				}
				if(_self.settings.suggestionsAction.success !== undefined && typeof _self.settings.suggestionsAction.success == "function") {
					_self.settings.suggestionsAction.success(data);
				}
			};
			if(this.settings.suggestionsAction.error !== undefined && typeof this.settings.suggestionsAction.error == "function") {
				ajaxFormParams['error'] = this.settings.suggestionsAction.error;
			}
			ajaxFormParams['complete'] = function(data) {
				if(_self.settings.suggestionsAction.complete !== undefined && typeof _self.settings.suggestionsAction.complete == "function") {
					_self.settings.suggestionsAction.complete(data);
				}
				_self.ajaxActive = false;
			};

			if(this.settings.suggestionsAction.dataType !== undefined && this.settings.suggestionsAction.dataType !== null) {
                ajaxFormParams['dataType'] = this.settings.suggestionsAction.dataType;
            }

			$.ajax(ajaxFormParams);
		},

		processWhiteList : function(keycode, value) {
			if(keycode == '40' || keycode == '38') {
				var type = (keycode == '40')? 'down': 'up';
				this.upDownSuggestion(value, type);
			} else {
				clearTimeout(this.delayTimer);
				var _self       = this;
				this.delayTimer = setTimeout(function() {
					if(_self.isSuggestAction() && !_self.ajaxActive) {
				      	var minChars  = _self.settings.suggestionsAction.minChars;
						var minChange = _self.settings.suggestionsAction.minChange;
						var lastSearch= _self.selectors.sTagsInput.attr('last-search');
						if(value.length >= minChars && (minChange === -1 || !lastSearch || _self.similarity(lastSearch, value)*100 <= minChange)) {
							_self.selectors.sTagsInput.attr('last-search', value);
							_self.ajaxActive = true;
							_self.processAjaxSuggestion(value, keycode);
						}
					} else {
						_self.suggestWhiteList(value, keycode);
					}
			    }, this.settings.suggestionsAction.delay);
			}
		},

		upDownSuggestion : function(value, type) {
			var _self     = this;
			var isActive  = false;
			$(this.selectors.listArea).find(this.classes.listItem+':visible').each(function(){
				if($(this).hasClass('active')) {
					$(this).removeClass('active');
					if(type == 'up') {
						$item = $(this).prevAll(_self.classes.listItem+':visible:first');
					} else {
						$item = $(this).nextAll(_self.classes.listItem+':visible:first');
					}
					if($item.length) {
						isActive = true;
						$item.addClass('active');
						$(_self.selectors.sTagsInput).val($item.text());
					}
					return false;
				}
			});
			if(!isActive) {
				var childItem = (type == 'down')? 'first': 'last';
				$item = $(this.selectors.listArea).find(this.classes.listItem+':visible:'+childItem);
				if($item.length) {
					$item.addClass('active');
					$(_self.selectors.sTagsInput).val($item.text());
				}
			}
		},

		suggestWhiteList : function(value, keycode, showAll) {
			var _self = this;
			var found = false;
			var all   = (showAll)? true: false;
			var lower = value.toString().toLowerCase();
			$(this.selectors.listArea).find(_self.classes.noSuggestion).hide();
			var $list = $(this.selectors.listArea).find(this.classes.list);
			$list.find(this.classes.listItem).each(function(){
				var dataVal = $(this).data('val');
				if($.isNumeric(dataVal)) {
					dataVal = (value.toString().indexOf('.') == -1)? parseInt(dataVal): parseFloat(dataVal);
				}

				/**
				 * Suggest item matching result
				 */
				var suggestItemResult = 0;
				if(_self.settings.suggestMatch && typeof _self.settings.suggestMatch == "function") {
					suggestItemResult = _self.settings.suggestMatch($(this).text(), value);
				} else {
					suggestItemResult = ~$(this).text().toString().toLowerCase().indexOf(lower);
				}

				if((all || suggestItemResult) && $.inArray(dataVal, _self.tagNames) === -1) {
					$(this).attr('data-show', 1);
					found = true;
				} else {
					$(this).removeAttr('data-show');
				}
				$(this).hide();
			});
			if(found) {
				/**
				 * Sorting the suggestions
				 */
				$dataShow = $list.find(this.classes.listItem+'[data-show]');
				if(lower) {
					$dataShow.sort(function(a, b) {
						return value.localeCompare($(a).text().toString());
					}).appendTo($list);
				} else {
					$dataShow.sort(function(a, b) {
						return $(a).text().toString().localeCompare($(b).text().toString());
					}).appendTo($list);
				}
				$dataShow.each(function(){
					$(this).show();
				});

			   /**
				* If only one item left in whitelist suggestions
				*/
				$item = $(this.selectors.listArea).find(this.classes.listItem+':visible');
				if($item.length == 1 && keycode != '8') {
					if((this.settings.whiteList && this.isSimilarText(value.toLowerCase(), $item.text().toLowerCase(), 40)) || this.isSimilarText(value.toLowerCase(), $item.text().toLowerCase(), 60)) {
						$item.addClass('active');
						$(this.selectors.sTagsInput).val($item.text());
					}
				} else {
					$item.removeClass('active');
				}

				$(this.selectors.listArea).show();

			} else {
				if(value && _self.settings.noSuggestionMsg) {
					$(this.selectors.listArea).find(_self.classes.listItem).hide();
					$(this.selectors.listArea).find(_self.classes.noSuggestion).show();
				} else {
					$(this.selectors.listArea).hide();
				}
			}
		},

		setDefault : function() {
			var _self = this;
			var items = $(this.selector).val().split(',');
			if(items.length) {
				$.each(items, function(index, item){
					_self.addTag($.trim(item));
				});
			}
		},

		setRemoveEvent: function() {
			var _self = this;
			$(this.selectors.inputArea).find(this.classes.removeTag).click(function(e){
				e.stopImmediatePropagation();
				$tagItem = $(this).closest(_self.classes.tagItem);
				_self.removeTagByItem($tagItem, false);
			});
		},

		createList : function() {
			var _self     = this;
			var listHTML  = '';
			$.each(this.settings.suggestions, function(index, item){
				var value = '';
				var tag   = '';
				if(typeof item === 'object') {
					value = item.value
					tag   = item.tag
				} else {
					value = item;
					tag   = item;
				}
				listHTML += '<li class="'+_self.classes.listItem.substring(1)+'" data-val="'+value+'">'+tag+'</li>';
			});
			if(_self.settings.noSuggestionMsg) {
				listHTML += '<li class="'+_self.classes.noSuggestion.substring(1)+'">'+_self.settings.noSuggestionMsg+'</li>';
			}
			return listHTML;
		},

		addTag : function(value, animate=true) {
			if(!value) {
                return;
			}
			// Trim value
			if (typeof value === "string" && this.settings.trimValue) {
				value = $.trim(value);
			}
			
			// lowercase and dash
			if (typeof value === "string" && this.settings.lowercase && this.settings.dashspaces) {
				value = value.replace(/\s+/g, '-').toLowerCase();
			}
			else if (typeof value === "string" && this.settings.lowercase){
				value = value.toLowerCase();
			}
			else if (typeof value === "string" && this.settings.dashspaces){
				value = value.replace(/\s+/g, '-');
			}

			var html = '<span class="'+this.classes.tagItem.substring(1)+'" data-val="'+value+'">'+this.getTag(value)+' '+this.setIcon()+'</span>';
			$item    = $(html).insertBefore($(this.selectors.sTagsInput));
			if(this.settings.defaultTagClass) {
				$item.addClass(this.settings.defaultTagClass);
			}
			if(this.settings.tagLimit != -1 && this.settings.tagLimit > 0 && this.tagNames.length >= this.settings.tagLimit) {
				this.animateRemove($item, animate);
				if(animate) {
					this.flashItem(value);
				}
				return false;
			}
			var itemKey = this.getItemKey(value);
			if(this.settings.whiteList && itemKey === -1) {
				this.animateRemove($item, animate);
				if(animate) {
					this.flashItem(value, itemKey);
				}
				return false;
			}
			if(this.isPresent(value)) {
				this.animateRemove($item, animate);
				if(animate) {
					this.flashItem(value, itemKey);
				}
			} else {
				this.customStylings($item, itemKey);
				var dataVal = value;
				if($.isNumeric(dataVal)) {
					dataVal = (value.toString().indexOf('.') == -1)? parseInt(dataVal): parseFloat(dataVal);
				}
				this.tagNames.push(dataVal);
				this.setRemoveEvent();
				this.setInputValue();
				if(this.settings.afterAdd && typeof this.settings.afterAdd == "function") {
					this.settings.afterAdd(value);
				}
			}
			$(this.selector).trigger('suggestags.add', [value]);
			$(this.selector).trigger('suggestags.change');
			if(this.settings.triggerChange) {
				$(this.selector).trigger('change');
			}
			$(this.selectors.listArea).find(this.classes.listItem).removeClass('active');
			$(this.selectors.listArea).hide();
			$(this.selectors.sTagsInput).removeClass(this.classes.readyToRemove.substring(1));
			this.checkPlusAfter();
		},

		getItemKey : function(value) {
			var itemKey = -1
			var _self = this;
			if(this.settings.suggestions.length) {
				var lower = value.toString().toLowerCase();
				$.each(this.settings.suggestions, function(key, item){
					if(typeof item === 'object') {
						if(item.value.toString().toLowerCase() == lower) {
							itemKey = key;
							if(item.class !== undefined && _self.settings.classes[key] === undefined) {
								_self.settings.classes[key] = item.class;
							}
							if(item.background !== undefined && _self.settings.backgrounds[key] === undefined) {
								_self.settings.backgrounds[key] = item.background;
							}
							if(item.color !== undefined && _self.settings.colors[key] === undefined) {
								_self.settings.colors[key] = item.color;
							}
							return false;
						}  
					} else if(item.toString().toLowerCase() == lower) {
						itemKey = key;
						return false;
					}
				});
			}
			return itemKey;
		},

		isPresent : function(value) {
			var present = false;
			$.each(this.tagNames, function(index, tag){
				if(value.toString().toLowerCase() == tag.toString().toLowerCase()) {
					present = true;
					return false;
				}
			});
			return present;
		},

		customStylings : function(item, key) {
			var isCustom = false;
			if(this.settings.classes[key]) {
				isCustom = true;
				$(item).addClass(this.settings.classes[key]);
			}
			if(this.settings.backgrounds[key]) {
				isCustom = true;
				$(item).css('background', this.settings.backgrounds[key]);
			}
			if(this.settings.colors[key]) {
				isCustom = true;
				$(item).css('color', this.settings.colors[key]);
			}
			if(!isCustom) {
                $(item).addClass(this.classes.colBg.substring(1));
            }
		},

		removeTag: function(value, animate=true) {
			var _self = this;
			$findTags = $(this.selectors.inputArea).find('[data-val="'+value+'"]');
			if($findTags.length) {
				$findTags.each(function(){
					_self.removeTagByItem(this, animate);
				});
			}
		},

		removeTagByItem : function(item, animate) {
			this.tagNames.splice($(item).index(), 1);
			this.animateRemove(item, animate);
			this.setInputValue();
			$(this.selector).trigger('suggestags.remove', [$(item).attr('data-val')]);
			$(this.selector).trigger('suggestags.change');
			if(this.settings.triggerChange) {
				$(this.selector).trigger('change');
			}
			if(this.settings.afterRemove && typeof this.settings.afterRemove == "function") {
				this.settings.afterRemove($(item).attr('data-val'));
			}
			$(this.selectors.sTagsInput).removeClass(this.classes.readyToRemove.substring(1));
			this.checkPlusAfter();
		},

		animateRemove : function(item, animate) {
			$(item).addClass('disabled');
			if(animate) {
				setTimeout(function(){
					$(item).slideUp();
					setTimeout(function(){
						$(item).remove();
					}, 500);
				}, 500);
			} else {
				$(item).remove();
			}
		},

		flashItem : function(value, itemKey) {
			$tagItem = '';
			value 	 = value.toString().toLowerCase();
			$(this.selectors.sTagsArea).find(this.classes.tagItem).each(function(){
				var tagName = $.trim($(this).attr('data-val'));
				if(value == tagName.toString().toLowerCase()) {
					$tagItem = $(this);
					return false;
				}
			});
			if($tagItem) {
				background = (this.settings.backgrounds[itemKey] !== undefined)? this.settings.backgrounds[itemKey]: null;
				if(background !== null) {
					$tagItem.css('background', ''); 
				}
				$tagItem.addClass('flash');
				setTimeout(function(){
					$tagItem.removeClass('flash');
					if(background !== null) {
						$tagItem.css('background', background);
					}
				}, 1500, $tagItem);
			}
		},

		setIcon : function() {
			var removeClass = this.classes.removeTag.substring(1);
			if(this.settings.type == 'bootstrap') {
				return '<span class="fa fa-times '+removeClass+'"></span>';
			} else if(this.settings.type == 'materialize') {
				return '<i class="material-icons right '+removeClass+'">clear</i>';
			} else {
				return '<b class="'+removeClass+'">&#10006;</b>';
			}
		},

		setInputValue: function() {
			this.updateIsRequired();
			$(this.selector).val(this.tagNames.join(','));
			if(this.settings.printValues) {
				this.printValues();
			}
		},

		fixCSS : function() {
			if(this.settings.type == 'amsify') {
				$(this.selectors.inputArea).addClass(this.classes.inputAreaDef.substring(1)).css({'padding': '5px 5px'});
			} else if(this.settings.type == 'materialize') {
				$(this.selectors.inputArea).addClass(this.classes.inputAreaDef.substring(1)).css({'height': 'auto', 'padding': '5px 5px'});
				$(this.selectors.sTagsInput).css({'margin': '0', 'height': 'auto'});
			}
		},

		printValues : function() {
			console.info(this.tagNames, $(this.selector).val());
		},

		checkMethod : function() {
			$findTags = $(this.selector).next(this.classes.sTagsArea);
			if($findTags.length) {
				$findTags.remove();
			}
			$(this.selector).show();
			if(typeof this.method !== undefined && this.method == 'destroy') {
				return false;
			} else {
				return true;
			}
		},

		refresh : function() {
			this._setMethod('refresh');
			this._init();
		},

		destroy : function() {
			this._setMethod('destroy');
			this._init();
		},

		getActionURL : function(urlString) {
			var URL = '';
			if(window !== undefined) {
				URL = window.location.protocol+'//'+window.location.host;
			}
			if(this.isAbsoluteURL(urlString)) {
				URL = urlString;
			} else {
				URL += '/'+urlString.replace(/^\/|\/$/g, '');
			}
			return URL;
		},

		isAbsoluteURL : function(urlString) {
			var regexURL = new RegExp('^(?:[a-z]+:)?//', 'i');
			return (regexURL.test(urlString))? true: false;
		},

		unique: function(list) {
			var result = [];
			var _self  = this;
			$.each(list, function(i, e) {
				if(typeof e === 'object') {
					if(!_self.objectInArray(e, result)) {
						result.push(e);
					}
				} else {
					if($.inArray(e, result) == -1) {
						result.push(e);
					}
				}
			});
			return result;
		},

		objectInArray : function(element, result) {
			if(result.length) {
				var present = false;
				$.each(result, function(i, e) {
					if(typeof e === 'object') {
						if(e.value == element.value) {
							present = true;
							return false;
						}
					} else {
						if(e == element.value) {
							present = true;
							return false;
						}
					}
				});
				return present;
			} else {
				return false;
			}
		},

		isSimilarText: function(str1, str2, perc) {
			if(!this.settings.checkSimilar) {
				return false;
			}
			var percent = this.similarity(str1, str2);
			return (percent*100 >= perc)? true: false;
		},

		similarity: function(s1, s2) {
			var longer = s1;
			var shorter = s2;
			if(s1.length < s2.length) {
				longer = s2;
				shorter = s1;
			}
			var longerLength = longer.length;
			if(longerLength == 0) {
				return 1.0;
			}
			return (longerLength - this.editDistance(longer, shorter))/parseFloat(longerLength);
		},

		editDistance: function(s1, s2) {
			s1 = s1.toLowerCase();
			s2 = s2.toLowerCase();
			var costs = new Array();
			for(var i = 0; i <= s1.length; i++) {
				var lastValue = i;
				for(var j = 0; j <= s2.length; j++) {
					if(i == 0) {
						costs[j] = j;
					} else {
						if(j > 0) {
							var newValue = costs[j-1];
							if(s1.charAt(i-1) != s2.charAt(j-1)) {
								newValue = Math.min(Math.min(newValue, lastValue), costs[j]) + 1;
							}
							costs[j-1] = lastValue;
							lastValue  = newValue;
						}
					}
				}
				if(i > 0)
					costs[s2.length] = lastValue;
			}
			return costs[s2.length];
		},

		checkPlusAfter : function(fromBlur) {
			if(this.settings.showPlusAfter > 0) {
				if(this.tagNames.length > this.settings.showPlusAfter) {
					var _self 	   = this;
					var plusNumber = this.tagNames.length - this.settings.showPlusAfter;
					if(!this.selectors.plusTag) {
						var html  = '<span class="'+this.classes.plusItem.substring(1)+'"></span>';
						this.selectors.plusTag 	= $(html).appendTo(this.selectors.inputArea);
						$(this.selectors.plusTag).addClass(this.classes.showPlusBg.substring(1));
						/**
						 * Show input after focus on input area
						 */
						$(this.selectors.inputArea).click(function(){
							$(_self.selectors.sTagsInput).show();
						});
					}
					$(this.selectors.plusTag).text('+ '+plusNumber);
					$tagItems = $(this.selectors.inputArea).find(this.classes.tagItem);
					$tagItems.show();
					if($(this.selectors.inputArea).hasClass(this.classes.focus.substring(1))){
						$(this.selectors.plusTag).hide();
					} else {
						if(fromBlur && !this.blurTgItems) {
							this.blurTgItems = $tagItems;
							setTimeout(function(){
								if(_self.blurTgItems) {
									_self.blurTgItems.slice(_self.settings.showPlusAfter).hide();
								}
							}, 200);
						} else {
							this.blurTgItems = null;
							$tagItems.slice(this.settings.showPlusAfter).hide();
						}
						$(this.selectors.sTagsInput).hide();
						$(this.selectors.plusTag).show();
					}
				} else if(this.selectors.plusTag) {
					$(this.selectors.inputArea).find(this.classes.tagItem).show();
					$(this.selectors.plusTag).hide();
				}
			}
		}
	};

	$.fn.amsifySuggestags = function(options, method) {
		return this.each(function() {
			var amsifySuggestags = new AmsifySuggestags(this);
			amsifySuggestags._settings(options);
			amsifySuggestags._setMethod(method);
			amsifySuggestags._init();
		});
	};
}));	
	
 $('input[id="specialization"]').amsifySuggestags();

	
</script>
<style>


.amsify-suggestags-area
.amsify-suggestags-input-area {
	text-align: left;
	height: auto;
}

.amsify-suggestags-area
.amsify-suggestags-input-area:hover {
	cursor: text;
}

.amsify-suggestags-area
.amsify-suggestags-input-area
.amsify-suggestags-input {
	max-width: 200px;
	padding: 0px 4px;
	border: 0;
}

.amsify-suggestags-area
.amsify-suggestags-input-area
.amsify-suggestags-input:focus {
	outline: 0;
}
span.amsify-select-tag {
    background: #e0e0e0;
    padding: 4px 8px;
    display: inline-block;
    border-radius: 5px;
    margin-right: 5px;
}
span.amsify-select-tag .amsify-remove-tag {
    font-size: 12px;
    margin-left: 3px;
    cursor: pointer;
}

</style>
@stop


