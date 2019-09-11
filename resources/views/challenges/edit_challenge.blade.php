 @section('stylesheets')
 <!-- Datatables Js-->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
 @stop

 @extends('layouts.app')

 @section('content')
     <h1>{{$challenge->name}}</h1>

     <!-- search box container starts  -->
     <div class="search">
         <div class="row">
             <div class="col-lg-10 col-lg-offset-1">
                 <table id="table" class="table table-bordered">
                     <thead>
                     <tr>
                         <th>#</th>
                         <th>Title</th>
                         <th>Created At</th>
                     </tr>
                     </thead>
                     <tbody id="tablecontents">
                     @foreach($steps as $step)
                         <tr class="row1" data-id="{{ $step->step_number }}">
                             <td>
                                 <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                                     <i class="fa fa-ellipsis-v"></i>
                                     <i class="fa fa-ellipsis-v"></i>
                                 </div>
                             </td>
                             <td>{{ $step->name }}</td>
                             <td>{{ date('d-m-Y h:m:s',strtotime($step->created_at)) }}</td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <hr>
         <h5>Drag and Drop the table rows and <button class="btn btn-default" onclick="window.location.reload()"><b>REFRESH</b></button> the page to check the Demo. For the complete tutorial of how to make this demo app visit the following <a href="#">Link</a>.</h5>
     </div>


 @stop

 @section('scripts')

     <!-- jQuery UI -->
     <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

     <!-- Datatables Js-->
     <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

     <script type="text/javascript">
         $(function () {
             $("#table").DataTable();

             $( "#tablecontents" ).sortable({
                 items: "tr",
                 cursor: 'move',
                 opacity: 0.6,
                 update: function() {
                     //sendOrderToServer();
                 }
             });

             function sendOrderToServer() {

                 var order = [];
                 $('tr.row1').each(function(index,element) {
                     order.push({
                         id: $(this).attr('data-id'),
                         position: index+1
                     });
                 });

                 $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "{{ url('demos/sortabledatatable') }}",
                     data: {
                         order:order,
                         _token: '{{csrf_token()}}'
                     },
                     success: function(response) {
                         if (response.status == "success") {
                             console.log(response);
                         } else {
                             console.log(response);
                         }
                     }
                 });

             }
         });

     </script>

 @stop