//exp_list.js


var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "bFilter": false,
       // "bInfo": false,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": SITE_URL + "main/ajax_notifications",
            "type": "POST",
            "data": function ( data ) {
                data.to_user_id = $('#to_user_id').val();
                data.from_user_id = $('#from_user_id').val();
                data.category = $('#category').val();
                data.added_date = $('#added_date').val();
                data.added_date_to = $('#added_date_to').val();
                data.noti_type = $('#noti_type').val();
                data.message = $('#message').val();
            } ,
             "dataSrc": function ( json ) {
                //Make your callback here.
//               $('#lbl_total').text("Total Amount: "+json.currentstart);
                return json.data;
            }    

            // "success":function(data){
            //     samu(data);
            //     }
        },
        /* "fnDrawCallback": function (oSettings,data) {
            alert( data) ;
            },*/

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        "order": [[ 4, "desc" ]],
        "aoColumns": [
              { "bSortable": false },
              null,
              null,
              null,
              null,
              null,
              { "bSortable": false },
              { "bSortable": false }
              ],
        "lengthMenu": [ [5,10, 25, 50, -1], [5,10, 25, 50, "All"] ]


    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null,false);  //just reload table
    });

    $( "#added_date,#added_date_to" ).datepicker({
        dateFormat :'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

// table.on( 'draw', function () {
//     alert( 'Table redrawn' );
// } );

//$('.dataTables_length').hide();

});

