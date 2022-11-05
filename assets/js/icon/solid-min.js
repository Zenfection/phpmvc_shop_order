/*!
 * Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license (Commercial License)
 * Copyright 2022 Fonticons, Inc.
 */
! function () {
    "use strict";
    var c = {},
        s = {};
    try {
        "undefined" != typeof window && (c = window), "undefined" != typeof document && (s = document)
    } catch (c) {}
    var l = (c.navigator || {}).userAgent,
        z = void 0 === l ? "" : l,
        H = c,
        V = s;
    H.document, V.documentElement && V.head && "function" == typeof V.addEventListener && V.createElement, ~z.indexOf("MSIE") || z.indexOf("Trident/");

    function M(s, c) {
        var l, z = Object.keys(s);
        return Object.getOwnPropertySymbols && (l = Object.getOwnPropertySymbols(s), c && (l = l.filter(function (c) {
            return Object.getOwnPropertyDescriptor(s, c).enumerable
        })), z.push.apply(z, l)), z
    }

    function e(s) {
        for (var c = 1; c < arguments.length; c++) {
            var l = null != arguments[c] ? arguments[c] : {};
            c % 2 ? M(Object(l), !0).forEach(function (c) {
                L(s, c, l[c])
            }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(s, Object.getOwnPropertyDescriptors(l)) : M(Object(l)).forEach(function (c) {
                Object.defineProperty(s, c, Object.getOwnPropertyDescriptor(l, c))
            })
        }
        return s
    }

    function L(c, s, l) {
        return s in c ? Object.defineProperty(c, s, {
            value: l,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : c[s] = l, c
    }

    function C(c, s) {
        (null == s || s > c.length) && (s = c.length);
        for (var l = 0, z = new Array(s); l < s; l++) z[l] = c[l];
        return z
    }
    var h = "___FONT_AWESOME___",
        m = function () {
            try {
                return !0
            } catch (c) {
                return !1
            }
        }(),
        a = "classic",
        r = "sharp",
        v = [a, r];

    function o(c) {
        return new Proxy(c, {
            get: function (c, s) {
                return s in c ? c[s] : c[a]
            }
        })
    }
    o((L(f = {}, a, {
        fa: "solid",
        fas: "solid",
        "fa-solid": "solid",
        far: "regular",
        "fa-regular": "regular",
        fal: "light",
        "fa-light": "light",
        fat: "thin",
        "fa-thin": "thin",
        fad: "duotone",
        "fa-duotone": "duotone",
        fab: "brands",
        "fa-brands": "brands",
        fak: "kit",
        "fa-kit": "kit"
    }), L(f, r, {
        fa: "solid",
        fass: "solid",
        "fa-solid": "solid"
    }), f));
    var t = o((L(i = {}, a, {
            solid: "fas",
            regular: "far",
            light: "fal",
            thin: "fat",
            duotone: "fad",
            brands: "fab",
            kit: "fak"
        }), L(i, r, {
            solid: "fass"
        }), i)),
        V = (o((L(l = {}, a, {
            fab: "fa-brands",
            fad: "fa-duotone",
            fak: "fa-kit",
            fal: "fa-light",
            far: "fa-regular",
            fas: "fa-solid",
            fat: "fa-thin"
        }), L(l, r, {
            fass: "fa-solid"
        }), l)), o((L(c = {}, a, {
            "fa-brands": "fab",
            "fa-duotone": "fad",
            "fa-kit": "fak",
            "fa-light": "fal",
            "fa-regular": "far",
            "fa-solid": "fas",
            "fa-thin": "fat"
        }), L(c, r, {
            "fa-solid": "fass"
        }), c)), o((L(s = {}, a, {
            900: "fas",
            400: "far",
            normal: "far",
            300: "fal",
            100: "fat"
        }), L(s, r, {
            900: "fass"
        }), s)), [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        z = V.concat([11, 12, 13, 14, 15, 16, 17, 18, 19, 20]),
        f = "duotone-group",
        i = "swap-opacity",
        l = "primary",
        c = "secondary",
        s = new Set;
    Object.keys(t[a]).map(s.add.bind(s)), Object.keys(t[r]).map(s.add.bind(s));
    [].concat(v, function (c) {
        if (Array.isArray(c)) return C(c)
    }(s = s) || function (c) {
        if ("undefined" != typeof Symbol && null != c[Symbol.iterator] || null != c["@@iterator"]) return Array.from(c)
    }(s) || function (c, s) {
        if (c) {
            if ("string" == typeof c) return C(c, s);
            var l = Object.prototype.toString.call(c).slice(8, -1);
            return "Map" === (l = "Object" === l && c.constructor ? c.constructor.name : l) || "Set" === l ? Array.from(c) : "Arguments" === l || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(l) ? C(c, s) : void 0
        }
    }(s) || function () {
        throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
    }(), ["2xs", "xs", "sm", "lg", "xl", "2xl", "beat", "border", "fade", "beat-fade", "bounce", "flip-both", "flip-horizontal", "flip-vertical", "flip", "fw", "inverse", "layers-counter", "layers-text", "layers", "li", "pull-left", "pull-right", "pulse", "rotate-180", "rotate-270", "rotate-90", "rotate-by", "shake", "spin-pulse", "spin-reverse", "spin", "stack-1x", "stack-2x", "stack", "ul", f, i, l, c]).concat(V.map(function (c) {
        return "".concat(c, "x")
    })).concat(z.map(function (c) {
        return "w-".concat(c)
    }));
    H = H || {};
    H[h] || (H[h] = {}), H[h].styles || (H[h].styles = {}), H[h].hooks || (H[h].hooks = {}), H[h].shims || (H[h].shims = []);
    var n = H[h];

    function d(z) {
        return Object.keys(z).reduce(function (c, s) {
            var l = z[s];
            return !!l.icon ? c[l.iconName] = l.icon : c[s] = l, c
        }, {})
    }

    function S(c, s, l) {
        var z = (2 < arguments.length && void 0 !== l ? l : {}).skipHooks,
            l = void 0 !== z && z,
            z = d(s);
        "function" != typeof n.hooks.addPack || l ? n.styles[c] = e(e({}, n.styles[c] || {}), z) : n.hooks.addPack(c, d(s)), "fas" === c && S("fa", s)
    }
    var u = {
        star: [576, 512, [11088, 61446], "f005", "M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"],
        
        "star-half": [576, 512, [61731], "f089", "M288 0c-12.2 .1-23.3 7-28.6 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3L288 439.8V0zM429.9 512c1.1 .1 2.1 .1 3.2 0h-3.2z"],

    };
    ! function (c) {
        try {
            for (var s = arguments.length, l = new Array(1 < s ? s - 1 : 0), z = 1; z < s; z++) l[z - 1] = arguments[z];
            c.apply(void 0, l)
        } catch (c) {
            if (!m) throw c
        }
    }(function () {
        S("fas", u), S("fa-solid", u)
    })
}();