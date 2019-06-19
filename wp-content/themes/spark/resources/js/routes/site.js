import Headroom from 'headroom.js'

export default {
  init() {

    let navbar = document.querySelector("#site-header")
    if (navbar) {
      let headroom = new Headroom(navbar)
      headroom.init()
    }

    let mobileMenu = document.querySelector("#sticky-mobile-nav")
    if (mobileMenu) {
      let headroom = new Headroom(mobileMenu)
      headroom.init()
    }

    // Mobile categories menu
    $('#sticky-mobile-nav .categories .button').click(function () {
      $('#categories').slideToggle('fast')
    })
  }
};
