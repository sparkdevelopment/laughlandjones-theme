import $ from 'jquery'
import { TweenLite, Back, Elastic, Bounce } from 'gsap'

class Subscribe {
  constructor () {
    this.initDom()
    var self = this

    // Throttlers
    self.ctaThrottle = false
    self.subscribeThrottle = false

    $(document).ready(function () {
      self.subscribeCta.on('click', function (e) {
        if (self.ctaThrottle) {
          return
        }
        self.ctaThrottle = true
        if ($(e.currentTarget).hasClass('no-ui')) {
          return self.showForm(e)
        } else {
          window.UI.affectButtonUI(self.showForm.bind(self), e)
        }
      })

      self.closeButton.on('click', function (e) {
        var boundHideForm = self.hideForm.bind(self)

        // Mobile
        if (self.isMobile) {
          return window.UI.affectCloseButtonUI(self.hideForm.bind(window.Modal), e)
        }

        // Desktop
        boundHideForm()
      })

      self.downloadGraphic.on('click', self.hideForm)

      // Hover states
      if (!self.isMobile) {
        self.closeButton.hover(function () {
          TweenLite.to(self.closeButton, 0.4, {rotation: 180, ease: Back.easeOut.config(1.7)})
        }, function () {
          TweenLite.to(self.closeButton, 0.4, {rotation: 0})
        })
        self.downloadGraphic.hover(function () {
          TweenLite.to(self.downloadGraphic, 0.4, {scale: 1.1})
        }, function () {
          TweenLite.to(self.downloadGraphic, 0.4, {scale: 1})
        })
      }
      self.blackout.on('click', self.hideForm)

      self.inputs.on('focus', self.removeError)

      self.subscribeBtn.on('click', function (e) {
        e.preventDefault()
        e.stopPropagation()

        if (self.subscribeThrottle) {
          return
        }
        self.subscribeThrottle = true
        window.UI.affectButtonUI(self.doSubscribe.bind(self), e)
      })
    })
    // -- DOC READY
  }

  showForm (e) {
    if (!e) {
      this.newsCheck.prop('checked', true)
      this.portCheck.prop('checked', false)
    } else if ($(e.currentTarget).hasClass('prefill-subscribe')) {
      this.newsCheck.prop('checked', true)
      this.portCheck.prop('checked', false)
    } else {
      this.newsCheck.prop('checked', false)
      this.portCheck.prop('checked', true)
    }

    TweenLite.set(this.modalWrapper, {display: 'block'})
    TweenLite.to(this.blackout, 0.7, {opacity: 1})

    if (window.UI.desktopView()) {
      TweenLite.to(this.modal, 1, {y: '0%', ease: Elastic.easeOut})
      if (this.isMobile) {
        TweenLite.set(this.closeButton, {rotation: 180})
      }
    } else {
      TweenLite.set(this.closeButton, {rotation: 180})
      TweenLite.to(this.modal, 0.8, {x: '0%', ease: Bounce.easeOut})
    }
  }

  hideForm () {
    if (window.UI.desktopView()) {
      TweenLite.to(this.modal, 0.5, {y: '-140%'})
    } else {
      TweenLite.to(this.modal, 0.6, {x: '100%'})
    }

    TweenLite.to(this.blackout, 0.7, {opacity: 0})

    var self = this
    setTimeout(function () {
      TweenLite.set(self.modalWrapper, {display: 'none'})
      //  TweenLite.set this.brochureContent,  {display: 'none'}
      self.ctaThrottle = false
    }, 750)
  }

  initDom () {
    // Global
    this.html = $('html')
    this.isMobile = this.html.hasClass('mobile')

    // The Modal
    this.modalWrapper = $('.modal-wrapper')
    this.modal = $('.modal')
    this.blackout = $('.blackout')
    this.closeButton = $('.close-modal-button')

    this.subscribeContent = $('#subscribe-wrap')
    this.thanksContent = $('#thanks-wrap')
    this.thanksGraphic = $('#thanks-graphic')

    // The form
    this.inputs = $('input[type="text"], input[type="email"]')
    this.nameField = $('#name-field')
    this.emailField = $('#email-field')
    this.subscribeBtn = $('#subscribe-button')
    this.newsCheck = $('#newsletter-check')
    this.portCheck = $('#portfolio-check')

    this.downloadGraphic = $('#download-link')

    //  The toggler
    this.subscribeCta = $('.subscribe-cta')
  }

  removeError (e) {
    $(e.currentTarget).removeClass('error')
  }

  doSubscribe () {
    var self = this

    if (!this.validation.bind(this)) {
      this.subscribeThrottle = false
      return
    }

    this.disableForm()

    var contact = {
      'name': this.nameField.val(),
      'email': this.emailField.val(),
      'newsletter': this.newsCheck[0].checked,
      'portfolio': this.portCheck[0].checked
    }

    // this.enableForm()
    // this.subscribeThrottle = false
    // return console.log contact

    $.ajax({
      'type': 'post',
      'dataType': 'json',
      'url': window.lj_ajax.url,
      'data': { 'action': 'lj_send_email', contact }
    }).success(function (res) {
      self.handleSuccess(res)
    }).error(function (e) {
      self.handleError(e)
    })
  }

  handleSuccess (res) {
    var self = this

    TweenLite.to(this.subscribeContent, 0.7, {opacity: 0})

    setTimeout(function () {
      TweenLite.set(self.subscribeContent, {display: 'none'})
      TweenLite.set(self.thanksContent, {display: 'block'})

      setTimeout(function () {
        TweenLite.to(self.thanksContent, 0.7, {opacity: 1})
        console.log(res)
        if (res.brochure) {
          TweenLite.to(self.downloadGraphic, 0.7, {opacity: 1, scale: 1, ease: Bounce.easeOut}).delay(0.6)
        } else {
          TweenLite.to(self.thanksGraphic, 0.7, {opacity: 1, scale: 1, ease: Bounce.easeOut}).delay(0.6)
        }
      }, 10)

      self.subscribeCta.remove()

      if (!res.brochure) {
        setTimeout(function () {
          self.hideForm()
        }
          , 3000)
      }
    }, 700)
  }

  handleError (e) {
    this.enableForm()
    window.alert('Our apologies! It looks like something went wrong. Please try again later.')
  }

  disableForm () {
    this.subscribeBtn.addClass('disabled')
    this.nameField.attr('disabled', 'disabled')
    this.emailField.attr('disabled', 'disabled')
    this.newsCheck.attr('disabled', 'disabled')
    this.portCheck.attr('disabled', 'disabled')
  }

  enableForm () {
    this.subscribeBtn.removeClass('disabled')
    this.nameField.attr('disabled', false)
    this.emailField.attr('disabled', false)
    this.newsCheck.attr('disabled', false)
    this.portCheck.attr('disabled', false)
  }

  validation () {
    var Valid = true
    var Errors = ''

    if (this.nameField.val() === '' || this.nameField.val().length < 2 || !/\s/g.test(this.nameField.val())) {
      Valid = false
      this.invalidate(this.nameField)
      Errors = Errors + 'Please enter your name\n'
    }

    if (!this.validEmail(this.emailField.val())) {
      Valid = false
      this.invalidate(this.emailField)
      Errors = Errors + 'Please enter your email'
    }

    if (Errors.length > 0 && this.isMobile) {
      window.alert(Errors)
    }

    return Valid
  }

  validEmail (email) {
    var emailRegex = /^([a-zA-Z0-9_.\-+])+\this.(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
    return emailRegex.test(email)
  }

  invalidate (el) {
    el.val('')
    el.addClass('error')
  }
}

export default Subscribe
