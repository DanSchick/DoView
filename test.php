<?php
include "top.php";
?>

<input type='text' value='' placeholder='Search' id='keyword'>
<div id="results"> </div>


<script>
// var MIN_LENGTH = 3;
// $( document ).ready(function() {
//     $("#keyword").keyup(function() {
//         var keyword = $("#keyword").val();
//         if (keyword.length >= MIN_LENGTH) {
//             $.get( "search.php", { keyword: keyword } )
//               .done(function( data ) {
//                 console.log(data);
//               });
//         }
//     });

// });


var MIN_LENGTH = 3;

$( document ).ready(function() {
    $("#keyword").keyup(function() {
        var keyword = $("#keyword").val();
        var id;
        keyword = keyword.replace(/ /g,"_");
        console.log(keyword);
        if (keyword.length >= MIN_LENGTH) {
            $.get( "search.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                $(results).each(function(key, value) {
                    id = value.split(" ");
                    id = id[0];
                    console.log(id);
                    $('#results').append('<div class="item" id="' + id + '">' + value + '</div>');
                })

                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword').val(text);
                })

            });
        } else {
            $('#results').html('');
        }
    });

    $("#keyword").blur(function(){
            $("#results").fadeOut(500);
        })
        .focus(function() {
            $("#results").show();
        });

});

</script>


<style>
#keyword {
    width: 200px;
    font-size: 1em;
}

#results {
    width: 204px;
    position: absolute;
    border: 1px solid #c0c0c0;
}

#results .item {
    padding: 3px;
    font-family: Helvetica;
    border-bottom: 1px solid #c0c0c0;
}

#results .item:last-child {
    border-bottom: 0px;
}

#results .item:hover {
    background-color: #f2f2f2;
    cursor: pointer;
}
</style>
