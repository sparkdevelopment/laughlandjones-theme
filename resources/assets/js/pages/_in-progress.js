import $ from 'jquery'
import Swiper from 'swiper'

class InProgress {
  constructor () {
    this.initDom()
    this.startSlideshows()
  }

  initDom () {
    this.html = $('html')
    this.isMobile = this.html.hasClass('mobile')
    this.imageBrowsers = $('.project-images-browser')
  }

  startSlideshows () {
    [...this.imageBrowsers].forEach(browser => {
      var mainSliderContainer = $(browser).find('.images__main')
      var smallSliderContainer = $(browser).find('.images__small')

      var mainSlider = new Swiper(mainSliderContainer, {
        speed: 800,
        spaceBetween: 0,
        noSwipingClass: 'images__main__slide',
        slidesPerView: 1,
        breakpoints: {
          992: {
            noSwipingClass: 'something-else'
          }
        }
      })

      var smallSlider = new Swiper(smallSliderContainer, {
        speed: 800,
        autoplay: false,
        autoplayDisableOnInteraction: false,
        spaceBetween: 5,
        centeredSlides: true,
        noSwiping: 'images__small__slide',
        slidesPerView: 3,
        slideToClickedSlide: true
      })

      mainSlider.params.control = smallSlider
      smallSlider.params.control = mainSlider
    })
  }
}

export default InProgress
