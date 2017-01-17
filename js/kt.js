$(document).ready(function() {

        $('.multicol').show().find('tr').each(function (i,item){           
          var $row = $(item); 
             $row.hide()
             
           $row.delay(i*50).fadeIn(50);  
          
    });  


});