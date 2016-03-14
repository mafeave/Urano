

$.ajax({
	
   type: 'POST',
   url: './include/process.php',
   
   success: function(data){
	   $('#mynew').append(data);
       $('#mynew').addClass('animated zoomIn').fadeIn();
       setTimeout(function(){$('#mynew').removeClass('animated zoomIn');},1500);
   //----------------------------------------------------------------------------
         
         /////////////////prueba
          var tede2 = 'ma00011';
          var tede4 = 'ma00013';
          var tede5 = 'ma00015';
          var tasker2 = 'matem';
          var color2 = 'green-label';
          $('#'+tede2).text(tasker2).addClass(color2).show();
          $('#'+tede4).text(tasker2).addClass(color2).show();
          $('#'+tede5).text(tasker2).addClass(color2).show();

          var tede3 = 'ma00012'
          var tasker3 = 'ciencias';
          var color3 = 'blue-label';
          $('#'+tede3).text(tasker3).addClass(color3).show();

          ///////////////////////////////////////7


   //----------------------------------------------------------------------------
   }

});