$(document).ready(function() {
  //Datapicker
  // $('.calendar-pigb input').datepicker({
  //   format: "dd/mm/yyyy"
  // });

  //Mask
  // $('.money').mask('000.000.000.000.000,00', {reverse: true});
  // $('.money').mask('000000000000000.00', {reverse: true});
  
  //Bootbox
  confirmDelete = function(data) {

  	var actionUrl = data.getAttribute("data-url");

  	bootbox.dialog({
  		title: "Deseja excluir este registro?",
  		message: '<form class="form-horizontal" method="POST" action="'+ actionUrl +'">' +
      				 '<input type="hidden" name="_METHOD" value="DELETE"/>' +
      				 '<div class="form-group">' +
      				 	'<div class="col-sm-offset-9 col-sm-3">' +
    		  				'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>' +
    		  				'<button type="submit" class="btn btn-primary ml5">Ok</button>' +
      				 	'</div>' +
      				 '</div>' +
      				 '</form>'
  	});

  }
  
  //Button toggle yes or no
  $('.btn-toggle').click(function() {

    $(this).find('.btn').toggleClass('active');

  });
});