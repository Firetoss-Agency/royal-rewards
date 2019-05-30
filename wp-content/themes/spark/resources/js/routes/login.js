export default {
  init() {

    let username = $('.login-username label').text()
    let password = $('.login-password label').text()

    $('.login-username input').attr('placeholder', username)
    $('.login-password input').attr('placeholder', password)

  }
};
