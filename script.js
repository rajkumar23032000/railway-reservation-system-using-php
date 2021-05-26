/*function bookedSuccess() {
    document.getElementById("booked-success").style.display = "block";
}

function cancelledSuccess() {
    document.getElementById("cancelled-success").style.display = "block";
}*/


$(document).ready(function () {
    $(".cont1-h5").hide();
    $(".cont1-h4").hide();
    $("#booked-success").hide();
    $("#cancelled-success").hide();


    $(".cont1-h5").fadeIn(2000);
    $(".cont1-h4").fadeIn(2000);

    $(".cont1-h1").hover(function () {
        $(this).slideUp(2000).slideDown(1000);
    })

    $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".row .col .booked-journeys-card").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#book-seats-btn").click(function () {
        $("#booked-success").show();
    })

    $("#cancel-tickets-btn").click(function () {
        $("#cancelled-success").show();
    })

});