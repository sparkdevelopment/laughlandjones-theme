import $ from 'jquery'
import { TweenLite, CSSPlugin, Elastic } from 'gsap'

// Prevent tree shaking
/* eslint-disable no-unused-vars */
const plugins = [ CSSPlugin ]
/* eslint-enable no-unused-vars */

class UI {
  constructor () {
    this.initDom()

    this.backToTop.on('click', () => {
      $('html, body').animate({ scrollTop: 0 }, 500)
      return false
    })

    $(document).ready(() => {
      this.showPage()
    })
  }

  showPage () {
    TweenLite.to(this.page, 1, {opacity: 1})
  }

  hidePage () {
    TweenLite.to(this.page, 0.7, {opacity: 0})
  }

  initDom () {
    this.backToTop = $('#back-to-top')

    this.page = $('.page')

    this.html = $('html')

    this.buttons = $('.button')
  }

  affectButtonUI (callback, e) {
    var scale
    var button = $(e.currentTarget).children('button')

    var inSpeed = 200
    var outSpeed = 700

    if (this.html.hasClass('mobile')) {
      scale = 1.1
    } else {
      scale = 1.3
    }

    TweenLite.to(button, inSpeed / 1000, {scaleX: scale})

    setTimeout(() => {
      TweenLite.to(button, outSpeed / 1000, {scaleX: 1})
      setTimeout(() => {
        callback(e)
      }, outSpeed)
    }, inSpeed)
  }

  affectCloseButtonUI (callback, e) {
    var button = $(e.currentTarget)

    TweenLite.to(button, 0.6, {rotation: 0, ease: Elastic.easeOut})

    setTimeout(() => {
      callback(e)
    }, 900)
  }

  desktopView () {
    return window.matchMedia('(min-width: 992px)').matches
  }

  largerDesktopView () {
    return window.matchMedia('(min-width: 1025px)').matches
  }
}

export default UI
