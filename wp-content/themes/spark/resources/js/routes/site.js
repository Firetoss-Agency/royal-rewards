import Headroom from 'headroom.js'

export default {
  init() {

    let navbar = document.querySelector("#site-header")
    if (navbar) {
      let headroom = new Headroom(navbar)
      headroom.init()
    }

  }
};
