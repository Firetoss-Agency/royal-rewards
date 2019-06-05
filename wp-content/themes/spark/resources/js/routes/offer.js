import axios from 'axios'

export default {
  init() {

    const rootUrl = 'http://royal-rewards.test/wp-json'
    const wp = `${rootUrl}/wp/v2`
    const acf = `${rootUrl}/acf/v3`
    let token = window.localStorage.getItem('royal_jwt')

    axios({
      method: 'post',
      url: wp + '/users/1',
      headers: {
        "content-type": "application/json",
        "Authorization": 'Bearer ' + token
      },
      data: {
        "fields": {
          favorites: true,
          "test": "testing"
        }
      }
    })
    .then(response => {
      console.log(response.data.acf)
    })
    .catch(error => console.log(error))

  }
}
