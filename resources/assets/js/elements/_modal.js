import $ from 'jquery'
import { TweenLite, Bounce, Elastic } from 'gsap'

class Modal {
  constructor () {
    this.initDom()

    var self = this

    $(document).ready(() =>
      self.close.on('click', self.hide.bind(self))
    )
  }

  show () {
    TweenLite.set(this.modalWrap, {display: 'block'})

    TweenLite.to(this.modalWrap, 0.7, {opacity: 1})

    if (window.matchMedia('(min-width: 992px)').matches) {
      setTimeout(() => {
        TweenLite.to(this.modal, 1, {y: 0, ease: Elastic.easeOut})
        TweenLite.set(this.close, {rotation: 180})
      }, 500)
    } else {
      setTimeout(() => {
        TweenLite.to(this.modal, 1, {x: 0, ease: Bounce.easeOut})
        TweenLite.to(this.close, 1, {rotation: 180, ease: Elastic.easeOut})
      }, 500)
    }
  }

  hide () {
    TweenLite.to(this.close, 0.7, {rotation: 0, ease: Elastic.easeOut})

    setTimeout(() => {
      if (this.isMobile) {
        TweenLite.to(this.modal, 0.6, {x: this.WIDTH})

        setTimeout(() => {
          TweenLite.to(this.modalWrap, 0.7, {opacity: 0})
          setTimeout(() => {
            TweenLite.set(this.modalWrap, {display: 'none'})
          }, 700)
        }, 600)
      } else {
        TweenLite.to(this.modal, 0.6, {y: -this.HEIGHT})

        setTimeout(() => {
          TweenLite.to(this.modalWrap, 0.7, {opacity: 0})
          setTimeout(() => {
            TweenLite.set(this.modalWrap, {display: 'none'})
          }, 700)
        }, 600)
      }
    }, 500)
  }

  initDom () {
    this.html = $('html')

    this.isMobile = this.html.hasClass('mobile')

    this.modalWrap = $('#modal-wrapper')
    this.modal = $('#modal')
    this.close = $('#close-button')

    this.WIDTH = this.html.width()
    this.HEIGHT = this.html.height()
  }
}

export default Modal
