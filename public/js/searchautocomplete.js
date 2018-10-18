var EasyAutocomplete = function(t) {
    return t.main = function(e, n) {
        function i() {
            return 0 === v.length ? void g.error("Input field doesn't exist.") : d.checkDataUrlProperties() ? d.checkRequiredProperties() ? (a(), void
                            function() {
                                function t() {
                                    v.off("keyup").keyup(function(t) {
                                        function e(t) {
                                            if (!(t.length < d.get("minCharNumber"))) {
                                                if ("list-required" !== d.get("data")) {
                                                    var e = d.get("data"),
                                                        n = p.init(e);
                                                    n = p.updateCategories(n, e), l(n = p.processData(n, t), t), v.parent().find("li").length > 0 ? r() : s()
                                                }
                                                var i = function() {
                                                    var t = {},
                                                        e = d.get("ajaxSettings") || {};
                                                    for (var n in e) t[n] = e[n];
                                                    return t
                                                }();
                                                void 0 !== i.url && "" !== i.url || (i.url = d.get("url")), void 0 !== i.dataType && "" !== i.dataType || (i.dataType = d.get("dataType")), void 0 !== i.url && "list-required" !== i.url && (i.url = i.url(t), i.data = d.get("preparePostData")(i.data, t), $.ajax(i).done(function(e) {
                                                    var n = p.init(e);
                                                    n = p.updateCategories(n, e), n = p.convertXml(n),
                                                    function(t, e) {
                                                        return !1 === d.get("matchResponseProperty") || ("string" == typeof d.get("matchResponseProperty") ? e[d.get("matchResponseProperty")] === t : "function" != typeof d.get("matchResponseProperty") || d.get("matchResponseProperty")(e) === t)
                                                    }(t, e) && l(n = p.processData(n, t), t), p.checkIfDataExists(n) && v.parent().find("li").length > 0 ? r() : s(), d.get("ajaxCallback")()
                                                }).fail(function() {
                                                    g.warning("Fail to load response data")
                                                }).always(function() {}))
                                            }
                                        }
                                        switch (t.keyCode) {
                                            case 27:
                                                s(), v.trigger("blur");
                                                break;
                                            case 38:
                                                t.preventDefault(), E.length > 0 && C > 0 && (C -= 1, v.val(d.get("getValue")(E[C])), c(C));
                                                break;
                                            case 40:
                                                t.preventDefault(), E.length > 0 && C < E.length - 1 && (C += 1, v.val(d.get("getValue")(E[C])), c(C));
                                                break;
                                            default:
                                                if (t.keyCode > 40 || 8 === t.keyCode) {
                                                    var n = v.val();
                                                    !0 !== d.get("list").hideOnEmptyPhrase || 8 !== t.keyCode || "" !== n ? d.get("requestDelay") > 0 ? (void 0 !== u && clearTimeout(u), u = setTimeout(function() {
                                                                e(n)
                                                            }, d.get("requestDelay"))) : e(n) : s()
                                                }
                                        }
                                    })
                                }
                                h("autocompleteOff", !0) && v.attr("autocomplete", "off"), v.focusout(function() {
                                    var t, e = v.val();
                                    d.get("list").match.caseSensitive || (e = e.toLowerCase());
                                    for (var n = 0, i = E.length; i > n; n += 1)
                                        if (t = d.get("getValue")(E[n]), d.get("list").match.caseSensitive || (t = t.toLowerCase()), t === e) return C = n, void c(C)
                                }), t(), v.on("keydown", function(t) {
                                    var e = (t = t || window.event).keyCode;
                                    return 38 === e ? (suppressKeypress = !0, !1) : void 0
                                }).keydown(function(t) {
                                    13 === t.keyCode && C > -1 && (v.val(d.get("getValue")(E[C])), d.get("list").onKeyEnterEvent(), d.get("list").onChooseEvent(), C = -1, s(), t.preventDefault())
                                }), v.off("keypress"), v.focus(function() {
                                    "" !== v.val() && E.length > 0 && (C = -1, r())
                                }), v.blur(function() {
                                    setTimeout(function() {
                                        C = -1, s()
                                    }, 250)
                                })
                            }()) : void g.error("Will not work without mentioned properties.") : void g.error("One of options variables 'data' or 'url' must be defined.")
        }

        function a() {
            var t, e, n, i;
            v.parent().hasClass(f.getValue("WRAPPER_CSS_CLASS")) && (v.next("." + f.getValue("CONTAINER_CLASS")).remove(), v.unwrap()), n = $("<div>"), i = f.getValue("WRAPPER_CSS_CLASS"), d.get("theme") && "" !== d.get("theme") && (i += " eac-" + d.get("theme")), d.get("cssClasses") && "" !== d.get("cssClasses") && (i += " " + d.get("cssClasses")), "" !== m.getTemplateClass() && (i += " " + m.getTemplateClass()), n.addClass(i), v.wrap(n), !0 === d.get("adjustWidth") && (e = v.outerWidth(), v.parent().css("width", e)), (t = $("<div>").addClass(f.getValue("CONTAINER_CLASS"))).attr("id", o()).prepend($("<ul class='style-scroll'>")), t.on("show.eac", function() {
                switch (d.get("list").showAnimation.type) {
                    case "slide":
                        var e = d.get("list").showAnimation.time,
                            n = d.get("list").showAnimation.callback;
                        t.find("ul").slideDown(e, n);
                        break;
                    case "fade":
                        e = d.get("list").showAnimation.time, n = d.get("list").showAnimation.callback, t.find("ul").fadeIn(e);
                        break;
                    default:
                        t.find("ul").show()
                }
                d.get("list").onShowListEvent()
            }).on("hide.eac", function() {
                switch (d.get("list").hideAnimation.type) {
                    case "slide":
                        var e = d.get("list").hideAnimation.time,
                            n = d.get("list").hideAnimation.callback;
                        t.find("ul").slideUp(e, n);
                        break;
                    case "fade":
                        e = d.get("list").hideAnimation.time, n = d.get("list").hideAnimation.callback, t.find("ul").fadeOut(e, n);
                        break;
                    default:
                        t.find("ul").hide()
                }
                d.get("list").onHideListEvent()
            }).on("selectElement.eac", function() {
                t.find("ul li").removeClass("selected"), t.find("ul li").eq(C).addClass("selected"), d.get("list").onSelectItemEvent()
            }).on("loadElements.eac", function(e, n, i) {
                var a = "",
                    o = t.find("ul");
                o.empty().detach(), E = [];
                for (var r = 0, s = 0, l = n.length; l > s; s += 1) {
                    var u = n[s].data;
                    if (0 !== u.length) {
                        void 0 !== n[s].header && n[s].header.length > 0 && o.append("<div class='eac-category' >" + n[s].header + "</div>");
                        for (var f = 0, g = u.length; g > f && r < n[s].maxListSize; f += 1) a = $("<li><div class='eac-item'></div></li>"),
                            function() {
                                var t, e, o, l, g = f,
                                    p = r,
                                    h = n[s].getValue(u[g]);
                                a.find(" > div").on("click", function() {
                                    v.val(h).trigger("change"), C = p, c(p), d.get("list").onClickEvent(), d.get("list").onChooseEvent()
                                }).mouseover(function() {
                                    C = p, c(p), d.get("list").onMouseOverEvent()
                                }).mouseout(function() {
                                    d.get("list").onMouseOutEvent()
                                }).html(m.build((o = h, l = i, d.get("highlightPhrase") && "" !== l ? (t = o, e = l.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&"), (t + "").replace(new RegExp("(" + e + ")", "gi"), "<b>$1</b>")) : o), u[g]))
                            }(), o.append(a), E.push(u[f]), r += 1
                    }
                }
                t.append(o), d.get("list").onLoadEvent()
            }), v.after(t), y = $("#" + o()), d.get("placeholder") && v.attr("placeholder", d.get("placeholder"))
        }

        function o() {
            var t = v.attr("id");
            return f.getValue("CONTAINER_ID") + t
        }

        function r() {
            y.trigger("show.eac")
        }

        function s() {
            y.trigger("hide.eac")
        }

        function c(t) {
            y.trigger("selectElement.eac", t)
        }

        function l(t, e) {
            y.trigger("loadElements.eac", [t, e])
        }
        var u, f = new t.Constans,
            d = new t.Configuration(n),
            g = new t.Logger,
            m = new t.Template(n.template),
            p = new t.ListBuilderService(d, t.proccess),
            h = d.equals,
            v = e,
            y = "",
            E = [],
            C = -1;
        t.consts = f, this.getConstants = function() {
            return f
        }, this.getConfiguration = function() {
            return d
        }, this.getContainer = function() {
            return y
        }, this.getSelectedItemIndex = function() {
            return C
        }, this.getItems = function() {
            return E
        }, this.getItemData = function(t) {
            return E.length < t || void 0 === E[t] ? -1 : E[t]
        }, this.getSelectedItemData = function() {
            return this.getItemData(C)
        }, this.build = function() {
            a()
        }, this.init = function() {
            i()
        }
    }, t.eacHandles = [], t.getHandle = function(e) {
        return t.eacHandles[e]
    }, t.inputHasId = function(t) {
        return void 0 !== $(t).attr("id") && $(t).attr("id").length > 0
    }, t.assignRandomId = function(e) {
        var n = "";
        do {
            n = "eac-" + Math.floor(1e4 * Math.random())
        } while (0 !== $("#" + n).length);
        elementId = t.consts.getValue("CONTAINER_ID") + n, $(e).attr("id", n)
    }, t.setHandle = function(e, n) {
        t.eacHandles[n] = e
    }, t
}((EasyAutocomplete = function(t) {
        return t.Template = function(t) {
            var e, n, i, a, o, r, s = {
                basic: {
                    type: "basic",
                    method: function(t) {
                        return t
                    },
                    cssClass: ""
                },
                description: {
                    type: "description",
                    fields: {
                        description: "description"
                    },
                    method: function(t) {
                        return t + " - description"
                    },
                    cssClass: "eac-description"
                },
                iconLeft: {
                    type: "iconLeft",
                    fields: {
                        icon: ""
                    },
                    method: function(t) {
                        return t
                    },
                    cssClass: "eac-icon-left"
                },
                iconRight: {
                    type: "iconRight",
                    fields: {
                        iconSrc: ""
                    },
                    method: function(t) {
                        return t
                    },
                    cssClass: "eac-icon-right"
                },
                links: {
                    type: "links",
                    fields: {
                        link: ""
                    },
                    method: function(t) {
                        return t
                    },
                    cssClass: ""
                },
                custom: {
                    type: "custom",
                    method: function() {},
                    cssClass: ""
                }
            };
            this.getTemplateClass = (o = t) && o.type && o.type && s[o.type] ? (r = s[o.type].cssClass, function() {
                    return r
                }) : function() {
                    return ""
                }, this.build = (e = t) && e.type && e.type && s[e.type] ? (a = (n = e).fields, "description" === n.type ? (i = s.description.method, "string" == typeof a.description ? i = function(t, e) {
                            return t + " - <span>" + e[a.description] + "</span>"
                        } : "function" == typeof a.description && (i = function(t, e) {
                            return t + " - <span>" + a.description(e) + "</span>"
                        }), i) : "iconRight" === n.type ? ("string" == typeof a.iconSrc ? i = function(t, e) {
                                return t + "<img class='eac-icon' src='" + e[a.iconSrc] + "' />"
                            } : "function" == typeof a.iconSrc && (i = function(t, e) {
                                return t + "<img class='eac-icon' src='" + a.iconSrc(e) + "' />"
                            }), i) : "iconLeft" === n.type ? ("string" == typeof a.iconSrc ? i = function(t, e) {
                                    return "<img class='eac-icon' src='" + e[a.iconSrc] + "' />" + t
                                } : "function" == typeof a.iconSrc && (i = function(t, e) {
                                    return "<img class='eac-icon' src='" + a.iconSrc(e) + "' />" + t
                                }), i) : "links" === n.type ? ("string" == typeof a.link ? i = function(t, e) {
                                        return "<a href='" + e[a.link] + "' >" + t + "</a>"
                                    } : "function" == typeof a.link && (i = function(t, e) {
                                        return "<a href='" + a.link(e) + "' >" + t + "</a>"
                                    }), i) : "custom" === n.type ? n.method : s.basic.method) : s.basic.method
        }, t
    }((EasyAutocomplete = function(t) {
            return t.proccess = function(e, n, i) {
                function a(t, n) {
                    return e.get("list").match.caseSensitive || ("string" == typeof t && (t = t.toLowerCase()), n = n.toLowerCase()), !!e.get("list").match.method(t, n)
                }
                t.proccess.match = a;
                var o, r, s = n.data;
                return s = function(t, n) {
                    var i = [],
                        o = "";
                    if (e.get("list").match.enabled)
                        for (var r = 0, s = t.length; s > r; r += 1) o = e.get("getValue")(t[r]), a(o, n) && i.push(t[r]);
                    else i = t;
                    return i
                }(s, i), r = s, void 0 !== n.maxNumberOfElements && r.length > n.maxNumberOfElements && (r = r.slice(0, n.maxNumberOfElements)), o = s = r, e.get("list").sort.enabled && o.sort(e.get("list").sort.method), o
            }, t
        }((EasyAutocomplete = function(t) {
                return t.ListBuilderService = function(t, e) {
                    function n(e, n) {
                        var i, a, o, r = {};
                        if (r = "XML" === t.get("dataType").toUpperCase() ? (o = {}, void 0 !== e.xmlElementName && (o.xmlElementName = e.xmlElementName), void 0 !== e.listLocation ? a = e.listLocation : void 0 !== t.get("listLocation") && (a = t.get("listLocation")), void 0 !== a ? "string" == typeof a ? o.data = $(n).find(a) : "function" == typeof a && (o.data = a(n)) : o.data = n, o) : (i = {}, void 0 !== e.listLocation ? "string" == typeof e.listLocation ? i.data = n[e.listLocation] : "function" == typeof e.listLocation && (i.data = e.listLocation(n)) : i.data = n, i), void 0 !== e.header && (r.header = e.header), void 0 !== e.maxNumberOfElements && (r.maxNumberOfElements = e.maxNumberOfElements), void 0 !== t.get("list").maxNumberOfElements && (r.maxListSize = t.get("list").maxNumberOfElements), void 0 !== e.getValue)
                            if ("string" == typeof e.getValue) {
                                var s = e.getValue;
                                r.getValue = function(t) {
                                    return t[s]
                                }
                            } else "function" == typeof e.getValue && (r.getValue = e.getValue);
                        else r.getValue = t.get("getValue");
                        return r
                    }

                    function i(e) {
                        var n = [];
                        return void 0 === e.xmlElementName && (e.xmlElementName = t.get("xmlElementName")), $(e.data).find(e.xmlElementName).each(function() {
                            n.push(this)
                        }), n
                    }
                    this.init = function(e) {
                        var n = [],
                            i = {};
                        return i.data = t.get("listLocation")(e), i.getValue = t.get("getValue"), i.maxListSize = t.get("list").maxNumberOfElements, n.push(i), n
                    }, this.updateCategories = function(e, i) {
                        if (t.get("categoriesAssigned")) {
                            e = [];
                            for (var a = 0; a < t.get("categories").length; a += 1) {
                                var o = n(t.get("categories")[a], i);
                                e.push(o)
                            }
                        }
                        return e
                    }, this.convertXml = function(e) {
                        if ("XML" === t.get("dataType").toUpperCase())
                            for (var n = 0; n < e.length; n += 1) e[n].data = i(e[n]);
                        return e
                    }, this.processData = function(n, i) {
                        for (var a = 0, o = n.length; o > a; a += 1) n[a].data = e(t, n[a], i);
                        return n
                    }, this.checkIfDataExists = function(t) {
                        for (var e = 0, n = t.length; n > e; e += 1)
                            if (void 0 !== t[e].data && t[e].data instanceof Array && t[e].data.length > 0) return !0;
                        return !1
                    }
                }, t
            }((EasyAutocomplete = function(t) {
                    return t.Constans = function() {
                        var t = {
                            CONTAINER_CLASS: "easy-autocomplete-container",
                            CONTAINER_ID: "eac-container-",
                            WRAPPER_CSS_CLASS: "easy-autocomplete"
                        };
                        this.getValue = function(e) {
                            return t[e]
                        }
                    }, t
                }((EasyAutocomplete = function(t) {
                        return t.Logger = function() {
                            this.error = function(t) {
                                console.log("ERROR: " + t)
                            }, this.warning = function(t) {
                                console.log("WARNING: " + t)
                            }
                        }, t
                    }((EasyAutocomplete = function(t) {
                            return t.Configuration = function(t) {
                                function e(t, e) {
                                    ! function e(n, a) {
                                        for (var o in a) void 0 === n[o] && t.log("Property '" + o + "' does not exist in EasyAutocomplete options API."), "object" == typeof n[o] && -1 === $.inArray(o, i) && e(n[o], a[o])
                                    }(n, e)
                                }
                                var n = {
                                        data: "list-required",
                                        url: "list-required",
                                        dataType: "json",
                                        listLocation: function(t) {
                                            return t
                                        },
                                        xmlElementName: "",
                                        getValue: function(t) {
                                            return t
                                        },
                                        autocompleteOff: !0,
                                        placeholder: !1,
                                        ajaxCallback: function() {},
                                        matchResponseProperty: !1,
                                        list: {
                                            sort: {
                                                enabled: !1,
                                                method: function(t, e) {
                                                    return t = n.getValue(t), (e = n.getValue(e)) > t ? -1 : t > e ? 1 : 0
                                                }
                                            },
                                            maxNumberOfElements: 6,
                                            hideOnEmptyPhrase: !0,
                                            match: {
                                                enabled: !1,
                                                caseSensitive: !1,
                                                method: function(t, e) {
                                                    return t.search(e) > -1
                                                }
                                            },
                                            showAnimation: {
                                                type: "normal",
                                                time: 400,
                                                callback: function() {}
                                            },
                                            hideAnimation: {
                                                type: "normal",
                                                time: 400,
                                                callback: function() {}
                                            },
                                            onClickEvent: function() {},
                                            onSelectItemEvent: function() {},
                                            onLoadEvent: function() {},
                                            onChooseEvent: function() {},
                                            onKeyEnterEvent: function() {},
                                            onMouseOverEvent: function() {},
                                            onMouseOutEvent: function() {},
                                            onShowListEvent: function() {},
                                            onHideListEvent: function() {}
                                        },
                                        highlightPhrase: !0,
                                        theme: "",
                                        cssClasses: "",
                                        minCharNumber: 0,
                                        requestDelay: 0,
                                        adjustWidth: !0,
                                        ajaxSettings: {},
                                        preparePostData: function(t, e) {
                                            return t
                                        },
                                        loggerEnabled: !0,
                                        template: "",
                                        categoriesAssigned: !1,
                                        categories: [{
                                            maxNumberOfElements: 4
                                        }]
                                    },
                                    i = ["ajaxSettings", "template"];
                                this.get = function(t) {
                                    return n[t]
                                }, this.equals = function(t, e) {
                                    return !(void 0 === n[i = t] || null === n[i] || n[t] !== e);
                                    var i
                                }, this.checkDataUrlProperties = function() {
                                    return "list-required" !== n.url || "list-required" !== n.data
                                }, this.checkRequiredProperties = function() {
                                    for (var t in n)
                                        if ("required" === n[t]) return logger.error("Option " + t + " must be defined"), !1;
                                    return !0
                                }, this.printPropertiesThatDoesntExist = function(t, n) {
                                    e(t, n)
                                },
                                    function() {
                                        if ("xml" === t.dataType && (t.getValue || (t.getValue = function(t) {
                                                return $(t).text()
                                            }), t.list || (t.list = {}), t.list.sort || (t.list.sort = {}), t.list.sort.method = function(e, n) {
                                                return e = t.getValue(e), (n = t.getValue(n)) > e ? -1 : e > n ? 1 : 0
                                            }, t.list.match || (t.list.match = {}), t.list.match.method = function(t, e) {
                                                return t.search(e) > -1
                                            }), void 0 !== t.categories && t.categories instanceof Array) {
                                            for (var e = [], i = 0, a = t.categories.length; a > i; i += 1) {
                                                var o = t.categories[i];
                                                for (var r in n.categories[0]) void 0 === o[r] && (o[r] = n.categories[0][r]);
                                                e.push(o)
                                            }
                                            t.categories = e
                                        }
                                    }(), !0 === (n = function t(e, n) {
                                    var i = e || {};
                                    for (var a in e) void 0 !== n[a] && null !== n[a] && ("object" != typeof n[a] || n[a] instanceof Array ? i[a] = n[a] : t(e[a], n[a]));
                                    return void 0 !== n.data && null !== n.data && "object" == typeof n.data && (i.data = n.data), i
                                }(n, t)).loggerEnabled && e(console, t), void 0 !== t.ajaxSettings && "object" == typeof t.ajaxSettings ? n.ajaxSettings = t.ajaxSettings : n.ajaxSettings = {},
                                    function() {
                                        if ("list-required" !== n.url && "function" != typeof n.url) {
                                            var e = n.url;
                                            n.url = function() {
                                                return e
                                            }
                                        }
                                        void 0 !== n.ajaxSettings.url && "function" != typeof n.ajaxSettings.url && (e = n.ajaxSettings.url, n.ajaxSettings.url = function() {
                                            return e
                                        });
                                        if ("string" == typeof n.listLocation) {
                                            var i = n.listLocation;
                                            "XML" === n.dataType.toUpperCase() ? n.listLocation = function(t) {
                                                    return $(t).find(i)
                                                } : n.listLocation = function(t) {
                                                    return t[i]
                                                }
                                        }
                                        if ("string" == typeof n.getValue) {
                                            var a = n.getValue;
                                            n.getValue = function(t) {
                                                return t[a]
                                            }
                                        }
                                        void 0 !== t.categories && (n.categoriesAssigned = !0)
                                    }()
                            }, t
                        }(EasyAutocomplete || {})) || {})) || {})) || {})) || {})) || {})) || {});
! function(t) {
    t.fn.easyAutocomplete = function(e) {
        return this.each(function() {
            var n = t(this),
                i = new EasyAutocomplete.main(n, e);
            EasyAutocomplete.inputHasId(n) || EasyAutocomplete.assignRandomId(n), i.init(), EasyAutocomplete.setHandle(i, n.attr("id"))
        })
    }, t.fn.getSelectedItemIndex = function() {
        var e = t(this).attr("id");
        return void 0 !== e ? EasyAutocomplete.getHandle(e).getSelectedItemIndex() : -1
    }, t.fn.getItems = function() {
        var e = t(this).attr("id");
        return void 0 !== e ? EasyAutocomplete.getHandle(e).getItems() : -1
    }, t.fn.getItemData = function(e) {
        var n = t(this).attr("id");
        return void 0 !== n && e > -1 ? EasyAutocomplete.getHandle(n).getItemData(e) : -1
    }, t.fn.getSelectedItemData = function() {
        var e = t(this).attr("id");
        return void 0 !== e ? EasyAutocomplete.getHandle(e).getSelectedItemData() : -1
    }
}(jQuery);