$( document ).ready(function() {
 	$(".btn").on("click",function(){
 		if(!$(this).hasClass("logout")){
 			r = confirm("Please verify the data that you are about to submit. Click on OK if the data looks correct.");
 			return r;
 		}
 	});
});