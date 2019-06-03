import Headroom from 'headroom.js'

export default {
  init() {

    let navbar = new Headroom(document.querySelector("#site-header"))
    navbar.init()

  }
};
