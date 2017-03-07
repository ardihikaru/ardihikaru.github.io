

function getSchedule(act, day){

    //console.log(act);
    $('#my_schedule tbody > tr').remove();

    var postForm = { //Fetch form data
        'act' 	    : act,
        'day' 	    : day
    };

    $.ajax({
        url     : "scripts/api/get.schedules.php",
        type    : "post",
        data    : postForm,
        dataType: "json"
    }).done(function(result){
        console.log(result);

        if (result.success){
            //console.log('success! size: '+ result.data.length);
            for(var i = 0; i < result.data.length; i++){
                $('#my_schedule > tbody:last-child').append('' +
                    '<tr>' +
                    '<td>'+result.data[i].current_day+'</td>' +
                    '<td>'+result.data[i].time_of_teaching+'</td>' +
                    '<td>'+result.data[i].taught_course+' <br/> <b class="cyan darken-4 white-text">'+result.data[i].time_starts+' - '+result.data[i].time_ends+'</b> </td>' +
                    '<td>'+result.data[i].taught_class+' ('+result.data[i].type_of_class+')</td>' +
                    '<td>'+result.data[i].class_location+' ('+result.data[i].class_code+')</td>' +
                    '<td>'+result.data[i].lecturer+'</td>' +
                    '</tr>');
            }

        }else{
            //console.log('failed!');

            $('#my_schedule > tbody:last-child').append('' +
                '<tr>' +
                '<td colspan="6" class="center">Tidak ada Jam mengajar </td>' +
                '</tr>');
        }
    });

}


// A $( document ).ready() block.
$( document ).ready(function() {
    //console.log( "ready!" );

    //$('.carousel.carousel-slider').carousel({fullWidth: true});

    $('.scrollspy').scrollSpy();

    $(".dropdown-button").dropdown();

    // default schedules
    getSchedule("-", "today");

    //$('#my_schedule tbody > tr').remove();
    //$('#my_schedule > tbody:last-child').append('<tr><td>row content</td><td>row content</td><td>row content</td><td>row content</td><td>row content</td><td>row content</td></tr>');
    //$("#my_schedule > tbody").append("<tr><td>row content</td></tr>");


});
