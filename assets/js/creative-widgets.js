/**
 * Vanilla Frontend JS for Painter Creative Elementor Widgets
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

(function () {
  'use strict';

  function initCreativeWidgets() {
    // Accessibility keyboard support for role="button" elements
    var customButtons = document.querySelectorAll('.ute-creative-button[role="button"]');
    customButtons.forEach(function (btn) {
      btn.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          btn.click();
        }
      });
    });

    // Handle paint roller micro-tilt if dynamic movement is enabled
    var tiltButtons = document.querySelectorAll('.ute-hover-paint_movement');
    tiltButtons.forEach(function (button) {
      button.addEventListener('mousemove', function (e) {
        var rect = button.getBoundingClientRect();
        var x = e.clientX - rect.left - rect.width / 2;
        var y = e.clientY - rect.top - rect.height / 2;
        var roller = button.querySelector('.ute-roller-wrap');
        if (roller) {
          roller.style.transform = 'translate(' + (x * 0.08) + 'px, ' + (y * 0.08) + 'px) rotate(' + (x * 0.04) + 'deg)';
        }
      });

      button.addEventListener('mouseleave', function () {
        var roller = button.querySelector('.ute-roller-wrap');
        if (roller) {
          roller.style.transform = '';
        }
      });
    });
  }

  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCreativeWidgets);
  } else {
    initCreativeWidgets();
  }

  // Hook into Elementor frontend if present
  window.addEventListener('elementor/frontend/init', function () {
    if (window.elementorFrontend && window.elementorFrontend.hooks) {
      window.elementorFrontend.hooks.addAction('frontend/element_ready/ute_creative_button.default', initCreativeWidgets);
      window.elementorFrontend.hooks.addAction('frontend/element_ready/ute_creative_heading.default', initCreativeWidgets);
    }
  });
})();
