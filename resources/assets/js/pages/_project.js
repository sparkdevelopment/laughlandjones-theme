import $ from 'jquery'
import Swiper from 'swiper'
import { TweenLite, Back } from 'gsap'

class Project {
  constructor () {
    this.initDom()

    this.slideShowInitThrottle = false
    this.slideshowBtnThrottle = false

    var self = this

    $(document).ready(() => {
      self.slideshowButton.hover(function () {
        TweenLite.to(self.slideshowButtonButton, 0.4, {scaleX: 1.1, ease: Back.easeOut.config(1.7)})
      }, function () {
        TweenLite.to(self.slideshowButtonButton, 0.4, {scaleX: 1})
      })

      self.close.hover(function () {
        TweenLite.to(self.close, 0.4, {rotation: 180, ease: Back.easeOut.config(1.7)})
      }, function () {
        TweenLite.to(self.close, 0.4, {rotation: 0})
      })

      self.imageGrid.append(self.createRows())

      self.slideshowButton.on('click', self.showSlideshow.bind(self))

      self.close.on('click', function (e) {
        var boundHideSlideshow = self.hideSlideshow.bind(self)
        if (self.isMobile) {
          window.UI.affectCloseButtonUI(boundHideSlideshow, e)
        } else {
          boundHideSlideshow()
        }
      })
    })
  }

  showSlideshow () {
    if (this.slideshowBtnThrottle) return

    this.slideshowBtnThrottle = true

    this.slideshow.addClass('show')

    TweenLite.to(this.slideshow, 1, {opacity: 1}).delay(0.1)

    if (this.slideShowInitThrottle) return

    this.slideShowInitThrottle = true

    if (this.isMobile) {
      TweenLite.set(this.close, {rotation: 180})
      this.swiper = new Swiper(this.slideshow, {
        spaceBetween: 0,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        speed: 600,
        observer: true
      })
    } else {
      this.swiper = new Swiper(this.slideshow, {
        spaceBetween: 30,
        effect: 'fade',
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        navigation: {
          nextEl: this.right,
          prevEl: this.left
        },
        speed: 600,
        observer: true,
        calculateHeight: true
      })
    }
  }

  hideSlideshow () {
    var self = this
    this.slideshowBtnThrottle = false

    TweenLite.to(this.slideshow, 0.7, {opacity: 0})

    setTimeout(function () {
      self.slideshow.removeClass('show')
    }, 800)
  }

  initDom () {
    this.html = $('html')

    this.isMobile = this.html.hasClass('mobile')

    this.imageGrid = $('#project-image-grid')

    this.slideshow = $('.swiper-container')

    this.left = $('#left-arrow')
    this.right = $('#right-arrow')

    this.close = $('#slideshow-close-button')

    this.slideshowButton = $('#view-slideshow')
    this.slideshowButtonButton = this.slideshowButton.children('button')
  }

  whichImage () {
    var img = 'normal'

    var dpr = window.devicePixelRatio || window.screen.deviceXDPI / window.screen.logicalXDPI || 1

    if (dpr > 1) img = 'retina'

    if (window._Agent === 'mobile') img = 'mobile'

    return img
  }

  createRows () {
    var _Photos = window._Photos

    var i = 0

    var rows = ''

    while (i < (_Photos.length)) {
      var gandalf = Math.random() * 10

      if (_Photos[i].orientation === 'landscape' && _Photos[i + 1] !== undefined && _Photos[i + 1].orientation === 'landscape') {
        if (_Photos[i + 3] === undefined && _Photos[i + 2] !== undefined && _Photos[i + 2].orientation === 'portrait') { // 2- 70/30 lscp/port - i+=2
          rows = rows + `
            <div class="project-image-row lfw"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i++
          continue
        }

        if (gandalf > 6) { // 1- Full width lscp - i++
          rows = rows + `
            <div class="project-image-row lfw"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i++
          continue
        } else { // 2- 50/50 lscp - i+=2
          rows = rows + `
            <div class="project-image-row ll"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i += 2
          continue
        }
      } else if (_Photos[i].orientation === 'landscape' && _Photos[i + 1] !== undefined && _Photos[i + 1].orientation === 'portrait') {
        if (_Photos[i + 2] === undefined) { // 2- 70/30 lscp/port - i+=2
          rows = rows + `
            <div class="project-image-row lp"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i += 2

          continue
        }

        if (gandalf > 6) { // 1- Full width lscp - i++
          rows = rows + `
            <div class="project-image-row lfw"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i++
          continue
        } else { // 2- 70/30 lscp/port - i+=2
          rows = rows + `
            <div class="project-image-row lp"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i += 2

          continue
        }
      } else if (_Photos[i].orientation === 'portrait' && _Photos[i + 1] !== undefined && _Photos[i + 1].orientation === 'landscape') {
        // 1- 70/30 lscp/port - i+=2

        rows = rows + `
          <div class="project-image-row pl"><!--

            --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
            --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--

          --></div>
        `

        i += 2

        continue
      } else if (_Photos[i].orientation === 'portrait' && _Photos[i + 1] !== undefined && _Photos[i + 1].orientation === 'portrait') {
        if (_Photos[i + 2] !== undefined && _Photos[i + 2].orientation === 'portrait' && gandalf > 8) {
          // 1- 33/33/33 port - i+=3

          rows = rows + `
            <div class="project-image-row ppp"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 2][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `
          i += 3
          continue
        } else { // 2- 50/50 port - i+=2
          rows = rows + `
            <div class="project-image-row pp"><!--

              --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--
              --><img data-src="${_Photos[i + 1][this.whichImage()]}" class="lazyload"><!--

            --></div>
          `

          i += 2

          continue
        }
      } else if (_Photos[i].orientation === 'landscape' && _Photos[i + 1] === undefined) {
        // 1- Full width lscp - return
        rows = rows + `
          <div class="project-image-row lfw"><!--

            --><img data-src="${_Photos[i][this.whichImage()]}" class="lazyload"><!--

          --></div>
        `
        i++
        continue
      } else if (_Photos[i].orientation === 'portrait' && _Photos[i + 1] === undefined) {
        // 1- Widow :/ - return

        rows = rows + `
          <div class="project-image-row p"><!--

            --><img data-src="#{_Photos[i][this.whichImage()]}" class="lazyload"><!--

          --></div>
        `
        i++
        continue
      } else if (_Photos[i] === undefined) {
        continue
      } else {
        break
      }
    }
    return rows
  }
}

export default Project
