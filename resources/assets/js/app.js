
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

(function($) {
    "use strict"; // Start of use strict  
  
    function validateSlider() {
      let firstSlide = document.querySelector('.first-slide')
      let orderList = document.querySelector('#order-list')
      let form = document.getElementById("first-slide")
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() == false) {        
          event.preventDefault()
          event.stopPropagation()
        }else { 
          $('#order-list').carousel('next')
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add("was-validated")
        console.log(form.checkValidity())
      }, false)
    }    
    window.addEventListener('load', validateSlider, false)
  
    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: (target.offset().top - 48)
          }, 1000, "easeInOutExpo");
          return false;
        }
      }
    });
  
    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
      $('.navbar-collapse').collapse('hide');
    });
  
    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
      target: '#mainNav',
      offset: 54
    });
  
    // Collapse Navbar
    var navbarCollapse = function() {
      if ($("#mainNav").offset().top > 100) {
        $("#mainNav").addClass("navbar-shrink");
      } else {
        $("#mainNav").removeClass("navbar-shrink");
      }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
  
    // merchandise carousel
    $('.merchandise-carousel a').on('click', function () {
      var slide = $(this).data('slide');    
      console.log('click')
      if( slide == 'next' ){
        $(this).parent().carousel('next')
      }else { $(this).parent().carousel('prev') }
    })

    // sub nav toggle class when mobile view
    $('.product-nav').on('click',function (e) {
        $(this).next().toggleClass('dropdown');
    })
  
  })(jQuery); // End of use strict