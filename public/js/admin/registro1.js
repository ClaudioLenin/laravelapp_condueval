$(document).ready(function () {

  $(document).on("click","#todo",function(e){
    $('#container1x tr td input[type=checkbox]').attr("checked",true);
  });
  $(document).on("click","#todo2",function(e){
    $('#container2x tr td input[type=checkbox]').attr("checked",true);
  });
  
});
