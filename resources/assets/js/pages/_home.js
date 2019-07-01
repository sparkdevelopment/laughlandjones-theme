import $ from 'jquery'
import Mobile from '../libraries/_mobile.js'
import Swiper from 'swiper'

class Home {
  constructor () {
    this.setupSlider()
  }

  setupSlider () {
    var homeElement = $('body.home')
    var swiperContainer = $('.swiper-container')
    var leftArrow = $('#left-arrow')
    var rightArrow = $('#right-arrow')
    /* eslint-disable no-unused-vars */
    var swiper
    /* eslint-enable no-unused-vars */

    if (homeElement) {
      if (Mobile.isMobile()) {
        console.log('mobile')
        swiper = new Swiper(swiperContainer, {
          speed: 600,
          loop: true,
          autoplay: {
            delay: 5000
          },
          autoplayDisableOnInteraction: false
        })
      } else {
        swiper = new Swiper(swiperContainer, {
          speed: 1000,
          loop: true,
          autoplay: {
            delay: 5000
          },
          navigation: {
            nextEl: rightArrow,
            prevEl: leftArrow
          },
          effect: 'fade',
          autoplayDisableOnInteraction: false
        })
      }
    }
  }
}

export default Home
