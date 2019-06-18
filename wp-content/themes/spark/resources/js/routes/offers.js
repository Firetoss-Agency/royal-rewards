export default {
  init() {

    let tile = $('.category-tiles .tile')
    let viewAll = $('.category-tiles header a')

    if (tile.hasClass('uk-active')) {
      console.log('ok');
      viewAll.removeClass('uk-hidden')
    }


    tile.click(function () {
      viewAll.removeClass('uk-hidden')
    })

    viewAll.click(function () {
      tile.removeClass('uk-active')
      $(this).addClass('uk-hidden')
    })

  }
}
