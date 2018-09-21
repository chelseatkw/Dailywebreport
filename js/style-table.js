$(document).ready(function () {
			   
	$('tbody tr').hover(function() {
	  $(this).addClass('odd');
	}, function() {
	  $(this).removeClass('odd');
	});

    $('#checkAllDiv').append('(' + $('#t_detail >tbody >tr').length + ')');
    $('#checkItemDiv_billy').append("(" + $(".billy").length + ") ");
    $('#checkItemDiv_chelsea').append("(" + $(".chelsea").length + ") ");
    $('#checkItemDiv_passino').append("(" + $(".passino").length + ") ");
    $('#checkItemDiv_penny').append("(" + $(".penny").length + ") ");
    $('#checkItemDiv_polly').append("(" + $(".polly").length + ") ");
    $('#checkItemDiv_william').append("(" + $(".william").length + ") ");
    /*
    $('#checkAll').siblings("label")[1].append("(" + $(".billy").length + ") ");
    $('#checkAll').siblings("label")[2].append("(" + $(".chelsea").length + ") ");
    $('#checkAll').siblings("label")[3].append("(" + $(".Passino").length + ") ");
    $('#checkAll').siblings("label")[4].append("(" + $(".penny").length + ") ");
    $('#checkAll').siblings("label")[5].append("(" + $(".polly").length + ") ");
	$('#checkAll').siblings("label")[6].append("(" + $(".william").length + ")");*/

	 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
     if(this.checked) {
        $("#t_detail >tbody >tr").show();
     }
     else {
     	$("#t_detail >tbody >tr").hide();
     }
 });
	 $('#checkItem_william').click(function() {
	 	if(this.checked) {
	 		$('.william').show();
	 	}
	 	else {
	 		$('.william').hide();
	 	}
	 });
	 $('#checkItem_polly').click(function() {
	 	if(this.checked) {
	 		$('.polly').show();
	 	}
	 	else {
	 		$('.polly').hide();
	 	}
	 }); 
	 $('#checkItem_penny').click(function() {
	 	if(this.checked) {
	 		$('.penny').show();
	 	}
	 	else {
	 		$('.penny').hide();
	 	}
	 });
	 $('#checkItem_passino').click(function() {
	 	if(this.checked) {
	 		$('.passino').show();
	 	}
	 	else {
	 		$('.passino').hide();
	 	}
	 });
	 $('#checkItem_chelsea').click(function() {
	 	if(this.checked) {
	 		$('.chelsea').show();
	 	}
	 	else {
	 		$('.chelsea').hide();
	 	}
	 });
	 $('#checkItem_billy').click(function() {
	 	if(this.checked) {
	 		$('.billy').show();
	 	}
	 	else {
	 		$('.billy').hide();
	 	}
	 });
})