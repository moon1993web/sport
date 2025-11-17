	
// carousal slider js


// top header
$(window).on("scroll", function() {
	if ($(document).scrollTop() > 50) {
	  $('header').addClass('shrink');
	} else {
	  $('header').removeClass('shrink');
	}
	});
	
	// 
	/*--------------- slider ---------------*/
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

// page loader
$(window).on('load', function () {
  $("body").removeClass("hidden");
  $(".page_loader").fadeOut("slow")
});

//Carousels
function carousels(){
  var carousel = $('.carouselslider'),
      options  = {
        itemsCustom : [
          [0, 1],
          [768, 2],
          [992, 3]
        ],
        navigation  : true
      };
  
  carousel.each(function(){
    var $this = $(this);

    if ($this.data('options')){
      options = $this.data('options');
    }

    $this.owlCarousel(options).addClass('loaded');
    
    $(window).on('resize', function(){
      delay(function(){
        bottomNavigation();
      }, 200);
    });

    function bottomNavigation(){
      if (
        ($this.hasClass('bottom-navigation')) && (!$this.find('.owl-pagination .owl-prev').length)
      ){
        $this.find('.owl-pagination').prepend('<a href="#" class="owl-prev"/>');
        $this.find('.owl-pagination').append('<a href="#" class="owl-next"/>');
        
        $this.find('.owl-next').html('<i class="fa fa-chevron-right"></i>').on('click',function (e){
          e.preventDefault();
          
          $this.trigger('owl.next');
        });
        
        $this.find('.owl-prev').html('<i class="fa fa-chevron-left"></i>').on('click',function (e){
          e.preventDefault();
          
          $this.trigger('owl.prev');
        });
      }
    }
    bottomNavigation();
  });
}
carousels();


$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});

/*************HEADER MENU*******************/
$(function() {
  $('#main-menu').smartmenus({
    mainMenuSubOffsetX: -1,
    mainMenuSubOffsetY: 4,
    subMenusSubOffsetX: 6,
    subMenusSubOffsetY: -6
  });
});

// SmartMenus CSS animated sub menus - toggle animation classes on sub menus show/hide
$(function() {
  $('#main-menu').bind({
    'show.smapi': function(e, menu) {
      $(menu).removeClass('hide-animation').addClass('show-animation');
    },
    'hide.smapi': function(e, menu) {
      $(menu).removeClass('show-animation').addClass('hide-animation');
    }
  }).on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function(e) {
    $(this).removeClass('show-animation hide-animation');
    e.stopPropagation();
  });
});

// SmartMenus mobile menu toggle button
$(function() {
  var $mainMenuState = $('#main-menu-state');
  if ($mainMenuState.length) {
    // animate mobile menu
    $mainMenuState.change(function(e) {
      var $menu = $('#main-menu');
      if (this.checked) {
        $menu.hide().slideDown(250, function() { $menu.css('display', ''); });
      } else {
        $menu.show().slideUp(250, function() { $menu.css('display', ''); });
      }
    });
    // hide mobile menu beforeunload
    $(window).bind('beforeunload unload', function() {
      if ($mainMenuState[0].checked) {
        $mainMenuState[0].click();
      }
    });
  }
  
/* ------------------ TEAM SLIDER-----------------*/
	
var owl = $('#carousel');
	owl.owlCarousel({
	loop:true,
	margin: 0,
	autoplayTimeout:5000,
	smartSpeed:450,
  rtl:true,
	dots:true,
	nav: false,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 2
	  },
	  1000: {
		items: 4
	  }
	}
})

/* ------------------ BLOG SLIDER-----------------*/
	
var owl = $('#blog_slider');
	owl.owlCarousel({
	loop:true,
	margin: 10,
	autoplayTimeout:5000,
	smartSpeed:450,
	dots:true,
	nav: false,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 2
	  },
	  1000: {
		items: 3
	  }
	}
})
  
  
/* ------------------ NUMBER COUNTER-----------------*/
// var a = 0;
// $(window).scroll(function() {

//   var oTop = $('#counter').offset().top - window.innerHeight;
//   if (a == 0 && $(window).scrollTop() > oTop) {
//     $('.counter-value').each(function() {
//       var $this = $(this),
//         countTo = $this.attr('data-count');
//       $({
//         countNum: $this.text()
//       }).animate({
//           countNum: countTo
//         },

//         {

//           duration: 2000,
//           easing: 'swing',
//           step: function() {
//             $this.text(Math.floor(this.countNum));
//           },
//           complete: function() {
//             $this.text(this.countNum);
//             //alert('finished');
//           }

//         });
//     });
//     a = 1;
//   }

// });  
  
