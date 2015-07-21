function getFrameID(e) {
    var t = document.getElementById(e);
    if (t) {
        if (/^iframe$/i.test(t.tagName)) return e;
        var n = t.getElementsByTagName("iframe");
        if (!n.length) return null;
        for (var i = 0; n.length > i && !/^https?:\/\/(?:www\.)?youtube(?:-nocookie)?\.com(\/|$)/i.test(n[i].src); i++);
        if (t = n[i], t.id) return t.id;
        do e += "-frame"; while (document.getElementById(e));
        return t.id = e, e
    }
    return null
}

function onYouTubePlayerAPIReady() {
    YT_ready(!0)
}

function onYouTubePlayerReady() {
    Player_ready(!0)
}
void 0 === jQuery.migrateMute && (jQuery.migrateMute = !0),
function (e, t, n) {
    function i(n) {
        s[n] || (s[n] = !0, e.migrateWarnings.push(n), t.console && console.warn && !e.migrateMute && (console.warn("JQMIGRATE: " + n), e.migrateTrace && console.trace && console.trace()))
    }

    function r(t, r, s, a) {
        if (Object.defineProperty) try {
            return Object.defineProperty(t, r, {
                configurable: !0,
                enumerable: !0,
                get: function () {
                    return i(a), s
                },
                set: function (e) {
                    i(a), s = e
                }
            }), n
        } catch (o) {}
        e._definePropertyBroken = !0, t[r] = s
    }
    var s = {};
    e.migrateWarnings = [], !e.migrateMute && t.console && console.log && console.log("JQMIGRATE: Logging is active"), e.migrateTrace === n && (e.migrateTrace = !0), e.migrateReset = function () {
        s = {}, e.migrateWarnings.length = 0
    }, "BackCompat" === document.compatMode && i("jQuery is not compatible with Quirks Mode");
    var a = e("<input/>", {
        size: 1
    }).attr("size") && e.attrFn,
        o = e.attr,
        u = e.attrHooks.value && e.attrHooks.value.get || function () {
            return null
        }, l = e.attrHooks.value && e.attrHooks.value.set || function () {
            return n
        }, c = /^(?:input|button)$/i,
        d = /^[238]$/,
        h = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
        p = /^(?:checked|selected)$/i;
    r(e, "attrFn", a || {}, "jQuery.attrFn is deprecated"), e.attr = function (t, r, s, u) {
        var l = r.toLowerCase(),
            f = t && t.nodeType;
        return u && (4 > o.length && i("jQuery.fn.attr( props, pass ) is deprecated"), t && !d.test(f) && (a ? r in a : e.isFunction(e.fn[r]))) ? e(t)[r](s) : ("type" === r && s !== n && c.test(t.nodeName) && t.parentNode && i("Can't change the 'type' of an input or button in IE 6/7/8"), !e.attrHooks[l] && h.test(l) && (e.attrHooks[l] = {
            get: function (t, i) {
                var r, s = e.prop(t, i);
                return s === !0 || "boolean" != typeof s && (r = t.getAttributeNode(i)) && r.nodeValue !== !1 ? i.toLowerCase() : n
            },
            set: function (t, n, i) {
                var r;
                return n === !1 ? e.removeAttr(t, i) : (r = e.propFix[i] || i, r in t && (t[r] = !0), t.setAttribute(i, i.toLowerCase())), i
            }
        }, p.test(l) && i("jQuery.fn.attr('" + l + "') may use property instead of attribute")), o.call(e, t, r, s))
    }, e.attrHooks.value = {
        get: function (e, t) {
            var n = (e.nodeName || "").toLowerCase();
            return "button" === n ? u.apply(this, arguments) : ("input" !== n && "option" !== n && i("jQuery.fn.attr('value') no longer gets properties"), t in e ? e.value : null)
        },
        set: function (e, t) {
            var r = (e.nodeName || "").toLowerCase();
            return "button" === r ? l.apply(this, arguments) : ("input" !== r && "option" !== r && i("jQuery.fn.attr('value', val) no longer sets properties"), e.value = t, n)
        }
    };
    var f, m, v = e.fn.init,
        g = e.parseJSON,
        _ = /^(?:[^<]*(<[\w\W]+>)[^>]*|#([\w\-]*))$/;
    e.fn.init = function (t, n, r) {
        var s;
        return t && "string" == typeof t && !e.isPlainObject(n) && (s = _.exec(t)) && s[1] && ("<" !== t.charAt(0) && i("$(html) HTML strings must start with '<' character"), n && n.context && (n = n.context), e.parseHTML) ? v.call(this, e.parseHTML(e.trim(t), n, !0), n, r) : v.apply(this, arguments)
    }, e.fn.init.prototype = e.fn, e.parseJSON = function (e) {
        return e || null === e ? g.apply(this, arguments) : (i("jQuery.parseJSON requires a valid JSON string"), null)
    }, e.uaMatch = function (e) {
        e = e.toLowerCase();
        var t = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || 0 > e.indexOf("compatible") && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];
        return {
            browser: t[1] || "",
            version: t[2] || "0"
        }
    }, e.browser || (f = e.uaMatch(navigator.userAgent), m = {}, f.browser && (m[f.browser] = !0, m.version = f.version), m.chrome ? m.webkit = !0 : m.webkit && (m.safari = !0), e.browser = m), r(e, "browser", e.browser, "jQuery.browser is deprecated"), e.sub = function () {
        function t(e, n) {
            return new t.fn.init(e, n)
        }
        e.extend(!0, t, this), t.superclass = this, t.fn = t.prototype = this(), t.fn.constructor = t, t.sub = this.sub, t.fn.init = function (i, r) {
            return r && r instanceof e && !(r instanceof t) && (r = t(r)), e.fn.init.call(this, i, r, n)
        }, t.fn.init.prototype = t.fn;
        var n = t(document);
        return i("jQuery.sub() is deprecated"), t
    }, e.ajaxSetup({
        converters: {
            "text json": e.parseJSON
        }
    });
    var y = e.fn.data;
    e.fn.data = function (t) {
        var r, s, a = this[0];
        return !a || "events" !== t || 1 !== arguments.length || (r = e.data(a, t), s = e._data(a, t), r !== n && r !== s || s === n) ? y.apply(this, arguments) : (i("Use of jQuery.fn.data('events') is deprecated"), s)
    };
    var b = /\/(java|ecma)script/i,
        w = e.fn.andSelf || e.fn.addBack;
    e.fn.andSelf = function () {
        return i("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"), w.apply(this, arguments)
    }, e.clean || (e.clean = function (t, r, s, a) {
        r = r || document, r = !r.nodeType && r[0] || r, r = r.ownerDocument || r, i("jQuery.clean() is deprecated");
        var o, u, l, c, d = [];
        if (e.merge(d, e.buildFragment(t, r).childNodes), s)
            for (l = function (e) {
                return !e.type || b.test(e.type) ? a ? a.push(e.parentNode ? e.parentNode.removeChild(e) : e) : s.appendChild(e) : n
            }, o = 0; null != (u = d[o]); o++) e.nodeName(u, "script") && l(u) || (s.appendChild(u), u.getElementsByTagName !== n && (c = e.grep(e.merge([], u.getElementsByTagName("script")), l), d.splice.apply(d, [o + 1, 0].concat(c)), o += c.length));
        return d
    });
    var V = e.event.add,
        x = e.event.remove,
        E = e.event.trigger,
        T = e.fn.toggle,
        C = e.fn.live,
        k = e.fn.die,
        S = "ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",
        M = RegExp("\\b(?:" + S + ")\\b"),
        j = /(?:^|\s)hover(\.\S+|)\b/,
        N = function (t) {
            return "string" != typeof t || e.event.special.hover ? t : (j.test(t) && i("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"), t && t.replace(j, "mouseenter$1 mouseleave$1"))
        };
    e.event.props && "attrChange" !== e.event.props[0] && e.event.props.unshift("attrChange", "attrName", "relatedNode", "srcElement"), e.event.dispatch && r(e.event, "handle", e.event.dispatch, "jQuery.event.handle is undocumented and deprecated"), e.event.add = function (e, t, n, r, s) {
        e !== document && M.test(t) && i("AJAX events should be attached to document: " + t), V.call(this, e, N(t || ""), n, r, s)
    }, e.event.remove = function (e, t, n, i, r) {
        x.call(this, e, N(t) || "", n, i, r)
    }, e.fn.error = function () {
        var e = Array.prototype.slice.call(arguments, 0);
        return i("jQuery.fn.error() is deprecated"), e.splice(0, 0, "error"), arguments.length ? this.bind.apply(this, e) : (this.triggerHandler.apply(this, e), this)
    }, e.fn.toggle = function (t, n) {
        if (!e.isFunction(t) || !e.isFunction(n)) return T.apply(this, arguments);
        i("jQuery.fn.toggle(handler, handler...) is deprecated");
        var r = arguments,
            s = t.guid || e.guid++,
            a = 0,
            o = function (n) {
                var i = (e._data(this, "lastToggle" + t.guid) || 0) % a;
                return e._data(this, "lastToggle" + t.guid, i + 1), n.preventDefault(), r[i].apply(this, arguments) || !1
            };
        for (o.guid = s; r.length > a;) r[a++].guid = s;
        return this.click(o)
    }, e.fn.live = function (t, n, r) {
        return i("jQuery.fn.live() is deprecated"), C ? C.apply(this, arguments) : (e(this.context).on(t, this.selector, n, r), this)
    }, e.fn.die = function (t, n) {
        return i("jQuery.fn.die() is deprecated"), k ? k.apply(this, arguments) : (e(this.context).off(t, this.selector || "**", n), this)
    }, e.event.trigger = function (e, t, n, r) {
        return n || M.test(e) || i("Global events are undocumented and deprecated"), E.call(this, e, t, n || document, r)
    }, e.each(S.split("|"), function (t, n) {
        e.event.special[n] = {
            setup: function () {
                var t = this;
                return t !== document && (e.event.add(document, n + "." + e.guid, function () {
                    e.event.trigger(n, null, t, !0)
                }), e._data(this, n, e.guid++)), !1
            },
            teardown: function () {
                return this !== document && e.event.remove(document, n + "." + e._data(this, n)), !1
            }
        }
    })
}(jQuery, window),
function (e, t) {
    function n(t, n) {
        var r = t.nodeName.toLowerCase();
        if ("area" === r) {
            var s, a = t.parentNode,
                o = a.name;
            return t.href && o && "map" === a.nodeName.toLowerCase() ? (s = e("img[usemap=#" + o + "]")[0], !! s && i(s)) : !1
        }
        return (/input|select|textarea|button|object/.test(r) ? !t.disabled : "a" == r ? t.href || n : n) && i(t)
    }

    function i(t) {
        return !e(t).parents().andSelf().filter(function () {
            return "hidden" === e.curCSS(this, "visibility") || e.expr.filters.hidden(this)
        }).length
    }
    e.ui = e.ui || {}, e.ui.version || (e.extend(e.ui, {
        version: "1.8.22",
        keyCode: {
            ALT: 18,
            BACKSPACE: 8,
            CAPS_LOCK: 20,
            COMMA: 188,
            COMMAND: 91,
            COMMAND_LEFT: 91,
            COMMAND_RIGHT: 93,
            CONTROL: 17,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            INSERT: 45,
            LEFT: 37,
            MENU: 93,
            NUMPAD_ADD: 107,
            NUMPAD_DECIMAL: 110,
            NUMPAD_DIVIDE: 111,
            NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106,
            NUMPAD_SUBTRACT: 109,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SHIFT: 16,
            SPACE: 32,
            TAB: 9,
            UP: 38,
            WINDOWS: 91
        }
    }), e.fn.extend({
        propAttr: e.fn.prop || e.fn.attr,
        _focus: e.fn.focus,
        focus: function (t, n) {
            return "number" == typeof t ? this.each(function () {
                var i = this;
                setTimeout(function () {
                    e(i).focus(), n && n.call(i)
                }, t)
            }) : this._focus.apply(this, arguments)
        },
        scrollParent: function () {
            var t;
            return t = e.browser.msie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function () {
                return /(relative|absolute|fixed)/.test(e.curCSS(this, "position", 1)) && /(auto|scroll)/.test(e.curCSS(this, "overflow", 1) + e.curCSS(this, "overflow-y", 1) + e.curCSS(this, "overflow-x", 1))
            }).eq(0) : this.parents().filter(function () {
                return /(auto|scroll)/.test(e.curCSS(this, "overflow", 1) + e.curCSS(this, "overflow-y", 1) + e.curCSS(this, "overflow-x", 1))
            }).eq(0), /fixed/.test(this.css("position")) || !t.length ? e(document) : t
        },
        zIndex: function (n) {
            if (n !== t) return this.css("zIndex", n);
            if (this.length)
                for (var i, r, s = e(this[0]); s.length && s[0] !== document;) {
                    if (i = s.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (r = parseInt(s.css("zIndex"), 10), !isNaN(r) && 0 !== r)) return r;
                    s = s.parent()
                }
            return 0
        },
        disableSelection: function () {
            return this.bind((e.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function (e) {
                e.preventDefault()
            })
        },
        enableSelection: function () {
            return this.unbind(".ui-disableSelection")
        }
    }), e("<a>").outerWidth(1).jquery || e.each(["Width", "Height"], function (n, i) {
        function r(t, n, i, r) {
            return e.each(s, function () {
                n -= parseFloat(e.curCSS(t, "padding" + this, !0)) || 0, i && (n -= parseFloat(e.curCSS(t, "border" + this + "Width", !0)) || 0), r && (n -= parseFloat(e.curCSS(t, "margin" + this, !0)) || 0)
            }), n
        }
        var s = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
            a = i.toLowerCase(),
            o = {
                innerWidth: e.fn.innerWidth,
                innerHeight: e.fn.innerHeight,
                outerWidth: e.fn.outerWidth,
                outerHeight: e.fn.outerHeight
            };
        e.fn["inner" + i] = function (n) {
            return n === t ? o["inner" + i].call(this) : this.each(function () {
                e(this).css(a, r(this, n) + "px")
            })
        }, e.fn["outer" + i] = function (t, n) {
            return "number" != typeof t ? o["outer" + i].call(this, t) : this.each(function () {
                e(this).css(a, r(this, t, !0, n) + "px")
            })
        }
    }), e.extend(e.expr[":"], {
        data: e.expr.createPseudo ? e.expr.createPseudo(function (t) {
            return function (n) {
                return !!e.data(n, t)
            }
        }) : function (t, n, i) {
            return !!e.data(t, i[3])
        },
        focusable: function (t) {
            return n(t, !isNaN(e.attr(t, "tabindex")))
        },
        tabbable: function (t) {
            var i = e.attr(t, "tabindex"),
                r = isNaN(i);
            return (r || i >= 0) && n(t, !r)
        }
    }), e(function () {
        var t = document.body,
            n = t.appendChild(n = document.createElement("div"));
        n.offsetHeight, e.extend(n.style, {
            minHeight: "100px",
            height: "auto",
            padding: 0,
            borderWidth: 0
        }), e.support.minHeight = 100 === n.offsetHeight, e.support.selectstart = "onselectstart" in n, t.removeChild(n).style.display = "none"
    }), e.curCSS || (e.curCSS = e.css), e.extend(e.ui, {
        plugin: {
            add: function (t, n, i) {
                var r = e.ui[t].prototype;
                for (var s in i) r.plugins[s] = r.plugins[s] || [], r.plugins[s].push([n, i[s]])
            },
            call: function (e, t, n) {
                var i = e.plugins[t];
                if (i && e.element[0].parentNode)
                    for (var r = 0; i.length > r; r++) e.options[i[r][0]] && i[r][1].apply(e.element, n)
            }
        },
        contains: function (e, t) {
            return document.compareDocumentPosition ? 16 & e.compareDocumentPosition(t) : e !== t && e.contains(t)
        },
        hasScroll: function (t, n) {
            if ("hidden" === e(t).css("overflow")) return !1;
            var i = n && "left" === n ? "scrollLeft" : "scrollTop",
                r = !1;
            return t[i] > 0 ? !0 : (t[i] = 1, r = t[i] > 0, t[i] = 0, r)
        },
        isOverAxis: function (e, t, n) {
            return e > t && t + n > e
        },
        isOver: function (t, n, i, r, s, a) {
            return e.ui.isOverAxis(t, i, s) && e.ui.isOverAxis(n, r, a)
        }
    }))
}(jQuery),
function (e, t) {
    if (e.cleanData) {
        var n = e.cleanData;
        e.cleanData = function (t) {
            for (var i, r = 0; null != (i = t[r]); r++) try {
                e(i).triggerHandler("remove")
            } catch (s) {}
            n(t)
        }
    } else {
        var i = e.fn.remove;
        e.fn.remove = function (t, n) {
            return this.each(function () {
                return n || (!t || e.filter(t, [this]).length) && e("*", this).add([this]).each(function () {
                    try {
                        e(this).triggerHandler("remove")
                    } catch (t) {}
                }), i.call(e(this), t, n)
            })
        }
    }
    e.widget = function (t, n, i) {
        var r, s = t.split(".")[0];
        t = t.split(".")[1], r = s + "-" + t, i || (i = n, n = e.Widget), e.expr[":"][r] = function (n) {
            return !!e.data(n, t)
        }, e[s] = e[s] || {}, e[s][t] = function (e, t) {
            arguments.length && this._createWidget(e, t)
        };
        var a = new n;
        a.options = e.extend(!0, {}, a.options), e[s][t].prototype = e.extend(!0, a, {
            namespace: s,
            widgetName: t,
            widgetEventPrefix: e[s][t].prototype.widgetEventPrefix || t,
            widgetBaseClass: r
        }, i), e.widget.bridge(t, e[s][t])
    }, e.widget.bridge = function (n, i) {
        e.fn[n] = function (r) {
            var s = "string" == typeof r,
                a = Array.prototype.slice.call(arguments, 1),
                o = this;
            return r = !s && a.length ? e.extend.apply(null, [!0, r].concat(a)) : r, s && "_" === r.charAt(0) ? o : (s ? this.each(function () {
                var i = e.data(this, n),
                    s = i && e.isFunction(i[r]) ? i[r].apply(i, a) : i;
                return s !== i && s !== t ? (o = s, !1) : void 0
            }) : this.each(function () {
                var t = e.data(this, n);
                t ? t.option(r || {})._init() : e.data(this, n, new i(r, this))
            }), o)
        }
    }, e.Widget = function (e, t) {
        arguments.length && this._createWidget(e, t)
    }, e.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        options: {
            disabled: !1
        },
        _createWidget: function (t, n) {
            e.data(n, this.widgetName, this), this.element = e(n), this.options = e.extend(!0, {}, this.options, this._getCreateOptions(), t);
            var i = this;
            this.element.bind("remove." + this.widgetName, function () {
                i.destroy()
            }), this._create(), this._trigger("create"), this._init()
        },
        _getCreateOptions: function () {
            return e.metadata && e.metadata.get(this.element[0])[this.widgetName]
        },
        _create: function () {},
        _init: function () {},
        destroy: function () {
            this.element.unbind("." + this.widgetName).removeData(this.widgetName), this.widget().unbind("." + this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass + "-disabled " + "ui-state-disabled")
        },
        widget: function () {
            return this.element
        },
        option: function (n, i) {
            var r = n;
            if (0 === arguments.length) return e.extend({}, this.options);
            if ("string" == typeof n) {
                if (i === t) return this.options[n];
                r = {}, r[n] = i
            }
            return this._setOptions(r), this
        },
        _setOptions: function (t) {
            var n = this;
            return e.each(t, function (e, t) {
                n._setOption(e, t)
            }), this
        },
        _setOption: function (e, t) {
            return this.options[e] = t, "disabled" === e && this.widget()[t ? "addClass" : "removeClass"](this.widgetBaseClass + "-disabled" + " " + "ui-state-disabled").attr("aria-disabled", t), this
        },
        enable: function () {
            return this._setOption("disabled", !1)
        },
        disable: function () {
            return this._setOption("disabled", !0)
        },
        _trigger: function (t, n, i) {
            var r, s, a = this.options[t];
            if (i = i || {}, n = e.Event(n), n.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), n.target = this.element[0], s = n.originalEvent, s)
                for (r in s) r in n || (n[r] = s[r]);
            return this.element.trigger(n, i), !(e.isFunction(a) && a.call(this.element[0], n, i) === !1 || n.isDefaultPrevented())
        }
    }
}(jQuery),
function (e) {
    var t = !1;
    e(document).mouseup(function () {
        t = !1
    }), e.widget("ui.mouse", {
        options: {
            cancel: ":input,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function () {
            var t = this;
            this.element.bind("mousedown." + this.widgetName, function (e) {
                return t._mouseDown(e)
            }).bind("click." + this.widgetName, function (n) {
                return !0 === e.data(n.target, t.widgetName + ".preventClickEvent") ? (e.removeData(n.target, t.widgetName + ".preventClickEvent"), n.stopImmediatePropagation(), !1) : void 0
            }), this.started = !1
        },
        _mouseDestroy: function () {
            this.element.unbind("." + this.widgetName), e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function (n) {
            if (!t) {
                this._mouseStarted && this._mouseUp(n), this._mouseDownEvent = n;
                var i = this,
                    r = 1 == n.which,
                    s = "string" == typeof this.options.cancel && n.target.nodeName ? e(n.target).closest(this.options.cancel).length : !1;
                return r && !s && this._mouseCapture(n) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
                    i.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(n) && this._mouseDelayMet(n) && (this._mouseStarted = this._mouseStart(n) !== !1, !this._mouseStarted) ? (n.preventDefault(), !0) : (!0 === e.data(n.target, this.widgetName + ".preventClickEvent") && e.removeData(n.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (e) {
                    return i._mouseMove(e)
                }, this._mouseUpDelegate = function (e) {
                    return i._mouseUp(e)
                }, e(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), n.preventDefault(), t = !0, !0)) : !0
            }
        },
        _mouseMove: function (t) {
            return !e.browser.msie || document.documentMode >= 9 || t.button ? this._mouseStarted ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted) : this._mouseUp(t)
        },
        _mouseUp: function (t) {
            return e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, t.target == this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(t)), !1
        },
        _mouseDistanceMet: function (e) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function () {
            return this.mouseDelayMet
        },
        _mouseStart: function () {},
        _mouseDrag: function () {},
        _mouseStop: function () {},
        _mouseCapture: function () {
            return !0
        }
    })
}(jQuery),
function (e) {
    var t = 5;
    e.widget("ui.slider", e.ui.mouse, {
        widgetEventPrefix: "slide",
        options: {
            animate: !1,
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: !1,
            step: 1,
            value: 0,
            values: null
        },
        _create: function () {
            var n = this,
                i = this.options,
                r = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                s = "<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>",
                a = i.values && i.values.length || 1,
                o = [];
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget" + " ui-widget-content" + " ui-corner-all" + (i.disabled ? " ui-slider-disabled ui-disabled" : "")), this.range = e([]), i.range && (i.range === !0 && (i.values || (i.values = [this._valueMin(), this._valueMin()]), i.values.length && 2 !== i.values.length && (i.values = [i.values[0], i.values[0]])), this.range = e("<div></div>").appendTo(this.element).addClass("ui-slider-range ui-widget-header" + ("min" === i.range || "max" === i.range ? " ui-slider-range-" + i.range : "")));
            for (var u = r.length; a > u; u += 1) o.push(s);
            this.handles = r.add(e(o.join("")).appendTo(n.element)), this.handle = this.handles.eq(0), this.handles.add(this.range).filter("a").click(function (e) {
                e.preventDefault()
            }).hover(function () {
                i.disabled || e(this).addClass("ui-state-hover")
            }, function () {
                e(this).removeClass("ui-state-hover")
            }).focus(function () {
                i.disabled ? e(this).blur() : (e(".ui-slider .ui-state-focus").removeClass("ui-state-focus"), e(this).addClass("ui-state-focus"))
            }).blur(function () {
                e(this).removeClass("ui-state-focus")
            }), this.handles.each(function (t) {
                e(this).data("index.ui-slider-handle", t)
            }), this.handles.keydown(function (i) {
                var r, s, a, o, u = e(this).data("index.ui-slider-handle");
                if (!n.options.disabled) {
                    switch (i.keyCode) {
                    case e.ui.keyCode.HOME:
                    case e.ui.keyCode.END:
                    case e.ui.keyCode.PAGE_UP:
                    case e.ui.keyCode.PAGE_DOWN:
                    case e.ui.keyCode.UP:
                    case e.ui.keyCode.RIGHT:
                    case e.ui.keyCode.DOWN:
                    case e.ui.keyCode.LEFT:
                        if (i.preventDefault(), !n._keySliding && (n._keySliding = !0, e(this).addClass("ui-state-active"), r = n._start(i, u), r === !1)) return
                    }
                    switch (o = n.options.step, s = a = n.options.values && n.options.values.length ? n.values(u) : n.value(), i.keyCode) {
                    case e.ui.keyCode.HOME:
                        a = n._valueMin();
                        break;
                    case e.ui.keyCode.END:
                        a = n._valueMax();
                        break;
                    case e.ui.keyCode.PAGE_UP:
                        a = n._trimAlignValue(s + (n._valueMax() - n._valueMin()) / t);
                        break;
                    case e.ui.keyCode.PAGE_DOWN:
                        a = n._trimAlignValue(s - (n._valueMax() - n._valueMin()) / t);
                        break;
                    case e.ui.keyCode.UP:
                    case e.ui.keyCode.RIGHT:
                        if (s === n._valueMax()) return;
                        a = n._trimAlignValue(s + o);
                        break;
                    case e.ui.keyCode.DOWN:
                    case e.ui.keyCode.LEFT:
                        if (s === n._valueMin()) return;
                        a = n._trimAlignValue(s - o)
                    }
                    n._slide(i, u, a)
                }
            }).keyup(function (t) {
                var i = e(this).data("index.ui-slider-handle");
                n._keySliding && (n._keySliding = !1, n._stop(t, i), n._change(t, i), e(this).removeClass("ui-state-active"))
            }), this._refreshValue(), this._animateOff = !1
        },
        destroy: function () {
            return this.handles.remove(), this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-slider-disabled ui-widget ui-widget-content ui-corner-all").removeData("slider").unbind(".slider"), this._mouseDestroy(), this
        },
        _mouseCapture: function (t) {
            var n, i, r, s, a, o, u, l, c, d = this.options;
            return d.disabled ? !1 : (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), n = {
                x: t.pageX,
                y: t.pageY
            }, i = this._normValueFromMouse(n), r = this._valueMax() - this._valueMin() + 1, a = this, this.handles.each(function (t) {
                var n = Math.abs(i - a.values(t));
                r > n && (r = n, s = e(this), o = t)
            }), d.range === !0 && this.values(1) === d.min && (o += 1, s = e(this.handles[o])), u = this._start(t, o), u === !1 ? !1 : (this._mouseSliding = !0, a._handleIndex = o, s.addClass("ui-state-active").focus(), l = s.offset(), c = !e(t.target).parents().andSelf().is(".ui-slider-handle"), this._clickOffset = c ? {
                left: 0,
                top: 0
            } : {
                left: t.pageX - l.left - s.width() / 2,
                top: t.pageY - l.top - s.height() / 2 - (parseInt(s.css("borderTopWidth"), 10) || 0) - (parseInt(s.css("borderBottomWidth"), 10) || 0) + (parseInt(s.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(t, o, i), this._animateOff = !0, !0))
        },
        _mouseStart: function () {
            return !0
        },
        _mouseDrag: function (e) {
            var t = {
                x: e.pageX,
                y: e.pageY
            }, n = this._normValueFromMouse(t);
            return this._slide(e, this._handleIndex, n), !1
        },
        _mouseStop: function (e) {
            return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(e, this._handleIndex), this._change(e, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
        },
        _detectOrientation: function () {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function (e) {
            var t, n, i, r, s;
            return "horizontal" === this.orientation ? (t = this.elementSize.width, n = e.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (t = this.elementSize.height, n = e.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), i = n / t, i > 1 && (i = 1), 0 > i && (i = 0), "vertical" === this.orientation && (i = 1 - i), r = this._valueMax() - this._valueMin(), s = this._valueMin() + i * r, this._trimAlignValue(s)
        },
        _start: function (e, t) {
            var n = {
                handle: this.handles[t],
                value: this.value()
            };
            return this.options.values && this.options.values.length && (n.value = this.values(t), n.values = this.values()), this._trigger("start", e, n)
        },
        _slide: function (e, t, n) {
            var i, r, s;
            this.options.values && this.options.values.length ? (i = this.values(t ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === t && n > i || 1 === t && i > n) && (n = i), n !== this.values(t) && (r = this.values(), r[t] = n, s = this._trigger("slide", e, {
                handle: this.handles[t],
                value: n,
                values: r
            }), i = this.values(t ? 0 : 1), s !== !1 && this.values(t, n, !0))) : n !== this.value() && (s = this._trigger("slide", e, {
                handle: this.handles[t],
                value: n
            }), s !== !1 && this.value(n))
        },
        _stop: function (e, t) {
            var n = {
                handle: this.handles[t],
                value: this.value()
            };
            this.options.values && this.options.values.length && (n.value = this.values(t), n.values = this.values()), this._trigger("stop", e, n)
        },
        _change: function (e, t) {
            if (!this._keySliding && !this._mouseSliding) {
                var n = {
                    handle: this.handles[t],
                    value: this.value()
                };
                this.options.values && this.options.values.length && (n.value = this.values(t), n.values = this.values()), this._trigger("change", e, n)
            }
        },
        value: function (e) {
            return arguments.length ? (this.options.value = this._trimAlignValue(e), this._refreshValue(), this._change(null, 0), void 0) : this._value()
        },
        values: function (t, n) {
            var i, r, s;
            if (arguments.length > 1) return this.options.values[t] = this._trimAlignValue(n), this._refreshValue(), this._change(null, t), void 0;
            if (!arguments.length) return this._values();
            if (!e.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(t) : this.value();
            for (i = this.options.values, r = arguments[0], s = 0; i.length > s; s += 1) i[s] = this._trimAlignValue(r[s]), this._change(null, s);
            this._refreshValue()
        },
        _setOption: function (t, n) {
            var i, r = 0;
            switch (e.isArray(this.options.values) && (r = this.options.values.length), e.Widget.prototype._setOption.apply(this, arguments), t) {
            case "disabled":
                n ? (this.handles.filter(".ui-state-focus").blur(), this.handles.removeClass("ui-state-hover"), this.handles.propAttr("disabled", !0), this.element.addClass("ui-disabled")) : (this.handles.propAttr("disabled", !1), this.element.removeClass("ui-disabled"));
                break;
            case "orientation":
                this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue();
                break;
            case "value":
                this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                break;
            case "values":
                for (this._animateOff = !0, this._refreshValue(), i = 0; r > i; i += 1) this._change(null, i);
                this._animateOff = !1
            }
        },
        _value: function () {
            var e = this.options.value;
            return e = this._trimAlignValue(e)
        },
        _values: function (e) {
            var t, n, i;
            if (arguments.length) return t = this.options.values[e], t = this._trimAlignValue(t);
            for (n = this.options.values.slice(), i = 0; n.length > i; i += 1) n[i] = this._trimAlignValue(n[i]);
            return n
        },
        _trimAlignValue: function (e) {
            if (this._valueMin() >= e) return this._valueMin();
            if (e >= this._valueMax()) return this._valueMax();
            var t = this.options.step > 0 ? this.options.step : 1,
                n = (e - this._valueMin()) % t,
                i = e - n;
            return 2 * Math.abs(n) >= t && (i += n > 0 ? t : -t), parseFloat(i.toFixed(5))
        },
        _valueMin: function () {
            return this.options.min
        },
        _valueMax: function () {
            return this.options.max
        },
        _refreshValue: function () {
            var t, n, i, r, s, a = this.options.range,
                o = this.options,
                u = this,
                l = this._animateOff ? !1 : o.animate,
                c = {};
            this.options.values && this.options.values.length ? this.handles.each(function (i) {
                t = 100 * ((u.values(i) - u._valueMin()) / (u._valueMax() - u._valueMin())), c["horizontal" === u.orientation ? "left" : "bottom"] = t + "%", e(this).stop(1, 1)[l ? "animate" : "css"](c, o.animate), u.options.range === !0 && ("horizontal" === u.orientation ? (0 === i && u.range.stop(1, 1)[l ? "animate" : "css"]({
                    left: t + "%"
                }, o.animate), 1 === i && u.range[l ? "animate" : "css"]({
                    width: t - n + "%"
                }, {
                    queue: !1,
                    duration: o.animate
                })) : (0 === i && u.range.stop(1, 1)[l ? "animate" : "css"]({
                    bottom: t + "%"
                }, o.animate), 1 === i && u.range[l ? "animate" : "css"]({
                    height: t - n + "%"
                }, {
                    queue: !1,
                    duration: o.animate
                }))), n = t
            }) : (i = this.value(), r = this._valueMin(), s = this._valueMax(), t = s !== r ? 100 * ((i - r) / (s - r)) : 0, c["horizontal" === u.orientation ? "left" : "bottom"] = t + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](c, o.animate), "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                width: t + "%"
            }, o.animate), "max" === a && "horizontal" === this.orientation && this.range[l ? "animate" : "css"]({
                width: 100 - t + "%"
            }, {
                queue: !1,
                duration: o.animate
            }), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                height: t + "%"
            }, o.animate), "max" === a && "vertical" === this.orientation && this.range[l ? "animate" : "css"]({
                height: 100 - t + "%"
            }, {
                queue: !1,
                duration: o.animate
            }))
        }
    }), e.extend(e.ui.slider, {
        version: "1.8.22"
    })
}(jQuery),
function (e) {
    function t() {}

    function n(e, t, n) {
        if (null == e) return x;
        var i = typeof e;
        if ("function" != i) {
            if ("object" != i) return function (t) {
                return t[e]
            };
            var r = gt(e);
            return function (t) {
                for (var n = r.length, i = !1; n-- && (i = c(t[r[n]], e[r[n]], N)););
                return i
            }
        }
        return t !== undefined ? 1 === n ? function (n) {
            return e.call(t, n)
        } : 2 === n ? function (n, i) {
            return e.call(t, n, i)
        } : 4 === n ? function (n, i, r, s) {
            return e.call(t, n, i, r, s)
        } : function (n, i, r) {
            return e.call(t, n, i, r)
        } : e
    }

    function i() {
        for (var e, t = {
                hasDontEnumBug: W,
                hasEnumPrototype: z,
                isKeysFast: nt,
                nonEnumArgs: it,
                noCharByIndex: at,
                shadowed: F,
                arrays: "isArray(iterable)",
                bottom: "",
                loop: "",
                top: "",
                useHas: !0
            }, i = 0; e = arguments[i]; i++)
            for (var r in e) t[r] = e[r];
        var s = t.args;
        t.firstArg = /^[^,]+/.exec(s)[0];
        var a = Function("createCallback, hasOwnProperty, isArguments, isArray, isString, objectTypes, nativeKeys", "return function(" + s + ") {\n" + ct(t) + "\n}");
        return a(n, I, u, vt, p, lt, H)
    }

    function r(e) {
        return _t[e]
    }

    function s(e) {
        return "function" != typeof e.toString && "string" == typeof (e + "")
    }

    function a(e, t, n) {
        t || (t = 0), n === undefined && (n = e ? e.length : 0);
        for (var i = -1, r = n - t || 0, s = Array(0 > r ? 0 : r); r > ++i;) s[i] = e[t + i];
        return s
    }

    function o(e) {
        return yt[e]
    }

    function u(e) {
        return L.call(e) == U
    }

    function l(e) {
        var t = [];
        return mt(e, function (e, n) {
            t.push(n)
        }), t
    }

    function c(e, t, i, r, a, o) {
        var l = i === N;
        if (i && !l) {
            i = r === undefined ? i : n(i, r, 2);
            var h = i(e, t);
            if (h !== undefined) return !!h
        }
        if (e === t) return 0 !== e || 1 / e == 1 / t;
        var p = typeof e,
            f = typeof t;
        if (e === e && (!e || "function" != p && "object" != p) && (!t || "function" != f && "object" != f)) return !1;
        if (null == e || null == t) return e === t;
        var m = L.call(e),
            v = L.call(t);
        if (m == U && (m = J), v == U && (v = J), m != v) return !1;
        switch (m) {
        case X:
        case q:
            return +e == +t;
        case Y:
            return e != +e ? t != +t : 0 == e ? 1 / e == 1 / t : e == +t;
        case K:
        case Z:
            return e == t + ""
        }
        var g = m == Q;
        if (!g) {
            if (e.__wrapped__ || t.__wrapped__) return c(e.__wrapped__ || e, t.__wrapped__ || t, i, r, a, o);
            if (m != J || ot && (s(e) || s(t))) return !1;
            var _ = !rt && u(e) ? Object : e.constructor,
                y = !rt && u(t) ? Object : t.constructor;
            if (_ != y && !(d(_) && _ instanceof _ && d(y) && y instanceof y)) return !1
        }
        a || (a = []), o || (o = []);
        for (var b = a.length; b--;)
            if (a[b] == e) return o[b] == t;
        var w = 0;
        if (h = !0, a.push(e), o.push(t), g) {
            if (b = e.length, w = t.length, h = w == e.length, !h && !l) return h;
            for (; w--;) {
                var V = b,
                    x = t[w];
                if (l)
                    for (; V-- && !(h = c(e[V], x, i, r, a, o)););
                else if (!(h = c(e[w], x, i, r, a, o))) break
            }
            return h
        }
        return ft(t, function (t, n, s) {
            return I.call(s, n) ? (w++, h = I.call(e, n) && c(e[n], t, i, r, a, o)) : undefined
        }), h && !l && ft(e, function (e, t, n) {
            return I.call(n, t) ? h = --w > -1 : undefined
        }), h
    }

    function d(e) {
        return "function" == typeof e
    }

    function h(e) {
        return e ? lt[typeof e] : !1
    }

    function p(e) {
        return "string" == typeof e || L.call(e) == Z
    }

    function f(e, t, n) {
        var i = -1,
            r = e ? e.length : 0,
            s = !1;
        return n = (0 > n ? R(0, r + n) : n) || 0, "number" == typeof r ? s = (p(e) ? e.indexOf(t, n) : _(e, t, n)) > -1 : pt(e, function (e) {
            return ++i >= n ? !(s = e === t) : undefined
        }), s
    }

    function m(e, t, i) {
        var r = [];
        if (t = n(t, i), vt(e))
            for (var s = -1, a = e.length; a > ++s;) {
                var o = e[s];
                t(o, s, e) && r.push(o)
            } else pt(e, function (e, n, i) {
                t(e, n, i) && r.push(e)
            });
        return r
    }

    function v(e, t, n) {
        if (t && n === undefined && vt(e))
            for (var i = -1, r = e.length; r > ++i && t(e[i], i, e) !== !1;);
        else pt(e, t, n);
        return e
    }

    function g(e, t, i) {
        var r = {};
        return t = n(t, i), v(e, function (e, n, i) {
            n = t(e, n, i) + "", (I.call(r, n) ? r[n] : r[n] = []).push(e)
        }), r
    }

    function _(e, t, n) {
        var i = -1,
            r = e ? e.length : 0;
        if ("number" == typeof n) i = (0 > n ? R(0, r + n) : n || 0) - 1;
        else if (n) return i = y(e, t), e[i] === t ? i : -1;
        for (; r > ++i;)
            if (e[i] === t) return i;
        return -1
    }

    function y(e, t, i, r) {
        var s = 0,
            a = e ? e.length : s;
        for (i = i ? n(i, r, 1) : x, t = i(t); a > s;) {
            var o = s + a >>> 1;
            t > i(e[o]) ? s = o + 1 : a = o
        }
        return s
    }

    function b() {
        return w(D.apply(M, arguments))
    }

    function w(e, t, i, r) {
        var s = -1,
            a = e ? e.length : 0,
            o = [],
            u = o;
        "function" == typeof t && (r = i, i = t, t = !1);
        var l = !t && a >= 75;
        if (l) var c = {};
        for (i && (u = [], i = n(i, r)); a > ++s;) {
            var d = e[s],
                h = i ? i(d, s, e) : d;
            if (l) var p = h + "",
            f = I.call(c, p) ? !(u = c[p]) : u = c[p] = [];
            (t ? !s || u[u.length - 1] !== h : f || 0 > _(u, h)) && ((i || l) && u.push(h), o.push(d))
        }
        return o
    }

    function V(e) {
        return null == e ? "" : (e + "").replace(O, r)
    }

    function x(e) {
        return e
    }

    function E(e, t, n) {
        e = +e || 0;
        for (var i = -1, r = Array(e); e > ++i;) r[i] = t.call(n, i);
        return r
    }

    function T(e) {
        return null == e ? "" : (e + "").replace(P, o)
    }
    var C = "object" == typeof exports && exports,
        k = "object" == typeof module && module && module.exports == C && module,
        S = "object" == typeof global && global;
    S.global === S && (e = S);
    var M = [],
        j = {}, N = j;
    e._;
    var P = /&(?:amp|lt|gt|quot|#39);/g,
        A = RegExp("^" + (j.valueOf + "").replace(/[.*+?^${}()|[\]\\]/g, "\\$&").replace(/valueOf|for [^\]]+/g, ".+?") + "$"),
        O = /[&<>"']/g,
        F = ["constructor", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "valueOf"],
        D = (Math.ceil, M.concat),
        I = (Math.floor, j.hasOwnProperty),
        L = (M.push, j.toString),
        $ = A.test($ = a.bind) && $,
        B = A.test(B = Array.isArray) && B,
        H = (e.isFinite, e.isNaN, A.test(H = Object.keys) && H),
        R = Math.max;
    Math.min, Math.random;
    var W, z, U = "[object Arguments]",
        Q = "[object Array]",
        X = "[object Boolean]",
        q = "[object Date]",
        G = "[object Function]",
        Y = "[object Number]",
        J = "[object Object]",
        K = "[object RegExp]",
        Z = "[object String]",
        et = !! e.attachEvent,
        tt = $ && !/\n|true/.test($ + et),
        nt = H && (et || tt),
        it = !0;
    (function () {
        function e() {
            this.x = 1
        }
        var t = [];
        e.prototype = {
            valueOf: 1,
            y: 1
        };
        for (var n in new e) t.push(n);
        for (n in arguments) it = !n;
        W = !/valueOf/.test(t), z = e.propertyIsEnumerable("prototype")
    })(1);
    var rt = arguments.constructor == Object,
        st = !u(arguments),
        at = "xx" != "x" [0] + Object("x")[0];
    try {
        var ot = L.call(document) == J && !({
            toString: 0
        } + "")
    } catch (ut) {}
    var lt = {
        "boolean": !1,
        "function": !0,
        object: !0,
        number: !1,
        string: !1,
        undefined: !1
    }, ct = function (e) {
            var t = "var index, iterable = " + e.firstArg + ", result = iterable;\nif (!iterable) return result;\n" + e.top + ";\n";
            if (e.arrays ? (t += "var length = iterable.length; index = -1;\nif (" + e.arrays + ") {  ", e.noCharByIndex && (t += "\n  if (isString(iterable)) {\n    iterable = iterable.split('')\n  }  "), t += "\n  while (++index < length) {\n    " + e.loop + "\n  }\n}\nelse {  ") : e.nonEnumArgs && (t += "\n  var length = iterable.length; index = -1;\n  if (length && isArguments(iterable)) {\n    while (++index < length) {\n      index += '';\n      " + e.loop + "\n    }\n  } else {  "), e.hasEnumPrototype && (t += "\n  var skipProto = typeof iterable == 'function';\n  "), e.isKeysFast && e.useHas ? (t += "\n  var ownIndex = -1,\n      ownProps = objectTypes[typeof iterable] ? nativeKeys(iterable) : [],\n      length = ownProps.length;\n\n  while (++ownIndex < length) {\n    index = ownProps[ownIndex];\n    ", e.hasEnumPrototype && (t += "if (!(skipProto && index == 'prototype')) {\n  "), t += e.loop + "", e.hasEnumPrototype && (t += "}\n"), t += "  }  ") : (t += "\n  for (index in iterable) {", (e.hasEnumPrototype || e.useHas) && (t += "\n    if (", e.hasEnumPrototype && (t += "!(skipProto && index == 'prototype')"), e.hasEnumPrototype && e.useHas && (t += " && "), e.useHas && (t += "hasOwnProperty.call(iterable, index)"), t += ") {    "), t += e.loop + ";    ", (e.hasEnumPrototype || e.useHas) && (t += "\n    }"), t += "\n  }  "), e.hasDontEnumBug) {
                t += "\n\n  var ctor = iterable.constructor;\n    ";
                for (var n = 0; 7 > n; n++) t += "\n  index = '" + e.shadowed[n] + "';\n  if (", "constructor" == e.shadowed[n] && (t += "!(ctor && ctor.prototype === iterable) && "), t += "hasOwnProperty.call(iterable, index)) {\n    " + e.loop + "\n  }    "
            }
            return (e.arrays || e.nonEnumArgs) && (t += "\n}"), t += e.bottom + ";\nreturn result"
        }, dt = {
            args: "collection, callback, thisArg",
            top: "callback = callback && typeof thisArg == 'undefined' ? callback : createCallback(callback, thisArg)",
            arrays: "typeof length == 'number'",
            loop: "if (callback(iterable[index], index, collection) === false) return result"
        }, ht = {
            top: "if (!objectTypes[typeof iterable]) return result;\n" + dt.top,
            arrays: !1
        }, pt = i(dt);
    st && (u = function (e) {
        return e ? I.call(e, "callee") : !1
    });
    var ft = i(dt, ht, {
        useHas: !1
    }),
        mt = i(dt, ht),
        vt = B || function (e) {
            return rt && e instanceof Array || L.call(e) == Q
        }, gt = H ? function (e) {
            return h(e) ? z && "function" == typeof e || it && e.length && u(e) ? l(e) : H(e) : []
        } : l,
        _t = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;"
        }, yt = {
            "&amp;": "&",
            "&lt;": "<",
            "&gt;": ">",
            "&quot;": '"',
            "&#x27;": "'"
        };
    d(/x/) && (d = function (e) {
        return e instanceof Function || L.call(e) == G
    }), tt && k && "function" == typeof setImmediate && (defer = bind(setImmediate, e)), t.filter = m, t.forEach = v, t.forIn = ft, t.forOwn = mt, t.groupBy = g, t.keys = gt, t.times = E, t.union = b, t.uniq = w, t.each = v, t.select = m, t.unique = w, t.contains = f, t.escape = V, t.identity = x, t.indexOf = _, t.isArguments = u, t.isArray = vt, t.isEqual = c, t.isFunction = d, t.isObject = h, t.isString = p, t.sortedIndex = y, t.unescape = T, t.include = f, t.VERSION = "1.0.1", "function" == typeof define && "object" == typeof define.amd && define.amd ? (e._ = t, define(function () {
        return t
    })) : C ? k ? (k.exports = t)._ = t : C._ = t : e._ = t
}(this),
function (e) {
    "function" == typeof define && define.amd ? "undefined" != typeof jQuery ? define(["jquery"], e) : define([], e) : "undefined" != typeof jQuery ? e(jQuery) : e()
}(function (e, t) {
    function n(e, t) {
        for (var n = decodeURI(e), i = g[t ? "strict" : "loose"].exec(n), r = {
                attr: {},
                param: {},
                seg: {}
            }, s = 14; s--;) r.attr[m[s]] = i[s] || "";
        return r.param.query = o(r.attr.query), r.param.fragment = o(r.attr.fragment), r.seg.path = r.attr.path.replace(/^\/+|\/+$/g, "").split("/"), r.seg.fragment = r.attr.fragment.replace(/^\/+|\/+$/g, "").split("/"), r.attr.base = r.attr.host ? (r.attr.protocol ? r.attr.protocol + "://" + r.attr.host : r.attr.host) + (r.attr.port ? ":" + r.attr.port : "") : "", r
    }

    function i(e) {
        var n = e.tagName;
        return n !== t ? f[n.toLowerCase()] : n
    }

    function r(e, t) {
        if (0 == e[t].length) return e[t] = {};
        var n = {};
        for (var i in e[t]) n[i] = e[t][i];
        return e[t] = n, n
    }

    function s(e, n, i, a) {
        var o = e.shift();
        if (o) {
            var u = n[i] = n[i] || [];
            "]" == o ? d(u) ? "" != a && u.push(a) : "object" == typeof u ? u[h(u).length] = a : u = n[i] = [n[i], a] : ~o.indexOf("]") ? (o = o.substr(0, o.length - 1), !_.test(o) && d(u) && (u = r(n, i)), s(e, u, o, a)) : (!_.test(o) && d(u) && (u = r(n, i)), s(e, u, o, a))
        } else d(n[i]) ? n[i].push(a) : n[i] = "object" == typeof n[i] ? a : n[i] === t ? a : [n[i], a]
    }

    function a(e, t, n) {
        if (~t.indexOf("]")) {
            var i = t.split("[");
            i.length, s(i, e, "base", n)
        } else {
            if (!_.test(t) && d(e.base)) {
                var r = {};
                for (var a in e.base) r[a] = e.base[a];
                e.base = r
            }
            u(e.base, t, n)
        }
        return e
    }

    function o(e) {
        return c((e + "").split(/&|;/), function (e, t) {
            try {
                t = decodeURIComponent(t.replace(/\+/g, " "))
            } catch (n) {}
            var i = t.indexOf("="),
                r = l(t),
                s = t.substr(0, r || i),
                o = t.substr(r || i, t.length),
                o = o.substr(o.indexOf("=") + 1, o.length);
            return "" == s && (s = t, o = ""), a(e, s, o)
        }, {
            base: {}
        }).base
    }

    function u(e, n, i) {
        var r = e[n];
        t === r ? e[n] = i : d(r) ? r.push(i) : e[n] = [r, i]
    }

    function l(e) {
        for (var t, n, i = e.length, r = 0; i > r; ++r)
            if (n = e[r], "]" == n && (t = !1), "[" == n && (t = !0), "=" == n && !t) return r
    }

    function c(e, n) {
        for (var i = 0, r = e.length >> 0, s = arguments[2]; r > i;) i in e && (s = n.call(t, s, e[i], i, e)), ++i;
        return s
    }

    function d(e) {
        return "[object Array]" === Object.prototype.toString.call(e)
    }

    function h(e) {
        var t = [];
        for (prop in e) e.hasOwnProperty(prop) && t.push(prop);
        return t
    }

    function p(e, i) {
        return 1 === arguments.length && e === !0 && (i = !0, e = t), i = i || !1, e = e || "" + window.location, {
            data: n(e, i),
            attr: function (e) {
                return e = v[e] || e, e !== t ? this.data.attr[e] : this.data.attr
            },
            param: function (e) {
                return e !== t ? this.data.param.query[e] : this.data.param.query
            },
            fparam: function (e) {
                return e !== t ? this.data.param.fragment[e] : this.data.param.fragment
            },
            segment: function (e) {
                return e === t ? this.data.seg.path : (e = 0 > e ? this.data.seg.path.length + e : e - 1, this.data.seg.path[e])
            },
            fsegment: function (e) {
                return e === t ? this.data.seg.fragment : (e = 0 > e ? this.data.seg.fragment.length + e : e - 1, this.data.seg.fragment[e])
            }
        }
    }
    var f = {
        a: "href",
        img: "src",
        form: "action",
        base: "href",
        script: "src",
        iframe: "src",
        link: "href"
    }, m = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "fragment"],
        v = {
            anchor: "fragment"
        }, g = {
            strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
            loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
        }, _ = (Object.prototype.toString, /^[0-9]+$/);
    e !== t ? (e.fn.url = function (t) {
        var n = "";
        return this.length && (n = e(this).attr(i(this[0])) || ""), p(n, t)
    }, e.url = p) : window.purl = p
}),
function (e, t) {
    var n = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    e.fn.imagesLoaded = function (i) {
        function r() {
            var t = e(d),
                n = e(h);
            o && (h.length ? o.reject(l, t, n) : o.resolve(l)), e.isFunction(i) && i.call(a, l, t, n)
        }

        function s(t, i) {
            t.src === n || -1 !== e.inArray(t, c) || (c.push(t), i ? h.push(t) : d.push(t), e.data(t, "imagesLoaded", {
                isBroken: i,
                src: t.src
            }), u && o.notifyWith(e(t), [i, l, e(d), e(h)]), l.length === c.length && (setTimeout(r), l.unbind(".imagesLoaded")))
        }
        var a = this,
            o = e.isFunction(e.Deferred) ? e.Deferred() : 0,
            u = e.isFunction(o.notify),
            l = a.find("img").add(a.filter("img")),
            c = [],
            d = [],
            h = [];
        return l.length ? l.bind("load.imagesLoaded error.imagesLoaded", function (e) {
            s(e.target, "error" === e.type)
        }).each(function (i, r) {
            var a = r.src,
                o = e.data(r, "imagesLoaded");
            o && o.src === a ? s(r, o.isBroken) : r.complete && r.naturalWidth !== t ? s(r, 0 === r.naturalWidth || 0 === r.naturalHeight) : (r.readyState || r.complete) && (r.src = n, r.src = a)
        }) : r(), o ? o.promise(a) : a
    }
}(jQuery),
function (e) {
    function t(e) {
        var t = ["Moz", "Webkit", "O", "ms"],
            n = e.charAt(0).toUpperCase() + e.substr(1);
        if (e in c.style) return e;
        for (e = 0; t.length > e; ++e) {
            var i = t[e] + n;
            if (i in c.style) return i
        }
    }

    function n(e) {
        return "string" == typeof e && this.parse(e), this
    }

    function i(e, t, n) {
        !0 === t ? e.queue(n) : t ? e.queue(t, n) : n()
    }

    function r(t) {
        var n = [];
        return e.each(t, function (t) {
            t = e.camelCase(t), t = e.transit.propertyMap[t] || t, t = o(t), -1 === e.inArray(t, n) && n.push(t)
        }), n
    }

    function s(t, n, i, s) {
        t = r(t), e.cssEase[i] && (i = e.cssEase[i]);
        var a = "" + l(n) + " " + i;
        parseInt(s, 10) > 0 && (a += " " + l(s));
        var o = [];
        return e.each(t, function (e, t) {
            o.push(t + " " + a)
        }), o.join(", ")
    }

    function a(t, i) {
        i || (e.cssNumber[t] = !0), e.transit.propertyMap[t] = d.transform, e.cssHooks[t] = {
            get: function (i) {
                return (e(i).css("transform") || new n).get(t)
            },
            set: function (i, r) {
                var s = e(i).css("transform") || new n;
                s.setFromString(t, r), e(i).css({
                    transform: s
                })
            }
        }
    }

    function o(e) {
        return e.replace(/([A-Z])/g, function (e) {
            return "-" + e.toLowerCase()
        })
    }

    function u(e, t) {
        return "string" != typeof e || e.match(/^[\-0-9\.]+$/) ? "" + e + t : e
    }

    function l(t) {
        return e.fx.speeds[t] && (t = e.fx.speeds[t]), u(t, "ms")
    }
    e.transit = {
        version: "0.1.3",
        propertyMap: {
            marginLeft: "margin",
            marginRight: "margin",
            marginBottom: "margin",
            marginTop: "margin",
            paddingLeft: "padding",
            paddingRight: "padding",
            paddingBottom: "padding",
            paddingTop: "padding"
        },
        enabled: !0,
        useTransitionEnd: !1
    };
    var c = document.createElement("div"),
        d = {}, h = navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
    d.transition = t("transition"), d.transitionDelay = t("transitionDelay"), d.transform = t("transform"), d.transformOrigin = t("transformOrigin"), c.style[d.transform] = "", c.style[d.transform] = "rotateY(90deg)", d.transform3d = "" !== c.style[d.transform], e.extend(e.support, d);
    var p = d.transitionEnd = {
        MozTransition: "transitionend",
        OTransition: "oTransitionEnd",
        WebkitTransition: "webkitTransitionEnd",
        msTransition: "MSTransitionEnd"
    }[d.transition] || null,
        c = null;
    e.cssEase = {
        _default: "ease",
        "in": "ease-in",
        out: "ease-out",
        "in-out": "ease-in-out",
        snap: "cubic-bezier(0,1,.5,1)"
    }, e.cssHooks.transform = {
        get: function (t) {
            return e(t).data("transform")
        },
        set: function (t, i) {
            var r = i;
            r instanceof n || (r = new n(r)), t.style[d.transform] = "WebkitTransform" !== d.transform || h ? "" + r : r.toString(!0), e(t).data("transform", r)
        }
    }, e.cssHooks.transformOrigin = {
        get: function (e) {
            return e.style[d.transformOrigin]
        },
        set: function (e, t) {
            e.style[d.transformOrigin] = t
        }
    }, e.cssHooks.transition = {
        get: function (e) {
            return e.style[d.transition]
        },
        set: function (e, t) {
            e.style[d.transition] = t
        }
    }, a("scale"), a("translate"), a("rotate"), a("rotateX"), a("rotateY"), a("rotate3d"), a("perspective"), a("skewX"), a("skewY"), a("x", !0), a("y", !0), n.prototype = {
        setFromString: function (e, t) {
            var i = "string" == typeof t ? t.split(",") : t.constructor === Array ? t : [t];
            i.unshift(e), n.prototype.set.apply(this, i)
        },
        set: function (e) {
            var t = Array.prototype.slice.apply(arguments, [1]);
            this.setter[e] ? this.setter[e].apply(this, t) : this[e] = t.join(",")
        },
        get: function (e) {
            return this.getter[e] ? this.getter[e].apply(this) : this[e] || 0
        },
        setter: {
            rotate: function (e) {
                this.rotate = u(e, "deg")
            },
            rotateX: function (e) {
                this.rotateX = u(e, "deg")
            },
            rotateY: function (e) {
                this.rotateY = u(e, "deg")
            },
            scale: function (e, t) {
                void 0 === t && (t = e), this.scale = e + "," + t
            },
            skewX: function (e) {
                this.skewX = u(e, "deg")
            },
            skewY: function (e) {
                this.skewY = u(e, "deg")
            },
            perspective: function (e) {
                this.perspective = u(e, "px")
            },
            x: function (e) {
                this.set("translate", e, null)
            },
            y: function (e) {
                this.set("translate", null, e)
            },
            translate: function (e, t) {
                void 0 === this._translateX && (this._translateX = 0), void 0 === this._translateY && (this._translateY = 0), null !== e && (this._translateX = u(e, "px")), null !== t && (this._translateY = u(t, "px")), this.translate = this._translateX + "," + this._translateY
            }
        },
        getter: {
            x: function () {
                return this._translateX || 0
            },
            y: function () {
                return this._translateY || 0
            },
            scale: function () {
                var e = (this.scale || "1,1").split(",");
                return e[0] && (e[0] = parseFloat(e[0])), e[1] && (e[1] = parseFloat(e[1])), e[0] === e[1] ? e[0] : e
            },
            rotate3d: function () {
                for (var e = (this.rotate3d || "0,0,0,0deg").split(","), t = 0; 3 >= t; ++t) e[t] && (e[t] = parseFloat(e[t]));
                return e[3] && (e[3] = u(e[3], "deg")), e
            }
        },
        parse: function (e) {
            var t = this;
            e.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function (e, n, i) {
                t.setFromString(n, i)
            })
        },
        toString: function (e) {
            var t, n = [];
            for (t in this) this.hasOwnProperty(t) && (d.transform3d || "rotateX" !== t && "rotateY" !== t && "perspective" !== t && "transformOrigin" !== t) && "_" !== t[0] && (e && "scale" === t ? n.push(t + "3d(" + this[t] + ",1)") : e && "translate" === t ? n.push(t + "3d(" + this[t] + ",0)") : n.push(t + "(" + this[t] + ")"));
            return n.join(" ")
        }
    }, e.fn.transition = e.fn.transit = function (t, n, r, a) {
        var o = this,
            u = 0,
            c = !0;
        "function" == typeof n && (a = n, n = void 0), "function" == typeof r && (a = r, r = void 0), t.easing !== void 0 && (r = t.easing, delete t.easing), t.duration !== void 0 && (n = t.duration, delete t.duration), t.complete !== void 0 && (a = t.complete, delete t.complete), t.queue !== void 0 && (c = t.queue, delete t.queue), t.delay !== void 0 && (u = t.delay, delete t.delay), n === void 0 && (n = e.fx.speeds._default), r === void 0 && (r = e.cssEase._default);
        var n = l(n),
            h = s(t, n, r, u),
            f = e.transit.enabled && d.transition ? parseInt(n, 10) + parseInt(u, 10) : 0;
        if (0 === f) return i(o, c, function (e) {
            o.css(t), a && a.apply(o), e && e()
        }), o;
        var m = {}, v = function (n) {
                var i = !1,
                    r = function () {
                        i && o.unbind(p, r), f > 0 && o.each(function () {
                            this.style[d.transition] = m[this] || null
                        }), "function" == typeof a && a.apply(o), "function" == typeof n && n()
                    };
                f > 0 && p && e.transit.useTransitionEnd ? (i = !0, o.bind(p, r)) : window.setTimeout(r, f), o.each(function () {
                    f > 0 && (this.style[d.transition] = h), e(this).css(t)
                })
            };
        return i(o, c, function (e) {
            var t = 0;
            "MozTransition" === d.transition && 25 > t && (t = 25), window.setTimeout(function () {
                v(e)
            }, t)
        }), this
    }, e.transit.getTransitionValue = s
}(jQuery),
function (window, undefined) {
    function returnTrue() {
        return !0
    }

    function returnFalse() {
        return !1
    }
    var document = window.document;
    document.createElement("video"), document.createElement("audio");
    var VideoJS = function (e, t, n) {
        var i;
        if ("string" == typeof e) {
            if (0 === e.indexOf("#") && (e = e.slice(1)), _V_.players[e]) return _V_.players[e];
            i = _V_.el(e)
        } else i = e; if (!i || !i.nodeName) throw new TypeError("The element or ID supplied is not valid. (VideoJS)");
        return i.player || new _V_.Player(i, t, n)
    }, _V_ = VideoJS,
        CDN_VERSION = "3.2";
    VideoJS.players = {}, VideoJS.options = {
        techOrder: ["html5", "flash"],
        html5: {},
        flash: {
            swf: "http://vjs.zencdn.net/c/video-js.swf"
        },
        width: "auto",
        height: "auto",
        defaultVolume: 0,
        components: {
            posterImage: {},
            textTrackDisplay: {},
            loadingSpinner: {},
            bigPlayButton: {},
            controlBar: {}
        }
    }, "GENERATED_CDN_VSN" != CDN_VERSION && (_V_.options.flash.swf = "http://vjs.zencdn.net/" + CDN_VERSION + "/video-js.swf"), _V_.merge = function (e, t, n) {
        t || (t = {});
        for (var i in t)!t.hasOwnProperty(i) || n && e.hasOwnProperty(i) || (e[i] = t[i]);
        return e
    }, _V_.extend = function (e) {
        this.merge(this, e, !0)
    }, _V_.extend({
        tech: {},
        controlSets: {},
        isIE: function () {
            return !1
        },
        isFF: function () {
            return !!_V_.ua.match("Firefox")
        },
        isIPad: function () {
            return null !== navigator.userAgent.match(/iPad/i)
        },
        isIPhone: function () {
            return null !== navigator.userAgent.match(/iPhone/i)
        },
        isIOS: function () {
            return VideoJS.isIPhone() || VideoJS.isIPad()
        },
        iOSVersion: function () {
            var e = navigator.userAgent.match(/OS (\d+)_/i);
            return e && e[1] ? e[1] : undefined
        },
        isAndroid: function () {
            return null !== navigator.userAgent.match(/Android.*AppleWebKit/i)
        },
        androidVersion: function () {
            var e = navigator.userAgent.match(/Android (\d+)\./i);
            return e && e[1] ? e[1] : undefined
        },
        testVid: document.createElement("video"),
        ua: navigator.userAgent,
        support: {},
        each: function (e, t) {
            if (e && 0 !== e.length)
                for (var n = 0, i = e.length; i > n; n++) t.call(this, e[n], n)
        },
        eachProp: function (e, t) {
            if (e)
                for (var n in e) e.hasOwnProperty(n) && t.call(this, n, e[n])
        },
        el: function (e) {
            return document.getElementById(e)
        },
        createElement: function (e, t) {
            var n, i = document.createElement(e);
            for (n in t) t.hasOwnProperty(n) && (-1 !== n.indexOf("-") ? i.setAttribute(n, t[n]) : i[n] = t[n]);
            return i
        },
        insertFirst: function (e, t) {
            t.firstChild ? t.insertBefore(e, t.firstChild) : t.appendChild(e)
        },
        addClass: function (e, t) {
            -1 == (" " + e.className + " ").indexOf(" " + t + " ") && (e.className = "" === e.className ? t : e.className + " " + t)
        },
        removeClass: function (e, t) {
            if (-1 != e.className.indexOf(t)) {
                var n = e.className.split(" ");
                n.splice(n.indexOf(t), 1), e.className = n.join(" ")
            }
        },
        remove: function (e, t) {
            if (t) {
                var n = t.indexOf(e);
                return -1 != n ? t.splice(n, 1) : undefined
            }
        },
        blockTextSelection: function () {
            document.body.focus(), document.onselectstart = function () {
                return !1
            }
        },
        unblockTextSelection: function () {
            document.onselectstart = function () {
                return !0
            }
        },
        formatTime: function (e, t) {
            t = t || e;
            var n = Math.floor(e % 60),
                i = Math.floor(e / 60 % 60),
                r = Math.floor(e / 3600),
                s = Math.floor(t / 60 % 60),
                a = Math.floor(t / 3600);
            return r = r > 0 || a > 0 ? r + ":" : "", i = ((r || s >= 10) && 10 > i ? "0" + i : i) + ":", n = 10 > n ? "0" + n : n, r + i + n
        },
        uc: function (e) {
            return e.charAt(0).toUpperCase() + e.slice(1)
        },
        getRelativePosition: function (e, t) {
            return Math.max(0, Math.min(1, (e - _V_.findPosX(t)) / t.offsetWidth))
        },
        getComputedStyleValue: function (e, t) {
            return window.getComputedStyle(e, null).getPropertyValue(t)
        },
        trim: function (e) {
            return ("" + e).replace(/^\s+/, "").replace(/\s+$/, "")
        },
        round: function (e, t) {
            return t || (t = 0), Math.round(e * Math.pow(10, t)) / Math.pow(10, t)
        },
        isEmpty: function (e) {
            for (var t in e) return !1;
            return !0
        },
        createTimeRange: function (e, t) {
            return {
                length: 1,
                start: function () {
                    return e
                },
                end: function () {
                    return t
                }
            }
        },
        cache: {},
        guid: 1,
        expando: "vdata" + (new Date).getTime(),
        getData: function (e) {
            var t = e[_V_.expando];
            return t || (t = e[_V_.expando] = _V_.guid++, _V_.cache[t] = {}), _V_.cache[t]
        },
        removeData: function (e) {
            var t = e[_V_.expando];
            if (t) {
                delete _V_.cache[t];
                try {
                    delete e[_V_.expando]
                } catch (n) {
                    e.removeAttribute ? e.removeAttribute(_V_.expando) : e[_V_.expando] = null
                }
            }
        },
        proxy: function (e, t, n) {
            t.guid || (t.guid = _V_.guid++);
            var i = function () {
                return t.apply(e, arguments)
            };
            return i.guid = n ? n + "_" + t.guid : t.guid, i
        },
        get: function (e, t, n) {
            var i = 0 == e.indexOf("file:") || 0 == window.location.href.indexOf("file:") && -1 == e.indexOf("http:");
            "undefined" == typeof XMLHttpRequest && (XMLHttpRequest = function () {
                try {
                    return new ActiveXObject("Msxml2.XMLHTTP.6.0")
                } catch (e) {}
                try {
                    return new ActiveXObject("Msxml2.XMLHTTP.3.0")
                } catch (t) {}
                try {
                    return new ActiveXObject("Msxml2.XMLHTTP")
                } catch (n) {}
                throw Error("This browser does not support XMLHttpRequest.")
            });
            var r = new XMLHttpRequest;
            try {
                r.open("GET", e)
            } catch (s) {
                return _V_.log("VideoJS XMLHttpRequest (open)", s), !1
            }
            r.onreadystatechange = _V_.proxy(this, function () {
                4 == r.readyState && (200 == r.status || i && 0 == r.status ? t(r.responseText) : n && n())
            });
            try {
                r.send()
            } catch (s) {
                _V_.log("VideoJS XMLHttpRequest (send)", s), n && n(s)
            }
        },
        setLocalStorage: function (e, t) {
            var n = window.localStorage || !1;
            if (n) try {
                n[e] = t
            } catch (i) {
                22 == i.code || 1014 == i.code ? _V_.log("LocalStorage Full (VideoJS)", i) : _V_.log("LocalStorage Error (VideoJS)", i)
            }
        },
        getAbsoluteURL: function (e) {
            return e.match(/^https?:\/\//) || (e = _V_.createElement("div", {
                innerHTML: '<a href="' + e + '">x</a>'
            }).firstChild.href), e
        }
    }), _V_.log = function () {
        if (_V_.log.history = _V_.log.history || [], _V_.log.history.push(arguments), window.console) {
            arguments.callee = arguments.callee.caller;
            var e = [].slice.call(arguments);
            "object" == typeof console.log ? _V_.log.apply.call(console.log, console, e) : console.log.apply(console, e)
        }
    },
    function (e) {
        function t() {}
        for (var n, i = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","); n = i.pop();) e[n] = e[n] || t
    }(function () {
        try {
            return console.log(), window.console
        } catch (e) {
            return window.console = {}
        }
    }()), _V_.findPosX = "getBoundingClientRect" in document.documentElement ? function (e) {
        var t;
        try {
            t = e.getBoundingClientRect()
        } catch (n) {}
        if (!t) return 0;
        var i = document.documentElement,
            r = document.body,
            s = i.clientLeft || r.clientLeft || 0,
            a = window.pageXOffset || r.scrollLeft,
            o = t.left + a - s;
        return o
    } : function (e) {
        for (var t = e.offsetLeft; e = obj.offsetParent;) - 1 == e.className.indexOf("video-js"), t += e.offsetLeft;
        return t
    },
    function () {
        var e = !1,
            t = /xyz/.test(function () {}) ? /\b_super\b/ : /.*/;
        _V_.Class = function () {}, _V_.Class.extend = function (n) {
            function i() {
                return !e && this.init ? this.init.apply(this, arguments) : e ? undefined : arguments.callee.prototype.init()
            }
            var r = this.prototype;
            e = !0;
            var s = new this;
            e = !1;
            for (var a in n) s[a] = "function" == typeof n[a] && "function" == typeof r[a] && t.test(n[a]) ? function (e, t) {
                return function () {
                    var n = this._super;
                    this._super = r[e];
                    var i = t.apply(this, arguments);
                    return this._super = n, i
                }
            }(a, n[a]) : n[a];
            return i.prototype = s, i.constructor = i, i.extend = arguments.callee, i
        }
    }(), _V_.Component = _V_.Class.extend({
        init: function (e, t) {
            this.player = e, t = this.options = _V_.merge(this.options || {}, t), this.el = t.el ? t.el : this.createElement(), this.initComponents()
        },
        destroy: function () {},
        createElement: function (e, t) {
            return _V_.createElement(e || "div", t)
        },
        buildCSSClass: function () {
            return ""
        },
        initComponents: function () {
            var e = this.options;
            e && e.components && this.eachProp(e.components, function (e, t) {
                var n = this.proxy(function () {
                    this[e] = this.addComponent(e, t)
                });
                t.loadEvent ? this.one(t.loadEvent, n) : n()
            })
        },
        addComponent: function (e, t) {
            var n, i;
            return "string" == typeof e ? (t = t || {}, i = t.componentClass || _V_.uc(e), n = new _V_[i](this.player || this, t)) : n = e, this.el.appendChild(n.el), n
        },
        removeComponent: function (e) {
            this.el.removeChild(e.el)
        },
        show: function () {
            this.el.style.display = "block"
        },
        hide: function () {
            this.el.style.display = "none"
        },
        fadeIn: function () {
            this.removeClass("vjs-fade-out"), this.addClass("vjs-fade-in")
        },
        fadeOut: function () {
            this.removeClass("vjs-fade-in"), this.addClass("vjs-fade-out")
        },
        lockShowing: function () {
            var e = this.el.style;
            e.display = "block", e.opacity = 1, e.visiblity = "visible"
        },
        unlockShowing: function () {
            var e = this.el.style;
            e.display = "", e.opacity = "", e.visiblity = ""
        },
        addClass: function (e) {
            _V_.addClass(this.el, e)
        },
        removeClass: function (e) {
            _V_.removeClass(this.el, e)
        },
        addEvent: function (e, t) {
            return _V_.addEvent(this.el, e, _V_.proxy(this, t))
        },
        removeEvent: function (e, t) {
            return _V_.removeEvent(this.el, e, t)
        },
        triggerEvent: function (e, t) {
            return _V_.triggerEvent(this.el, e, t)
        },
        one: function (e, t) {
            _V_.one(this.el, e, _V_.proxy(this, t))
        },
        ready: function (e) {
            return e ? (this.isReady ? e.call(this) : (this.readyQueue === undefined && (this.readyQueue = []), this.readyQueue.push(e)), this) : this
        },
        triggerReady: function () {
            this.isReady = !0, this.readyQueue && this.readyQueue.length > 0 && (this.each(this.readyQueue, function (e) {
                e.call(this)
            }), this.readyQueue = [], this.triggerEvent("ready"))
        },
        each: function (e, t) {
            _V_.each.call(this, e, t)
        },
        eachProp: function (e, t) {
            _V_.eachProp.call(this, e, t)
        },
        extend: function (e) {
            _V_.merge(this, e)
        },
        proxy: function (e, t) {
            return _V_.proxy(this, e, t)
        }
    }), _V_.Control = _V_.Component.extend({
        buildCSSClass: function () {
            return "vjs-control " + this._super()
        }
    }), _V_.ControlBar = _V_.Component.extend({
        options: {
            loadEvent: "play",
            components: {
                playToggle: {},
                fullscreenToggle: {},
                currentTimeDisplay: {},
                timeDivider: {},
                durationDisplay: {},
                remainingTimeDisplay: {},
                progressControl: {},
                volumeControl: {},
                muteToggle: {}
            }
        },
        init: function (e, t) {
            this._super(e, t), e.addEvent("play", this.proxy(function () {
                this.fadeIn(), this.player.addEvent("mouseover", this.proxy(this.fadeIn)), this.player.addEvent("mouseout", this.proxy(this.fadeOut))
            }))
        },
        createElement: function () {
            return _V_.createElement("div", {
                className: "vjs-controls"
            })
        },
        fadeIn: function () {
            this._super(), this.player.triggerEvent("controlsvisible")
        },
        fadeOut: function () {
            this._super(), this.player.triggerEvent("controlshidden")
        },
        lockShowing: function () {
            this.el.style.opacity = "1"
        }
    }), _V_.Button = _V_.Control.extend({
        init: function (e, t) {
            this._super(e, t), this.addEvent("click", this.onClick), this.addEvent("focus", this.onFocus), this.addEvent("blur", this.onBlur)
        },
        createElement: function (e, t) {
            return t = _V_.merge({
                className: this.buildCSSClass(),
                innerHTML: '<div><span class="vjs-control-text">' + (this.buttonText || "Need Text") + "</span></div>",
                role: "button",
                tabIndex: 0
            }, t), this._super(e, t)
        },
        onClick: function () {},
        onFocus: function () {
            _V_.addEvent(document, "keyup", _V_.proxy(this, this.onKeyPress))
        },
        onKeyPress: function (e) {
            (32 == e.which || 13 == e.which) && (e.preventDefault(), this.onClick())
        },
        onBlur: function () {
            _V_.removeEvent(document, "keyup", _V_.proxy(this, this.onKeyPress))
        }
    }), _V_.PlayButton = _V_.Button.extend({
        buttonText: "Play",
        buildCSSClass: function () {
            return "vjs-play-button " + this._super()
        },
        onClick: function () {
            this.player.play()
        }
    }), _V_.PauseButton = _V_.Button.extend({
        buttonText: "Pause",
        buildCSSClass: function () {
            return "vjs-pause-button " + this._super()
        },
        onClick: function () {
            this.player.pause()
        }
    }), _V_.PlayToggle = _V_.Button.extend({
        buttonText: "Play",
        init: function (e, t) {
            this._super(e, t), e.addEvent("play", _V_.proxy(this, this.onPlay)), e.addEvent("pause", _V_.proxy(this, this.onPause))
        },
        buildCSSClass: function () {
            return "vjs-play-control " + this._super()
        },
        onClick: function () {
            this.player.paused() ? this.player.play() : this.player.pause()
        },
        onPlay: function () {
            _V_.removeClass(this.el, "vjs-paused"), _V_.addClass(this.el, "vjs-playing")
        },
        onPause: function () {
            _V_.removeClass(this.el, "vjs-playing"), _V_.addClass(this.el, "vjs-paused")
        }
    }), _V_.FullscreenToggle = _V_.Button.extend({
        buttonText: "Fullscreen",
        buildCSSClass: function () {
            return "vjs-fullscreen-control " + this._super()
        },
        onClick: function () {
            this.player.isFullScreen ? this.player.cancelFullScreen() : this.player.requestFullScreen()
        }
    }), _V_.BigPlayButton = _V_.Button.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("play", _V_.proxy(this, this.hide)), e.addEvent("ended", _V_.proxy(this, this.show))
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-big-play-button",
                innerHTML: "<span></span>"
            })
        },
        onClick: function () {
            this.player.currentTime() && this.player.currentTime(0), this.player.play()
        }
    }), _V_.LoadingSpinner = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("canplay", _V_.proxy(this, this.hide)), e.addEvent("canplaythrough", _V_.proxy(this, this.hide)), e.addEvent("playing", _V_.proxy(this, this.hide)), e.addEvent("seeking", _V_.proxy(this, this.show)), e.addEvent("error", _V_.proxy(this, this.show)), e.addEvent("waiting", _V_.proxy(this, this.show))
        },
        createElement: function () {
            var e, t;
            return "string" == typeof this.player.el.style.WebkitBorderRadius || "string" == typeof this.player.el.style.MozBorderRadius || "string" == typeof this.player.el.style.KhtmlBorderRadius || "string" == typeof this.player.el.style.borderRadius ? (e = "vjs-loading-spinner", t = "<div class='ball1'></div><div class='ball2'></div><div class='ball3'></div><div class='ball4'></div><div class='ball5'></div><div class='ball6'></div><div class='ball7'></div><div class='ball8'></div>") : (e = "vjs-loading-spinner-fallback", t = ""), this._super("div", {
                className: e,
                innerHTML: t
            })
        }
    }), _V_.CurrentTimeDisplay = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("timeupdate", _V_.proxy(this, this.updateContent))
        },
        createElement: function () {
            var e = this._super("div", {
                className: "vjs-current-time vjs-time-controls vjs-control"
            });
            return this.content = _V_.createElement("div", {
                className: "vjs-current-time-display",
                innerHTML: "0:00"
            }), e.appendChild(_V_.createElement("div").appendChild(this.content)), e
        },
        updateContent: function () {
            var e = this.player.scrubbing ? this.player.values.currentTime : this.player.currentTime();
            this.content.innerHTML = _V_.formatTime(e, this.player.duration())
        }
    }), _V_.DurationDisplay = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("timeupdate", _V_.proxy(this, this.updateContent))
        },
        createElement: function () {
            var e = this._super("div", {
                className: "vjs-duration vjs-time-controls vjs-control"
            });
            return this.content = _V_.createElement("div", {
                className: "vjs-duration-display",
                innerHTML: "0:00"
            }), e.appendChild(_V_.createElement("div").appendChild(this.content)), e
        },
        updateContent: function () {
            this.player.duration() && (this.content.innerHTML = _V_.formatTime(this.player.duration()))
        }
    }), _V_.TimeDivider = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-time-divider",
                innerHTML: "<div><span>/</span></div>"
            })
        }
    }), _V_.RemainingTimeDisplay = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("timeupdate", _V_.proxy(this, this.updateContent))
        },
        createElement: function () {
            var e = this._super("div", {
                className: "vjs-remaining-time vjs-time-controls vjs-control"
            });
            return this.content = _V_.createElement("div", {
                className: "vjs-remaining-time-display",
                innerHTML: "-0:00"
            }), e.appendChild(_V_.createElement("div").appendChild(this.content)), e
        },
        updateContent: function () {
            this.player.duration() && (this.content.innerHTML = "-" + _V_.formatTime(this.player.remainingTime()))
        }
    }), _V_.Slider = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent(this.playerEvent, _V_.proxy(this, this.update)), this.addEvent("mousedown", this.onMouseDown), this.addEvent("focus", this.onFocus), this.addEvent("blur", this.onBlur), this.player.addEvent("controlsvisible", this.proxy(this.update)), this.update()
        },
        createElement: function (e, t) {
            return t = _V_.merge({
                role: "slider",
                "aria-valuenow": 0,
                "aria-valuemin": 0,
                "aria-valuemax": 100,
                tabIndex: 0
            }, t), this._super(e, t)
        },
        onMouseDown: function (e) {
            e.preventDefault(), _V_.blockTextSelection(), _V_.addEvent(document, "mousemove", _V_.proxy(this, this.onMouseMove)), _V_.addEvent(document, "mouseup", _V_.proxy(this, this.onMouseUp)), this.onMouseMove(e)
        },
        onMouseUp: function () {
            _V_.unblockTextSelection(), _V_.removeEvent(document, "mousemove", this.onMouseMove, !1), _V_.removeEvent(document, "mouseup", this.onMouseUp, !1), this.update()
        },
        update: function () {
            var e, t = this.getPercent();
            if (handle = this.handle, bar = this.bar, isNaN(t) && (t = 0), e = t, handle) {
                var n = this.el,
                    i = n.offsetWidth,
                    r = handle.el.offsetWidth,
                    s = r ? r / i : 0,
                    a = 1 - s;
                adjustedProgress = t * a, e = adjustedProgress + s / 2, handle.el.style.left = _V_.round(100 * adjustedProgress, 2) + "%"
            }
            bar.el.style.width = _V_.round(100 * e, 2) + "%"
        },
        calculateDistance: function (e) {
            var t = this.el,
                n = _V_.findPosX(t),
                i = t.offsetWidth,
                r = this.handle;
            if (r) {
                var s = r.el.offsetWidth;
                n += s / 2, i -= s
            }
            return Math.max(0, Math.min(1, (e.pageX - n) / i))
        },
        onFocus: function () {
            _V_.addEvent(document, "keyup", _V_.proxy(this, this.onKeyPress))
        },
        onKeyPress: function (e) {
            37 == e.which ? (e.preventDefault(), this.stepBack()) : 39 == e.which && (e.preventDefault(), this.stepForward())
        },
        onBlur: function () {
            _V_.removeEvent(document, "keyup", _V_.proxy(this, this.onKeyPress))
        }
    }), _V_.ProgressControl = _V_.Component.extend({
        options: {
            components: {
                seekBar: {}
            }
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-progress-control vjs-control"
            })
        }
    }), _V_.SeekBar = _V_.Slider.extend({
        options: {
            components: {
                loadProgressBar: {},
                bar: {
                    componentClass: "PlayProgressBar"
                },
                handle: {
                    componentClass: "SeekHandle"
                }
            }
        },
        playerEvent: "timeupdate",
        init: function (e, t) {
            this._super(e, t)
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-progress-holder"
            })
        },
        getPercent: function () {
            return this.player.currentTime() / this.player.duration()
        },
        onMouseDown: function (e) {
            this._super(e), this.player.scrubbing = !0, this.videoWasPlaying = !this.player.paused(), this.player.pause()
        },
        onMouseMove: function (e) {
            var t = this.calculateDistance(e) * this.player.duration();
            t == this.player.duration() && (t -= .1), this.player.currentTime(t)
        },
        onMouseUp: function (e) {
            this._super(e), this.player.scrubbing = !1, this.videoWasPlaying && this.player.play()
        },
        stepForward: function () {
            this.player.currentTime(this.player.currentTime() + 1)
        },
        stepBack: function () {
            this.player.currentTime(this.player.currentTime() - 1)
        }
    }), _V_.LoadProgressBar = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("progress", _V_.proxy(this, this.update))
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-load-progress",
                innerHTML: '<span class="vjs-control-text">Loaded: 0%</span>'
            })
        },
        update: function () {
            this.el.style && (this.el.style.width = _V_.round(100 * this.player.bufferedPercent(), 2) + "%")
        }
    }), _V_.PlayProgressBar = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-play-progress",
                innerHTML: '<span class="vjs-control-text">Progress: 0%</span>'
            })
        }
    }), _V_.SeekHandle = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-seek-handle",
                innerHTML: '<span class="vjs-control-text">00:00</span>'
            })
        }
    }), _V_.VolumeControl = _V_.Component.extend({
        options: {
            components: {
                volumeBar: {}
            }
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-volume-control vjs-control"
            })
        }
    }), _V_.VolumeBar = _V_.Slider.extend({
        options: {
            components: {
                bar: {
                    componentClass: "VolumeLevel"
                },
                handle: {
                    componentClass: "VolumeHandle"
                }
            }
        },
        playerEvent: "volumechange",
        createElement: function () {
            return this._super("div", {
                className: "vjs-volume-bar"
            })
        },
        onMouseMove: function (e) {
            this.player.volume(this.calculateDistance(e))
        },
        getPercent: function () {
            return this.player.volume()
        },
        stepForward: function () {
            this.player.volume(this.player.volume() + .1)
        },
        stepBack: function () {
            this.player.volume(this.player.volume() - .1)
        }
    }), _V_.VolumeLevel = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-volume-level",
                innerHTML: '<span class="vjs-control-text"></span>'
            })
        }
    }), _V_.VolumeHandle = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-volume-handle",
                innerHTML: '<span class="vjs-control-text"></span>'
            })
        }
    }), _V_.MuteToggle = _V_.Button.extend({
        init: function (e, t) {
            this._super(e, t), e.addEvent("volumechange", _V_.proxy(this, this.update))
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-mute-control vjs-control",
                innerHTML: '<div><span class="vjs-control-text">Mute</span></div>'
            })
        },
        onClick: function () {
            this.player.muted(this.player.muted() ? !1 : !0)
        },
        update: function () {
            var e = this.player.volume(),
                t = 3;
            0 == e || this.player.muted() ? t = 0 : .33 > e ? t = 1 : .67 > e && (t = 2), _V_.each.call(this, [0, 1, 2, 3], function (e) {
                _V_.removeClass(this.el, "vjs-vol-" + e)
            }), _V_.addClass(this.el, "vjs-vol-" + t)
        }
    }), _V_.PosterImage = _V_.Button.extend({
        init: function (e, t) {
            this._super(e, t), this.player.options.poster || this.hide(), e.addEvent("play", _V_.proxy(this, this.hide))
        },
        createElement: function () {
            return _V_.createElement("img", {
                className: "vjs-poster",
                src: this.player.options.poster,
                tabIndex: -1
            })
        },
        onClick: function () {
            this.player.play()
        }
    }), _V_.Menu = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t)
        },
        addItem: function (e) {
            this.addComponent(e), e.addEvent("click", this.proxy(function () {
                this.unlockShowing()
            }))
        },
        createElement: function () {
            return this._super("ul", {
                className: "vjs-menu"
            })
        }
    }), _V_.MenuItem = _V_.Button.extend({
        init: function (e, t) {
            this._super(e, t), t.selected && this.addClass("vjs-selected")
        },
        createElement: function (e, t) {
            return this._super("li", _V_.merge({
                className: "vjs-menu-item",
                innerHTML: this.options.label
            }, t))
        },
        onClick: function () {
            this.selected(!0)
        },
        selected: function (e) {
            e ? this.addClass("vjs-selected") : this.removeClass("vjs-selected")
        }
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function (e) {
        "use strict";
        if (this === void 0 || null === this) throw new TypeError;
        var t = Object(this),
            n = t.length >>> 0;
        if (0 === n) return -1;
        var i = 0;
        if (arguments.length > 0 && (i = Number(arguments[1]), i !== i ? i = 0 : 0 !== i && i !== 1 / 0 && i !== -(1 / 0) && (i = (i > 0 || -1) * Math.floor(Math.abs(i)))), i >= n) return -1;
        for (var r = i >= 0 ? i : Math.max(n - Math.abs(i), 0); n > r; r++)
            if (r in t && t[r] === e) return r;
        return -1
    }), _V_.extend({
        addEvent: function (e, t, n) {
            var i, r = _V_.getData(e);
            r && !r.handler && (r.handler = function (t) {
                t = _V_.fixEvent(t);
                var n = _V_.getData(e).events[t.type];
                if (n) {
                    var i = [];
                    _V_.each(n, function (e, t) {
                        i[t] = e
                    });
                    for (var r = 0, s = i.length; s > r; r++) i[r].call(e, t)
                }
            }), r.events || (r.events = {}), i = r.events[t], i || (i = r.events[t] = [], document.addEventListener ? e.addEventListener(t, r.handler, !1) : document.attachEvent && e.attachEvent("on" + t, r.handler)), n.guid || (n.guid = _V_.guid++), i.push(n)
        },
        removeEvent: function (e, t, n) {
            var i, r = _V_.getData(e);
            if (r.events)
                if (t) {
                    if (i = r.events[t]) {
                        if (n && n.guid)
                            for (var s = 0; i.length > s; s++) i[s].guid === n.guid && i.splice(s--, 1);
                        _V_.cleanUpEvents(e, t)
                    }
                } else
                    for (t in r.events) _V_.cleanUpEvents(e, t)
        },
        cleanUpEvents: function (e, t) {
            var n = _V_.getData(e);
            0 === n.events[t].length && (delete n.events[t], document.removeEventListener ? e.removeEventListener(t, n.handler, !1) : document.detachEvent && e.detachEvent("on" + t, n.handler)), _V_.isEmpty(n.events) && (delete n.events, delete n.handler), _V_.isEmpty(n) && _V_.removeData(e)
        },
        fixEvent: function (e) {
            if (e[_V_.expando]) return e;
            var t = e;
            e = new _V_.Event(t);
            for (var n, i = _V_.Event.props.length; i;) n = _V_.Event.props[--i], e[n] = t[n];
            if (e.target || (e.target = e.srcElement || document), 3 === e.target.nodeType && (e.target = e.target.parentNode), !e.relatedTarget && e.fromElement && (e.relatedTarget = e.fromElement === e.target ? e.toElement : e.fromElement), null == e.pageX && null != e.clientX) {
                var r = e.target.ownerDocument || document,
                    s = r.documentElement,
                    a = r.body;
                e.pageX = e.clientX + (s && s.scrollLeft || a && a.scrollLeft || 0) - (s && s.clientLeft || a && a.clientLeft || 0), e.pageY = e.clientY + (s && s.scrollTop || a && a.scrollTop || 0) - (s && s.clientTop || a && a.clientTop || 0)
            }
            return null != e.which || null == e.charCode && null == e.keyCode || (e.which = null != e.charCode ? e.charCode : e.keyCode), !e.metaKey && e.ctrlKey && (e.metaKey = e.ctrlKey), e.which || e.button === undefined || (e.which = 1 & e.button ? 1 : 2 & e.button ? 3 : 4 & e.button ? 2 : 0), e
        },
        triggerEvent: function (e, t) {
            var n, i = _V_.getData(e),
                r = (e.parentNode || e.ownerDocument, t.type || t);
            i && (n = i.handler), t = "object" == typeof t ? t[_V_.expando] ? t : new _V_.Event(r, t) : new _V_.Event(r), t.type = r, n && n.call(e, t), t.result = undefined, t.target = e
        },
        one: function (e, t, n) {
            _V_.addEvent(e, t, function () {
                _V_.removeEvent(e, t, arguments.callee), n.apply(this, arguments)
            })
        }
    }), _V_.Event = function (e, t) {
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? returnTrue : returnFalse) : this.type = e, t && _V_.merge(this, t), this.timeStamp = (new Date).getTime(), this[_V_.expando] = !0
    }, _V_.Event.prototype = {
        preventDefault: function () {
            this.isDefaultPrevented = returnTrue;
            var e = this.originalEvent;
            e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        },
        stopPropagation: function () {
            this.isPropagationStopped = returnTrue;
            var e = this.originalEvent;
            e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
        },
        stopImmediatePropagation: function () {
            this.isImmediatePropagationStopped = returnTrue, this.stopPropagation()
        },
        isDefaultPrevented: returnFalse,
        isPropagationStopped: returnFalse,
        isImmediatePropagationStopped: returnFalse
    }, _V_.Event.props = "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" ");
    var JSON;
    JSON || (JSON = {}),
    function () {
        var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
        "function" != typeof JSON.parse && (JSON.parse = function (text, reviver) {
            function walk(e, t) {
                var n, i, r = e[t];
                if (r && "object" == typeof r)
                    for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (i = walk(r, n), i !== undefined ? r[n] = i : delete r[n]);
                return reviver.call(e, t, r)
            }
            var j;
            if (text += "", cx.lastIndex = 0, cx.test(text) && (text = text.replace(cx, function (e) {
                return "\\u" + ("0000" + e.charCodeAt(0).toString(16)).slice(-4)
            })), /^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) return j = eval("(" + text + ")"), "function" == typeof reviver ? walk({
                "": j
            }, "") : j;
            throw new SyntaxError("JSON.parse")
        })
    }(), _V_.Player = _V_.Component.extend({
        init: function (e, t, n) {
            this.tag = e;
            var i = this.el = _V_.createElement("div"),
                r = this.options = {}, s = r.width = e.getAttribute("width"),
                a = r.height = e.getAttribute("height"),
                o = s || 300,
                u = a || 150;
            if (e.player = i.player = this, this.ready(n), e.parentNode.insertBefore(i, e), i.appendChild(e), i.id = this.id = e.id, i.className = e.className, e.id += "_html5_api", e.className = "vjs-tech", _V_.players[i.id] = this, i.setAttribute("width", o), i.setAttribute("height", u), i.style.width = o + "px", i.style.height = u + "px", e.removeAttribute("width"), e.removeAttribute("height"), _V_.merge(r, _V_.options), _V_.merge(r, this.getVideoTagSettings()), _V_.merge(r, t), e.removeAttribute("controls"), e.removeAttribute("poster"), e.hasChildNodes())
                for (var l = 0, c = e.childNodes; c.length > l; l++)("SOURCE" == c[l].nodeName || "TRACK" == c[l].nodeName) && e.removeChild(c[l]);
            if (this.values = {}, this.addClass("vjs-paused"), this.addEvent("ended", this.onEnded), this.addEvent("play", this.onPlay), this.addEvent("pause", this.onPause), this.addEvent("progress", this.onProgress), this.addEvent("error", this.onError), r.controls && this.ready(function () {
                this.initComponents()
            }), this.textTracks = [], r.tracks && r.tracks.length > 0 && this.addTextTracks(r.tracks), r.sources && 0 != r.sources.length) this.src(r.sources);
            else
                for (var l = 0, c = r.techOrder; c.length > l; l++) {
                    var d = c[l],
                        h = _V_[d];
                    if (h.isSupported()) {
                        this.loadTech(d);
                        break
                    }
                }
        },
        values: {},
        destroy: function () {
            this.stopTrackingProgress(), this.stopTrackingCurrentTime(), _V_.players[this.id] = null, delete _V_.players[this.id], this.tech.destroy(), this.el.parentNode.removeChild(this.el)
        },
        createElement: function () {},
        getVideoTagSettings: function () {
            var e = {
                sources: [],
                tracks: []
            };
            if (e.src = this.tag.getAttribute("src"), e.controls = null !== this.tag.getAttribute("controls"), e.poster = this.tag.getAttribute("poster"), e.preload = this.tag.getAttribute("preload"), e.autoplay = null !== this.tag.getAttribute("autoplay"), e.loop = null !== this.tag.getAttribute("loop"), e.muted = null !== this.tag.getAttribute("muted"), this.tag.hasChildNodes())
                for (var t, n = 0, i = this.tag.childNodes; i.length > n; n++) t = i[n], "SOURCE" == t.nodeName && e.sources.push({
                    src: t.getAttribute("src"),
                    type: t.getAttribute("type"),
                    media: t.getAttribute("media"),
                    title: t.getAttribute("title")
                }), "TRACK" == t.nodeName && e.tracks.push({
                    src: t.getAttribute("src"),
                    kind: t.getAttribute("kind"),
                    srclang: t.getAttribute("srclang"),
                    label: t.getAttribute("label"),
                    "default": null !== t.getAttribute("default"),
                    title: t.getAttribute("title")
                });
            return e
        },
        loadTech: function (e, t) {
            this.tech ? this.unloadTech() : "html5" != e && this.tag && (this.el.removeChild(this.tag), this.tag = !1), this.techName = e, this.isReady = !1;
            var n = function () {
                this.player.triggerReady(), this.support.progressEvent || this.player.manualProgressOn(), this.support.timeupdateEvent || this.player.manualTimeUpdatesOn()
            }, i = _V_.merge({
                    source: t,
                    parentEl: this.el
                }, this.options[e]);
            t && (t.src == this.values.src && this.values.currentTime > 0 && (i.startTime = this.values.currentTime), this.values.src = t.src), this.tech = new _V_[e](this, i), this.tech.ready(n)
        },
        unloadTech: function () {
            this.tech.destroy(), this.manualProgress && this.manualProgressOff(), this.manualTimeUpdates && this.manualTimeUpdatesOff(), this.tech = !1
        },
        manualProgressOn: function () {
            this.manualProgress = !0, this.trackProgress(), this.tech.addEvent("progress", function () {
                this.removeEvent("progress", arguments.callee), this.support.progressEvent = !0, this.player.manualProgressOff()
            })
        },
        manualProgressOff: function () {
            this.manualProgress = !1, this.stopTrackingProgress()
        },
        trackProgress: function () {
            this.progressInterval = setInterval(_V_.proxy(this, function () {
                this.values.bufferEnd < this.buffered().end(0) ? this.triggerEvent("progress") : 1 == this.bufferedPercent() && (this.stopTrackingProgress(), this.triggerEvent("progress"))
            }), 500)
        },
        stopTrackingProgress: function () {
            clearInterval(this.progressInterval)
        },
        manualTimeUpdatesOn: function () {
            this.manualTimeUpdates = !0, this.addEvent("play", this.trackCurrentTime), this.addEvent("pause", this.stopTrackingCurrentTime), this.tech.addEvent("timeupdate", function () {
                this.removeEvent("timeupdate", arguments.callee), this.support.timeupdateEvent = !0, this.player.manualTimeUpdatesOff()
            })
        },
        manualTimeUpdatesOff: function () {
            this.manualTimeUpdates = !1, this.stopTrackingCurrentTime(), this.removeEvent("play", this.trackCurrentTime), this.removeEvent("pause", this.stopTrackingCurrentTime)
        },
        trackCurrentTime: function () {
            this.currentTimeInterval && this.stopTrackingCurrentTime(), this.currentTimeInterval = setInterval(_V_.proxy(this, function () {
                this.triggerEvent("timeupdate")
            }), 250)
        },
        stopTrackingCurrentTime: function () {
            clearInterval(this.currentTimeInterval)
        },
        onEnded: function () {
            this.options.loop ? (this.currentTime(0), this.play()) : (this.pause(), this.currentTime(0), this.pause())
        },
        onPlay: function () {
            _V_.removeClass(this.el, "vjs-paused"), _V_.addClass(this.el, "vjs-playing")
        },
        onPause: function () {
            _V_.removeClass(this.el, "vjs-playing"), _V_.addClass(this.el, "vjs-paused")
        },
        onProgress: function () {
            1 == this.bufferedPercent() && this.triggerEvent("loadedalldata")
        },
        onError: function (e) {
            _V_.log("Video Error", e)
        },
        techCall: function (e, t) {
            if (this.tech.isReady) try {
                this.tech[e](t)
            } catch (n) {
                _V_.log(n)
            } else this.tech.ready(function () {
                this[e](t)
            })
        },
        techGet: function (e) {
            if (this.tech.isReady) try {
                return this.tech[e]()
            } catch (t) {
                this.tech[e] === undefined ? _V_.log("Video.js: " + e + " method not defined for " + this.techName + " playback technology.", t) : "TypeError" == t.name ? (_V_.log("Video.js: " + e + " unavailable on " + this.techName + " playback technology element.", t), this.tech.isReady = !1) : _V_.log(t)
            }
        },
        play: function () {
            return this.techCall("play"), this
        },
        pause: function () {
            return this.techCall("pause"), this
        },
        paused: function () {
            return this.techGet("paused") === !1 ? !1 : !0
        },
        currentTime: function (e) {
            return e !== undefined ? (this.values.lastSetCurrentTime = e, this.techCall("setCurrentTime", e), this.manualTimeUpdates && this.triggerEvent("timeupdate"), this) : this.values.currentTime = this.techGet("currentTime") || 0
        },
        duration: function () {
            return parseFloat(this.techGet("duration"))
        },
        remainingTime: function () {
            return this.duration() - this.currentTime()
        },
        buffered: function () {
            var e = this.techGet("buffered"),
                t = 0,
                n = this.values.bufferEnd = this.values.bufferEnd || 0;
            return e && e.length > 0 && e.end(0) !== n && (n = e.end(0), this.values.bufferEnd = n), _V_.createTimeRange(t, n)
        },
        bufferedPercent: function () {
            return this.duration() ? this.buffered().end(0) / this.duration() : 0
        },
        volume: function (e) {
            var t;
            return e !== undefined ? (t = Math.max(0, Math.min(1, parseFloat(e))), this.values.volume = t, this.techCall("setVolume", t), _V_.setLocalStorage("volume", t), this) : (t = parseFloat(this.techGet("volume")), isNaN(t) ? 1 : t)
        },
        muted: function (e) {
            return e !== undefined ? (this.techCall("setMuted", e), this) : this.techGet("muted") || !1
        },
        width: function (e, t) {
            return e !== undefined ? (this.el.width = e, this.el.style.width = e + "px", t || this.triggerEvent("resize"), this) : parseInt(this.el.getAttribute("width"))
        },
        height: function (e) {
            return e !== undefined ? (this.el.height = e, this.el.style.height = e + "px", this.triggerEvent("resize"), this) : parseInt(this.el.getAttribute("height"))
        },
        size: function (e, t) {
            return this.width(e, !0).height(t)
        },
        supportsFullScreen: function () {
            return this.techGet("supportsFullScreen") || !1
        },
        requestFullScreen: function () {
            var e = _V_.support.requestFullScreen;
            return this.isFullScreen = !0, e ? (_V_.addEvent(document, e.eventName, this.proxy(function () {
                this.isFullScreen = document[e.isFullScreen], 0 == this.isFullScreen && _V_.removeEvent(document, e.eventName, arguments.callee), this.triggerEvent("fullscreenchange")
            })), this.tech.support.fullscreenResize === !1 && 1 != this.options.flash.iFrameMode ? (this.pause(), this.unloadTech(), _V_.addEvent(document, e.eventName, this.proxy(function () {
                _V_.removeEvent(document, e.eventName, arguments.callee), this.loadTech(this.techName, {
                    src: this.values.src
                })
            })), this.el[e.requestFn]()) : this.el[e.requestFn]()) : this.tech.supportsFullScreen() ? (this.triggerEvent("fullscreenchange"), this.techCall("enterFullScreen")) : (this.triggerEvent("fullscreenchange"), this.enterFullWindow()), this
        },
        cancelFullScreen: function () {
            var e = _V_.support.requestFullScreen;
            return this.isFullScreen = !1, e ? this.tech.support.fullscreenResize === !1 && 1 != this.options.flash.iFrameMode ? (this.pause(), this.unloadTech(), _V_.addEvent(document, e.eventName, this.proxy(function () {
                _V_.removeEvent(document, e.eventName, arguments.callee), this.loadTech(this.techName, {
                    src: this.values.src
                })
            })), document[e.cancelFn]()) : document[e.cancelFn]() : this.tech.supportsFullScreen() ? (this.techCall("exitFullScreen"), this.triggerEvent("fullscreenchange")) : (this.exitFullWindow(), this.triggerEvent("fullscreenchange")), this
        },
        enterFullWindow: function () {
            this.isFullWindow = !0, this.docOrigOverflow = document.documentElement.style.overflow, _V_.addEvent(document, "keydown", _V_.proxy(this, this.fullWindowOnEscKey)), document.documentElement.style.overflow = "hidden", _V_.addClass(document.body, "vjs-full-window"), _V_.addClass(this.el, "vjs-fullscreen"), this.triggerEvent("enterFullWindow")
        },
        fullWindowOnEscKey: function (e) {
            27 == e.keyCode && (1 == this.isFullScreen ? this.cancelFullScreen() : this.exitFullWindow())
        },
        exitFullWindow: function () {
            this.isFullWindow = !1, _V_.removeEvent(document, "keydown", this.fullWindowOnEscKey), document.documentElement.style.overflow = this.docOrigOverflow, _V_.removeClass(document.body, "vjs-full-window"), _V_.removeClass(this.el, "vjs-fullscreen"), this.triggerEvent("exitFullWindow")
        },
        selectSource: function (e) {
            for (var t = 0, n = this.options.techOrder; n.length > t; t++) {
                var i = n[t],
                    r = _V_[i];
                if (r.isSupported())
                    for (var s = 0, a = e; a.length > s; s++) {
                        var o = a[s];
                        if (r.canPlaySource.call(this, o)) return {
                            source: o,
                            tech: i
                        }
                    }
            }
            return !1
        },
        src: function (e) {
            if (e instanceof Array) {
                var e, t, n = this.selectSource(e);
                n ? (e = n.source, t = n.tech, t == this.techName ? this.src(e) : this.loadTech(t, e)) : _V_.log("No compatible source and playback technology were found.")
            } else e instanceof Object ? _V_[this.techName].canPlaySource(e) ? this.src(e.src) : this.src([e]) : (this.values.src = e, this.isReady ? (this.techCall("src", e), "auto" == this.options.preload && this.load(), this.options.autoplay && this.play()) : this.ready(function () {
                this.src(e)
            }));
            return this
        },
        load: function () {
            return this.techCall("load"), this
        },
        currentSrc: function () {
            return this.techGet("currentSrc") || this.values.src || ""
        },
        preload: function (e) {
            return e !== undefined ? (this.techCall("setPreload", e), this.options.preload = e, this) : this.techGet("preload")
        },
        autoplay: function (e) {
            return e !== undefined ? (this.techCall("setAutoplay", e), this.options.autoplay = e, this) : this.techGet("autoplay", e)
        },
        loop: function (e) {
            return e !== undefined ? (this.techCall("setLoop", e), this.options.loop = e, this) : this.techGet("loop")
        },
        controls: function () {
            return this.options.controls
        },
        poster: function () {
            return this.techGet("poster")
        },
        error: function () {
            return this.techGet("error")
        },
        ended: function () {
            return this.techGet("ended")
        }
    }),
    function () {
        var e, t, n, i;
        _V_.Player.prototype, document.cancelFullscreen !== undefined ? (e = "requestFullscreen", t = "exitFullscreen", n = "fullscreenchange", i = "fullScreen") : _V_.each(["moz", "webkit"], function (r) {
            "moz" == r && !document.mozFullScreenEnabled || document[r + "CancelFullScreen"] === undefined || (e = r + "RequestFullScreen", t = r + "CancelFullScreen", n = r + "fullscreenchange", i = "webkit" == r ? r + "IsFullScreen" : r + "FullScreen")
        }), e && (_V_.support.requestFullScreen = {
            requestFn: e,
            cancelFn: t,
            eventName: n,
            isFullScreen: i
        })
    }(), _V_.PlaybackTech = _V_.Component.extend({
        init: function () {},
        onClick: function () {
            this.player.options.controls && _V_.PlayToggle.prototype.onClick.call(this)
        }
    }), _V_.apiMethods = "play,pause,paused,currentTime,setCurrentTime,duration,buffered,volume,setVolume,muted,setMuted,width,height,supportsFullScreen,enterFullScreen,src,load,currentSrc,preload,setPreload,autoplay,setAutoplay,loop,setLoop,error,networkState,readyState,seeking,initialTime,startOffsetTime,played,seekable,ended,videoTracks,audioTracks,videoWidth,videoHeight,textTracks,defaultPlaybackRate,playbackRate,mediaGroup,controller,controls,defaultMuted".split(","), _V_.each(_V_.apiMethods, function (e) {
        _V_.PlaybackTech.prototype[e] = function () {
            throw Error("The '" + e + "' method is not available on the playback technology's API")
        }
    }), _V_.html5 = _V_.PlaybackTech.extend({
        init: function (e, t, n) {
            this.player = e, this.el = this.createElement(), this.ready(n), this.addEvent("click", this.proxy(this.onClick));
            var i = t.source;
            i && this.el.currentSrc == i.src ? e.triggerEvent("loadstart") : i && (this.el.src = i.src), e.ready(function () {
                this.options.autoplay && this.paused() && (this.tag.poster = null, this.play())
            }), this.setupTriggers(), this.triggerReady()
        },
        destroy: function () {
            this.player.tag = !1, this.removeTriggers(), this.el.parentNode.removeChild(this.el)
        },
        createElement: function () {
            var e, t = (_V_.html5, this.player),
                n = t.tag;
            return n && this.support.movingElementInDOM !== !1 || (n && t.el.removeChild(n), e = _V_.createElement("video", {
                id: n.id || t.el.id + "_html5_api",
                className: n.className || "vjs-tech"
            }), n = e, _V_.insertFirst(n, t.el)), _V_.each(["autoplay", "preload", "loop", "muted"], function (e) {
                null !== t.options[e] && (n[e] = t.options[e])
            }, this), n
        },
        setupTriggers: function () {
            _V_.each.call(this, _V_.html5.events, function (e) {
                _V_.addEvent(this.el, e, _V_.proxy(this.player, this.eventHandler))
            })
        },
        removeTriggers: function () {
            _V_.each.call(this, _V_.html5.events, function (e) {
                _V_.removeEvent(this.el, e, _V_.proxy(this.player, this.eventHandler))
            })
        },
        eventHandler: function (e) {
            e.stopPropagation(), this.triggerEvent(e)
        },
        play: function () {
            this.el.play()
        },
        pause: function () {
            this.el.pause()
        },
        paused: function () {
            return this.el.paused
        },
        currentTime: function () {
            return this.el.currentTime
        },
        setCurrentTime: function (e) {
            try {
                this.el.currentTime = e
            } catch (t) {
                _V_.log(t, "Video isn't ready. (VideoJS)")
            }
        },
        duration: function () {
            return this.el.duration || 0
        },
        buffered: function () {
            return this.el.buffered
        },
        volume: function () {
            return this.el.volume
        },
        setVolume: function (e) {
            this.el.volume = e
        },
        muted: function () {
            return this.el.muted
        },
        setMuted: function (e) {
            this.el.muted = e
        },
        width: function () {
            return this.el.offsetWidth
        },
        height: function () {
            return this.el.offsetHeight
        },
        supportsFullScreen: function () {
            return "function" != typeof this.el.webkitEnterFullScreen || navigator.userAgent.match("Chrome") || navigator.userAgent.match("Mac OS X 10.5") ? !1 : !0
        },
        enterFullScreen: function () {
            try {
                this.el.webkitEnterFullScreen()
            } catch (e) {
                11 == e.code && _V_.log("VideoJS: Video not ready.")
            }
        },
        src: function (e) {
            this.el.src = e
        },
        load: function () {
            this.el.load()
        },
        currentSrc: function () {
            return this.el.currentSrc
        },
        preload: function () {
            return this.el.preload
        },
        setPreload: function (e) {
            this.el.preload = e
        },
        autoplay: function () {
            return this.el.autoplay
        },
        setAutoplay: function (e) {
            this.el.autoplay = e
        },
        loop: function () {
            return this.el.loop
        },
        setLoop: function (e) {
            this.el.loop = e
        },
        error: function () {
            return this.el.error
        },
        seeking: function () {
            return this.el.seeking
        },
        ended: function () {
            return this.el.ended
        },
        controls: function () {
            return this.player.options.controls
        },
        defaultMuted: function () {
            return this.el.defaultMuted
        }
    }), _V_.html5.isSupported = function () {
        return !!document.createElement("video").canPlayType
    }, _V_.html5.canPlaySource = function (e) {
        return !!document.createElement("video").canPlayType(e.type)
    }, _V_.html5.events = "loadstart,suspend,abort,error,emptied,stalled,loadedmetadata,loadeddata,canplay,canplaythrough,playing,waiting,seeking,seeked,ended,durationchange,timeupdate,progress,play,pause,ratechange,volumechange".split(","), _V_.html5.prototype.support = {
        fullscreen: typeof _V_.testVid.webkitEnterFullScreen !== undefined ? _V_.ua.match("Chrome") || _V_.ua.match("Mac OS X 10.5") ? !1 : !0 : !1,
        movingElementInDOM: !_V_.isIOS()
    }, _V_.isAndroid() && 3 > _V_.androidVersion() && (document.createElement("video").constructor.prototype.canPlayType = function (e) {
        return e && -1 != e.toLowerCase().indexOf("video/mp4") ? "maybe" : ""
    }), _V_.flash = _V_.PlaybackTech.extend({
        init: function (e, t) {
            this.player = e;
            var n = t.source,
                i = t.parentEl,
                r = this.el = _V_.createElement("div", {
                    id: i.id + "_temp_flash"
                }),
                s = e.el.id + "_flash_api",
                a = e.options,
                o = _V_.merge({
                    readyFunction: "_V_.flash.onReady",
                    eventProxyFunction: "_V_.flash.onEvent",
                    errorEventProxyFunction: "_V_.flash.onError",
                    autoplay: a.autoplay,
                    preload: a.preload,
                    loop: a.loop,
                    muted: a.muted
                }, t.flashVars),
                u = _V_.merge({
                    wmode: "opaque",
                    bgcolor: "#000000"
                }, t.params),
                l = _V_.merge({


                    id: s,
                    name: s,
                    "class": "vjs-tech"
                }, t.attributes);
            if (n && (o.src = encodeURIComponent(_V_.getAbsoluteURL(n.src))), _V_.insertFirst(r, i), t.startTime && this.ready(function () {
                this.load(), this.play(), this.currentTime(t.startTime)
            }), 1 != t.iFrameMode || _V_.isFF) _V_.flash.embed(t.swf, r, o, u, l);
            else {
                var c = _V_.createElement("iframe", {
                    id: s + "_iframe",
                    name: s + "_iframe",
                    className: "vjs-tech",
                    scrolling: "no",
                    marginWidth: 0,
                    marginHeight: 0,
                    frameBorder: 0
                });
                o.readyFunction = "ready", o.eventProxyFunction = "events", o.errorEventProxyFunction = "errors", _V_.addEvent(c, "load", _V_.proxy(this, function () {
                    var e, n = c.contentWindow;
                    e = c.contentDocument ? c.contentDocument : c.contentWindow.document, e.write(_V_.flash.getEmbedCode(t.swf, o, u, l)), n.player = this.player, n.ready = _V_.proxy(this.player, function (t) {
                        var n = e.getElementById(t),
                            i = this,
                            r = i.tech;
                        r.el = n, _V_.addEvent(n, "click", r.proxy(r.onClick)), _V_.flash.checkReady(r)
                    }), n.events = _V_.proxy(this.player, function (e, t) {
                        var n = this;
                        n && "flash" == n.techName && n.triggerEvent(t)
                    }), n.errors = _V_.proxy(this.player, function (e, t) {
                        _V_.log("Flash Error", t)
                    })
                })), r.parentNode.replaceChild(c, r)
            }
        },
        destroy: function () {
            this.el.parentNode.removeChild(this.el)
        },
        play: function () {
            this.el.vjs_play()
        },
        pause: function () {
            this.el.vjs_pause()
        },
        src: function (e) {
            if (e = _V_.getAbsoluteURL(e), this.el.vjs_src(e), this.player.autoplay()) {
                var t = this;
                setTimeout(function () {
                    t.play()
                }, 0)
            }
        },
        load: function () {
            this.el.vjs_load()
        },
        poster: function () {
            this.el.vjs_getProperty("poster")
        },
        buffered: function () {
            return _V_.createTimeRange(0, this.el.vjs_getProperty("buffered"))
        },
        supportsFullScreen: function () {
            return !1
        },
        enterFullScreen: function () {
            return !1
        }
    }),
    function () {
        var e = _V_.flash.prototype,
            t = "preload,currentTime,defaultPlaybackRate,playbackRate,autoplay,loop,mediaGroup,controller,controls,volume,muted,defaultMuted".split(","),
            n = "error,currentSrc,networkState,readyState,seeking,initialTime,duration,startOffsetTime,paused,played,seekable,ended,videoTracks,audioTracks,videoWidth,videoHeight,textTracks".split(",");
        "load,play,pause".split(","), createSetter = function (t) {
            var n = t.charAt(0).toUpperCase() + t.slice(1);
            e["set" + n] = function (e) {
                return this.el.vjs_setProperty(t, e)
            }
        }, createGetter = function (t) {
            e[t] = function () {
                return this.el.vjs_getProperty(t)
            }
        }, _V_.each(t, function (e) {
            createGetter(e), createSetter(e)
        }), _V_.each(n, function (e) {
            createGetter(e)
        })
    }(), _V_.flash.isSupported = function () {
        return _V_.flash.version()[0] >= 10
    }, _V_.flash.canPlaySource = function (e) {
        return e.type in _V_.flash.prototype.support.formats ? "maybe" : undefined
    }, _V_.flash.prototype.support = {
        formats: {
            "video/flv": "FLV",
            "video/x-flv": "FLV",
            "video/mp4": "MP4",
            "video/m4v": "MP4"
        },
        progressEvent: !1,
        timeupdateEvent: !1,
        fullscreenResize: !1,
        parentResize: !_V_.ua.match("Firefox")
    }, _V_.flash.onReady = function (e) {
        var t = _V_.el(e),
            n = t.player || t.parentNode.player,
            i = n.tech;
        t.player = n, i.el = t, i.addEvent("click", i.onClick), _V_.flash.checkReady(i)
    }, _V_.flash.checkReady = function (e) {
        e.el.vjs_getProperty ? e.triggerReady() : setTimeout(function () {
            _V_.flash.checkReady(e)
        }, 50)
    }, _V_.flash.onEvent = function (e, t) {
        var n = _V_.el(e).player;
        n.triggerEvent(t)
    }, _V_.flash.onError = function (e, t) {
        var n = _V_.el(e).player;
        n.triggerEvent("error"), _V_.log("Flash Error", t, e)
    }, _V_.flash.version = function () {
        var e = "0,0,0";
        try {
            e = new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version").replace(/\D+/g, ",").match(/^,?(.+),?$/)[1]
        } catch (t) {
            try {
                navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin && (e = (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g, ",").match(/^,?(.+),?$/)[1])
            } catch (t) {}
        }
        return e.split(",")
    }, _V_.flash.embed = function (e, t, n, i, r) {
        var s = _V_.flash.getEmbedCode(e, n, i, r),
            a = _V_.createElement("div", {
                innerHTML: s
            }).childNodes[0],
            o = t.parentNode;
        if (t.parentNode.replaceChild(a, t), _V_.isIE()) {
            var u = o.childNodes[0];
            setTimeout(function () {
                u.style.display = "block"
            }, 1e3)
        }
        return a
    }, _V_.flash.getEmbedCode = function (e, t, n, i) {
        var r = '<object type="application/x-shockwave-flash"',
            s = "",
            a = "";
        return attrsString = "", t && _V_.eachProp(t, function (e, t) {
            s += e + "=" + t + "&amp;"
        }), n = _V_.merge({
            movie: e,
            flashvars: s,
            allowScriptAccess: "always",
            allowNetworking: "all"
        }, n), _V_.eachProp(n, function (e, t) {
            a += '<param name="' + e + '" value="' + t + '" />'
        }), i = _V_.merge({
            data: e,
            width: "100%",
            height: "100%"
        }, i), _V_.eachProp(i, function (e, t) {
            attrsString += e + '="' + t + '" '
        }), r + attrsString + ">" + a + "</object>"
    }, _V_.merge(_V_.Player.prototype, {
        addTextTracks: function (e) {
            for (var t, n, i = this.textTracks = this.textTracks ? this.textTracks : [], r = 0, s = e.length; s > r; r++) n = _V_.uc(e[r].kind || "subtitles"), t = new _V_[n + "Track"](this, e[r]), i.push(t), t["default"] && this.ready(_V_.proxy(t, t.show));
            return this
        },
        showTextTrack: function (e, t) {
            for (var n, i, r, s = this.textTracks, a = 0, o = s.length; o > a; a++) n = s[a], n.id === e ? (n.show(), i = n) : t && n.kind == t && n.mode > 0 && n.disable();
            return r = i ? i.kind : t ? t : !1, r && this.triggerEvent(r + "trackchange"), this
        }
    }), _V_.Track = _V_.Component.extend({
        init: function (e, t) {
            this._super(e, t), _V_.merge(this, {
                id: t.id || "vjs_" + t.kind + "_" + t.language + "_" + _V_.guid++,
                src: t.src,
                "default": t["default"],
                title: t.title,
                language: t.srclang,
                label: t.label,
                cues: [],
                activeCues: [],
                readyState: 0,
                mode: 0
            })
        },
        createElement: function () {
            return this._super("div", {
                className: "vjs-" + this.kind + " vjs-text-track"
            })
        },
        show: function () {
            this.activate(), this.mode = 2, this._super()
        },
        hide: function () {
            this.activate(), this.mode = 1, this._super()
        },
        disable: function () {
            2 == this.mode && this.hide(), this.deactivate(), this.mode = 0
        },
        activate: function () {
            0 == this.readyState && this.load(), 0 == this.mode && (this.player.addEvent("timeupdate", this.proxy(this.update, this.id)), this.player.addEvent("ended", this.proxy(this.reset, this.id)), ("captions" == this.kind || "subtitles" == this.kind) && this.player.textTrackDisplay.addComponent(this))
        },
        deactivate: function () {
            this.player.removeEvent("timeupdate", this.proxy(this.update, this.id)), this.player.removeEvent("ended", this.proxy(this.reset, this.id)), this.reset(), this.player.textTrackDisplay.removeComponent(this)
        },
        load: function () {
            0 == this.readyState && (this.readyState = 1, _V_.get(this.src, this.proxy(this.parseCues), this.proxy(this.onError)))
        },
        onError: function (e) {
            this.error = e, this.readyState = 3, this.triggerEvent("error")
        },
        parseCues: function (e) {
            for (var t, n, i, r, s = e.split("\n"), a = "", o = 1, u = s.length; u > o; o++)
                if (a = _V_.trim(s[o])) {
                    for (-1 == a.indexOf("-->") ? (r = a, a = _V_.trim(s[++o])) : r = this.cues.length, t = {
                        id: r,
                        index: this.cues.length
                    }, n = a.split(" --> "), t.startTime = this.parseCueTime(n[0]), t.endTime = this.parseCueTime(n[1]), i = []; s[++o] && (a = _V_.trim(s[o]));) i.push(a);
                    t.text = i.join("<br/>"), this.cues.push(t)
                }
            this.readyState = 2, this.triggerEvent("loaded")
        },
        parseCueTime: function (e) {
            var t, n, i, r, s, a = e.split(":"),
                o = 0;
            return 3 == a.length ? (t = a[0], n = a[1], i = a[2]) : (t = 0, n = a[0], i = a[1]), i = i.split(/\s+/), r = i.splice(0, 1)[0], r = r.split(/\.|,/), s = parseFloat(r[1]), r = r[0], o += 3600 * parseFloat(t), o += 60 * parseFloat(n), o += parseFloat(r), s && (o += s / 1e3), o
        },
        update: function () {
            if (this.cues.length > 0) {
                var e = this.player.currentTime();
                if (this.prevChange === undefined || this.prevChange > e || e >= this.nextChange) {
                    var t, n, i, r, s = this.cues,
                        a = this.player.duration(),
                        o = 0,
                        u = !1,
                        l = [];
                    for (e >= this.nextChange || this.nextChange === undefined ? r = this.firstActiveIndex !== undefined ? this.firstActiveIndex : 0 : (u = !0, r = this.lastActiveIndex !== undefined ? this.lastActiveIndex : s.length - 1);;) {
                        if (i = s[r], e >= i.endTime) o = Math.max(o, i.endTime), i.active && (i.active = !1);
                        else if (i.startTime > e) {
                            if (a = Math.min(a, i.startTime), i.active && (i.active = !1), !u) break
                        } else u ? (l.splice(0, 0, i), n === undefined && (n = r), t = r) : (l.push(i), t === undefined && (t = r), n = r), a = Math.min(a, i.endTime), o = Math.max(o, i.startTime), i.active = !0; if (u) {
                            if (0 === r) break;
                            r--
                        } else {
                            if (r === s.length - 1) break;
                            r++
                        }
                    }
                    this.activeCues = l, this.nextChange = a, this.prevChange = o, this.firstActiveIndex = t, this.lastActiveIndex = n, this.updateDisplay(), this.triggerEvent("cuechange")
                }
            }
        },
        updateDisplay: function () {
            for (var e = this.activeCues, t = "", n = 0, i = e.length; i > n; n++) t += "<span class='vjs-tt-cue'>" + e[n].text + "</span>";
            this.el.innerHTML = t
        },
        reset: function () {
            this.nextChange = 0, this.prevChange = this.player.duration(), this.firstActiveIndex = 0, this.lastActiveIndex = 0
        }
    }), _V_.CaptionsTrack = _V_.Track.extend({
        kind: "captions"
    }), _V_.SubtitlesTrack = _V_.Track.extend({
        kind: "subtitles"
    }), _V_.ChaptersTrack = _V_.Track.extend({
        kind: "chapters"
    }), _V_.TextTrackDisplay = _V_.Component.extend({
        createElement: function () {
            return this._super("div", {
                className: "vjs-text-track-display"
            })
        }
    }), _V_.TextTrackMenuItem = _V_.MenuItem.extend({
        init: function (e, t) {
            var n = this.track = t.track;
            t.label = n.label, t.selected = n["default"], this._super(e, t), this.player.addEvent(n.kind + "trackchange", _V_.proxy(this, this.update))
        },
        onClick: function () {
            this._super(), this.player.showTextTrack(this.track.id, this.track.kind)
        },
        update: function () {
            2 == this.track.mode ? this.selected(!0) : this.selected(!1)
        }
    }), _V_.OffTextTrackMenuItem = _V_.TextTrackMenuItem.extend({
        init: function (e, t) {
            t.track = {
                kind: t.kind,
                player: e,
                label: "Off"
            }, this._super(e, t)
        },
        onClick: function () {
            this._super(), this.player.showTextTrack(this.track.id, this.track.kind)
        },
        update: function () {
            for (var e, t = this.player.textTracks, n = 0, i = t.length, r = !0; i > n; n++) e = t[n], e.kind == this.track.kind && 2 == e.mode && (r = !1);
            r ? this.selected(!0) : this.selected(!1)
        }
    }), _V_.TextTrackButton = _V_.Button.extend({
        init: function (e, t) {
            this._super(e, t), this.menu = this.createMenu(), 0 === this.items.length && this.hide()
        },
        createMenu: function () {
            var e = new _V_.Menu(this.player);
            return e.el.appendChild(_V_.createElement("li", {
                className: "vjs-menu-title",
                innerHTML: _V_.uc(this.kind)
            })), e.addItem(new _V_.OffTextTrackMenuItem(this.player, {
                kind: this.kind
            })), this.items = this.createItems(), this.each(this.items, function (t) {
                e.addItem(t)
            }), this.addComponent(e), e
        },
        createItems: function () {
            var e = [];
            return this.each(this.player.textTracks, function (t) {
                t.kind === this.kind && e.push(new _V_.TextTrackMenuItem(this.player, {
                    track: t
                }))
            }), e
        },
        buildCSSClass: function () {
            return this.className + " vjs-menu-button " + this._super()
        },
        onFocus: function () {
            this.menu.lockShowing(), _V_.one(this.menu.el.childNodes[this.menu.el.childNodes.length - 1], "blur", this.proxy(function () {
                this.menu.unlockShowing()
            }))
        },
        onBlur: function () {},
        onClick: function () {
            this.one("mouseout", this.proxy(function () {
                this.menu.unlockShowing(), this.el.blur()
            }))
        }
    }), _V_.CaptionsButton = _V_.TextTrackButton.extend({
        kind: "captions",
        buttonText: "Captions",
        className: "vjs-captions-button"
    }), _V_.SubtitlesButton = _V_.TextTrackButton.extend({
        kind: "subtitles",
        buttonText: "Subtitles",
        className: "vjs-subtitles-button"
    }), _V_.ChaptersButton = _V_.TextTrackButton.extend({
        kind: "chapters",
        buttonText: "Chapters",
        className: "vjs-chapters-button",
        createItems: function () {
            var e = [];
            return this.each(this.player.textTracks, function (t) {
                t.kind === this.kind && e.push(new _V_.TextTrackMenuItem(this.player, {
                    track: t
                }))
            }), e
        },
        createMenu: function () {
            for (var e, t, n = this.player.textTracks, i = 0, r = n.length, s = this.items = []; r > i; i++)
                if (e = n[i], e.kind == this.kind && e["default"]) {
                    if (2 > e.readyState) return this.chaptersTrack = e, e.addEvent("loaded", this.proxy(this.createMenu)), undefined;
                    t = e;
                    break
                }
            var a = this.menu = new _V_.Menu(this.player);
            if (a.el.appendChild(_V_.createElement("li", {
                className: "vjs-menu-title",
                innerHTML: _V_.uc(this.kind)
            })), t)
                for (var o, u, l = t.cues, i = 0, r = l.length; r > i; i++) o = l[i], u = new _V_.ChaptersTrackMenuItem(this.player, {
                    track: t,
                    cue: o
                }), s.push(u), a.addComponent(u);
            return this.addComponent(a), this.items.length > 0 && this.show(), a
        }
    }), _V_.ChaptersTrackMenuItem = _V_.MenuItem.extend({
        init: function (e, t) {
            var n = this.track = t.track,
                i = this.cue = t.cue,
                r = e.currentTime();
            t.label = i.text, t.selected = r >= i.startTime && i.endTime > r, this._super(e, t), n.addEvent("cuechange", _V_.proxy(this, this.update))
        },
        onClick: function () {
            this._super(), this.player.currentTime(this.cue.startTime), this.update(this.cue.startTime)
        },
        update: function () {
            var e = this.cue,
                t = this.player.currentTime();
            t >= e.startTime && e.endTime > t ? this.selected(!0) : this.selected(!1)
        }
    }), _V_.merge(_V_.ControlBar.prototype.options.components, {
        subtitlesButton: {},
        captionsButton: {},
        chaptersButton: {}
    }), _V_.autoSetup = function () {
        var e, t, n, i = document.getElementsByTagName("video");
        if (i && i.length > 0)
            for (var r = 0, s = i.length; s > r; r++) {
                if (t = i[r], !t || !t.getAttribute) {
                    _V_.autoSetupTimeout(1);
                    break
                }
                t.player === undefined && (e = t.getAttribute("data-setup"), null !== e && (e = JSON.parse(e || "{}"), n = _V_(t, e)))
            } else _V_.windowLoaded || _V_.autoSetupTimeout(1)
    }, _V_.autoSetupTimeout = function (e) {
        setTimeout(_V_.autoSetup, e)
    }, _V_.addEvent(window, "load", function () {
        _V_.windowLoaded = !0
    }), _V_.autoSetup(), window.VideoJS = window._V_ = VideoJS
}(window),
function (e) {
    e.BigVideo = function (t) {
        function n() {
            var t = e(window).width(),
                n = e(window).height(),
                i = t / n;
            v > i ? "video" === d ? (l.width(n * v).height(n), e(f).css("top", 0).css("left", -(n * v - t) / 2).css("height", n), e(f + "_html5_api").css("width", n * v), e(f + "_flash_api").css("width", n * v).css("height", n)) : e("#big-video-image").width(n * v).height(n).css("top", 0).css("left", -(n * v - t) / 2) : "video" === d ? (l.width(t).height(t / v), e(f).css("top", -(t / v - n) / 2).css("left", 0).css("height", t / v), e(f + "_html5_api").css("width", "100%"), e(f + "_flash_api").css("width", t).css("height", t / v)) : e("#big-video-image").width(t).height(t / v).css("top", -(t / v - n) / 2).css("left", 0)
        }

        function i() {
            var t = '<div id="big-video-control-container">';
            t += '<div id="big-video-control">', t += '<a href="#" id="big-video-control-play"></a>', t += '<div id="big-video-control-middle">', t += '<div id="big-video-control-bar">', t += '<div id="big-video-control-bound-left"></div>', t += '<div id="big-video-control-progress"></div>', t += '<div id="big-video-control-track"></div>', t += '<div id="big-video-control-bound-right"></div>', t += "</div>", t += "</div>", t += '<div id="big-video-control-timer"></div>', t += "</div>", t += "</div>", e("body").append(t), e("#big-video-control-container").css("display", "none"), e("#big-video-control-track").slider({
                animate: !0,
                step: .01,
                slide: function (t, n) {
                    b = !0, e("#big-video-control-progress").css("width", n.value - .16 + "%"), l.currentTime(n.value / 100 * l.duration())
                },
                stop: function (e, t) {
                    b = !1, l.currentTime(t.value / 100 * l.duration())
                }
            }), e("#big-video-control-bar").click(function (t) {
                l.currentTime(t.offsetX / e(this).width() * l.duration())
            }), e("#big-video-control-play").click(function (e) {
                e.preventDefault(), r("toggle")
            }), l.addEvent("timeupdate", function () {
                if (!b && l.currentTime() / l.duration()) {
                    var t = l.currentTime(),
                        n = Math.floor(t / 60),
                        i = Math.floor(t) - 60 * n;
                    10 > i && (i = "0" + i);
                    var r = 100 * (l.currentTime() / l.duration());
                    e("#big-video-control-track").slider("value", r), e("#big-video-control-progress").css("width", r - .16 + "%"), e("#big-video-control-timer").text(n + ":" + i + "/" + g)
                }
            })
        }

        function r(t) {
            var n = t || "toggle";
            "toggle" === n && (n = w ? "pause" : "play"), "pause" === n ? (l.pause(), e("#big-video-control-play").css("background-position", "-16px"), w = !1) : "play" === n && (l.play(), e("#big-video-control-play").css("background-position", "0"), w = !0)
        }

        function s() {
            l.play(), e("body").off("click", s)
        }

        function a() {
            c++, c === T.length && (c = 0), o(T[c])
        }

        function o(t) {
            e(f).css("display", "block"), d = "video", l.src(t), w = !0, x ? (e("#big-video-control-container").css("display", "none"), l.volume(0), E = !0) : (e("#big-video-control-container").css("display", "block"), l.volume(_), E = !1), e("#big-video-image").css("display", "none"), e(f).css("display", "block")
        }

        function u(t) {
            e("#big-video-image").remove(), l.pause(), e(f).css("display", "none"), e("#big-video-control-container").css("display", "none"), d = "image";
            var i = e('<img id="big-video-image" src=' + t + " />");
            m.append(i), e("#big-video-image").imagesLoaded(function () {
                v = e("#big-video-image").width() / e("#big-video-image").height(), n()
            })
        }
        var l, c, d, h = {
                useFlashForFirefox: !1,
                forceAutoplay: !1,
                controls: !0
            }, p = this,
            f = "#big-video-vid",
            m = e('<div id="big-video-wrap_old_old"></div>'),
            v = (e(""), 16 / 9),
            g = 0,
            _ = .8,
            y = !1,
            b = !1,
            w = !1,
            V = !1,
            x = !1,
            E = !1,
            T = [];
        p.settings = e.extend({}, h, t);
        var C = navigator.userAgent.toLowerCase(),
            k = -1 != C.indexOf("firefox");
        p.settings.useFlashForFirefox && k && (VideoJS.options.techOrder = ["flash"]), p.init = function () {
            if (!y) {
                e("body").prepend(m);
                var t = p.settings.forceAutoplay ? "autoplay" : "";
                l = e('<video id="' + f.substr(1) + '" class="video-js vjs-default-skin" preload="auto" data-setup="{}" ' + t + " webkit-playsinline></video>"), l.css("position", "absolute"), m.append(l), l = _V_(f.substr(1), {
                    controls: !1,
                    autoplay: !0,
                    preload: "auto"
                }), p.settings.controls && i(), n(), y = !0, w = !1, p.settings.forceAutoplay && e("body").on("click", s), e("#big-video-vid_flash_api").attr("scale", "noborder").attr("width", "100%").attr("height", "100%"), e(window).resize(function () {
                    n()
                }), l.addEvent("loadedmetadata", function () {
                    v = document.getElementById("big-video-vid_flash_api") ? document.getElementById("big-video-vid_flash_api").vjs_getProperty("videoWidth") / document.getElementById("big-video-vid_flash_api").vjs_getProperty("videoHeight") : e("#big-video-vid_html5_api").prop("videoWidth") / e("#big-video-vid_html5_api").prop("videoHeight"), n();
                    var t = Math.round(l.duration()),
                        i = Math.floor(t / 60),
                        r = t - 60 * i;
                    10 > r && (r = "0" + r), g = i + ":" + r
                }), l.addEvent("ended", function () {
                    E && (l.currentTime(0), l.play()), V && a()
                })
            }
        }, p.show = function (e, t) {
            if (x = void 0 !== t && t.ambient === !0, "string" == typeof e) {
                var n = e.substring(e.lastIndexOf(".") + 1);
                "jpg" === n || "gif" === n || "png" === n ? u(e) : (void 0 !== t && t.altSource && navigator.userAgent.toLowerCase().indexOf("firefox") > -1 && (e = t.altSource), o(e), V = !1)
            } else T = e, c = 0, o(T[c]), V = !0
        }, p.getPlayer = function () {
            return l
        }
    }
}(jQuery),
function (e, t) {
    var n, i, r;
    n = i = e.jQuery, r = i.ScrollTo = i.ScrollTo || {
        config: {
            duration: 400,
            easing: "swing",
            callback: t,
            durationMode: "each",
            offsetTop: 0,
            offsetLeft: 0
        },
        configure: function (e) {
            return i.extend(r.config, e || {}), this
        },
        scroll: function (t, n) {
            var s, a, o, u, l, c, d, h, p, f, m, v, g, _, y, b, w, V;
            return s = t.pop(), a = s.$container, o = a.get(0), u = s.$target, l = i("<span/>").css({
                position: "absolute",
                top: "0px",
                left: "0px"
            }), c = a.css("position"), a.css("position", "relative"), l.appendTo(a), m = l.offset().top, v = u.offset().top, g = v - m - parseInt(n.offsetTop, 10), _ = l.offset().left, y = u.offset().left, b = y - _ - parseInt(n.offsetLeft, 10), d = o.scrollTop, h = o.scrollLeft, l.remove(), a.css("position", c), w = {}, V = function (e) {
                return 0 === t.length ? "function" == typeof n.callback && n.callback.apply(this, [e]) : r.scroll(t, n), !0
            }, n.onlyIfOutside && (p = d + a.height(), f = h + a.width(), g > d && p > g && (g = d), b > h && f > b && (b = h)), g !== d && (w.scrollTop = g), b !== h && (w.scrollLeft = b), i.browser.safari && o === document.body ? (e.scrollTo(w.scrollLeft, w.scrollTop), V()) : w.scrollTop || w.scrollLeft ? a.animate(w, n.duration, n.easing, V) : V(), !0
        },
        fn: function (e) {
            var t, n, s, a;
            t = [];
            var o = i(this);
            if (0 === o.length) return this;
            for (n = i.extend({}, r.config, e), s = o.parent(), a = s.get(0); 1 === s.length && a !== document.body && a !== document;) {
                var u, l;
                u = "visible" !== s.css("overflow-y") && a.scrollHeight !== a.clientHeight, l = "visible" !== s.css("overflow-x") && a.scrollWidth !== a.clientWidth, (u || l) && (t.push({
                    $container: s,
                    $target: o
                }), o = s), s = s.parent(), a = s.get(0)
            }
            return t.push({
                $container: i(i.browser.msie || i.browser.mozilla ? "html" : "body"),
                $target: o
            }), "all" === n.durationMode && (n.duration /= t.length), r.scroll(t, n), this
        }
    }, i.fn.ScrollTo = i.ScrollTo.fn
}(window),
function (e) {
    e.fn.fitVids = function (t) {
        var n = {
            customSelector: null
        }, i = document.createElement("div"),
            r = document.getElementsByTagName("base")[0] || document.getElementsByTagName("script")[0];
        return i.className = "fit-vids-style", i.innerHTML = "&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>", r.parentNode.insertBefore(i, r), t && e.extend(n, t), this.each(function () {
            var t = ["iframe[src*='player.vimeo.com']", "iframe[src*='www.youtube.com']", "iframe[src*='www.kickstarter.com']", "object", "embed"];
            n.customSelector && t.push(n.customSelector);
            var i = e(this).find(t.join(","));
            i.each(function () {
                var t = e(this);
                if (!("embed" == this.tagName.toLowerCase() && t.parent("object").length || t.parent(".fluid-width-video-wrapper").length)) {
                    var n = "object" == this.tagName.toLowerCase() ? t.attr("height") : t.height(),
                        i = n / t.width();
                    if (!t.attr("id")) {
                        var r = "fitvid" + Math.floor(999999 * Math.random());
                        t.attr("id", r)
                    }
                    t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", 100 * i + "%"), t.removeAttr("height").removeAttr("width")
                }
            })
        })
    }
}(jQuery),
function (e) {
    e.fn.inflateText = function (t) {
        var n = {
            scale: 1,
            minFontSize: Number.NEGATIVE_INFINITY,
            maxFontSize: Number.POSITIVE_INFINITY
        }, i = function (e) {
                var t;
                return function () {
                    var n = Array.prototype.slice.call(arguments, 1),
                        i = 100,
                        r = function () {
                            e.apply({}, n), t = null
                        };
                    t && clearTimeout(t), t = setTimeout(r, i)
                }
            };
        return this.each(function () {
            var r, s = e(this);
            t && e.extend(n, t), r = function () {
                var t = e('<div style="height:1px;overflow:hidden;"></div>').appendTo("body"),
                    i = s.clone().css({
                        display: "inline",
                        fontSize: "96px"
                    }).appendTo(t);
                s.css("font-size", "12pt"), s.css("font-size", Math.max(Math.min(96 * n.scale * s.width() / i.width(), parseFloat(n.maxFontSize)), parseFloat(n.minFontSize))), t.remove()
            }, r(), e(window).resize(i(r))
        })
    }
}(jQuery), window.log = function f() {
    if (log.history = log.history || [], log.history.push(arguments), this.console) {
        var e, t = arguments;
        try {
            t.callee = f.caller
        } catch (n) {}
        e = [].slice.call(t), "object" == typeof console.log ? log.apply.call(console.log, console, e) : console.log.apply(console, e)
    }
},
function (e) {
    function t() {}
    for (var n, i = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","); n = i.pop();) e[n] = e[n] || t
}(function () {
    try {

        return console.log(), window.console
    } catch (e) {
        return window.console = {}
    }
}()), $(function () {
    function e() {
        c.show($("#screen-" + d).attr("data-video") + ".mp4", {
            ambient: !0,
            altSource: $("#screen-" + d).attr("data-video") + ".mp4"
        })
    }

    function t() {
        p = !0, 1 >= d ? d = h : d--, u(), m || $("#big-video-wrap_old").transit({
            left: "100%"
        }, f), Modernizr.csstransitions ? $(".video-wrapper").transit({
            left: "-" + 100 * (d - 1) + "%"
        }, f, r) : r()
    }

    function n() {
        p = !0, d === h ? (v.css("opacity", 1), d = 1) : d++, u(), m || $("#big-video-wrap_old").transit({
            left: "-100%"
        }, f), Modernizr.csstransitions ? $(".video-wrapper").transit({
            left: "-" + 100 * (d - 1) + "%"
        }, f, r) : r()
    }

    function i() {
        $(".big-image").css({
            opacity: 1
        }), $("#screen-" + d).find(".big-image").transit({
            opacity: 0
        }, 500)
    }

    function r() {
        p = !1, m || ($("#big-video-wrap_old").css("left", 0), e())
    }

    function s() {
        var e = g.height();
        $(".video-wrapper").css("height", e + "px")
    }

    function a() {
        v.each(function () {
            var e = $(this),
                t = new Image;
            t.src = e.attr("src");
            var n, i, r = g.width(),
                s = g.height(),
                a = s / r,
                o = t.width,
                u = t.height,
                l = u / o;
            a > l ? (i = s, n = s / l) : (i = r * l, n = r), e.css({
                width: n,
                height: i,
                left: (r - n) / 2,
                top: (s - i) / 2
            })
        })
    }

    function o() {
        var e = $(window),
            t = $(".category"),
            n = e.scrollTop(),
            i = "menu-logo";
        $.each(t, function () {
            var e = $(this),
                t = e.attr("id");
            n >= e.offset().top - 20 && e.next().offset().top > n && (i = t), $("#top-menu .menu-tab").removeClass("selected")
        })
    }

    function u() {
        var e = $("#screen-menu.menu .menu-tab");
        e.removeClass("selected"), e.eq(d - 1).addClass("selected")
		console.log('fun u');
    }

    function l() {
        var e = $(window),
            t = $("#top-menu");
        e.scrollTop() >= e.height() ? t.addClass("locked") : t.hasClass("locked") && t.removeClass("locked")
    }
    $("html, body").animate({
        opacity: 1
    }, 1500);
    var c, d = 1,
        h = $(".screen").length,
        p = !1,
        f = 1e3,
        m = Modernizr.touch,
        v = $(".big-image"),
        g = $(window);
    m || (c = new $.BigVideo({
        forceAutoplay: m
    }), c.init(), e(), c.getPlayer().addEvent("loadeddata", function () {
        i()
    }), v.css("position", "relative").imagesLoaded(a), g.on("resize", a)), s(), g.on("resize", s), $("#previous-btn").on("click", function (e) {
        e.preventDefault(), p || t()
    }), $("#next-btn").on("click", function (e) {
        e.preventDefault(), p || n()
    }), $(".fitvid").fitVids(), $("#screen-menu .menu-tab").on("click", function (e) {
        e.preventDefault(), p || d == $(this).index() + 1 || (p = !0, d = $(this).index() + 1, u(), m || $("#big-video-wrap_old").transit({
            left: "-100%"
        }, f), Modernizr.csstransitions ? $(".video-wrapper").transit({
            left: "-" + 100 * (d - 1) + "%"
        }, f, r) : r())
    }), $("#section-camp").fadeIn(), $("#screen-2 li").on("click", function () {
        var e = $(this);
        if (!e.hasClass("selected")) {
            var t = e.attr("id").substring(5);
            $("#screen-2 .about-link").removeClass("selected"), e.addClass("selected"), $("#screen-2 .about-section").removeClass("selected").fadeOut(100), $("#section-" + t).addClass("selected").delay(100).fadeIn(300)
        }
    }), $("#top-menu .menu-link, .screen .scroll-link").on("click", function () {
        var e = $(this),
            t = e.attr("href");
        return $(t).ScrollTo({
            duration: 600,
            easing: "swing"
        }), l(), !1
    }), $("#top-menu .menu-logo").on("click", function () {
        $("html,body").animate({
            scrollTop: 0
        }, 600)
    }), $("#top-menu .menu-tab a").on("click", o), o(), $(window).on("scroll", o), l(), $(window).scroll(function () {
        l()
    }), $(".map-image").hover(function () {
        _()
    }, function () {
        _()
    });
    var _ = function () {
        var e = $(".map-image");
        e.stop().fadeOut(150), setTimeout(function () {
            e.toggleClass("zoom-dadaab").fadeIn(150)
        }, 150)
    }, y = $(".credit-container");
    $(".credits .heading").on("click", function () {
        y.slideToggle(600).toggleClass("open")
    }), $(".credit-listing a").on("click", function () {
        var e = $(this),
            t = e.attr("href");
        return y.hasClass("open") ? $(t).ScrollTo({
            duration: 600,
            easing: "swing",
            offsetTop: 120
        }) : (y.slideToggle(600).toggleClass("open"), setTimeout(function () {
            $(t).ScrollTo({
                duration: 600,
                easing: "swing",
                offsetTop: 120
            })
        }, 600)), !1
    })
});
var YT_ready = function () {
    var e = [],
        t = !1;
    return function (n, i) {
        if (n === !0) {
            t = !0;
            for (var r = 0; e.length > r; r++) e.shift()()
        } else "function" == typeof n && (t ? n() : e[i ? "unshift" : "push"](n))
    }
}(),
    Player_ready = function () {
        var e = [],
            t = !1;
        return function (n, i) {
            if (n === !0) {
                t = !0;
                for (var r = 0; e.length > r; r++) e.shift()()
            } else "function" == typeof n && (t ? n() : e[i ? "unshift" : "push"](n))
        }
    }();
