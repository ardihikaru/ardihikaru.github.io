// A $( document ).ready() block.
$( document ).ready(function() {
    //console.log( "ready!" );

    $('.scrollspy').scrollSpy();

    $(".dropdown-button").dropdown();

    //$("#contents").load("contents/home.html");
    $("#main-content").load("contents/home.html");
    $("#footer").load("includes/footer.html");

    /*
    // source: http://stackoverflow.com/questions/35980949/how-can-i-make-the-submenu-in-the-materializecss-dropdown
    $('.dropdown-button2').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            gutter: ($('.dropdown-content').width()*3)/2.5 + 5, // Spacing from edge
            belowOrigin: false, // Displays dropdown below the button
            alignment: 'left' // Displays dropdown with edge aligned to the left of button
        }
    );
    */

});