import Headroom from 'headroom.js'

export default {
  init() {

    let navbar = document.querySelector("#site-header")
    if (navbar) {
      let headroom = new Headroom(navbar)
      headroom.init()
    }

    // Mobile categories menu
    $('#sticky-mobile-nav .categories .button').click(function () {
      $('#categories').slideToggle('fast')
    })
  }
};
