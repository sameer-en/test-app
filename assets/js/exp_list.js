//exp_list.js


var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": SITE_URL + "exp/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.catid = $('#catid').val();
                data.userid = $('#userid').val();
                data.amount = $('#amount').val();
                data.expdate = $('#expdate').val();
                data.expdate_to = $('#expdate_to').val();
                data.exptype = $('#exptype').val();
                // data.address = $('#address').val();
            } ,
             "dataSrc": function ( json ) {
                //Make your callback here.
                $('#lbl_total').text("Total Amount: "+json.totalamount);
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
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false }
              ]


    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload(null,false);  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null,false);  //just reload table
    });

    $( "#expdate,#expdate_to" ).datepicker({
        dateFormat :'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

// table.on( 'draw', function () {
//     alert( 'Table redrawn' );
// } );



});

function samu(dat)
{
    alert('213')
}
