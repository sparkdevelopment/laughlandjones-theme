import $ from 'jquery'

class Fabric {
  constructor () {
    $(document).ready(function () {
      $('.design-colors li').on('click', (e) => {
        e.preventDefault()
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
      })
    })
  }
}

export default Fabric
