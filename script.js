$(document).ready(function(){

 var dataTable = $('#personal').DataTable({
  "language": {
  "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
  },
  "processing" : true,
  "serverSide" : true,
  "order" : [],
  "ajax" : {
   url:"datos.php",
   type:"POST"
  }
 });


  
}); 