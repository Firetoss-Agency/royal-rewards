import axios from 'axios'

export default {
  init() {

    const api = 'http://royal-rewards.test/wp-json/wp/v2'
    const token = window.localStorage.getItem('royal_jwt')
    const headers = {
      "content-type": "application/json",
      "Authorization": 'Bearer ' + token
    }
    let favButton = $('.favorite-button')

    // If Offer is already favorited or not
    let favorited = favButton.data('favorited')

    // Change button text based on whether it's favorited or not
    updateFavoritedButton(favorited)

    // Add current User's ID to Favorites taxonomy
    $('.favorite-button').on('click', function (event) {
      event.preventDefault()

      let userId    = parseInt($(this).attr('data-user'))
      let termId    = parseInt($(this).attr('data-term'))
      let offerId   = parseInt($(this).attr('data-offer'))

      // ====================================================================
      // If User has their ID already created as a term in Favorites taxonomy
      // ====================================================================
      if (termId) {

        // Get current Offer
        axios.get(api + '/offers/' + offerId)
        .then(post => {

          // Get existing Favorites for this Offer
          let favorites = post.data.favorites

          // ============================================
          // If the User already has this Offer Favorited
          // ============================================
          if (favorited) {

            // Get index of the term_id on the Favorites array
            let index = favorites.indexOf(termId)

            // Remove User's Term ID from Favorites Taxonomy, on this Offers Favorites
            if (index !== -1) favorites.splice(index, 1)

            // Update this Offers Favorites to remove the current User
            axios({
              method: 'post',
              url: api + '/offers/' + offerId,
              headers: headers,
              data: {
                "favorites": favorites
              }
            })
            .then(() => {
              // Update button text
              updateFavoritedButton(false)

              // Update button data-favorited attribute
              favButton.attr('data-favorited', '')

              // Update the favorited variable
              favorited = false
            })
            .catch(error => console.log(error))
          }

          // =============================================
          // If the User doesn't have this Offer Favorited
          // =============================================
          else {

            // Add User's Term ID from Favorites Taxonomy, to this Offers Favorites
            favorites.push(termId)

            // Update this Offers Favorites to include the current User
            axios({
              method: 'post',
              url: api + '/offers/' + offerId,
              headers: headers,
              data: {
                "favorites": favorites
              }
            })
            .then(() => {
              // Update button text
              updateFavoritedButton(true)

              // Update button data-favorited attribute
              favButton.attr('data-favorited', 1)

              // Update the favorited variable
              favorited = true
            })
            .catch(error => console.log(error))
          }

        })
        .catch(error => console.log(error))
      }

      // =====================================================================
      // If user doesn't have their ID created as a term in Favorites taxonomy
      // =====================================================================
      else {

        // Create the User's term on the Favorites Taxonomy
        axios({
          method: 'post',
          url: api + '/favorites',
          headers: headers,
          data: {
            "name": userId.toString()
          }
        })
        .then(term => {
          // Get the term's ID
          let newTermId = term.data.id

          // Get current Offer
          axios.get(api + '/offers/' + offerId)
          .then(post => {

            // Get existing Favorites for this Offer
            let favorites = post.data.favorites

            // Add User's Term ID from Favorites Taxonomy, to this Offers Favorites
            favorites.push(newTermId)

            // Update this Offers Favorites to include the current User
            axios({
              method: 'post',
              url: api + '/offers/' + offerId,
              headers: headers,
              data: {
                "favorites": favorites
              }
            })
            .then(() => {
              // Update button text
              updateFavoritedButton(true)

              // Update button data-favorited attribute
              favButton.attr('data-favorited', 1)

              // Update button data-term attribute
              favButton.attr('data-term', newTermId)

              // Update the favorited variable
              favorited = true
            })
            .catch(error => console.log(error))
          })
          .catch(error => console.log(error))
        })
        .catch(error => console.log(error))
      }
    })

    // Functions
    function updateFavoritedButton (favorited) {
      if (favorited) {
        // Show Remove from Favorites button text
        favButton.children('.remove').removeClass('uk-hidden')

        // Hide Add to Favorites button text
        favButton.children('.add').addClass('uk-hidden')
      } else {
        // Show Add to Favorites button text
        favButton.children('.add').removeClass('uk-hidden')

        // Hide Remove from Favorites button text
        favButton.children('.remove').addClass('uk-hidden')
      }
    }

  }
}
