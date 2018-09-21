
// var $slider = $('.slideshow .slider'),
//   maxItems = $('.item', $slider).length,
//   dragging = false,
//   tracking,
//   rightTracking;

// $sliderRight = $('.slideshow').clone().addClass('slideshow-right').appendTo($('.split-slideshow'));

// rightItems = $('.item', $sliderRight).toArray();
// reverseItems = rightItems.reverse();
// $('.slider', $sliderRight).html('');
// for (i = 0; i < maxItems; i++) {
//   $(reverseItems[i]).appendTo($('.slider', $sliderRight));
// }

// $slider.addClass('slideshow-left');
// $('.slideshow-left').slick({
//   vertical: true,
//   verticalSwiping: true,
//   arrows: false,
//   infinite: true,
//   dots: true,
//   speed: 1000,
//   cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
// }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {

//   if (currentSlide > nextSlide && nextSlide == 0 && currentSlide == maxItems - 1) {
//     $('.slideshow-right .slider').slick('slickGoTo', -1);
//     $('.slideshow-text').slick('slickGoTo', maxItems);
//   } else if (currentSlide < nextSlide && currentSlide == 0 && nextSlide == maxItems - 1) {
//     $('.slideshow-right .slider').slick('slickGoTo', maxItems);
//     $('.slideshow-text').slick('slickGoTo', -1);
//   } else {
//     $('.slideshow-right .slider').slick('slickGoTo', maxItems - 1 - nextSlide);
//     $('.slideshow-text').slick('slickGoTo', nextSlide);
//   }
// }).handle("mousewheel", function(event) {
//   event.preventDefault();
//   if (event.deltaX > 0 || event.deltaY < 0) {
//     $(this).slick('slickNext');
//   } else if (event.deltaX < 0 || event.deltaY > 0) {
//     $(this).slick('slickPrev');
//   };
// }).on('mousedown touchstart', function(){
//   dragging = true;
//   tracking = $('.slick-track', $slider).css('transform');
//   tracking = parseInt(tracking.split(',')[5]);
//   rightTracking = $('.slideshow-right .slick-track').css('transform');
//   rightTracking = parseInt(rightTracking.split(',')[5]);
// }).on('mousemove touchmove', function(){
//   if (dragging) {
//     newTracking = $('.slideshow-left .slick-track').css('transform');
//     newTracking = parseInt(newTracking.split(',')[5]);
//     diffTracking = newTracking - tracking;
//     $('.slideshow-right .slick-track').css({'transform': 'matrix(1, 0, 0, 1, 0, ' + (rightTracking - diffTracking) + ')'});
//   }
// }).on('mouseleave touchend mouseup', function(){
//   dragging = false;
// });

// $('.slideshow-right .slider').slick({
//   swipe: false,
//   vertical: true,
//   arrows: false,
//   infinite: true,
//   speed: 950,
//   cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
//   initialSlide: maxItems - 1
// });
// $('.slideshow-text').slick({
//   swipe: false,
//   vertical: true,
//   arrows: false,
//   infinite: true,
//   speed: 900,
//   cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)'
// });



'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var $window = $(window);
var $body = $('body');

