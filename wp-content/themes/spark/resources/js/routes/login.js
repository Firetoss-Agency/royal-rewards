import axios from 'axios'

export default {
  init() {

    // LOGIN

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
          "username": user,
          "password": pass
        }
      })
      .then(response => {
        window.localStorage.setItem('royal_jwt', response.data.token)
      })
      .catch(error => console.log(error))
    })


    // FORGOT PASSWORD

    let forgot = $('#wppb-recover-password .wppb-username-email label').text()

    $('#wppb-recover-password .wppb-username-email input').attr('placeholder', forgot)

    $('button.forgot-password-toggle').click(function () {
      $('#wppb-login-wrap').toggle()
      $('#wppb-recover-password-container').toggle()

      let text = $(this).text()
      $(this).text(
        text == "Forgot Password" ? "Back To Login" : "Forgot Password"
      );
    })


    // PASSWORD RESET

    $('.passw1 input').attr('placeholder', 'New Password')
    $('.passw2 input').attr('placeholder', 'Confirm New Password')

    let name = getQueryVariable('loginName')
    let key = getQueryVariable('key')

    if (name || key) {
      $('#wppb-login-wrap').toggle()
      $('#wppb-recover-password-container').toggle()
      $('button.forgot-password-toggle').text('Back To Login')
    }

    function getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split("&");
      for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
      }
      return(false);
    }

  }
};
