import axios from 'axios'

export default {
  init() {

    let username = $('.login-username label').text()
    let password = $('.login-password label').text()

    $('.login-username input').attr('placeholder', username)
    $('.login-password input').attr('placeholder', password)

    // Set JWT Token
    let user = $('#user_login').val()
    let pass = $('#pass_login').val()
    let submit = $('#wppb-submit')

    submit.on('click', function () {
      axios({
        method: 'post',
        url: 'http://royal-rewards.test/wp-json/jwt-auth/v1/token',
        data: {
          "username": "ftadmin",
          "password": "1198-0256-1191-97ad"
        }
      })
      .then(response => {
        window.localStorage.setItem('royal_jwt', response.data.token)
      })
      .catch(error => console.log(error))
    })

  }
};