var Slideshow = function () {
  function Slideshow() {
    var _this = this;

    var userOptions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Slideshow);

    var defaultOptions = {
      $el: $('.slideshow'),
      showArrows: false,
      showPagination: true,
      duration: 10000,
      autoplay: true
    };

    var options = Object.assign({}, defaultOptions, userOptions);

    this.$el = options.$el;
    this.maxSlide = this.$el.find($('.js-slider-home-slide')).length;
    this.showArrows = this.maxSlide > 1 ? options.showArrows : false;
    this.showPagination = options.showPagination;
    this.currentSlide = 1;
    this.isAnimating = false;
    this.animationDuration = 1200;
    this.autoplaySpeed = options.duration;
    this.interval;
    this.$controls = this.$el.find('.js-slider-home-button');
    this.autoplay = this.maxSlide > 1 ? options.autoplay : false;

    this.$el.on('click', '.js-slider-home-next', function (event) {
      return _this.nextSlide();
    });
    this.$el.on('click', '.js-slider-home-prev', function (event) {
      return _this.prevSlide();
    });
    this.$el.on('click', '.js-pagination-item', function (event) {
      if (!_this.isAnimating) {
        _this.preventClick();
        _this.goToSlide(event.target.dataset.slide);
      }
    });

    this.init();
  }

  _createClass(Slideshow, [{
    key: 'init',
    value: function init() {
      this.goToSlide(1);

      /* if (this.showArrows) {
         this.$el.append(`<div class="c-header-home_footer">
      <div class="o-container">
      <div class="c-header-home_controls -nomobile o-button-group">
      	<div class="js-parallax is-inview" data-speed="1" data-position="top" data-target="#js-header">
      		<button class="o-button -white -square -left js-slider-home-button js-slider-home-prev" type="button">
      			<span class="o-button_label">
      				<svg class="o-button_icon" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-prev"></use></svg>
      			</span>
      		</button>
      		<button class="o-button -white -square js-slider-home-button js-slider-home-next" type="button">
      			<span class="o-button_label">
      				<svg class="o-button_icon" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-next"></use></svg>
      			</span>
      		</button>
      	</div>
      </div>
      </div>
      </div>`);
       }
       */
      if (this.autoplay) {
        this.startAutoplay();
      }

      if (this.showPagination) {
        var paginationNumber = this.maxSlide;
        var pagination = '<div class="pagination"><div class="container">';

        for (var i = 0; i < this.maxSlide; i++) {
          var item = '<span class="pagination__item js-pagination-item ' + (i === 0 ? 'is-current' : '') + '" data-slide=' + (i + 1) + '>' + (i + 1) + '</span>';
          pagination = pagination + item;
        }

        pagination = pagination + '</div></div>';

        this.$el.append(pagination);
      }
    }
  }, {
    key: 'preventClick',
    value: function preventClick() {
      var _this2 = this;

      this.isAnimating = true;
      this.$controls.prop('disabled', true);
      clearInterval(this.interval);

      setTimeout(function () {
        _this2.isAnimating = false;
        _this2.$controls.prop('disabled', false);
        if (_this2.autoplay) {
          _this2.startAutoplay();
        }
      }, this.animationDuration);
    }
  }, {
    key: 'goToSlide',
    value: function goToSlide(index) {
      this.currentSlide = parseInt(index);

      if (this.currentSlide > this.maxSlide) {
        this.currentSlide = 1;
      }

      if (this.currentSlide === 0) {
        this.currentSlide = this.maxSlide;
      }

      var newCurrent = this.$el.find('.js-slider-home-slide[data-slide="' + this.currentSlide + '"]');
      var newPrev = this.currentSlide === 1 ? this.$el.find('.js-slider-home-slide').last() : newCurrent.prev('.js-slider-home-slide');
      var newNext = this.currentSlide === this.maxSlide ? this.$el.find('.js-slider-home-slide').first() : newCurrent.next('.js-slider-home-slide');

      this.$el.find('.js-slider-home-slide').removeClass('is-prev is-next is-current');
      this.$el.find('.js-pagination-item').removeClass('is-current');

      if (this.maxSlide > 1) {
        newPrev.addClass('is-prev');
        newNext.addClass('is-next');
      }

      newCurrent.addClass('is-current');
      this.$el.find('.js-pagination-item[data-slide="' + this.currentSlide + '"]').addClass('is-current');
    }
  }, {
    key: 'nextSlide',
    value: function nextSlide() {
      this.preventClick();
      this.goToSlide(this.currentSlide + 1);
    }
  }, {
    key: 'prevSlide',
    value: function prevSlide() {
      this.preventClick();
      this.goToSlide(this.currentSlide - 1);
    }
  }, {
    key: 'startAutoplay',
    value: function startAutoplay() {
      var _this3 = this;

      this.interval = setInterval(function () {
        if (!_this3.isAnimating) {
          _this3.nextSlide();
        }
      }, this.autoplaySpeed);
    }
  }, {
    key: 'destroy',
    value: function destroy() {
      this.$el.off();
    }
  }]);

  return Slideshow;
}();

(function () {
  var loaded = false;
  var maxLoad = 3000;

  function load() {
    var options = {
      showPagination: true
    };

    var slideShow = new Slideshow(options);
  }

  function addLoadClass() {
    $body.addClass('is-loaded');

    setTimeout(function () {
      $body.addClass('is-animated');
    }, 600);
  }

  $window.on('load', function () {
    if (!loaded) {
      loaded = true;
      load();
    }
  });

  setTimeout(function () {
    if (!loaded) {
      loaded = true;
      load();
    }
  }, maxLoad);

  addLoadClass();
})();