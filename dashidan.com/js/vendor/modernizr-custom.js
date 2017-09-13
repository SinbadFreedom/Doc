/*! modernizr 3.5.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-audio-canvas-canvastext-cookies-emoji-svg-video-setclasses !*/
!function (e, a, n) {
    function o(e, a) {
        return typeof e === a
    }
    
    function t() {
        var e, a, n, t, c, s, l;
        for (var p in r) {
            if (r.hasOwnProperty(p)) {
                if (e = [], a = r[p], a.name && (e.push(a.name.toLowerCase()), a.options && a.options.aliases
                    && a.options.aliases.length)) {
                    for (n = 0; n < a.options.aliases.length; n++) {
                        e.push(
                            a.options.aliases[n].toLowerCase());
                    }
                }
                for (t = o(a.fn, "function") ? a.fn() : a.fn, c = 0; c < e.length; c++) {
                    s = e[c], l = s.split("."), 1
                    === l.length ?
                        Modernizr[l[0]] =
                            t :
                        (!Modernizr[l[0]]
                        || Modernizr[l[0]] instanceof Boolean
                        || (Modernizr[l[0]] =
                            new Boolean(Modernizr[l[0]])), Modernizr[l[0]][l[1]] =
                            t), i.push(
                        (t ? "" : "no-") + l.join("-"))
                }
            }
        }
    }
    
    function c(e) {
        var a = p.className, n = Modernizr._config.classPrefix || "";
        if (d && (a = a.baseVal), Modernizr._config.enableJSClass) {
            var o = new RegExp("(^|\\s)" + n + "no-js(\\s|$)");
            a = a.replace(o, "$1" + n + "js$2")
        }
        Modernizr._config.enableClasses && (a += " " + n + e.join(" " + n), d ? p.className.baseVal = a :
            p.className = a)
    }
    
    function s() {
        return "function" != typeof a.createElement ? a.createElement(arguments[0]) :
            d ? a.createElementNS.call(a, "http://www.w3.org/2000/svg", arguments[0]) :
                a.createElement.apply(a, arguments)
    }
    
    var i = [], r = [], l = {
        _version: "3.5.0",
        _config: {classPrefix: "", enableClasses: !0, enableJSClass: !0, usePrefixes: !0},
        _q: [],
        on: function (e, a) {
            var n = this;
            setTimeout(function () {
                a(n[e])
            }, 0)
        },
        addTest: function (e, a, n) {
            r.push({name: e, fn: a, options: n})
        },
        addAsyncTest: function (e) {
            r.push({name: null, fn: e})
        }
    }, Modernizr = function () {
    };
    Modernizr.prototype = l, Modernizr = new Modernizr, Modernizr.addTest("cookies", function () {
        try {
            a.cookie = "cookietest=1";
            var e = -1 != a.cookie.indexOf("cookietest=");
            return a.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT", e
        } catch (n) {
            return !1
        }
    });
    var p = a.documentElement, d = "svg" === p.nodeName.toLowerCase();
    Modernizr.addTest("audio", function () {
        var e = s("audio"), a = !1;
        try {
            a = !!e.canPlayType, a && (a = new Boolean(a), a.ogg =
                e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/, ""), a.mp3 =
                e.canPlayType('audio/mpeg; codecs="mp3"').replace(/^no$/, ""), a.opus =
                e.canPlayType('audio/ogg; codecs="opus"') || e.canPlayType('audio/webm; codecs="opus"').replace(/^no$/,
                    ""), a.wav =
                e.canPlayType('audio/wav; codecs="1"').replace(/^no$/, ""), a.m4a =
                (e.canPlayType("audio/x-m4a;") || e.canPlayType("audio/aac;")).replace(/^no$/, ""))
        } catch (n) {
        }
        return a
    }), Modernizr.addTest("canvas", function () {
        var e = s("canvas");
        return !(!e.getContext || !e.getContext("2d"))
    }), Modernizr.addTest("canvastext", function () {
        return Modernizr.canvas === !1 ? !1 : "function" == typeof s("canvas").getContext("2d").fillText
    }), Modernizr.addTest("emoji", function () {
        if (!Modernizr.canvastext) {
            return !1;
        }
        var a = e.devicePixelRatio || 1, n = 12 * a, o = s("canvas"), t = o.getContext("2d");
        return t.fillStyle = "#f00", t.textBaseline = "top", t.font = "32px Arial", t.fillText("🐨", 0, 0), 0
        !== t.getImageData(
            n, n, 1, 1).data[0]
    }), Modernizr.addTest("video", function () {
        var e = s("video"), a = !1;
        try {
            a = !!e.canPlayType, a && (a = new Boolean(a), a.ogg =
                e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, ""), a.h264 =
                e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, ""), a.webm =
                e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, ""), a.vp9 =
                e.canPlayType('video/webm; codecs="vp9"').replace(/^no$/, ""), a.hls =
                e.canPlayType('application/x-mpegURL; codecs="avc1.42E01E"').replace(/^no$/, ""))
        } catch (n) {
        }
        return a
    }), Modernizr.addTest("svg", !!a.createElementNS && !!a.createElementNS("http://www.w3.org/2000/svg",
            "svg").createSVGRect), t(), c(
        i), delete l.addTest, delete l.addAsyncTest;
    for (var u = 0; u < Modernizr._q.length; u++) {
        Modernizr._q[u]();
    }
    e.Modernizr = Modernizr
}(window, document);
