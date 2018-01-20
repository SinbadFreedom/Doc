/**
 * jQuery Lined Textarea Plugin
 *   http://alan.blog-city.com/jquerylinedtextarea.htm
 *
 * Copyright (c) 2010 Alan Williamson
 *
 * Contributions done by Ryan Zielke (NeoAlchemy@gmail.com)
 *
 * Version:
 *    $Id: jquery-linedtextarea.js 464 2010-01-08 10:36:33Z alan $
 *
 * Released under the MIT License:
 *    http://www.opensource.org/licenses/mit-license.php
 *
 * Usage:
 *   Displays a line number count column to the left of the textarea
 *
 *   Class up your textarea with a given class, or target it directly
 *   with JQuery Selectors
 *
 *   $(".lined").linedtextarea({
 *   	selectedLine: 10,
 *    selectedClass: 'lineselect'
 *   });
 *
 * History:
 *   - 2011.12.08: Changes to allow resizing and not affect styling of the outer div
 *   - 2010.01.08: Fixed a Google Chrome layout problem
 *   - 2010.01.07: Refactored code for speed/readability; Fixed horizontal sizing
 *   - 2010.01.06: Initial Release
 *
 */
(function ($) {
    $.fn.linedtextarea = function (options) {

        // Get the Options
        var opts = $.extend({}, $.fn.linedtextarea.defaults, options);

        /*
         * Helper function to make sure the line numbers are always
         * kept up to the current system
         */
        var fillOutLines = function (codeLines, h, lineNo) {
            while ((codeLines.height() - h) <= 0) {
                if (lineNo == opts.selectedLine) {
                    codeLines.append("<div class='lineno lineselect'>" + lineNo + "</div>");
                } else {
                    codeLines.append("<div class='lineno'>" + lineNo + "</div>");
                }

                lineNo++;
            }
            return lineNo;
        };

        var lineNo = 1;
        var textarea = $(this);
        textarea.scroll(function (tn) {
            var domTextArea = $(this)[0];
            var scrollTop = domTextArea.scrollTop;
            var clientHeight = domTextArea.clientHeight;
            codeLinesDiv.css({'margin-top': (-1 * scrollTop) + "px"});
            lineNo = fillOutLines(codeLinesDiv, scrollTop + clientHeight, lineNo);
        });

        /* Should the textarea get resized outside of our control */
        textarea.resize(function (tn) {
            var domTextArea = $(this)[0];
            linesDiv.height(domTextArea.clientHeight + 6);
        });

        window.setInterval(function (tn) {
            linesDiv.height(textarea.height());
            var scrollTop = textarea[0].scrollTop;
            var clientHeight = textarea[0].clientHeight;
            codeLinesDiv.css({'margin-top': (-1 * scrollTop) + "px"});
            lineNo = fillOutLines(codeLinesDiv, scrollTop + clientHeight, lineNo);
        }, 10);
    };

    // default options
    $.fn.linedtextarea.defaults = {
        selectedLine: -1,
        selectedClass: 'lineselect'
    };
})(jQuery);
