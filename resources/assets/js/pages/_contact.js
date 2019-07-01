import $ from 'jquery'

class Contact {
  constructor () {
    this.initDom()
    var self = this

    $(document).ready(function () {
      self.locationTabs.on('click', (e) => {
        var mode = $(e.currentTarget).attr('data-location')
        self.toggleTab(mode)
      })

      self.subscribeBtn.on('click', (e) =>
        window.UI.affectButtonUI(window.Modal.show.bind(window.Modal), e)
      )
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
