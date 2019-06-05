/** Import external dependencies */
import $ from 'jquery'

/** Import UIkit */
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'

/** Load Icons */
UIkit.use(Icons)

/** Import local dependencies */
import Router from './util/Router'
import site from './routes/site'
import pageLogin from './routes/login'
import singleOffers from './routes/offer'

/** Populate Router instance with DOM routes */
const routes = new Router({
  site,
  pageLogin,
  singleOffers
});

/** Load events */
$(document).ready(() => routes.loadEvents())
