function setMenuActive(quel){
	   
   $(".menu-entry").removeClass("active");
   $("#menu"+quel).addClass("active");
   
}

/***************************************************
	  SELECT MENU ON SMALL DEVICES
***************************************************/
$(function() {
			var pull 		= $('#pull');
				menu 		= $('#primary-menu ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 479 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
				if(w > 719 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});

$(document).ready(function() {
        $("#btn").toggle(
			function () { 
			$(".profile").animate({right:'0px'},600);
			},
			function () { 
			$(".profile").animate({right:'-350px'},600); 
			}
		);

        $("#cerrar").on('click', function () { 
            $(".profile").animate({right:'-350px'},300); 
        });

		$(function(){
			$(".notificaciones").hide();
			$("#btn2").click(function(){$(".notificaciones").slideToggle(300);})	
		});

		var  block_in = false;
        $("#btn3").toggle(
			function () { 
			$(".question").animate({left:'0px'},600);
			block_in = true;
			},
			function () { 
			$(".question").animate({left:'-300px'},600); 
			block_in = false;
			}
		);	
        
		
});

$(document).click(function (e)
{
    var container = $(".question");

    if (!container.is(e.target) 
        && container.has(e.target).length === 0
        && container.is(":visible"))
    {
        container.animate({left:'-300px'},600);
    }

     var container2 = $(".profile");

    if (!container2.is(e.target) 
        && container2.has(e.target).length === 0
        && container2.is(":visible"))
    {
        container2.animate({right:'-350px'},600); 
    }
});

$(document).ready(function(){
        var btn1 = $("#act_btn_1");
        var btn2 = $("#act_btn_2");
        var btn3 = $("#act_btn_3");
        var btn6 = $("#act_btn_6");
        var btn7 = $("#act_btn_7");
        var video = $("#video");
        var eval = $("#evaluacion");
        var disc = $("#discusion");
        var g_disc = $("#generar_discusion");
        var answ = $("#respuesta");
        var see = "block";
        var hide = "none";
        var getin = {left:'8px'};
        var getout = {left:'-600px'};
        btn1.click(function(){
        eval.css({display:hide});
        eval.animate(getout);
        answ.css({display:hide});
        answ.animate(getout);
        disc.css({display:hide});
        disc.animate(getout);
        g_disc.css({display:hide});
        g_disc.animate(getout);
        video.css({display:see});
        video.animate(getin);       
        });
        btn2.click(function(){
        eval.css({display:see});
        eval.animate(getin);
        answ.css({display:hide});
        answ.animate(getout);
        disc.css({display:hide});
        disc.animate(getout);
        g_disc.css({display:hide});
        g_disc.animate(getout);
        video.css({display:hide});
        video.animate(getout);       
        });
        btn3.click(function(){
        eval.css({display:hide});
        eval.animate(getout);
        answ.css({display:hide});
        answ.animate(getout);
        disc.css({display:see});
        disc.animate(getin);
        g_disc.css({display:hide});
        g_disc.animate(getout);
        video.css({display:hide});
        video.animate(getout);       
        }); 
        btn6.click(function(){
        eval.css({display:hide});
        eval.animate(getout);
        answ.css({display:see});
        answ.animate(getin);
        disc.css({display:hide});
        disc.animate(getout);
        g_disc.css({display:hide});
        g_disc.animate(getout);
        video.css({display:hide});
        video.animate(getout);       
        }); 
        btn7.click(function(){
        eval.css({display:hide});
        eval.animate(getout);
        answ.css({display:hide});
        answ.animate(getout);
        disc.css({display:hide});
        disc.animate(getout);
        g_disc.css({display:see});
        g_disc.animate(getin);
        video.css({display:hide});
        video.animate(getout);       
        });
 

});



$(document).ready(function(){
                $("#uno").click(function(){
                $("#slide1").css("display","none");
                $(".one").css("background-color","#5fcf80");
                $(".two").css("background-color","#5fcf80");
                $(".three").css("background-color","#575756");
                $(".four").css("background-color","#575756");
                $("#slide2").animate({right:'0px'});
                $("#slide_title").html("Navegación entre módulos");
                $("#slide_txt").html("Accede rápidamente al módulo que quieras ir.");
                $("#uno").hide();
                $("#dos").show();
                });

                $("#dos").click(function(){
                $("#slide2").css("display","none");
                $(".three").css("background-color","#5fcf80");
                $("#slide3").animate({right:'0px'});
                $("#slide_title").html("Actividades del módulo");
                $("#slide_txt").html("Accede a las actividades y controla tu progreso del módulo.");
                $("#dos").hide();
                $("#tres").show();
                });

                $("#tres").click(function(){
                $("#slide3").css("display","none");
                $(".four").css("background-color","#5fcf80");
                $("#slide4").animate({right:'0px'});
                $("#slide_title").html("Tu perfil");
                $("#slide_txt").html("Edita tu información personal, administra tu plan, controla tu puntaje y logros.");
                $("#tres").hide();
                $("#cuatro").show();
                });

                 $("#cuatro").click(function(){
                $("#slide4").css("display","none");
                $(".five").css("background-color","#5fcf80");
                $("#slide5").animate({right:'0px'});
                $("#slide_title").html("Pregunta al facilitador");
                $("#slide_txt").html("Recibe respuesta a todas tus preguntas.");
                $("#cuatro").hide();
                $("#cinco").show();
                });

         });

    $(function() {
        //configuration
        var width = 235;
        var animationSpeed = 1000;
        var pause = 5000;
        var currentSlide = 1;


        //cache DOM
        var $slider = $('.atr_slider_wrap');
        var $slideContainer = $slider.find('.atr_mobile_blocks');
        var $slide = $slideContainer.find('.atr_mobile_block');
        setInterval(function(){
            $slideContainer.animate({'margin-left':'-='+width},animationSpeed, function(){
                
                if(++currentSlide === $slide.length){
                    currentSlide = 1;
                    $slideContainer.css('margin-left',0);
                }
            });
        },pause);

    });

   
    $(document).ready(function(){
        var activity_btn = $("#act_btn_1");
        activity_btn.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn2 = $("#act_btn_2");
        activity_btn2.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn3 = $("#act_btn_3");
        activity_btn3.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

         var activity_btn4 = $("#act_btn_4");
        activity_btn4.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

         var activity_btn5 = $("#act_btn_5");
        activity_btn5.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn6 = $("#act_btn_6");
        activity_btn6.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn7 = $("#act_btn_7");
        activity_btn7.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

         var activity_btn8 = $("#act_btn_8");
        activity_btn8.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

         var activity_btn9 = $("#act_btn_9");
        activity_btn9.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn10 = $("#act_btn_10");
        activity_btn10.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });

        var activity_btn11 = $("#act_btn_11");
        activity_btn11.on('mouseenter', function(){
                $(".tool_tip_wrap").html($(this).data("actividad"));
        }).on('mouseleave',function(){
                $(".tool_tip_wrap").html(" ");
        });


        $(".module_on").css("background", "url(../img/aprov_icon.png)");


    });


    
    