(function () {
    var e = document.createElement("script");
    e.src = "http://www.youtube.com/player_api";
    var t = document.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(e, t)
})(), $(function () {
        var e = function () {
            function e() {
                var e = $.url();
                if ("post" == e.segment(1)) {
                    var n = e.segment(2);
                    $(".post-img").imagesLoaded(function () {
                        Player_ready(function () {
                            t(n)
                        })
                    })
                }
            }

            function t(e, t) {
                var n = $('[data-postid="' + e + '"]'),
                    i = t;
                t || (i = n.closest(".category")), i.ScrollTo();
                var r = i.find(".category-feature iframe"),
                    s = r.get(0).id,
                    a = n.data("youtubeid"),
                    o = _.unescape(n.data("title")),
                    u = _.unescape(n.data("body"));
                i.find(".featured-heading").empty().html(o), i.find(".body").empty().html(u);
                var l = _.filter(c, function (e) {
                    return e.a.id == s
                }),
                    d = _.filter(c, function (e) {
                        return e.a.id != s
                    });
                _.forEach(d, function (e) {
                    t ? e.pauseVideo() : e.addEventListener("onReady", function () {
                        e.pauseVideo()
                    })
                });
                var h = l[0];
                t ? h.loadVideoById(a) : h.addEventListener("onReady", function () {
                    h.loadVideoById(a)
                })
            }

            function n() {
                var e = document.createElement("script");
                e.src = ("https:" == location.protocol ? "https" : "http") + "://www.youtube.com/player_api";
                var n = document.getElementsByTagName("script")[0];
                n.parentNode.insertBefore(e, n), i(), $(".category").on("click", "[data-postid]", function (e) {
                    e.preventDefault(), t($(this).data("postid"), $(e.delegateTarget))
                })
            }

            function i() {
               
            }

            function r(t) {
                _.forEach(t, function (e, t) {
                    for (var n = t.replace("primary-", ""), i = $("#" + n), r = "", s = {}, a = 0; e.length > a; a++) {
                        var o = e[a],
                            u = o.title ? o.title : "",
                            l = o.body ? o.body : "",
                            d = $(l).filter(".body").text(),
                            h = encodeURIComponent("Watch this video from the world's largest refugee camp. #DadaabStories #GetInspired"),
                            p = '<a class="share facebook ir" target="_blank" href="http://www.facebook.com/sharer.php?u=' + o.post_url + '">Share This Link on Facebook</a><a class="share twitter ir" target="_blank" href="http://twitter.com/share?text=' + h + "&url=" + o.post_url + '">Share This Link on Twitter</a>',
                            f = /\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\'\ >]*)/,
                            m = f.exec(l)[1],
                            v = RegExp("(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})", "g"),
                            g = $(l).filter("iframe").attr("src"),
                            y = v.exec(g)[1];
                        if (r += '<div class="col span_3">', r += '<a class="post-thumb" title="' + _.escape(u) + '" href="' + o.post_url + '" data-body="' + _.escape(d) + '" data-title="' + _.escape(u) + '" data-youtubeid="' + y + '" data-postid="' + $.url(o.post_url).segment(2) + '"><img class="post-img" alt="' + u + '" src="' + m + '"></a>', r += "</div>", _.contains(o.tags, "featured")) {
                            s = o, i.find(".body").empty().append(d), i.find(".featured-heading").empty().append(u), i.find(".share-video").empty().append(p);
                            var b = "";
                            b += '<iframe id="' + n + '-player" type="text/html" allowfullscreen', b += ' src="http://www.youtube.com/embed/' + y + '?enablejsapi=1&showinfo=0&theme=light&rel=0&modestbranding=1&autohide=1&color=white"', b += ' frameborder="0"></iframe>', i.find(".category-feature").empty().append(b).fitVids();
                            var w;
                            YT_ready(function () {
                                var e = getFrameID(n + "-player");
                                if (e) {
                                    w = new YT.Player(n + "-player", {
                                        events: {
                                            onStateChange: function (e) {
                                                if (e.data == YT.PlayerState.PLAYING) {
                                                    var n = _.filter(c, function (e) {
                                                        return e.id != t
                                                    });
                                                    _.forEach(n, function (e) {
                                                        e.pauseVideo()
                                                    })
                                                }
                                            },
                                            onReady: function () {
                                                onYouTubePlayerReady()
                                            }
                                        }
                                    });
                                    var t = w.id;
                                    c.push(w)
                                }
                            })
                        }
                    }
                    i.find(".thumbs").empty().append(r)
                }), e()
            }
            var s = "studspro.com",
                a = "dpke33pFgaYThNZVGMUdUCEDas0ucHrW3bV7N4YKPEWTsSQoea",
                o = 100,
                u = "text",
                l = "raw",
                c = [];
            return {
                init: n
            }
        }();
        e.init()
    });