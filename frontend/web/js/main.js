/******** header date ******/  
/*
var d = (new Date()).toString().split(' ').splice(1,3).join(' ');
    document.getElementById("date").innerHTML = d;


*/


$(document).ready(function(){

        
    $('a.read-more').click(function() {
        $('p.lazy').toggle(500);

    });
  
    $('a.more-btn').click(function() {
        $('#lazy-wrapp').show(500);
        $('a.more-btn').hide(500);
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