$(document).ready(function () {
  if($("#counter").length == 1){
  var a = 0;
  $(window).scroll(function() {
  var oTop = $('#counter').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
  $('.counter-value').each(function() {
    var $this = $(this),
    countTo = $this.attr('data-count');
    $({
    countNum: $this.text()
    }).animate({
      countNum: countTo
    },
  
    {
      duration: 2000,
      easing: 'swing',
      step: function() {
      $this.text(Math.floor(this.countNum));
      },
      complete: function() {
      $this.text(this.countNum);
      //alert('finished');
      }
    });
  });
  a = 1;
  }
  });
  }else{}
}); 


  jQuery('.progress-bar1').each(function() {
    jQuery(this).find('.progress-content').animate({
      width:jQuery(this).attr('data-percentage')
    },2000);
    
    jQuery(this).find('.progress-number-mark').animate(
      {right:jQuery(this).attr('data-percentage')},
      {
       duration: 2000,
       step: function(now, fx) {
         var data = Math.round(now);
         jQuery(this).find('.percent').html(data + '');
       }
    });  
  });


//   jQuery('.progress-bar1').each(function() {
//     // انیمیشن برای نوار پیشرفت (progress-content)
//     jQuery(this).find('.progress-content').animate({
//         width: jQuery(this).attr('data-percentage') // عرض همچنان از راست به چپ پر می‌شود (مناسب برای RTL)
//     }, 2000);

//     // انیمیشن برای شماره درصد (progress-number-mark)
//     jQuery(this).find('.progress-number-mark').animate(
//         {
//             right: jQuery(this).attr('data-percentage') // استفاده از right به جای left برای RTL
//         },
//         {
//             duration: 2000,
//             step: function(now, fx) {
//                 var data = Math.round(now);
//                 jQuery(this).find('.percent').html(data + '%'); // اضافه کردن علامت درصد
//             }
//         }
//     );
// });


  
	
	
/*---------------Contact_Form--------------*/

$('#contact-us-form').submit(function() {
      var form = $(this);
      var formData = $(this).serialize();
     
      $.post('../mail.php', formData, function(data) {
        //form.find('.send_mes').val('');
        form.append('<div class="success-msg" style="color:#fff; font-weight:bold;">Mail Sent.</div>');
      }).fail(function() {
        //form.find('.required-field').val('');
        form.append('<div class="error-msg">Error occurred.</div>');
      });

      return false;

  });
  


  
//testimonial
    	// :: 2.0 Slick Active Code
      $('.slider-for').slick({
        slidesToShow: 1,
        centerMode: true,
        slidesToScroll: 1,
        rtl: true,              // اضافه کردن این گزینه
        speed: 500,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav',
        prevArrow: '<span><i class="fa fa-angle-right"></i></span>',
        nextArrow: '<span><i class="fa fa-angle-left"></i></span>'
      });
    $('.slider-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      rtl: true, 
      speed: 500,
      asNavFor: '.slider-for',
      dots: false,
      focusOnSelect: true,     
      slide: 'div',
      autoplay: false,
      centerMode: true,
      arrows: false,
      centerPadding: '5px',
       mobileFirst: true,
         responsive: [
             {
               breakpoint: 1324,
               settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
               breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 300,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
               
           ]
     });  
});



function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  clock.style.display = 'block';
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');


  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = ('0'+ t.days);
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      var live = document.getElementById('live');
      clearInterval(timeinterval);
      clock.style.display='none';
      if (clock.style.display=='none') {
        live.style.display='block';
      }
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var schedule = [
    ['May 28 2019 1:00:00 am EDT', 'May 29 2019 10:00:00 pm EDT'],
    ['May 30 2019 1:00:00 am EDT', 'May 31 2019 10:00:00 pm EDT'],
    ['June 1 2019 1:00:00 am EDT', 'June 3 2019 10:00:00 pm EDT'],
    ['June 4 2019 1:00:00 am EDT', 'June 5 2019 10:00:00 pm EDT'],
    ['June 6 2019 1:00:00 am EDT', 'June 7 2019 10:00:00 pm EDT'],
    ['June 8 2019 1:00:00 am EDT', 'June 8 2019 2:00:00 pm EDT'],
    ['June 8 2019 6:00:10 pm EDT', 'June 10 2019 10:00:00 pm EDT'],
    ['June 11 2019 1:00:00 am EDT', 'June 12 2019 10:00:00 pm EDT'],
    ['June 13 2019 1:00:00 am EDT', 'June 14 2019 10:00:00 pm EDT'],
    ['June 15 2019 1:00:00 am EDT', 'June 15 2019 2:00:00 pm EDT'],
    ['June 15 2019 6:00:00 pm EDT', 'June 17 2019 10:00:00 pm EDT'],
];
// iterate over each element in the schedule
for(var i=0; i<schedule.length; i++){
  var startDate = schedule[i][0];
  var endDate = schedule[i][1];

  // put dates in milliseconds for easy comparisons
  var startMs = Date.parse(startDate);
  var endMs = Date.parse(endDate);
  var currentMs = Date.parse(new Date());

  // if current date is between start and end dates, display clock
  if(endMs > currentMs && currentMs >= startMs ){
      initializeClock('clockdiv', endDate);
  }
}