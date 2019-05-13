/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
  // Site title and description.
  wp.customize("blogname", function(value) {
    value.bind(function(to) {
      $(".site-title a").text(to);
    });
  });
  wp.customize("blogdescription", function(value) {
    value.bind(function(to) {
      $(".site-description").text(to);
    });
  });

  // Header text color.
  wp.customize("header_textcolor", function(value) {
    value.bind(function(to) {
      if ("blank" === to) {
        $(".site-title, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute"
        });
      } else {
        $(".site-title, .site-description").css({
          clip: "auto",
          position: "relative"
        });
        $(".site-title a, .site-description").css({
          color: to
        });
      }
    });
  });
})(jQuery);

// CSS Grid Annotator for IE 11
// Version: 0.2 by Tom Rothe
// URL: https://github.com/motine/css_grid_annotator
function cssGridAnnotate() {
  // check if we have IE11
  var agent = navigator.userAgent;
  var isIE11 = agent.indexOf("Trident") >= 0 && agent.indexOf("rv:11") >= 0;
  if (!isIE11) {
    return;
  }

  CSS_DISPLAY_GRID = "-ms-grid";
  CSS_TEMPLATE_COLS = "-ms-grid-columns";
  CSS_ROW = "-ms-grid-row";
  CSS_COL = "-ms-grid-column";

  function annotateAll(parentElement) {
    // we have to go through every single element to check the computed style
    // this is very performance heavy
    var elements = parentElement.querySelectorAll("*");
    for (var i = 0; i < elements.length; i++) {
      var elm = elements[i];
      if (isGridContainer(elm) && !containsAnnotations(elm)) {
        // we only check grid container, but we ignore the ones with pre-defined annotations
        annotateContainer(elm);
      }
    }
  }

  // it annotates the children with grid-column and grid-row, based on the grid-template-columns style attribute.
  function annotateContainer(container) {
    // determine columns
    var colCount = getTemplateColCount(container);
    if (!colCount) {
      return;
    }
    // annotate children
    var children = container.children;
    for (var i = 0, visibleIndex = 0; i < children.length; i++) {
      // i: which child do currently address?, visibleIndex: how many children were visible up until now? these two only differ if there are hidden elements
      var child = children[i];
      if (isHiddenElemeent(child)) {
        continue;
      }
      child.style[CSS_COL] = (visibleIndex % colCount) + 1;
      child.style[CSS_ROW] = Math.floor(visibleIndex / colCount) + 1;
      visibleIndex++;
    }
  }

  function handleInsert(ev) {
    if (ev.target && ev.target.parentElement) {
      annotateAll(ev.target.parentElement);
    }
  }

  function isGridContainer(elm) {
    var styles = window.getComputedStyle(elm);
    return styles.display === CSS_DISPLAY_GRID;
  }

  function isHiddenElemeent(elm) {
    return (
      elm.type === "hidden" ||
      window.getComputedStyle(elm).getPropertyValue("display") === "none"
    );
  }

  // returns true if any of the direct children has CSS_COL or CSS_ROW in their computed style.
  function containsAnnotations(elm) {
    var children = elm.children;
    for (var i = 0; i < children.length; i++) {
      var child = children[i];
      var styles = window.getComputedStyle(child);
      if (
        styles.getPropertyValue(CSS_COL) != "1" ||
        styles.getPropertyValue(CSS_ROW) != "1"
      ) {
        // IE will automatically determine that all elements are at (1, 1)
        return true;
      }
    }
    return false;
  }

  // returns the number of elements in a computed grid-template-columns attribute.
  // We do not need to consider functions such as repeat or minmax, because they are not supported by IE11 anyway (so either the autoprefixer resolves them or the style definition is broken for IE11 anyway).
  function getTemplateColCount(elm) {
    var styles = window.getComputedStyle(elm);
    var templateColumns = styles.getPropertyValue(CSS_TEMPLATE_COLS);
    if (!templateColumns) {
      return;
    }
    return templateColumns.split(" ").length;
  }

  annotateAll(document.body);
  window.addEventListener("DOMNodeInserted", handleInsert, false);
}

window.addEventListener("load", cssGridAnnotate);
