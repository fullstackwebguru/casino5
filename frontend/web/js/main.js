/******** header date ******/  
/*
var d = (new Date()).toString().split(' ').splice(1,3).join(' ');
    document.getElementById("date").innerHTML = d;


*/


$(document).ready(function(){

    $('a.goto_section_bottom').click(function(e) {
        var destination = $("#wwd").offset().top;
        $('html, body').animate({scrollTop: destination}, 800);

    });

        
    $('a.read-more').click(function() {
        $('p.lazy').toggle(500);

    });
  
    $(document).on('click', 'a.more-btn', function() {
        var startPos = $(this).attr('data-pos');

        var that = $(this);

        $.ajax( {
            type: "GET",
            url : "casino/generate?startPos="+startPos,
            success : function (data) {
                $("#all-casino-container").append(data);
                $('.lazy-wrapp').show(500);
                that.hide(500).removeClass("more-btn");
            },
            dataType: 'html'
        });
    });

    $("p.plus").click(function(){
        $("tr.hide-0").toggleClass("visible");
    });

    $("p.plus-1").click(function(){
        $("tr.hide-1").toggleClass("visible");
    });

    $("p.plus-2").click(function(){
        $("tr.hide-2").toggleClass("visible");
    });
    
    $("p.plus-3").click(function(){
        $("tr.hide-3").toggleClass("visible");
    });

    $("p.plus-4").click(function(){
        $("tr.hide-4").toggleClass("visible");
    });

    $("p.plus-5").click(function(){
        $("tr.hide-5").toggleClass("visible");
    });

    $("p.plus-6").click(function(){
        $("tr.hide-6").toggleClass("visible");
    });

    $("p.plus-7").click(function(){
        $("tr.hide-7").toggleClass("visible");
    });

    $("p.plus-8").click(function(){
        $("tr.hide-8").toggleClass("visible");
    });

    $("p.plus-9").click(function(){
        $("tr.hide-9").toggleClass("visible");
    });





    $('body').append('<div id="toTop" class="btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span></div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        }); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });   
 
});