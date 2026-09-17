/**
 * Elementor Editor Canvas Reactivity Helper
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

(function () {
  'use strict';

  // Synchronize UTE_Editor_Data between parent window and iframe preview canvas
  function syncEditorData() {
    if (typeof window === 'undefined') return;

    if (!window.UTE_Editor_Data) {
      if (window.parent && window.parent.UTE_Editor_Data) {
        window.UTE_Editor_Data = window.parent.UTE_Editor_Data;
      } else if (window.top && window.top.UTE_Editor_Data) {
        window.UTE_Editor_Data = window.top.UTE_Editor_Data;
      }
    } else {
      // If defined in iframe, ensure parent also has it
      if (window.parent && !window.parent.UTE_Editor_Data) {
        window.parent.UTE_Editor_Data = window.UTE_Editor_Data;
      }
    }
  }

  syncEditorData();

  // Re-sync on DOM ready and load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', syncEditorData);
  }
  window.addEventListener('load', syncEditorData);

  // Hook into Elementor Frontend once initialized
  window.addEventListener('elementor/frontend/init', function () {
    syncEditorData();

    if (!window.elementorFrontend || !window.elementorFrontend.hooks) {
      return;
    }

    // Refresh live preview on editor changes
    window.elementorFrontend.hooks.addAction('frontend/element_ready/ute_creative_button.default', function ($scope) {
      syncEditorData();
      var button = $scope[0] ? $scope[0].querySelector('.ute-creative-button') : null;
      if (button) {
        button.classList.add('ute-editor-ready');
      }
    });

    window.elementorFrontend.hooks.addAction('frontend/element_ready/ute_creative_heading.default', function ($scope) {
      syncEditorData();
      var heading = $scope[0] ? $scope[0].querySelector('.ute-creative-heading') : null;
      if (heading) {
        heading.classList.add('ute-editor-ready');
      }
    });
  });
})();
