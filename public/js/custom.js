
$(document).ready(function() {
	// $('.additional-info').hide();
	$( ".datepicker" ).datetimepicker({
										format: 'YYYY-MM-DD',
							            viewMode: 'years',
									});

	// $('#check-btn').click(function(){
	// 	var email = $('input[name="email"]').val();
	// 	if (email != '') {

	// 		$('#check-btn').text('');
	// 		$('#check-btn').attr('disabled',true);
	// 		$('#check-btn').html('<span><img src="img/30.gif" width="50%"></span>');


	// 		$.ajax(
	//               {
	//                 url: base_url + '/check/' + email,
	//                 type:'GET',
	//                 dataType : "json",
	//                 success:function(data)
	//                 {
	//                 	$('.additional-info').slideDown();
	//                 	$('#check-btn').text('');
	// 					$('#check-btn').attr('disabled',false);
	// 					$('#check-btn').html('CHECK');
	//                 	if (data.length != 0) {
	// 	                	$.each(data, function(index, item) {
	// 	                		$('input[name="name"]').val(item.name);
	// 	                		$('input[name="phone"]').val(item.phone);
	// 	                		$('input[name="posisi"]').val(item.posisi);
	// 	                		$('input[name="existed_id"]').val(item.id);

	// 	                		$('select[name="dept"] option[value="'+item.dept+'"]').attr('selected','selected');
	// 	                		$('select[name="rayon"] option[value="'+item.rayon+'"]').attr('selected','selected');
	// 	                	});
	//                 	}
	//                 },
	//                 error:function(xhr,status,error)
	//                 {
	//                     alert("Please try again later.");
	//                     // location.reload();
	//                 }
	//               });
	// 	} else {
	// 		alert('Please fill the Name & Email fields.');
	// 	}
	// });

	// $("#register-form").submit(function(e) {
	//     // var isValid = $(e.target).parents('form').isValid();
	//     // e.preventDefault();
	//     var dept = $('select[name="dept"]').val();
	//     var rayon = $('select[name="rayon"]').val();
	//     if (dept == "" || dept == null || rayon == "" || rayon == null) {
	//     	alert('Please fill in the Dept/Rayon fields.');
	//     	return false;
	//     }

	//     return true;

	//     // if (!isValid) {
	//     // 	console.log('asdf');
	//     // 	e.preventDefault(); //prevent the default action
 //    	// }
	// });

	$(".date").on("change", function() {
	    this.setAttribute(
	        "data-date",
	        moment(this.value, "YYYY-MM-DD")
	        .format( this.getAttribute("data-date-format") )
	    )
	}).trigger("change")

	$(document).on("keydown", "form", function(event) { 
	    return event.key != "Enter";
	});
});