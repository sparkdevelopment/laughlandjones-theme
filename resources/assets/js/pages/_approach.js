import $ from 'jquery'
import Swiper from 'swiper'
import { TweenLite, TweenMax, Bounce } from 'gsap'

class Approach {
  constructor () {
    this.initDom()

    this.subListThrottle = false

    this.currentSector = 0

    this.swiperPlay = null

    $(document).ready(() => {
      this.sector.on('click', { self: this }, this.showSublist)

      this.close.on('click', { self: this }, this.hideSublist)

      this.doSlideshow()
    })
  }

  initDom () {
    this.html = $('html')

    this.isMobile = this.html.hasClass('mobile')

    this.whatItems = $('#sectors')

    this.sector = $('li.sector')

    this.subList = $('#subsectors-list')

    this.subsections = $('#subsections')

    this.propertyCopy = $('#subsection-copy')

    this.sectorHeading = $('#sector-heading')

    this.sectorImg = $('#section-img')

    this.close = $('#sector-close-button')

    this.backLink = $('#back-link')

    // SLIDESHOWS
  }

  noop () {
    // do nothing
  }

  doSlideshow () {
    this.SWIPERZ = new Swiper($('#slideshow'), {
      loop: true,
      effect: 'fade',
      speed: 900,
      //  autoplay: 5000,
      swipe: false,
      noSwiping: true,
      noSwipingClass: 'sector'
    })
  }

  showSublist (e) {
    if (!e.data.self.subListThrottle && !e.data.self.subList.hasClass('show')) {
      // DESKTOP
      if (window.UI.desktopView()) {
        e.data.self.sector.removeClass('active')
        $(e.currentTarget).addClass('active')

        var sector = $(e.currentTarget).attr('data-sector')

        e.data.self.SWIPERZ.slideTo(parseInt(sector) + 1)
      }

      // MOBILE & TABLET
      if (!window.UI.desktopView()) {
        e.data.self.subListThrottle = true
        e.data.self.subList.addClass('show')
        sector = $(e.currentTarget).attr('data-sector')
        var icon = $(e.currentTarget).attr('data-icon')
        e.data.self.populateList(sector, icon)

        e.data.self.innerWidth = e.data.self.html.width()
        TweenMax.to(e.data.self.subList, 0.7, {x: '0%', ease: Bounce.easeOut}).delay(0.2)
        TweenLite.set(e.data.self.close, {rotation: 180})
      }
    }
  }

  smallFunk (e) {
    TweenMax.to(e.data.self.subList, 0.6, {x: '100%'})
    setTimeout(() => {
      e.data.self.subList.removeClass('show')
      e.data.self.subListThrottle = false
      e.data.self.emptyList()
    }
      , 900)
  }

  hideSublist (e) {
    // MOBILE
    if (!window.UI.desktopView()) { window.UI.affectCloseButtonUI(e.data.self.smallFunk, e) }
  }

  emptyList () {
    this.sectorImg.empty()
    this.sectorHeading.empty()
    this.propertyCopy.empty()
    this.subsections.empty()
  }

  populateList (sector, icon) {
    var heading = window._Sectors[sector].title.replace('\n', '<br />')

    if (icon !== null) {
      var image = `<img src='${icon}' alt='${window._Sectors[sector].title} | Laughland Jones' />`
      this.sectorImg.append(image)
    }
    this.sectorHeading.html(heading)

    var html = ''

    if (sector === 4 || sector === '4') {
      window._Sectors[sector].copy.forEach(copy => {
        html = html + `
        <p>${copy}</p>
        `
      })
      this.propertyCopy.append(html)
    } else {
      window._Sectors[sector].subsections.forEach(section => {
        html = html + `<li class="subsection">${section}</li>`
      })

      this.subsections.append(html)
    }
  }
}

export default Approach
