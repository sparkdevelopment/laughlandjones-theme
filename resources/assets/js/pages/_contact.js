import $ from 'jquery'
import Cookies from 'js-cookie'

class Contact {
  constructor () {
    this.initDom()
    var self = this

    $(document).ready(function () {
      var cookieName = 'lj-subscribe'

      self.locationTabs.on('click', (e) => {
        var mode = $(e.currentTarget).attr('data-location')
        self.toggleTab(mode)
      })

      self.subscribeBtn.on('click', (e) =>
        window.UI.affectButtonUI(window.Modal.show.bind(window.Modal), e)
      )

      if (Cookies.get(cookieName)) {
        // have cookie
      } else {
        setTimeout(() => {
          window.Subscribe.showForm(false)
        }, 2000)
        Cookies.set(cookieName, 'viewed')
      }
    })
  }

  toggleTab (mode) {
    this.locationWrap.removeClass('studio warehouse')
    this.locationWrap.addClass(mode)
  }

  initDom () {
    this.locationWrap = $('#contact-data-wrap')
    this.locationTabs = $('#location-tabs .tab')
    this.subscribeBtn = $('.subscribe-cta')
    this.close = $('#close-button')
  }
}

export default Contact
