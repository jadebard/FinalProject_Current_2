/**
 * Created by Taylor on 4/10/2017.
 */


function stopSearch() {

    if (top.location.pathname === '/I211/FinalProject_Current_2/index.php') {

        $("body").css({'background-color': 'black'});

        $("footer").css({'position': 'fixed'});

    }

  if (top.location.pathname === '/I211/FinalProject_Current_2/index') {

      $("footer").css({'position': 'fixed'});
  }

    if (top.location.pathname === '/I211/FinalProject_Current_2/') {

        $("footer").css({'position': 'fixed'});
    }


    if (top.location.pathname === '/I211/FinalProject_Current_2/about') {
    $("footer").css({'position': 'fixed'});
        }

}




    function setBindings () {

        var btnID;
        $("i").click(function () {

            btnID = this.id;
            console.log(btnID);

            if (btnID == "login") {

                $(".loginModal").css("visibility", "visible");
            }

            TweenLite.set($(".loginForm"), {
                alpha: 0, rotationX: 90
            });

            TweenLite.to($(".loginForm"), 0.5, {

                alpha: 1, rotationX: 0

            });

        });

        $(".suClose").click(function () {
            $(".loginModal").css("visibility", "hidden");

        });

        $(".bg").click(function () {
            $(".loginModal").css("visibility", "hidden");

        });

    }

$(window).scroll(
    {

        topOfCallout: $("#homeSection")


    },

    function () {
        var winMiddle = ($(window).height());
        var currentTop = $(window).scrollTop();
        myVar = true;


        //if (currentTop >= $("#aboutSection").offset().top)
        if (currentTop >= 1) {


            $("#searchbar").css({'margin-top': '4px', 'margin-left': '60px', 'position': 'fixed', 'z-index': '100', '-ms-transform': 'scale(0.5, 0.5)', '-webkit-transform': 'scale(0.5, 0.5)', 'transform': 'scale(0.5, 0.5)', 'transition': '0.5s'});
            $("#suggestionDiv").css({'font-size': '30px'});
            console.log("firing");




        }

        else {

            $("#searchbar").css({'margin-top': '140px', 'position': 'absolute', '-ms-transform': 'scale(1, 1)', '-webkit-transform': 'scale(1, 1)', 'transform': 'scale(1, 1)'});
            $("#suggestionDiv").css({'font-size': '15px'});




        }

    });





$(document).ready(function(){

    stopSearch();

    setBindings();





});





