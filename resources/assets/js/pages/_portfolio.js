import $ from 'jquery'
import { TweenLite, CSSPlugin } from 'gsap'

// Prevent tree shaking
/* eslint-disable no-unused-vars */
const plugins = [ CSSPlugin ]
/* eslint-enable no-unused-vars */

class Portfolio {
  constructor () {
    this.initDom()

    $(document).ready(() => {
      this.project.on('click', this.goToProject)

      this.scrollBtns.on('click', this.scrollPortfolio)

      this.projectsListWrap.scroll(function () {
        if ((parseInt(this.projectsListWrap.scrollLeft())) < 50) {
          TweenLite.set(this.leftBtn, {opacity: 0})
        } else {
          TweenLite.set(this.leftBtn, {opacity: 1})
        }

        this.innerWidth = $(window).width()
        var threshold = this.projectsListWrap[0].scrollWidth - 50

        var rightPos = this.innerWidth + parseInt(this.projectsListWrap.scrollLeft()) + 50

        if (rightPos > threshold) { TweenLite.set(this.rightBtn, {opacity: 0}) } else { TweenLite.set(this.rightBtn, {opacity: 1}) }
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
    this.projectsListWrap.animate({scrollLeft: `${dirSign}=800px`}, 400)
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
