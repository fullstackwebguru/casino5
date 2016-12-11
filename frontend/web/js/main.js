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

$("li.top-banner").mouseenter(function(){
    $(this).css("background-color", "#000");
    $(this).find("p.i-text-1").css("color", "#fff");
    $(this).find("img.icon1-b").removeClass("invert-normal");
    $(this).find("img.icon1-b").addClass("inverted");
});

$("li.top-banner").mouseleave(function(){
    $(this).find("img.icon1-b").removeClass("inverted");
    $(this).find("img.icon1-b").addClass("invert-normal");
    $(this).css("background-color", "#fff");
    $(this).find("p.i-text-1").css("color", "#000");
});

