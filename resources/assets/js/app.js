
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

(function ($) {
  "use strict"; // Start of use strict  

  // Collapse Navbar
  function navbarCollapse() {
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

  

  // sub nav toggle class when mobile view
  $('.dropdown-toggle').on('click', function (e) {    
    if( $(this).next().hasClass('show-dropdown') ) {
      $(this).next().removeClass('show-dropdown')
    }else {
      $(this).next().toggleClass('dropdown')
    }
  })

})(jQuery); // End of use strict