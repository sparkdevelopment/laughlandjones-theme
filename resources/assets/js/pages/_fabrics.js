import $ from 'jquery'
import Cookies from 'js-cookie'

class Fabric {
  constructor () {
    var self = this

    if (navigator.cookieEnabled) this.initBasket(self)

    $(document).ready(function () {
      $('.design-colors li').on('click', (e) => {
        e.preventDefault()
        self.updateSelection(e)
      })
    })
  }

  initBasket (self) {
    var cookieName = 'lj-basket'
    // Check if cookie exists
    var basketValue = Cookies.get(cookieName)
    if (basketValue === undefined) {
      basketValue = []
    }

    self.drawBasket(basketValue.length)
  }

  drawBasket (basketSize) {
    var $basketContainer = $('.fabrics-header .basket')

    var basketOutput = '<a href="">BASKET <span><i id="basket-count">' + basketSize + '</i></span></a>'

    $basketContainer.html(basketOutput)
  }

  updateSelection (e) {
    var currentIndex = $(e.currentTarget).attr('data-index')
    var currentColours = ''

    // Swap Pattern Number
    $('#fabric-pattern-number').html(window.fabricVariations[currentIndex].no)

    // Swap image
    $('#current-design').css('background-image', 'url(' + window.fabricVariations[currentIndex].image_url + ')')

    // Swap colours
    Object.keys(window.fabricVariations[currentIndex].colours).forEach(function (colourHex, colourTitle) {
      currentColours += '<b style="background-color:' + colourHex + '" title="' + colourTitle + '"></b>'
    })
    $('#fabric-selected-colors .colors').html(currentColours)
  }
}

export default Fabric
