import $ from 'jquery'

function addClass () {
  // adds mobile class, and mobile os to html tag
  var deviceAgent = navigator.userAgent.toLowerCase()

  if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
    $('html').addClass('ios')
    $('html').addClass('mobile')
  }

  if (deviceAgent.match(/android/)) {
    $('html').addClass('android')
    $('html').addClass('mobile')
  }

  if (deviceAgent.match(/blackberry/)) {
    $('html').addClass('blackberry')
    $('html').addClass('mobile')
  }

  if (deviceAgent.match(/(symbianos|^sonyericsson|^nokia|^samsung|^lg)/)) {
    $('html').addClass('mobile')
  }
}

function isMobile () { return $('html').hasClass('mobile') }

export default { addClass, isMobile }
