export default {
  init() {

    const tile = $('.category-tiles .tile')
    const viewAll = $('main.offers header a')
    const mobile = $('#categories').hasClass('category-tiles--mobile')

    if (tile.hasClass('uk-active')) {
      viewAll.removeClass('uk-hidden')
    }

    tile.click(function () {
      viewAll.removeClass('uk-hidden')

      if (mobile)
        $('#categories').slideToggle('fast')
    })

    viewAll.click(function () {
      tile.removeClass('uk-active')
      $(this).addClass('uk-hidden')
    })

  }
}
