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
import postTypeArchiveOffers from './routes/offers'
import singleOffers from './routes/offer'
import about from './routes/about';


/** Populate Router instance with DOM routes */
const routes = new Router({
  site,
  pageLogin,
  postTypeArchiveOffers,
  singleOffers,
  about
});

/** Load events */
$(document).ready(() => routes.loadEvents())
