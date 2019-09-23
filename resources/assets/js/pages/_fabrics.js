import $ from 'jquery'
import Cookies from 'js-cookie'

class Fabric {
  constructor () {
    var self = this

    this.cookieName = 'lj-basket'

    if (navigator.cookieEnabled) this.initBasket(self)

    $(document).ready(function () {
      $('.design-colors li').on('click', (e) => {
        e.preventDefault()
        self.updateSelection(self, e)
        self.updateButtons(self)
      })

      $('#add-to-cart').on('click', (e) => {
        e.preventDefault()
        self.notify('Pattern ' + $('.fabric-pattern-number').html() + ' added to basket')
        self.addToBasket(self, e.currentTarget)
        self.updateButtons(self)
      })

      $('.remove-from-cart').on('click', (e) => {
        e.preventDefault()
        if ($('#basket').length) {
          self.notify('Pattern ' + $('e.currentTarget').parent().find('.fabric-pattern-number').html() + ' removed from basket')
        } else {
          self.notify('Pattern removed from basket')
        }
        self.removeFromBasket(self, e.currentTarget)
        self.updateButtons(self)
      })
    })

    self.updateButtons(self)
  }

  initBasket (self) {
    self.drawBasket(self)
  }

  drawBasket (self) {
    var basketValue = self.getBasket()
    var basketSize = Object.keys(basketValue).length
    var $basketContainer = $('.fabrics-header .basket')

    var basketOutput = '<a href="' + window.location.protocol + '//' + window.location.hostname + '/basket">BASKET <span><i id="basket-count">' + basketSize + '</i></span></a>'

    $basketContainer.html(basketOutput)
  }

  updateButtons (self) {
    var fabricId = parseInt($('#add-to-cart').attr('data-id'))
    var variationId = parseInt($('#add-to-cart').attr('data-variation'))
    if (self.isInBasket(self, fabricId, variationId)) {
      $('#remove-from-cart').addClass('visible')
      $('#add-to-cart').removeClass('visible')
    } else {
      $('#remove-from-cart').removeClass('visible')
      $('#add-to-cart').addClass('visible')
    }
  }

  getBasket () {
    // Check if cookie exists
    var basketValue = Cookies.get(this.cookieName)
    if (basketValue === undefined) {
      basketValue = []
    } else {
      basketValue = JSON.parse(basketValue)
    }

    return basketValue
  }

  addToBasket (self, fabric) {
    var basketValue = self.getBasket()
    var fabricId = parseInt($(fabric).attr('data-id'))
    var variationId = parseInt($(fabric).attr('data-variation'))
    if (!self.isInBasket(self, fabricId, variationId)) {
      basketValue.push({
        'fabric': fabricId,
        'variation': variationId
      })
      Cookies.set(this.cookieName, JSON.stringify(basketValue), { expires: 7 })
      self.drawBasket(self)
    }
  }

  removeFromBasket (self, fabric) {
    var basketValue = self.getBasket()
    var fabricId = parseInt($(fabric).attr('data-id'))
    var variationId = parseInt($(fabric).attr('data-variation'))
    if (self.isInBasket(self, fabricId, variationId)) {
      var updatedBasketValue = basketValue.filter(function (basketItem, index, arr) {
        return basketItem.fabric !== fabricId || basketItem.variation !== variationId
      })
      Cookies.set(this.cookieName, JSON.stringify(updatedBasketValue), { expires: 7 })
      self.drawBasket(self)

      if ($('#basket').length) {
        $(fabric).parent().remove()
      }
    }
  }

  isInBasket (self, fabricId, variationId) {
    var basketValue = self.getBasket()
    var found = basketValue.some(basketItem => {
      return basketItem.fabric === fabricId && basketItem.variation === variationId
    })
    return found
  }

  updateSelection (self, e) {
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

    // Set variation on cart buttons
    $('#remove-from-cart').attr('data-variation', currentIndex)
    $('#add-to-cart').attr('data-variation', currentIndex)

    // Update cart buttons
    self.updateButtons(self)
  }

  notify (message) {
    var $notifyModalWrap = $('.notify-modal-wrapper')
    var $notifyModal = $('.notify-modal')
    var $notifyBlackout = $('.notify-blackout')
    if (!message || !$notifyModalWrap) {
      return false
    }

    // Set messgage
    $notifyModal.find('.message').html(message)

    // Display modal
    $notifyModalWrap.css('display', 'block')
    $notifyModal.css('transform', 'none')
    $notifyModal.css('-webkit-transform', 'none')
    $notifyModal.css('-ms-transform', 'none')
    $notifyBlackout.css('opacity', '1')

    // Add click handler
    $notifyModal.on('click', '.button-ok', () => {
      $notifyModalWrap.css('display', 'none')
    })
  }
}

export default Fabric
