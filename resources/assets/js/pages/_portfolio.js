import $ from 'jquery'
import { TweenLite, CSSPlugin } from 'gsap'

// Prevent tree shaking
/* eslint-disable no-unused-vars */
const plugins = [ CSSPlugin ]
/* eslint-enable no-unused-vars */

class Portfolio {
  constructor () {
    this.initDom()

    var self = this

    $(document).ready(() => {
      self.project.on('click', self.goToProject)

      self.scrollBtns.on('click', self, self.scrollPortfolio)

      self.projectsListWrap.scroll(function () {
        if ((parseInt(self.projectsListWrap.scrollLeft())) < 50) {
          TweenLite.set(self.leftBtn, {opacity: 0})
        } else {
          TweenLite.set(self.leftBtn, {opacity: 1})
        }

        self.innerWidth = $(window).width()
        var threshold = self.projectsListWrap[0].scrollWidth - 50

        var rightPos = self.innerWidth + parseInt(self.projectsListWrap.scrollLeft()) + 50

        if (rightPos > threshold) { TweenLite.set(self.rightBtn, {opacity: 0}) } else { TweenLite.set(self.rightBtn, {opacity: 1}) }
      })
    })
  }

  initDom () {
    this.projectsListWrap = $('.projects-list-wrap')
    this.projectsList = $('ul#projects')
    this.project = $('#projects .project')

    this.scrollBtns = $('.scroll-buttons')
    this.leftBtn = $('#left')
    this.rightBtn = $('#right')
  }

  scrollPortfolio (e) {
    var dir = $(e.currentTarget).attr('id')
    var dirSign = dir === 'left' ? '-' : '+'
    e.data.projectsListWrap.animate({scrollLeft: `${dirSign}=800px`}, 400)
  }

  goToProject (e) {
    var project = $(e.currentTarget).attr('data-project')

    window.UI.hidePage()

    setTimeout(() => {
      window.location.href = `/portfolio/${project}`
    }, 700
    )
  }
}

export default Portfolio
