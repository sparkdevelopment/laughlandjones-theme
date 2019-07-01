import $ from 'jquery'
import { TweenLite, CSSPlugin, Bounce, Elastic, Expo } from 'gsap'
import Mobile from '../libraries/_mobile.js'

// Prevent tree shaking
/* eslint-disable no-unused-vars */
const plugins = [ CSSPlugin ]
/* eslint-enable no-unused-vars */

class Who {
  constructor () {
    this.initDom()

    this.numbersTimeout = null

    if (this.isMobile) {
      this.employees.on('click', this.showEmployee)
      this.close.on('click', this.hideEmployee)
    }

    this.sendCV.on('click', (e) => {
      window.UI.affectButtonUI(this.doSendCV, e)
    })

    if (this.NumbersSection && this.Numbers) {
      this.NumbersTimeout = setInterval(this.checkScrollTop(), 100)
    }
  }

  initDom () {
    this.html = $('html')
    this.isMobile = this.html.hasClass('mobile')
    this.teamElement = $('body.page-template-template-team')

    this.sendCV = $('#send-cv')

    this.employees = $('#employees-list .employee')

    // Mobile modal stuff
    this.mobilePanel = $('#mobile-more')
    this.close = $('#emp-close-button')
    this.image = this.mobilePanel.find('.image')
    this.name = this.mobilePanel.find('h1.name')
    this.copy = this.mobilePanel.find('p.copy')
    this.linkedin = this.mobilePanel.find('a.employee-linkedin')
    this.email = this.mobilePanel.find('a.employee-email')

    // Counting Numbers!!
    this.NumbersSection = $('#company-numbers')
    this.Numbers = this.NumbersSection.find('.company-numbers__number')
  }

  addListeners () {
    if (this.teamElement) {
      if (Mobile.isMobile()) {
        this.employees.on('click', this.showEmployee)
      }
    }
  }

  showEmployee (e) {
    var p = this.getPersonData($(e.currentTarget).attr, 'data-id')

    var img = $(e.currentTarget).attr('data-image')

    this.image.css('background-image', `url('${img}')`)

    var nameHtml = `
      ${p.first_name} ${p.last_name}
      <br/>
      <em class='position'>${p.position}</em>
    `
    this.name.html(nameHtml)

    this.copy.html(p.copy)

    var emailz = encodeURI(p.email)

    var subject = encodeURI('Enquiry for #{p.first_name}')

    this.email.attr('href', `mailto:${emailz}?subject=${subject}`)

    if (p.linkedin.length > 0) {
      this.linkedin.removeClass('hide')
      this.linkedin.attr('href', p.linkedin)
    } else {
      this.linkedin.addClass('hide')
    }

    TweenLite.set(this.mobilePanel, {display: 'block'})
    TweenLite.to(this.mobilePanel, 1, {x: '0%', ease: Bounce.easeOut}).delay(0.1)
    TweenLite.set(this.close, {rotation: 180})
  }

  hideEmployee (e) {
    TweenLite.to(this.close, 0.6, {rotation: 0, ease: Elastic.easeOut})

    setTimeout(() => {
      TweenLite.to(this.mobilePanel, 0.6, {x: '100%'}).delay(0.1)
      setTimeout(() => {
        TweenLite.set(this.mobilePanel, {display: 'none'})
      }, 700)
    }, 600)
  }

  getPersonData (id) {
    window._Employees.forEach(e => {
      if (e.id === parseInt(id)) {
        return e
      }
    })
  }

  doSendCV () {
    window.location.href = 'mailto:enquiries@laughlandjones.co.uk?subject=Enquiry: CV Attached'
  }

  checkScrollTop () {
    var top = window.scrollY
    var pageHeight = window.innerHeight
    var bottom = top + pageHeight
    var horizon = this.Numbers.first().offset().top + 200
    if (bottom > horizon) {
      clearInterval(this.NumbersTimeout)
      this.animateNumbers()
    }
  }

  animateNumbers () {
    var suffix
    [...this.Numbers].forEach(number => {
      var numDom = $(number)
      var total = numDom.attr('data-total')
      if (numDom.attr('data-suffix')) {
        suffix = ' ' + numDom.attr('data-suffix')
      } else {
        suffix = ''
      }

      this.doNumberCount(numDom, total, suffix)
    })
  }

  doNumberCount (numDom, total, suffix) {
    var numObj = { num: 0 }

    TweenLite.to(numObj, 4, { num: total,
      ease: Expo.easeInOut,
      onUpdate () {
        numDom.html(Math.floor(numObj.num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + suffix)
      }})
  }
}

export default Who
