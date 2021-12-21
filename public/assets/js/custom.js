
$(document).ready(function () { 
	function updateScroll() {
		if ($(window).scrollTop() >= 80) {
			$(".navbar").addClass('sticky');
		} else {
			$(".navbar").removeClass("sticky");
		}
	}
	
	
	$(function () {
		$(window).scroll(updateScroll);
		updateScroll();
	});
	});
 
 
 // menu icon changes
$(document).ready(function () {
	$(".navbar-toggler").click(function () {
		$(this).toggleClass("i-change");
	});
});



$(document).ready(function() {

    
  var readURL = function(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('.profile-pic').attr('src', e.target.result);
          }
  
          reader.readAsDataURL(input.files[0]);
      }
  }
  

  $(".file-upload").on('change', function(){
      readURL(this);
  });
  
  $(".upload-button").on('click', function() {
     $(".file-upload").click();
  });

  
});


$(".addmore").click(function(){
    $(".addoffers").toggle();
    
  });

