/**
 * Admin Settings JS
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

(function ($) {
  'use strict';

  $(document).ready(function () {
    // Smooth toggling feedback on switch change
    $('.ute-switch input').on('change', function () {
      var row = $(this).closest('.ute-widget-toggle-row');
      if ($(this).is(':checked')) {
        row.css('opacity', '1');
      } else {
        row.css('opacity', '0.6');
      }
    });
  });
})(jQuery);
