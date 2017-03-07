//common js 

$(document).ready(function() {

    $("#delModal").on('hidden.bs.modal', function () {
            $('#delid').val(0);
            $('#delurl').val('');
    });

});

function confirm_delete(id,url)
{
    $('#delid').val(id);
    $('#delurl').val(url);

    $('#delModal').modal();
}

function delete_record()
{
    $('#delModal').modal("hide");

    var id = $.trim($('#delid').val());
    var url = $.trim($('#delurl').val());
   
    if(id > 0 && url!='')
    {
        $.ajax({
            'url' :SITE_URL + url,
            'method' :'POST',
            'data':{'id':id},
          	'dataType': "json",
            'success' : function(response){
                    if(response.status == 'ok')
                    {
                        alert("Record deleted successfully!");
                        table.ajax.reload(null,false);  //just reload table

                        $('#delModal').modal("hide");
                    }
                    else
                    {
                        alert(response.message);
                        $('#delModal').modal("hide");
                    }
            },
            'error': function(){
                alert("error in deleting record!");
                $('#delModal').modal("hide");
            }
        });
    }
    else
    {
        alert("error");
        $('#delModal').modal("hide");

    }
}