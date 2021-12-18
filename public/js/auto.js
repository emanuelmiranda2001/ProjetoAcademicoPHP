$(document).ready(function() {
    $( "#name" ).autocomplete({

        source: function(request, response) {
            $.ajax({
            url: siteUrl + '/' +"autocomplete",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    return obj.title;
               }); 

               response(resp);
            }
        });
    },
    minLength: 2
 });
});