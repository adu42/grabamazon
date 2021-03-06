/*!
 * Vue.js v1.0.26
 * (c) 2016 Evan You
 * Released under the MIT License.
 */
!function (t, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.Vue = e();
}(this, function () {
    "use strict";

    function t(e, n, r) {
        if (i(e, n)) return void(e[n] = r);
        if (e._isVue) return void t(e._data, n, r);
        var s = e.__ob__;
        if (!s) return void(e[n] = r);
        if (s.convert(n, r), s.dep.notify(), s.vms) for (var o = s.vms.length; o--;) {
            var a = s.vms[o];
            a._proxy(n), a._digest();
        }
        return r;
    }

    function e(t, e) {
        if (i(t, e)) {
            delete t[e];
            var n = t.__ob__;
            if (!n) return void(t._isVue && (delete t._data[e], t._digest()));
            if (n.dep.notify(), n.vms) for (var r = n.vms.length; r--;) {
                var s = n.vms[r];
                s._unproxy(e), s._digest();
            }
        }
    }

    function i(t, e) {
        return Oi.call(t, e);
    }

    function n(t) {
        return Ti.test(t);
    }

    function r(t) {
        var e = (t + "").charCodeAt(0);
        return 36 === e || 95 === e;
    }

    function s(t) {
        return null == t ? "" : t.toString();
    }

    function o(t) {
        if ("string" != typeof t) return t;
        var e = Number(t);
        return isNaN(e) ? t : e;
    }

    function a(t) {
        return "true" === t ? !0 : "false" === t ? !1 : t;
    }

    function h(t) {
        var e = t.charCodeAt(0), i = t.charCodeAt(t.length - 1);
        return e !== i || 34 !== e && 39 !== e ? t : t.slice(1, -1);
    }

    function l(t) {
        return t.replace(Ni, c);
    }

    function c(t, e) {
        return e ? e.toUpperCase() : "";
    }

    function u(t) {
        return t.replace(ji, "$1-$2").toLowerCase();
    }

    function f(t) {
        return t.replace(Ei, c);
    }

    function p(t, e) {
        return function (i) {
            var n = arguments.length;
            return n ? n > 1 ? t.apply(e, arguments) : t.call(e, i) : t.call(e);
        };
    }

    function d(t, e) {
        e = e || 0;
        for (var i = t.length - e, n = new Array(i); i--;) n[i] = t[i + e];
        return n;
    }

    function v(t, e) {
        for (var i = Object.keys(e), n = i.length; n--;) t[i[n]] = e[i[n]];
        return t;
    }

    function m(t) {
        return null !== t && "object" == typeof t;
    }

    function g(t) {
        return Si.call(t) === Fi;
    }

    function _(t, e, i, n) {
        Object.defineProperty(t, e, {value: i, enumerable: !!n, writable: !0, configurable: !0});
    }

    function y(t, e) {
        var i, n, r, s, o, a = function h() {
            var a = Date.now() - s;
            e > a && a >= 0 ? i = setTimeout(h, e - a) : (i = null, o = t.apply(r, n), i || (r = n = null));
        };
        return function () {
            return r = this, n = arguments, s = Date.now(), i || (i = setTimeout(a, e)), o;
        };
    }

    function b(t, e) {
        for (var i = t.length; i--;) if (t[i] === e) return i;
        return -1;
    }

    function w(t) {
        var e = function i() {
            return i.cancelled ? void 0 : t.apply(this, arguments);
        };
        return e.cancel = function () {
            e.cancelled = !0;
        }, e;
    }

    function C(t, e) {
        return t == e || (m(t) && m(e) ? JSON.stringify(t) === JSON.stringify(e) : !1);
    }

    function $(t) {
        this.size = 0, this.limit = t, this.head = this.tail = void 0, this._keymap = Object.create(null);
    }

    function k() {
        var t, e = en.slice(hn, on).trim();
        if (e) {
            t = {};
            var i = e.match(vn);
            t.name = i[0], i.length > 1 && (t.args = i.slice(1).map(x));
        }
        t && (nn.filters = nn.filters || []).push(t), hn = on + 1;
    }

    function x(t) {
        if (mn.test(t)) return {value: o(t), dynamic: !1};
        var e = h(t), i = e === t;
        return {value: i ? t : e, dynamic: i};
    }

    function A(t) {
        var e = dn.get(t);
        if (e) return e;
        for (en = t, ln = cn = !1, un = fn = pn = 0, hn = 0, nn = {}, on = 0, an = en.length; an > on; on++) if (sn = rn, rn = en.charCodeAt(on), ln) 39 === rn && 92 !== sn && (ln = !ln); else if (cn) 34 === rn && 92 !== sn && (cn = !cn); else if (124 === rn && 124 !== en.charCodeAt(on + 1) && 124 !== en.charCodeAt(on - 1)) null == nn.expression ? (hn = on + 1, nn.expression = en.slice(0, on).trim()) : k(); else switch (rn) {
            case 34:
                cn = !0;
                break;
            case 39:
                ln = !0;
                break;
            case 40:
                pn++;
                break;
            case 41:
                pn--;
                break;
            case 91:
                fn++;
                break;
            case 93:
                fn--;
                break;
            case 123:
                un++;
                break;
            case 125:
                un--;
        }
        return null == nn.expression ? nn.expression = en.slice(0, on).trim() : 0 !== hn && k(), dn.put(t, nn), nn;
    }

    function O(t) {
        return t.replace(_n, "\\$&");
    }

    function T() {
        var t = O(An.delimiters[0]), e = O(An.delimiters[1]), i = O(An.unsafeDelimiters[0]),
            n = O(An.unsafeDelimiters[1]);
        bn = new RegExp(i + "((?:.|\\n)+?)" + n + "|" + t + "((?:.|\\n)+?)" + e, "g"), wn = new RegExp("^" + i + "((?:.|\\n)+?)" + n + "$"), yn = new $(1e3);
    }

    function N(t) {
        yn || T();
        var e = yn.get(t);
        if (e) return e;
        if (!bn.test(t)) return null;
        for (var i, n, r, s, o, a, h = [], l = bn.lastIndex = 0; i = bn.exec(t);) n = i.index, n > l && h.push({value: t.slice(l, n)}), r = wn.test(i[0]), s = r ? i[1] : i[2], o = s.charCodeAt(0), a = 42 === o, s = a ? s.slice(1) : s, h.push({
            tag: !0,
            value: s.trim(),
            html: r,
            oneTime: a
        }), l = n + i[0].length;
        return l < t.length && h.push({value: t.slice(l)}), yn.put(t, h), h;
    }

    function j(t, e) {
        return t.length > 1 ? t.map(function (t) {
            return E(t, e);
        }).join("+") : E(t[0], e, !0);
    }

    function E(t, e, i) {
        return t.tag ? t.oneTime && e ? '"' + e.$eval(t.value) + '"' : S(t.value, i) : '"' + t.value + '"';
    }

    function S(t, e) {
        if (Cn.test(t)) {
            var i = A(t);
            return i.filters ? "this._applyFilters(" + i.expression + ",null," + JSON.stringify(i.filters) + ",false)" : "(" + t + ")";
        }
        return e ? t : "(" + t + ")";
    }

    function F(t, e, i, n) {
        R(t, 1, function () {
            e.appendChild(t);
        }, i, n);
    }

    function D(t, e, i, n) {
        R(t, 1, function () {
            B(t, e);
        }, i, n);
    }

    function P(t, e, i) {
        R(t, -1, function () {
            z(t);
        }, e, i);
    }

    function R(t, e, i, n, r) {
        var s = t.__v_trans;
        if (!s || !s.hooks && !qi || !n._isCompiled || n.$parent && !n.$parent._isCompiled) return i(), void(r && r());
        var o = e > 0 ? "enter" : "leave";
        s[o](i, r);
    }

    function L(t) {
        if ("string" == typeof t) {
            t = document.querySelector(t);
        }
        return t;
    }

    function H(t) {
        if (!t) return !1;
        var e = t.ownerDocument.documentElement, i = t.parentNode;
        return e === t || e === i || !(!i || 1 !== i.nodeType || !e.contains(i));
    }

    function I(t, e) {
        var i = t.getAttribute(e);
        return null !== i && t.removeAttribute(e), i;
    }

    function M(t, e) {
        var i = I(t, ":" + e);
        return null === i && (i = I(t, "v-bind:" + e)), i;
    }

    function V(t, e) {
        return t.hasAttribute(e) || t.hasAttribute(":" + e) || t.hasAttribute("v-bind:" + e);
    }

    function B(t, e) {
        e.parentNode.insertBefore(t, e);
    }

    function W(t, e) {
        e.nextSibling ? B(t, e.nextSibling) : e.parentNode.appendChild(t);
    }

    function z(t) {
        t.parentNode.removeChild(t);
    }

    function U(t, e) {
        e.firstChild ? B(t, e.firstChild) : e.appendChild(t);
    }

    function J(t, e) {
        var i = t.parentNode;
        i && i.replaceChild(e, t);
    }

    function q(t, e, i, n) {
        t.addEventListener(e, i, n);
    }

    function Q(t, e, i) {
        t.removeEventListener(e, i);
    }

    function G(t) {
        var e = t.className;
        return "object" == typeof e && (e = e.baseVal || ""), e;
    }

    function Z(t, e) {
        Mi && !/svg$/.test(t.namespaceURI) ? t.className = e : t.setAttribute("class", e);
    }

    function X(t, e) {
        if (t.classList) t.classList.add(e); else {
            var i = " " + G(t) + " ";
            i.indexOf(" " + e + " ") < 0 && Z(t, (i + e).trim());
        }
    }

    function Y(t, e) {
        if (t.classList) t.classList.remove(e); else {
            for (var i = " " + G(t) + " ", n = " " + e + " "; i.indexOf(n) >= 0;) i = i.replace(n, " ");
            Z(t, i.trim());
        }
        t.className || t.removeAttribute("class");
    }

    function K(t, e) {
        var i, n;
        if (it(t) && at(t.content) && (t = t.content), t.hasChildNodes()) for (tt(t), n = e ? document.createDocumentFragment() : document.createElement("div"); i = t.firstChild;) n.appendChild(i);
        return n;
    }

    function tt(t) {
        for (var e; e = t.firstChild, et(e);) t.removeChild(e);
        for (; e = t.lastChild, et(e);) t.removeChild(e);
    }

    function et(t) {
        return t && (3 === t.nodeType && !t.data.trim() || 8 === t.nodeType);
    }

    function it(t) {
        return t.tagName && "template" === t.tagName.toLowerCase();
    }

    function nt(t, e) {
        var i = An.debug ? document.createComment(t) : document.createTextNode(e ? " " : "");
        return i.__v_anchor = !0, i;
    }

    function rt(t) {
        if (t.hasAttributes()) for (var e = t.attributes, i = 0, n = e.length; n > i; i++) {
            var r = e[i].name;
            if (Nn.test(r)) return l(r.replace(Nn, ""));
        }
    }

    function st(t, e, i) {
        for (var n; t !== e;) n = t.nextSibling, i(t), t = n;
        i(e);
    }

    function ot(t, e, i, n, r) {
        function s() {
            if (a++, o && a >= h.length) {
                for (var t = 0; t < h.length; t++) n.appendChild(h[t]);
                r && r();
            }
        }

        var o = !1, a = 0, h = [];
        st(t, e, function (t) {
            t === e && (o = !0), h.push(t), P(t, i, s);
        });
    }

    function at(t) {
        return t && 11 === t.nodeType;
    }

    function ht(t) {
        if (t.outerHTML) return t.outerHTML;
        var e = document.createElement("div");
        return e.appendChild(t.cloneNode(!0)), e.innerHTML;
    }

    function lt(t, e) {
        var i = t.tagName.toLowerCase(), n = t.hasAttributes();
        if (jn.test(i) || En.test(i)) {
            if (n) return ct(t, e);
        } else {
            if (gt(e, "components", i)) return {id: i};
            var r = n && ct(t, e);
            if (r) return r;
        }
    }

    function ct(t, e) {
        var i = t.getAttribute("is");
        if (null != i) {
            if (gt(e, "components", i)) return t.removeAttribute("is"), {id: i};
        } else if (i = M(t, "is"), null != i) return {id: i, dynamic: !0};
    }

    function ut(e, n) {
        var r, s, o;
        for (r in n) s = e[r], o = n[r], i(e, r) ? m(s) && m(o) && ut(s, o) : t(e, r, o);
        return e;
    }

    function ft(t, e) {
        var i = Object.create(t || null);
        return e ? v(i, vt(e)) : i;
    }

    function pt(t) {
        if (t.components) for (var e, i = t.components = vt(t.components), n = Object.keys(i), r = 0, s = n.length; s > r; r++) {
            var o = n[r];
            jn.test(o) || En.test(o) || (e = i[o], g(e) && (i[o] = wi.extend(e)));
        }
    }

    function dt(t) {
        var e, i, n = t.props;
        if (Di(n)) for (t.props = {}, e = n.length; e--;) i = n[e], "string" == typeof i ? t.props[i] = null : i.name && (t.props[i.name] = i); else if (g(n)) {
            var r = Object.keys(n);
            for (e = r.length; e--;) i = n[r[e]], "function" == typeof i && (n[r[e]] = {type: i});
        }
    }

    function vt(t) {
        if (Di(t)) {
            for (var e, i = {}, n = t.length; n--;) {
                e = t[n];
                var r = "function" == typeof e ? e.options && e.options.name || e.id : e.name || e.id;
                r && (i[r] = e);
            }
            return i;
        }
        return t;
    }

    function mt(t, e, n) {
        function r(i) {
            var r = Sn[i] || Fn;
            o[i] = r(t[i], e[i], n, i);
        }

        pt(e), dt(e);
        var s, o = {};
        if (e["extends"] && (t = "function" == typeof e["extends"] ? mt(t, e["extends"].options, n) : mt(t, e["extends"], n)), e.mixins) for (var a = 0, h = e.mixins.length; h > a; a++) {
            var l = e.mixins[a], c = l.prototype instanceof wi ? l.options : l;
            t = mt(t, c, n);
        }
        for (s in t) r(s);
        for (s in e) i(t, s) || r(s);
        return o;
    }

    function gt(t, e, i, n) {
        if ("string" == typeof i) {
            var r, s = t[e], o = s[i] || s[r = l(i)] || s[r.charAt(0).toUpperCase() + r.slice(1)];
            return o;
        }
    }

    function _t() {
        this.id = Dn++, this.subs = [];
    }

    function yt(t) {
        Hn = !1, t(), Hn = !0;
    }

    function bt(t) {
        if (this.value = t, this.dep = new _t, _(t, "__ob__", this), Di(t)) {
            var e = Pi ? wt : Ct;
            e(t, Rn, Ln), this.observeArray(t);
        } else this.walk(t);
    }

    function wt(t, e) {
        t.__proto__ = e;
    }

    function Ct(t, e, i) {
        for (var n = 0, r = i.length; r > n; n++) {
            var s = i[n];
            _(t, s, e[s]);
        }
    }

    function $t(t, e) {
        if (t && "object" == typeof t) {
            var n;
            return i(t, "__ob__") && t.__ob__ instanceof bt ? n = t.__ob__ : Hn && (Di(t) || g(t)) && Object.isExtensible(t) && !t._isVue && (n = new bt(t)), n && e && n.addVm(e), n;
        }
    }

    function kt(t, e, i) {
        var n = new _t, r = Object.getOwnPropertyDescriptor(t, e);
        if (!r || r.configurable !== !1) {
            var s = r && r.get, o = r && r.set, a = $t(i);
            Object.defineProperty(t, e, {
                enumerable: !0, configurable: !0, get: function () {
                    var e = s ? s.call(t) : i;
                    if (_t.target && (n.depend(), a && a.dep.depend(), Di(e))) for (var r, o = 0, h = e.length; h > o; o++) r = e[o], r && r.__ob__ && r.__ob__.dep.depend();
                    return e;
                }, set: function (e) {
                    var r = s ? s.call(t) : i;
                    e !== r && (o ? o.call(t, e) : i = e, a = $t(e), n.notify());
                }
            });
        }
    }

    function xt(t) {
        t.prototype._init = function (t) {
            t = t || {}, this.$el = null, this.$parent = t.parent, this.$root = this.$parent ? this.$parent.$root : this, this.$children = [], this.$refs = {}, this.$els = {}, this._watchers = [], this._directives = [], this._uid = Mn++, this._isVue = !0, this._events = {}, this._eventsCount = {}, this._isFragment = !1, this._fragment = this._fragmentStart = this._fragmentEnd = null, this._isCompiled = this._isDestroyed = this._isReady = this._isAttached = this._isBeingDestroyed = this._vForRemoving = !1, this._unlinkFn = null, this._context = t._context || this.$parent, this._scope = t._scope, this._frag = t._frag, this._frag && this._frag.children.push(this), this.$parent && this.$parent.$children.push(this), t = this.$options = mt(this.constructor.options, t, this), this._updateRef(), this._data = {}, this._callHook("init"), this._initState(), this._initEvents(), this._callHook("created"), t.el && this.$mount(t.el);
        };
    }

    function At(t) {
        if (void 0 === t) return "eof";
        var e = t.charCodeAt(0);
        switch (e) {
            case 91:
            case 93:
            case 46:
            case 34:
            case 39:
            case 48:
                return t;
            case 95:
            case 36:
                return "ident";
            case 32:
            case 9:
            case 10:
            case 13:
            case 160:
            case 65279:
            case 8232:
            case 8233:
                return "ws";
        }
        return e >= 97 && 122 >= e || e >= 65 && 90 >= e ? "ident" : e >= 49 && 57 >= e ? "number" : "else";
    }

    function Ot(t) {
        var e = t.trim();
        return "0" === t.charAt(0) && isNaN(t) ? !1 : n(e) ? h(e) : "*" + e;
    }

    function Tt(t) {
        function e() {
            var e = t[c + 1];
            return u === Xn && "'" === e || u === Yn && '"' === e ? (c++, n = "\\" + e, p[Bn](), !0) : void 0;
        }

        var i, n, r, s, o, a, h, l = [], c = -1, u = Jn, f = 0, p = [];
        for (p[Wn] = function () {
            void 0 !== r && (l.push(r), r = void 0);
        }, p[Bn] = function () {
            void 0 === r ? r = n : r += n;
        }, p[zn] = function () {
            p[Bn](), f++;
        }, p[Un] = function () {
            if (f > 0) f--, u = Zn, p[Bn](); else {
                if (f = 0, r = Ot(r), r === !1) return !1;
                p[Wn]();
            }
        }; null != u;) if (c++, i = t[c], "\\" !== i || !e()) {
            if (s = At(i), h = er[u], o = h[s] || h["else"] || tr, o === tr) return;
            if (u = o[0], a = p[o[1]], a && (n = o[2], n = void 0 === n ? i : n, a() === !1)) return;
            if (u === Kn) return l.raw = t, l;
        }
    }

    function Nt(t) {
        var e = Vn.get(t);
        return e || (e = Tt(t), e && Vn.put(t, e)), e;
    }

    function jt(t, e) {
        return It(e).get(t);
    }

    function Et(e, i, n) {
        var r = e;
        if ("string" == typeof i && (i = Tt(i)), !i || !m(e)) return !1;
        for (var s, o, a = 0, h = i.length; h > a; a++) s = e, o = i[a], "*" === o.charAt(0) && (o = It(o.slice(1)).get.call(r, r)), h - 1 > a ? (e = e[o], m(e) || (e = {}, t(s, o, e))) : Di(e) ? e.$set(o, n) : o in e ? e[o] = n : t(e, o, n);
        return !0;
    }

    function St() {
    }

    function Ft(t, e) {
        var i = vr.length;
        return vr[i] = e ? t.replace(lr, "\\n") : t, '"' + i + '"';
    }

    function Dt(t) {
        var e = t.charAt(0), i = t.slice(1);
        return sr.test(i) ? t : (i = i.indexOf('"') > -1 ? i.replace(ur, Pt) : i, e + "scope." + i);
    }

    function Pt(t, e) {
        return vr[e];
    }

    function Rt(t) {
        ar.test(t), vr.length = 0;
        var e = t.replace(cr, Ft).replace(hr, "");
        return e = (" " + e).replace(pr, Dt).replace(ur, Pt), Lt(e);
    }

    function Lt(t) {
        try {
            return new Function("scope", "return " + t + ";");
        } catch (e) {
            return St;
        }
    }

    function Ht(t) {
        var e = Nt(t);
        return e ? function (t, i) {
            Et(t, e, i);
        } : void 0;
    }

    function It(t, e) {
        t = t.trim();
        var i = nr.get(t);
        if (i) return e && !i.set && (i.set = Ht(i.exp)), i;
        var n = {exp: t};
        return n.get = Mt(t) && t.indexOf("[") < 0 ? Lt("scope." + t) : Rt(t), e && (n.set = Ht(t)), nr.put(t, n), n;
    }

    function Mt(t) {
        return fr.test(t) && !dr.test(t) && "Math." !== t.slice(0, 5);
    }

    function Vt() {
        gr.length = 0, _r.length = 0, yr = {}, br = {}, wr = !1;
    }

    function Bt() {
        for (var t = !0; t;) t = !1, Wt(gr), Wt(_r), gr.length ? t = !0 : (Li && An.devtools && Li.emit("flush"), Vt());
    }

    function Wt(t) {
        for (var e = 0; e < t.length; e++) {
            var i = t[e], n = i.id;
            yr[n] = null, i.run();
        }
        t.length = 0;
    }

    function zt(t) {
        var e = t.id;
        if (null == yr[e]) {
            var i = t.user ? _r : gr;
            yr[e] = i.length, i.push(t), wr || (wr = !0, Yi(Bt));
        }
    }

    function Ut(t, e, i, n) {
        n && v(this, n);
        var r = "function" == typeof e;
        if (this.vm = t, t._watchers.push(this), this.expression = e, this.cb = i, this.id = ++Cr, this.active = !0, this.dirty = this.lazy, this.deps = [], this.newDeps = [], this.depIds = new Ki, this.newDepIds = new Ki, this.prevError = null, r) this.getter = e, this.setter = void 0; else {
            var s = It(e, this.twoWay);
            this.getter = s.get, this.setter = s.set;
        }
        this.value = this.lazy ? void 0 : this.get(), this.queued = this.shallow = !1;
    }

    function Jt(t, e) {
        var i = void 0, n = void 0;
        e || (e = $r, e.clear());
        var r = Di(t), s = m(t);
        if ((r || s) && Object.isExtensible(t)) {
            if (t.__ob__) {
                var o = t.__ob__.dep.id;
                if (e.has(o)) return;
                e.add(o);
            }
            if (r) for (i = t.length; i--;) Jt(t[i], e); else if (s) for (n = Object.keys(t), i = n.length; i--;) Jt(t[n[i]], e);
        }
    }

    function qt(t) {
        return it(t) && at(t.content);
    }

    function Qt(t, e) {
        var i = e ? t : t.trim(), n = xr.get(i);
        if (n) return n;
        var r = document.createDocumentFragment(), s = t.match(Tr), o = Nr.test(t), a = jr.test(t);
        if (s || o || a) {
            var h = s && s[1], l = Or[h] || Or.efault, c = l[0], u = l[1], f = l[2], p = document.createElement("div");
            for (p.innerHTML = u + t + f; c--;) p = p.lastChild;
            for (var d; d = p.firstChild;) r.appendChild(d);
        } else r.appendChild(document.createTextNode(t));
        return e || tt(r), xr.put(i, r), r;
    }

    function Gt(t) {
        if (qt(t)) return Qt(t.innerHTML);
        if ("SCRIPT" === t.tagName) return Qt(t.textContent);
        for (var e, i = Zt(t), n = document.createDocumentFragment(); e = i.firstChild;) n.appendChild(e);
        return tt(n), n;
    }

    function Zt(t) {
        if (!t.querySelectorAll) return t.cloneNode();
        var e, i, n, r = t.cloneNode(!0);
        if (Er) {
            var s = r;
            if (qt(t) && (t = t.content, s = r.content), i = t.querySelectorAll("template"), i.length) for (n = s.querySelectorAll("template"), e = n.length; e--;) n[e].parentNode.replaceChild(Zt(i[e]), n[e]);
        }
        if (Sr) if ("TEXTAREA" === t.tagName) r.value = t.value; else if (i = t.querySelectorAll("textarea"), i.length) for (n = r.querySelectorAll("textarea"), e = n.length; e--;) n[e].value = i[e].value;
        return r;
    }

    function Xt(t, e, i) {
        var n, r;
        return at(t) ? (tt(t), e ? Zt(t) : t) : ("string" == typeof t ? i || "#" !== t.charAt(0) ? r = Qt(t, i) : (r = Ar.get(t), r || (n = document.getElementById(t.slice(1)), n && (r = Gt(n), Ar.put(t, r)))) : t.nodeType && (r = Gt(t)), r && e ? Zt(r) : r);
    }

    function Yt(t, e, i, n, r, s) {
        this.children = [], this.childFrags = [], this.vm = e, this.scope = r, this.inserted = !1, this.parentFrag = s, s && s.childFrags.push(this), this.unlink = t(e, i, n, r, this);
        var o = this.single = 1 === i.childNodes.length && !i.childNodes[0].__v_anchor;
        o ? (this.node = i.childNodes[0], this.before = Kt, this.remove = te) : (this.node = nt("fragment-start"), this.end = nt("fragment-end"), this.frag = i, U(this.node, i), i.appendChild(this.end), this.before = ee, this.remove = ie), this.node.__v_frag = this;
    }

    function Kt(t, e) {
        this.inserted = !0;
        var i = e !== !1 ? D : B;
        i(this.node, t, this.vm), H(this.node) && this.callHook(ne);
    }

    function te() {
        this.inserted = !1;
        var t = H(this.node), e = this;
        this.beforeRemove(), P(this.node, this.vm, function () {
            t && e.callHook(re), e.destroy();
        });
    }

    function ee(t, e) {
        this.inserted = !0;
        var i = this.vm, n = e !== !1 ? D : B;
        st(this.node, this.end, function (e) {
            n(e, t, i);
        }), H(this.node) && this.callHook(ne);
    }

    function ie() {
        this.inserted = !1;
        var t = this, e = H(this.node);
        this.beforeRemove(), ot(this.node, this.end, this.vm, this.frag, function () {
            e && t.callHook(re), t.destroy();
        });
    }

    function ne(t) {
        !t._isAttached && H(t.$el) && t._callHook("attached");
    }

    function re(t) {
        t._isAttached && !H(t.$el) && t._callHook("detached");
    }

    function se(t, e) {
        this.vm = t;
        var i, n = "string" == typeof e;
        n || it(e) && !e.hasAttribute("v-if") ? i = Xt(e, !0) : (i = document.createDocumentFragment(), i.appendChild(e)), this.template = i;
        var r, s = t.constructor.cid;
        if (s > 0) {
            var o = s + (n ? e : ht(e));
            r = Pr.get(o), r || (r = De(i, t.$options, !0), Pr.put(o, r));
        } else r = De(i, t.$options, !0);
        this.linker = r;
    }

    function oe(t, e, i) {
        var n = t.node.previousSibling;
        if (n) {
            for (t = n.__v_frag; !(t && t.forId === i && t.inserted || n === e);) {
                if (n = n.previousSibling, !n) return;
                t = n.__v_frag;
            }
            return t;
        }
    }

    function ae(t) {
        var e = t.node;
        if (t.end) for (; !e.__vue__ && e !== t.end && e.nextSibling;) e = e.nextSibling;
        return e.__vue__;
    }

    function he(t) {
        for (var e = -1, i = new Array(Math.floor(t)); ++e < t;) i[e] = e;
        return i;
    }

    function le(t, e, i, n) {
        return n ? "$index" === n ? t : n.charAt(0).match(/\w/) ? jt(i, n) : i[n] : e || i;
    }

    function ce(t, e, i) {
        for (var n, r, s, o = e ? [] : null, a = 0, h = t.options.length; h > a; a++) if (n = t.options[a], s = i ? n.hasAttribute("selected") : n.selected) {
            if (r = n.hasOwnProperty("_value") ? n._value : n.value, !e) return r;
            o.push(r);
        }
        return o;
    }

    function ue(t, e) {
        for (var i = t.length; i--;) if (C(t[i], e)) return i;
        return -1;
    }

    function fe(t, e) {
        var i = e.map(function (t) {
            var e = t.charCodeAt(0);
            return e > 47 && 58 > e ? parseInt(t, 10) : 1 === t.length && (e = t.toUpperCase().charCodeAt(0), e > 64 && 91 > e) ? e : is[t];
        });
        return i = [].concat.apply([], i), function (e) {
            return i.indexOf(e.keyCode) > -1 ? t.call(this, e) : void 0;
        };
    }

    function pe(t) {
        return function (e) {
            return e.stopPropagation(), t.call(this, e);
        };
    }

    function de(t) {
        return function (e) {
            return e.preventDefault(), t.call(this, e);
        };
    }

    function ve(t) {
        return function (e) {
            return e.target === e.currentTarget ? t.call(this, e) : void 0;
        };
    }

    function me(t) {
        if (as[t]) return as[t];
        var e = ge(t);
        return as[t] = as[e] = e, e;
    }

    function ge(t) {
        t = u(t);
        var e = l(t), i = e.charAt(0).toUpperCase() + e.slice(1);
        hs || (hs = document.createElement("div"));
        var n, r = rs.length;
        if ("filter" !== e && e in hs.style) return {kebab: t, camel: e};
        for (; r--;) if (n = ss[r] + i, n in hs.style) return {kebab: rs[r] + t, camel: n};
    }

    function _e(t) {
        var e = [];
        if (Di(t)) for (var i = 0, n = t.length; n > i; i++) {
            var r = t[i];
            if (r) if ("string" == typeof r) e.push(r); else for (var s in r) r[s] && e.push(s);
        } else if (m(t)) for (var o in t) t[o] && e.push(o);
        return e;
    }

    function ye(t, e, i) {
        if (e = e.trim(), -1 === e.indexOf(" ")) return void i(t, e);
        for (var n = e.split(/\s+/), r = 0, s = n.length; s > r; r++) i(t, n[r]);
    }

    function be(t, e, i) {
        function n() {
            ++s >= r ? i() : t[s].call(e, n);
        }

        var r = t.length, s = 0;
        t[0].call(e, n);
    }

    function we(t, e, i) {
        for (var r, s, o, a, h, c, f, p = [], d = Object.keys(e), v = d.length; v--;) s = d[v], r = e[s] || ks, h = l(s), xs.test(h) && (f = {
            name: s,
            path: h,
            options: r,
            mode: $s.ONE_WAY,
            raw: null
        }, o = u(s), null === (a = M(t, o)) && (null !== (a = M(t, o + ".sync")) ? f.mode = $s.TWO_WAY : null !== (a = M(t, o + ".once")) && (f.mode = $s.ONE_TIME)), null !== a ? (f.raw = a, c = A(a), a = c.expression, f.filters = c.filters, n(a) && !c.filters ? f.optimizedLiteral = !0 : f.dynamic = !0, f.parentPath = a) : null !== (a = I(t, o)) && (f.raw = a), p.push(f));
        return Ce(p);
    }

    function Ce(t) {
        return function (e, n) {
            e._props = {};
            for (var r, s, l, c, f, p = e.$options.propsData, d = t.length; d--;) if (r = t[d], f = r.raw, s = r.path, l = r.options, e._props[s] = r, p && i(p, s) && ke(e, r, p[s]), null === f) ke(e, r, void 0); else if (r.dynamic) r.mode === $s.ONE_TIME ? (c = (n || e._context || e).$get(r.parentPath), ke(e, r, c)) : e._context ? e._bindDir({
                name: "prop",
                def: Os,
                prop: r
            }, null, null, n) : ke(e, r, e.$get(r.parentPath)); else if (r.optimizedLiteral) {
                var v = h(f);
                c = v === f ? a(o(f)) : v, ke(e, r, c);
            } else c = l.type !== Boolean || "" !== f && f !== u(r.name) ? f : !0, ke(e, r, c);
        };
    }

    function $e(t, e, i, n) {
        var r = e.dynamic && Mt(e.parentPath), s = i;
        void 0 === s && (s = Ae(t, e)), s = Te(e, s, t);
        var o = s !== i;
        Oe(e, s, t) || (s = void 0), r && !o ? yt(function () {
            n(s);
        }) : n(s);
    }

    function ke(t, e, i) {
        $e(t, e, i, function (i) {
            kt(t, e.path, i);
        });
    }

    function xe(t, e, i) {
        $e(t, e, i, function (i) {
            t[e.path] = i;
        });
    }

    function Ae(t, e) {
        var n = e.options;
        if (!i(n, "default")) return n.type === Boolean ? !1 : void 0;
        var r = n["default"];
        return m(r), "function" == typeof r && n.type !== Function ? r.call(t) : r;
    }

    function Oe(t, e, i) {
        if (!t.options.required && (null === t.raw || null == e)) return !0;
        var n = t.options, r = n.type, s = !r, o = [];
        if (r) {
            Di(r) || (r = [r]);
            for (var a = 0; a < r.length && !s; a++) {
                var h = Ne(e, r[a]);
                o.push(h.expectedType), s = h.valid;
            }
        }
        if (!s) return !1;
        var l = n.validator;
        return l && !l(e) ? !1 : !0;
    }

    function Te(t, e, i) {
        var n = t.options.coerce;
        return n && "function" == typeof n ? n(e) : e;
    }

    function Ne(t, e) {
        var i, n;
        return e === String ? (n = "string", i = typeof t === n) : e === Number ? (n = "number", i = typeof t === n) : e === Boolean ? (n = "boolean", i = typeof t === n) : e === Function ? (n = "function", i = typeof t === n) : e === Object ? (n = "object", i = g(t)) : e === Array ? (n = "array", i = Di(t)) : i = t instanceof e, {
            valid: i,
            expectedType: n
        };
    }

    function je(t) {
        Ts.push(t), Ns || (Ns = !0, Yi(Ee));
    }

    function Ee() {
        for (var t = document.documentElement.offsetHeight, e = 0; e < Ts.length; e++) Ts[e]();
        return Ts = [], Ns = !1, t;
    }

    function Se(t, e, i, n) {
        this.id = e, this.el = t, this.enterClass = i && i.enterClass || e + "-enter", this.leaveClass = i && i.leaveClass || e + "-leave", this.hooks = i, this.vm = n, this.pendingCssEvent = this.pendingCssCb = this.cancel = this.pendingJsCb = this.op = this.cb = null, this.justEntered = !1, this.entered = this.left = !1, this.typeCache = {}, this.type = i && i.type;
        var r = this;
        ["enterNextTick", "enterDone", "leaveNextTick", "leaveDone"].forEach(function (t) {
            r[t] = p(r[t], r);
        });
    }

    function Fe(t) {
        if (/svg$/.test(t.namespaceURI)) {
            var e = t.getBoundingClientRect();
            return !(e.width || e.height);
        }
        return !(t.offsetWidth || t.offsetHeight || t.getClientRects().length);
    }

    function De(t, e, i) {
        var n = i || !e._asComponent ? Ve(t, e) : null,
            r = n && n.terminal || ri(t) || !t.hasChildNodes() ? null : qe(t.childNodes, e);
        return function (t, e, i, s, o) {
            var a = d(e.childNodes), h = Pe(function () {
                n && n(t, e, i, s, o), r && r(t, a, i, s, o);
            }, t);
            return Le(t, h);
        };
    }

    function Pe(t, e) {
        e._directives = [];
        var i = e._directives.length;
        t();
        var n = e._directives.slice(i);
        n.sort(Re);
        for (var r = 0, s = n.length; s > r; r++) n[r]._bind();
        return n;
    }

    function Re(t, e) {
        return t = t.descriptor.def.priority || zs, e = e.descriptor.def.priority || zs, t > e ? -1 : t === e ? 0 : 1;
    }

    function Le(t, e, i, n) {
        function r(r) {
            He(t, e, r), i && n && He(i, n);
        }

        return r.dirs = e, r;
    }

    function He(t, e, i) {
        for (var n = e.length; n--;) e[n]._teardown();
    }

    function Ie(t, e, i, n) {
        var r = we(e, i, t), s = Pe(function () {
            r(t, n);
        }, t);
        return Le(t, s);
    }

    function Me(t, e, i) {
        var n, r, s = e._containerAttrs, o = e._replacerAttrs;
        return 11 !== t.nodeType && (e._asComponent ? (s && i && (n = ti(s, i)), o && (r = ti(o, e))) : r = ti(t.attributes, e)), e._containerAttrs = e._replacerAttrs = null, function (t, e, i) {
            var s, o = t._context;
            o && n && (s = Pe(function () {
                n(o, e, null, i);
            }, o));
            var a = Pe(function () {
                r && r(t, e);
            }, t);
            return Le(t, a, o, s);
        };
    }

    function Ve(t, e) {
        var i = t.nodeType;
        return 1 !== i || ri(t) ? 3 === i && t.data.trim() ? We(t, e) : null : Be(t, e);
    }

    function Be(t, e) {
        if ("TEXTAREA" === t.tagName) {
            var i = N(t.value);
            i && (t.setAttribute(":value", j(i)), t.value = "");
        }
        var n, r = t.hasAttributes(), s = r && d(t.attributes);
        return r && (n = Xe(t, s, e)), n || (n = Ge(t, e)), n || (n = Ze(t, e)), !n && r && (n = ti(s, e)), n;
    }

    function We(t, e) {
        if (t._skip) return ze;
        var i = N(t.wholeText);
        if (!i) return null;
        for (var n = t.nextSibling; n && 3 === n.nodeType;) n._skip = !0, n = n.nextSibling;
        for (var r, s, o = document.createDocumentFragment(), a = 0, h = i.length; h > a; a++) s = i[a], r = s.tag ? Ue(s, e) : document.createTextNode(s.value), o.appendChild(r);
        return Je(i, o, e);
    }

    function ze(t, e) {
        z(e);
    }

    function Ue(t, e) {
        function i(e) {
            if (!t.descriptor) {
                var i = A(t.value);
                t.descriptor = {name: e, def: bs[e], expression: i.expression, filters: i.filters};
            }
        }

        var n;
        return t.oneTime ? n = document.createTextNode(t.value) : t.html ? (n = document.createComment("v-html"), i("html")) : (n = document.createTextNode(" "), i("text")), n;
    }

    function Je(t, e) {
        return function (i, n, r, o) {
            for (var a, h, l, c = e.cloneNode(!0), u = d(c.childNodes), f = 0, p = t.length; p > f; f++) a = t[f], h = a.value, a.tag && (l = u[f], a.oneTime ? (h = (o || i).$eval(h), a.html ? J(l, Xt(h, !0)) : l.data = s(h)) : i._bindDir(a.descriptor, l, r, o));
            J(n, c);
        };
    }

    function qe(t, e) {
        for (var i, n, r, s = [], o = 0, a = t.length; a > o; o++) r = t[o], i = Ve(r, e), n = i && i.terminal || "SCRIPT" === r.tagName || !r.hasChildNodes() ? null : qe(r.childNodes, e), s.push(i, n);
        return s.length ? Qe(s) : null;
    }

    function Qe(t) {
        return function (e, i, n, r, s) {
            for (var o, a, h, l = 0, c = 0, u = t.length; u > l; c++) {
                o = i[c], a = t[l++], h = t[l++];
                var f = d(o.childNodes);
                a && a(e, o, n, r, s), h && h(e, f, n, r, s);
            }
        };
    }

    function Ge(t, e) {
        var i = t.tagName.toLowerCase();
        if (!jn.test(i)) {
            var n = gt(e, "elementDirectives", i);
            return n ? Ke(t, i, "", e, n) : void 0;
        }
    }

    function Ze(t, e) {
        var i = lt(t, e);
        if (i) {
            var n = rt(t),
                r = {name: "component", ref: n, expression: i.id, def: Hs.component, modifiers: {literal: !i.dynamic}},
                s = function (t, e, i, s, o) {
                    n && kt((s || t).$refs, n, null), t._bindDir(r, e, i, s, o);
                };
            return s.terminal = !0, s;
        }
    }

    function Xe(t, e, i) {
        if (null !== I(t, "v-pre")) return Ye;
        if (t.hasAttribute("v-else")) {
            var n = t.previousElementSibling;
            if (n && n.hasAttribute("v-if")) return Ye;
        }
        for (var r, s, o, a, h, l, c, u, f, p, d = 0, v = e.length; v > d; d++) r = e[d], s = r.name.replace(Bs, ""), (h = s.match(Vs)) && (f = gt(i, "directives", h[1]), f && f.terminal && (!p || (f.priority || Us) > p.priority) && (p = f, c = r.name, a = ei(r.name), o = r.value, l = h[1], u = h[2]));
        return p ? Ke(t, l, o, i, p, c, u, a) : void 0;
    }

    function Ye() {
    }

    function Ke(t, e, i, n, r, s, o, a) {
        var h = A(i),
            l = {name: e, arg: o, expression: h.expression, filters: h.filters, raw: i, attr: s, modifiers: a, def: r};
        ("for" === e || "router-view" === e) && (l.ref = rt(t));
        var c = function (t, e, i, n, r) {
            l.ref && kt((n || t).$refs, l.ref, null), t._bindDir(l, e, i, n, r);
        };
        return c.terminal = !0, c;
    }

    function ti(t, e) {
        function i(t, e, i) {
            var n = i && ni(i), r = !n && A(s);
            v.push({
                name: t,
                attr: o,
                raw: a,
                def: e,
                arg: l,
                modifiers: c,
                expression: r && r.expression,
                filters: r && r.filters,
                interp: i,
                hasOneTime: n
            });
        }

        for (var n, r, s, o, a, h, l, c, u, f, p, d = t.length, v = []; d--;) if (n = t[d], r = o = n.name, s = a = n.value, f = N(s), l = null, c = ei(r), r = r.replace(Bs, ""), f) s = j(f), l = r, i("bind", bs.bind, f); else if (Ws.test(r)) c.literal = !Is.test(r), i("transition", Hs.transition); else if (Ms.test(r)) l = r.replace(Ms, ""), i("on", bs.on); else if (Is.test(r)) h = r.replace(Is, ""), "style" === h || "class" === h ? i(h, Hs[h]) : (l = h, i("bind", bs.bind)); else if (p = r.match(Vs)) {
            if (h = p[1], l = p[2], "else" === h) continue;
            u = gt(e, "directives", h, !0), u && i(h, u);
        }
        return v.length ? ii(v) : void 0;
    }

    function ei(t) {
        var e = Object.create(null), i = t.match(Bs);
        if (i) for (var n = i.length; n--;) e[i[n].slice(1)] = !0;
        return e;
    }

    function ii(t) {
        return function (e, i, n, r, s) {
            for (var o = t.length; o--;) e._bindDir(t[o], i, n, r, s);
        };
    }

    function ni(t) {
        for (var e = t.length; e--;) if (t[e].oneTime) return !0;
    }

    function ri(t) {
        return "SCRIPT" === t.tagName && (!t.hasAttribute("type") || "text/javascript" === t.getAttribute("type"));
    }

    function si(t, e) {
        return e && (e._containerAttrs = ai(t)), it(t) && (t = Xt(t)), e && (e._asComponent && !e.template && (e.template = "<slot></slot>"), e.template && (e._content = K(t), t = oi(t, e))), at(t) && (U(nt("v-start", !0), t), t.appendChild(nt("v-end", !0))), t;
    }

    function oi(t, e) {
        var i = e.template, n = Xt(i, !0);
        if (n) {
            var r = n.firstChild, s = r.tagName && r.tagName.toLowerCase();
            return e.replace ? (t === document.body, n.childNodes.length > 1 || 1 !== r.nodeType || "component" === s || gt(e, "components", s) || V(r, "is") || gt(e, "elementDirectives", s) || r.hasAttribute("v-for") || r.hasAttribute("v-if") ? n : (e._replacerAttrs = ai(r), hi(t, r), r)) : (t.appendChild(n), t);
        }
    }

    function ai(t) {
        return 1 === t.nodeType && t.hasAttributes() ? d(t.attributes) : void 0;
    }

    function hi(t, e) {
        for (var i, n, r = t.attributes, s = r.length; s--;) i = r[s].name, n = r[s].value, e.hasAttribute(i) || Js.test(i) ? "class" === i && !N(n) && (n = n.trim()) && n.split(/\s+/).forEach(function (t) {
            X(e, t);
        }) : e.setAttribute(i, n);
    }

    function li(t, e) {
        if (e) {
            for (var i, n, r = t._slotContents = Object.create(null), s = 0, o = e.children.length; o > s; s++) i = e.children[s], (n = i.getAttribute("slot")) && (r[n] || (r[n] = [])).push(i);
            for (n in r) r[n] = ci(r[n], e);
            if (e.hasChildNodes()) {
                var a = e.childNodes;
                if (1 === a.length && 3 === a[0].nodeType && !a[0].data.trim()) return;
                r["default"] = ci(e.childNodes, e);
            }
        }
    }

    function ci(t, e) {
        var i = document.createDocumentFragment();
        t = d(t);
        for (var n = 0, r = t.length; r > n; n++) {
            var s = t[n];
            !it(s) || s.hasAttribute("v-if") || s.hasAttribute("v-for") || (e.removeChild(s), s = Xt(s, !0)), i.appendChild(s);
        }
        return i;
    }

    function ui(t) {
        function e() {
        }

        function n(t, e) {
            var i = new Ut(e, t, null, {lazy: !0});
            return function () {
                return i.dirty && i.evaluate(), _t.target && i.depend(), i.value;
            };
        }

        Object.defineProperty(t.prototype, "$data", {
            get: function () {
                return this._data;
            }, set: function (t) {
                t !== this._data && this._setData(t);
            }
        }), t.prototype._initState = function () {
            this._initProps(), this._initMeta(), this._initMethods(), this._initData(), this._initComputed();
        }, t.prototype._initProps = function () {
            var t = this.$options, e = t.el, i = t.props;
            e = t.el = L(e), this._propsUnlinkFn = e && 1 === e.nodeType && i ? Ie(this, e, i, this._scope) : null;
        }, t.prototype._initData = function () {
            var t = this.$options.data, e = this._data = t ? t() : {};
            g(e) || (e = {});
            var n, r, s = this._props, o = Object.keys(e);
            for (n = o.length; n--;) r = o[n], s && i(s, r) || this._proxy(r);
            $t(e, this);
        }, t.prototype._setData = function (t) {
            t = t || {};
            var e = this._data;
            this._data = t;
            var n, r, s;
            for (n = Object.keys(e), s = n.length; s--;) r = n[s], r in t || this._unproxy(r);
            for (n = Object.keys(t), s = n.length; s--;) r = n[s], i(this, r) || this._proxy(r);
            e.__ob__.removeVm(this), $t(t, this), this._digest();
        }, t.prototype._proxy = function (t) {
            if (!r(t)) {
                var e = this;
                Object.defineProperty(e, t, {
                    configurable: !0, enumerable: !0, get: function () {
                        return e._data[t];
                    }, set: function (i) {
                        e._data[t] = i;
                    }
                });
            }
        }, t.prototype._unproxy = function (t) {
            r(t) || delete this[t];
        }, t.prototype._digest = function () {
            for (var t = 0, e = this._watchers.length; e > t; t++) this._watchers[t].update(!0);
        }, t.prototype._initComputed = function () {
            var t = this.$options.computed;
            if (t) for (var i in t) {
                var r = t[i], s = {enumerable: !0, configurable: !0};
                "function" == typeof r ? (s.get = n(r, this), s.set = e) : (s.get = r.get ? r.cache !== !1 ? n(r.get, this) : p(r.get, this) : e, s.set = r.set ? p(r.set, this) : e), Object.defineProperty(this, i, s);
            }
        }, t.prototype._initMethods = function () {
            var t = this.$options.methods;
            if (t) for (var e in t) this[e] = p(t[e], this);
        }, t.prototype._initMeta = function () {
            var t = this.$options._meta;
            if (t) for (var e in t) kt(this, e, t[e]);
        };
    }

    function fi(t) {
        function e(t, e) {
            for (var i, n, r, s = e.attributes, o = 0, a = s.length; a > o; o++) i = s[o].name, Qs.test(i) && (i = i.replace(Qs, ""), n = s[o].value, Mt(n) && (n += ".apply(this, $arguments)"), r = (t._scope || t._context).$eval(n, !0), r._fromParent = !0, t.$on(i.replace(Qs), r));
        }

        function i(t, e, i) {
            if (i) {
                var r, s, o, a;
                for (s in i) if (r = i[s], Di(r)) for (o = 0, a = r.length; a > o; o++) n(t, e, s, r[o]); else n(t, e, s, r);
            }
        }

        function n(t, e, i, r, s) {
            var o = typeof r;
            if ("function" === o) t[e](i, r, s); else if ("string" === o) {
                var a = t.$options.methods, h = a && a[r];
                h && t[e](i, h, s);
            } else r && "object" === o && n(t, e, i, r.handler, r);
        }

        function r() {
            this._isAttached || (this._isAttached = !0, this.$children.forEach(s));
        }

        function s(t) {
            !t._isAttached && H(t.$el) && t._callHook("attached");
        }

        function o() {
            this._isAttached && (this._isAttached = !1, this.$children.forEach(a));
        }

        function a(t) {
            t._isAttached && !H(t.$el) && t._callHook("detached");
        }

        t.prototype._initEvents = function () {
            var t = this.$options;
            t._asComponent && e(this, t.el), i(this, "$on", t.events), i(this, "$watch", t.watch);
        }, t.prototype._initDOMHooks = function () {
            this.$on("hook:attached", r), this.$on("hook:detached", o);
        }, t.prototype._callHook = function (t) {
            this.$emit("pre-hook:" + t);
            var e = this.$options[t];
            if (e) for (var i = 0, n = e.length; n > i; i++) e[i].call(this);
            this.$emit("hook:" + t);
        };
    }

    function pi() {
    }

    function di(t, e, i, n, r, s) {
        this.vm = e, this.el = i, this.descriptor = t, this.name = t.name, this.expression = t.expression, this.arg = t.arg, this.modifiers = t.modifiers, this.filters = t.filters, this.literal = this.modifiers && this.modifiers.literal, this._locked = !1, this._bound = !1, this._listeners = null, this._host = n, this._scope = r, this._frag = s;
    }

    function vi(t) {
        t.prototype._updateRef = function (t) {
            var e = this.$options._ref;
            if (e) {
                var i = (this._scope || this._context).$refs;
                t ? i[e] === this && (i[e] = null) : i[e] = this;
            }
        }, t.prototype._compile = function (t) {
            var e = this.$options, i = t;
            if (t = si(t, e), this._initElement(t), 1 !== t.nodeType || null === I(t, "v-pre")) {
                var n = this._context && this._context.$options, r = Me(t, e, n);
                li(this, e._content);
                var s, o = this.constructor;
                e._linkerCachable && (s = o.linker, s || (s = o.linker = De(t, e)));
                var a = r(this, t, this._scope), h = s ? s(this, t) : De(t, e)(this, t);
                this._unlinkFn = function () {
                    a(), h(!0);
                }, e.replace && J(i, t), this._isCompiled = !0, this._callHook("compiled");
            }
        }, t.prototype._initElement = function (t) {
            at(t) ? (this._isFragment = !0, this.$el = this._fragmentStart = t.firstChild, this._fragmentEnd = t.lastChild, 3 === this._fragmentStart.nodeType && (this._fragmentStart.data = this._fragmentEnd.data = ""), this._fragment = t) : this.$el = t, this.$el.__vue__ = this, this._callHook("beforeCompile");
        }, t.prototype._bindDir = function (t, e, i, n, r) {
            this._directives.push(new di(t, this, e, i, n, r));
        }, t.prototype._destroy = function (t, e) {
            if (this._isBeingDestroyed) return void(e || this._cleanup());
            var i, n, r = this, s = function () {
                !i || n || e || r._cleanup();
            };
            t && this.$el && (n = !0,
                this.$remove(function () {
                    n = !1, s();
                })), this._callHook("beforeDestroy"), this._isBeingDestroyed = !0;
            var o, a = this.$parent;
            for (a && !a._isBeingDestroyed && (a.$children.$remove(this), this._updateRef(!0)), o = this.$children.length; o--;) this.$children[o].$destroy();
            for (this._propsUnlinkFn && this._propsUnlinkFn(), this._unlinkFn && this._unlinkFn(), o = this._watchers.length; o--;) this._watchers[o].teardown();
            this.$el && (this.$el.__vue__ = null), i = !0, s();
        }, t.prototype._cleanup = function () {
            this._isDestroyed || (this._frag && this._frag.children.$remove(this), this._data && this._data.__ob__ && this._data.__ob__.removeVm(this), this.$el = this.$parent = this.$root = this.$children = this._watchers = this._context = this._scope = this._directives = null, this._isDestroyed = !0, this._callHook("destroyed"), this.$off());
        };
    }

    function mi(t) {
        t.prototype._applyFilters = function (t, e, i, n) {
            var r, s, o, a, h, l, c, u, f;
            for (l = 0, c = i.length; c > l; l++) if (r = i[n ? c - l - 1 : l], s = gt(this.$options, "filters", r.name, !0), s && (s = n ? s.write : s.read || s, "function" == typeof s)) {
                if (o = n ? [t, e] : [t], h = n ? 2 : 1, r.args) for (u = 0, f = r.args.length; f > u; u++) a = r.args[u], o[u + h] = a.dynamic ? this.$get(a.value) : a.value;
                t = s.apply(this, o);
            }
            return t;
        }, t.prototype._resolveComponent = function (e, i) {
            var n;
            if (n = "function" == typeof e ? e : gt(this.$options, "components", e, !0)) if (n.options) i(n); else if (n.resolved) i(n.resolved); else if (n.requested) n.pendingCallbacks.push(i); else {
                n.requested = !0;
                var r = n.pendingCallbacks = [i];
                n.call(this, function (e) {
                    g(e) && (e = t.extend(e)), n.resolved = e;
                    for (var i = 0, s = r.length; s > i; i++) r[i](e);
                }, function (t) {
                });
            }
        };
    }

    function gi(t) {
        function i(t) {
            return JSON.parse(JSON.stringify(t));
        }

        t.prototype.$get = function (t, e) {
            var i = It(t);
            if (i) {
                if (e) {
                    var n = this;
                    return function () {
                        n.$arguments = d(arguments);
                        var t = i.get.call(n, n);
                        return n.$arguments = null, t;
                    };
                }
                try {
                    return i.get.call(this, this);
                } catch (r) {
                }
            }
        }, t.prototype.$set = function (t, e) {
            var i = It(t, !0);
            i && i.set && i.set.call(this, this, e);
        }, t.prototype.$delete = function (t) {
            e(this._data, t);
        }, t.prototype.$watch = function (t, e, i) {
            var n, r = this;
            "string" == typeof t && (n = A(t), t = n.expression);
            var s = new Ut(r, t, e, {
                deep: i && i.deep,
                sync: i && i.sync,
                filters: n && n.filters,
                user: !i || i.user !== !1
            });
            return i && i.immediate && e.call(r, s.value), function () {
                s.teardown();
            };
        }, t.prototype.$eval = function (t, e) {
            if (Gs.test(t)) {
                var i = A(t), n = this.$get(i.expression, e);
                return i.filters ? this._applyFilters(n, null, i.filters) : n;
            }
            return this.$get(t, e);
        }, t.prototype.$interpolate = function (t) {
            var e = N(t), i = this;
            return e ? 1 === e.length ? i.$eval(e[0].value) + "" : e.map(function (t) {
                return t.tag ? i.$eval(t.value) : t.value;
            }).join("") : t;
        }, t.prototype.$log = function (t) {
            var e = t ? jt(this._data, t) : this._data;
            if (e && (e = i(e)), !t) {
                var n;
                for (n in this.$options.computed) e[n] = i(this[n]);
                if (this._props) for (n in this._props) e[n] = i(this[n]);
            }
            console.log(e);
        };
    }

    function _i(t) {
        function e(t, e, n, r, s, o) {
            e = i(e);
            var a = !H(e), h = r === !1 || a ? s : o, l = !a && !t._isAttached && !H(t.$el);
            return t._isFragment ? (st(t._fragmentStart, t._fragmentEnd, function (i) {
                h(i, e, t);
            }), n && n()) : h(t.$el, e, t, n), l && t._callHook("attached"), t;
        }

        function i(t) {
            return "string" == typeof t ? document.querySelector(t) : t;
        }

        function n(t, e, i, n) {
            e.appendChild(t), n && n();
        }

        function r(t, e, i, n) {
            B(t, e), n && n();
        }

        function s(t, e, i) {
            z(t), i && i();
        }

        t.prototype.$nextTick = function (t) {
            Yi(t, this);
        }, t.prototype.$appendTo = function (t, i, r) {
            return e(this, t, i, r, n, F);
        }, t.prototype.$prependTo = function (t, e, n) {
            return t = i(t), t.hasChildNodes() ? this.$before(t.firstChild, e, n) : this.$appendTo(t, e, n), this;
        }, t.prototype.$before = function (t, i, n) {
            return e(this, t, i, n, r, D);
        }, t.prototype.$after = function (t, e, n) {
            return t = i(t), t.nextSibling ? this.$before(t.nextSibling, e, n) : this.$appendTo(t.parentNode, e, n), this;
        }, t.prototype.$remove = function (t, e) {
            if (!this.$el.parentNode) return t && t();
            var i = this._isAttached && H(this.$el);
            i || (e = !1);
            var n = this, r = function () {
                i && n._callHook("detached"), t && t();
            };
            if (this._isFragment) ot(this._fragmentStart, this._fragmentEnd, this, this._fragment, r); else {
                var o = e === !1 ? s : P;
                o(this.$el, this, r);
            }
            return this;
        };
    }

    function yi(t) {
        function e(t, e, n) {
            var r = t.$parent;
            if (r && n && !i.test(e)) for (; r;) r._eventsCount[e] = (r._eventsCount[e] || 0) + n, r = r.$parent;
        }

        t.prototype.$on = function (t, i) {
            return (this._events[t] || (this._events[t] = [])).push(i), e(this, t, 1), this;
        }, t.prototype.$once = function (t, e) {
            function i() {
                n.$off(t, i), e.apply(this, arguments);
            }

            var n = this;
            return i.fn = e, this.$on(t, i), this;
        }, t.prototype.$off = function (t, i) {
            var n;
            if (!arguments.length) {
                if (this.$parent) for (t in this._events) n = this._events[t], n && e(this, t, -n.length);
                return this._events = {}, this;
            }
            if (n = this._events[t], !n) return this;
            if (1 === arguments.length) return e(this, t, -n.length), this._events[t] = null, this;
            for (var r, s = n.length; s--;) if (r = n[s], r === i || r.fn === i) {
                e(this, t, -1), n.splice(s, 1);
                break;
            }
            return this;
        }, t.prototype.$emit = function (t) {
            var e = "string" == typeof t;
            t = e ? t : t.name;
            var i = this._events[t], n = e || !i;
            if (i) {
                i = i.length > 1 ? d(i) : i;
                var r = e && i.some(function (t) {
                    return t._fromParent;
                });
                r && (n = !1);
                for (var s = d(arguments, 1), o = 0, a = i.length; a > o; o++) {
                    var h = i[o], l = h.apply(this, s);
                    l !== !0 || r && !h._fromParent || (n = !0);
                }
            }
            return n;
        }, t.prototype.$broadcast = function (t) {
            var e = "string" == typeof t;
            if (t = e ? t : t.name, this._eventsCount[t]) {
                var i = this.$children, n = d(arguments);
                e && (n[0] = {name: t, source: this});
                for (var r = 0, s = i.length; s > r; r++) {
                    var o = i[r], a = o.$emit.apply(o, n);
                    a && o.$broadcast.apply(o, n);
                }
                return this;
            }
        }, t.prototype.$dispatch = function (t) {
            var e = this.$emit.apply(this, arguments);
            if (e) {
                var i = this.$parent, n = d(arguments);
                for (n[0] = {name: t, source: this}; i;) e = i.$emit.apply(i, n), i = e ? i.$parent : null;
                return this;
            }
        };
        var i = /^hook:/;
    }

    function bi(t) {
        function e() {
            this._isAttached = !0, this._isReady = !0, this._callHook("ready");
        }

        t.prototype.$mount = function (t) {
            return this._isCompiled ? void 0 : (t = L(t), t || (t = document.createElement("div")), this._compile(t), this._initDOMHooks(), H(this.$el) ? (this._callHook("attached"), e.call(this)) : this.$once("hook:attached", e), this);
        }, t.prototype.$destroy = function (t, e) {
            this._destroy(t, e);
        }, t.prototype.$compile = function (t, e, i, n) {
            return De(t, this.$options, !0)(this, t, e, i, n);
        };
    }

    function wi(t) {
        this._init(t);
    }

    function Ci(t, e, i) {
        return i = i ? parseInt(i, 10) : 0, e = o(e), "number" == typeof e ? t.slice(i, i + e) : t;
    }

    function $i(t, e, i) {
        if (t = Ks(t), null == e) return t;
        if ("function" == typeof e) return t.filter(e);
        e = ("" + e).toLowerCase();
        for (var n, r, s, o, a = "in" === i ? 3 : 2, h = Array.prototype.concat.apply([], d(arguments, a)), l = [], c = 0, u = t.length; u > c; c++) if (n = t[c], s = n && n.$value || n, o = h.length) {
            for (; o--;) if (r = h[o], "$key" === r && xi(n.$key, e) || xi(jt(s, r), e)) {
                l.push(n);
                break;
            }
        } else xi(n, e) && l.push(n);
        return l;
    }

    function ki(t) {
        function e(t, e, i) {
            var r = n[i];
            return r && ("$key" !== r && (m(t) && "$value" in t && (t = t.$value), m(e) && "$value" in e && (e = e.$value)), t = m(t) ? jt(t, r) : t, e = m(e) ? jt(e, r) : e), t === e ? 0 : t > e ? s : -s;
        }

        var i = null, n = void 0;
        t = Ks(t);
        var r = d(arguments, 1), s = r[r.length - 1];
        "number" == typeof s ? (s = 0 > s ? -1 : 1, r = r.length > 1 ? r.slice(0, -1) : r) : s = 1;
        var o = r[0];
        return o ? ("function" == typeof o ? i = function (t, e) {
            return o(t, e) * s;
        } : (n = Array.prototype.concat.apply([], r), i = function (t, r, s) {
            return s = s || 0, s >= n.length - 1 ? e(t, r, s) : e(t, r, s) || i(t, r, s + 1);
        }), t.slice().sort(i)) : t;
    }

    function xi(t, e) {
        var i;
        if (g(t)) {
            var n = Object.keys(t);
            for (i = n.length; i--;) if (xi(t[n[i]], e)) return !0;
        } else if (Di(t)) {
            for (i = t.length; i--;) if (xi(t[i], e)) return !0;
        } else if (null != t) return t.toString().toLowerCase().indexOf(e) > -1;
    }

    function Ai(i) {
        function n(t) {
            return new Function("return function " + f(t) + " (options) { this._init(options) }")();
        }

        i.options = {
            directives: bs,
            elementDirectives: Ys,
            filters: eo,
            transitions: {},
            components: {},
            partials: {},
            replace: !0
        }, i.util = In, i.config = An, i.set = t, i["delete"] = e, i.nextTick = Yi, i.compiler = qs, i.FragmentFactory = se, i.internalDirectives = Hs, i.parsers = {
            path: ir,
            text: $n,
            template: Fr,
            directive: gn,
            expression: mr
        }, i.cid = 0;
        var r = 1;
        i.extend = function (t) {
            t = t || {};
            var e = this, i = 0 === e.cid;
            if (i && t._Ctor) return t._Ctor;
            var s = t.name || e.options.name, o = n(s || "VueComponent");
            return o.prototype = Object.create(e.prototype), o.prototype.constructor = o, o.cid = r++, o.options = mt(e.options, t), o["super"] = e, o.extend = e.extend, An._assetTypes.forEach(function (t) {
                o[t] = e[t];
            }), s && (o.options.components[s] = o), i && (t._Ctor = o), o;
        }, i.use = function (t) {
            if (!t.installed) {
                var e = d(arguments, 1);
                return e.unshift(this), "function" == typeof t.install ? t.install.apply(t, e) : t.apply(null, e), t.installed = !0, this;
            }
        }, i.mixin = function (t) {
            i.options = mt(i.options, t);
        }, An._assetTypes.forEach(function (t) {
            i[t] = function (e, n) {
                return n ? ("component" === t && g(n) && (n.name || (n.name = e), n = i.extend(n)), this.options[t + "s"][e] = n, n) : this.options[t + "s"][e];
            };
        }), v(i.transition, Tn);
    }

    var Oi = Object.prototype.hasOwnProperty, Ti = /^\s?(true|false|-?[\d\.]+|'[^']*'|"[^"]*")\s?$/, Ni = /-(\w)/g,
        ji = /([a-z\d])([A-Z])/g, Ei = /(?:^|[-_\/])(\w)/g, Si = Object.prototype.toString, Fi = "[object Object]",
        Di = Array.isArray, Pi = "__proto__" in {},
        Ri = "undefined" != typeof window && "[object Object]" !== Object.prototype.toString.call(window),
        Li = Ri && window.__VUE_DEVTOOLS_GLOBAL_HOOK__, Hi = Ri && window.navigator.userAgent.toLowerCase(),
        Ii = Hi && Hi.indexOf("trident") > 0, Mi = Hi && Hi.indexOf("msie 9.0") > 0,
        Vi = Hi && Hi.indexOf("android") > 0, Bi = Hi && /(iphone|ipad|ipod|ios)/i.test(Hi),
        Wi = Bi && Hi.match(/os ([\d_]+)/), zi = Wi && Wi[1].split("_"),
        Ui = zi && Number(zi[0]) >= 9 && Number(zi[1]) >= 3 && !window.indexedDB, Ji = void 0, qi = void 0, Qi = void 0,
        Gi = void 0;
    if (Ri && !Mi) {
        var Zi = void 0 === window.ontransitionend && void 0 !== window.onwebkittransitionend,
            Xi = void 0 === window.onanimationend && void 0 !== window.onwebkitanimationend;
        Ji = Zi ? "WebkitTransition" : "transition", qi = Zi ? "webkitTransitionEnd" : "transitionend", Qi = Xi ? "WebkitAnimation" : "animation", Gi = Xi ? "webkitAnimationEnd" : "animationend";
    }
    var Yi = function () {
        function t() {
            n = !1;
            var t = i.slice(0);
            i = [];
            for (var e = 0; e < t.length; e++) t[e]();
        }

        var e, i = [], n = !1;
        if ("undefined" == typeof MutationObserver || Ui) {
            var r = Ri ? window : "undefined" != typeof global ? global : {};
            e = r.setImmediate || setTimeout;
        } else {
            var s = 1, o = new MutationObserver(t), a = document.createTextNode(s);
            o.observe(a, {characterData: !0}), e = function () {
                s = (s + 1) % 2, a.data = s;
            };
        }
        return function (r, s) {
            var o = s ? function () {
                r.call(s);
            } : r;
            i.push(o), n || (n = !0, e(t, 0));
        };
    }(), Ki = void 0;
    "undefined" != typeof Set && Set.toString().match(/native code/) ? Ki = Set : (Ki = function () {
        this.set = Object.create(null);
    }, Ki.prototype.has = function (t) {
        return void 0 !== this.set[t];
    }, Ki.prototype.add = function (t) {
        this.set[t] = 1;
    }, Ki.prototype.clear = function () {
        this.set = Object.create(null);
    });
    var tn = $.prototype;
    tn.put = function (t, e) {
        var i, n = this.get(t, !0);
        return n || (this.size === this.limit && (i = this.shift()), n = {key: t}, this._keymap[t] = n, this.tail ? (this.tail.newer = n, n.older = this.tail) : this.head = n, this.tail = n, this.size++), n.value = e, i;
    }, tn.shift = function () {
        var t = this.head;
        return t && (this.head = this.head.newer, this.head.older = void 0, t.newer = t.older = void 0, this._keymap[t.key] = void 0, this.size--), t;
    }, tn.get = function (t, e) {
        var i = this._keymap[t];
        if (void 0 !== i) return i === this.tail ? e ? i : i.value : (i.newer && (i === this.head && (this.head = i.newer), i.newer.older = i.older), i.older && (i.older.newer = i.newer), i.newer = void 0, i.older = this.tail, this.tail && (this.tail.newer = i), this.tail = i, e ? i : i.value);
    };
    var en, nn, rn, sn, on, an, hn, ln, cn, un, fn, pn, dn = new $(1e3), vn = /[^\s'"]+|'[^']*'|"[^"]*"/g,
        mn = /^in$|^-?\d+/, gn = Object.freeze({parseDirective: A}), _n = /[-.*+?^${}()|[\]\/\\]/g, yn = void 0,
        bn = void 0, wn = void 0, Cn = /[^|]\|[^|]/,
        $n = Object.freeze({compileRegex: T, parseText: N, tokensToExp: j}), kn = ["{{", "}}"], xn = ["{{{", "}}}"],
        An = Object.defineProperties({
            debug: !1,
            silent: !1,
            async: !0,
            warnExpressionErrors: !0,
            devtools: !1,
            _delimitersChanged: !0,
            _assetTypes: ["component", "directive", "elementDirective", "filter", "transition", "partial"],
            _propBindingModes: {ONE_WAY: 0, TWO_WAY: 1, ONE_TIME: 2},
            _maxUpdateCount: 100
        }, {
            delimiters: {
                get: function () {
                    return kn;
                }, set: function (t) {
                    kn = t, T();
                }, configurable: !0, enumerable: !0
            }, unsafeDelimiters: {
                get: function () {
                    return xn;
                }, set: function (t) {
                    xn = t, T();
                }, configurable: !0, enumerable: !0
            }
        }), On = void 0, Tn = Object.freeze({
            appendWithTransition: F,
            beforeWithTransition: D,
            removeWithTransition: P,
            applyTransition: R
        }), Nn = /^v-ref:/,
        jn = /^(div|p|span|img|a|b|i|br|ul|ol|li|h1|h2|h3|h4|h5|h6|code|pre|table|th|td|tr|form|label|input|select|option|nav|article|section|header|footer)$/i,
        En = /^(slot|partial|component)$/i, Sn = An.optionMergeStrategies = Object.create(null);
    Sn.data = function (t, e, i) {
        return i ? t || e ? function () {
            var n = "function" == typeof e ? e.call(i) : e, r = "function" == typeof t ? t.call(i) : void 0;
            return n ? ut(n, r) : r;
        } : void 0 : e ? "function" != typeof e ? t : t ? function () {
            return ut(e.call(this), t.call(this));
        } : e : t;
    }, Sn.el = function (t, e, i) {
        if (i || !e || "function" == typeof e) {
            var n = e || t;
            return i && "function" == typeof n ? n.call(i) : n;
        }
    }, Sn.init = Sn.created = Sn.ready = Sn.attached = Sn.detached = Sn.beforeCompile = Sn.compiled = Sn.beforeDestroy = Sn.destroyed = Sn.activate = function (t, e) {
        return e ? t ? t.concat(e) : Di(e) ? e : [e] : t;
    }, An._assetTypes.forEach(function (t) {
        Sn[t + "s"] = ft;
    }), Sn.watch = Sn.events = function (t, e) {
        if (!e) return t;
        if (!t) return e;
        var i = {};
        v(i, t);
        for (var n in e) {
            var r = i[n], s = e[n];
            r && !Di(r) && (r = [r]), i[n] = r ? r.concat(s) : [s];
        }
        return i;
    }, Sn.props = Sn.methods = Sn.computed = function (t, e) {
        if (!e) return t;
        if (!t) return e;
        var i = Object.create(null);
        return v(i, t), v(i, e), i;
    };
    var Fn = function (t, e) {
        return void 0 === e ? t : e;
    }, Dn = 0;
    _t.target = null, _t.prototype.addSub = function (t) {
        this.subs.push(t);
    }, _t.prototype.removeSub = function (t) {
        this.subs.$remove(t);
    }, _t.prototype.depend = function () {
        _t.target.addDep(this);
    }, _t.prototype.notify = function () {
        for (var t = d(this.subs), e = 0, i = t.length; i > e; e++) t[e].update();
    };
    var Pn = Array.prototype, Rn = Object.create(Pn);
    ["push", "pop", "shift", "unshift", "splice", "sort", "reverse"].forEach(function (t) {
        var e = Pn[t];
        _(Rn, t, function () {
            for (var i = arguments.length, n = new Array(i); i--;) n[i] = arguments[i];
            var r, s = e.apply(this, n), o = this.__ob__;
            switch (t) {
                case"push":
                    r = n;
                    break;
                case"unshift":
                    r = n;
                    break;
                case"splice":
                    r = n.slice(2);
            }
            return r && o.observeArray(r), o.dep.notify(), s;
        });
    }), _(Pn, "$set", function (t, e) {
        return t >= this.length && (this.length = Number(t) + 1), this.splice(t, 1, e)[0];
    }), _(Pn, "$remove", function (t) {
        if (this.length) {
            var e = b(this, t);
            return e > -1 ? this.splice(e, 1) : void 0;
        }
    });
    var Ln = Object.getOwnPropertyNames(Rn), Hn = !0;
    bt.prototype.walk = function (t) {
        for (var e = Object.keys(t), i = 0, n = e.length; n > i; i++) this.convert(e[i], t[e[i]]);
    }, bt.prototype.observeArray = function (t) {
        for (var e = 0, i = t.length; i > e; e++) $t(t[e]);
    }, bt.prototype.convert = function (t, e) {
        kt(this.value, t, e);
    }, bt.prototype.addVm = function (t) {
        (this.vms || (this.vms = [])).push(t);
    }, bt.prototype.removeVm = function (t) {
        this.vms.$remove(t);
    };
    var In = Object.freeze({
            defineReactive: kt,
            set: t,
            del: e,
            hasOwn: i,
            isLiteral: n,
            isReserved: r,
            _toString: s,
            toNumber: o,
            toBoolean: a,
            stripQuotes: h,
            camelize: l,
            hyphenate: u,
            classify: f,
            bind: p,
            toArray: d,
            extend: v,
            isObject: m,
            isPlainObject: g,
            def: _,
            debounce: y,
            indexOf: b,
            cancellable: w,
            looseEqual: C,
            isArray: Di,
            hasProto: Pi,
            inBrowser: Ri,
            devtools: Li,
            isIE: Ii,
            isIE9: Mi,
            isAndroid: Vi,
            isIos: Bi,
            iosVersionMatch: Wi,
            iosVersion: zi,
            hasMutationObserverBug: Ui,
            get transitionProp() {
                return Ji;
            },
            get transitionEndEvent() {
                return qi;
            },
            get animationProp() {
                return Qi;
            },
            get animationEndEvent() {
                return Gi;
            },
            nextTick: Yi,
            get _Set() {
                return Ki;
            },
            query: L,
            inDoc: H,
            getAttr: I,
            getBindAttr: M,
            hasBindAttr: V,
            before: B,
            after: W,
            remove: z,
            prepend: U,
            replace: J,
            on: q,
            off: Q,
            setClass: Z,
            addClass: X,
            removeClass: Y,
            extractContent: K,
            trimNode: tt,
            isTemplate: it,
            createAnchor: nt,
            findRef: rt,
            mapNodeRange: st,
            removeNodeRange: ot,
            isFragment: at,
            getOuterHTML: ht,
            mergeOptions: mt,
            resolveAsset: gt,
            checkComponentAttr: lt,
            commonTagRE: jn,
            reservedTagRE: En,
            warn: On
        }), Mn = 0, Vn = new $(1e3), Bn = 0, Wn = 1, zn = 2, Un = 3, Jn = 0, qn = 1, Qn = 2, Gn = 3, Zn = 4, Xn = 5, Yn = 6,
        Kn = 7, tr = 8, er = [];
    er[Jn] = {ws: [Jn], ident: [Gn, Bn], "[": [Zn], eof: [Kn]}, er[qn] = {
        ws: [qn],
        ".": [Qn],
        "[": [Zn],
        eof: [Kn]
    }, er[Qn] = {ws: [Qn], ident: [Gn, Bn]}, er[Gn] = {
        ident: [Gn, Bn],
        0: [Gn, Bn],
        number: [Gn, Bn],
        ws: [qn, Wn],
        ".": [Qn, Wn],
        "[": [Zn, Wn],
        eof: [Kn, Wn]
    }, er[Zn] = {
        "'": [Xn, Bn],
        '"': [Yn, Bn],
        "[": [Zn, zn],
        "]": [qn, Un],
        eof: tr,
        "else": [Zn, Bn]
    }, er[Xn] = {"'": [Zn, Bn], eof: tr, "else": [Xn, Bn]}, er[Yn] = {'"': [Zn, Bn], eof: tr, "else": [Yn, Bn]};
    var ir = Object.freeze({parsePath: Nt, getPath: jt, setPath: Et}), nr = new $(1e3),
        rr = "Math,Date,this,true,false,null,undefined,Infinity,NaN,isNaN,isFinite,decodeURI,decodeURIComponent,encodeURI,encodeURIComponent,parseInt,parseFloat",
        sr = new RegExp("^(" + rr.replace(/,/g, "\\b|") + "\\b)"),
        or = "break,case,class,catch,const,continue,debugger,default,delete,do,else,export,extends,finally,for,function,if,import,in,instanceof,let,return,super,switch,throw,try,var,while,with,yield,enum,await,implements,package,protected,static,interface,private,public",
        ar = new RegExp("^(" + or.replace(/,/g, "\\b|") + "\\b)"), hr = /\s/g, lr = /\n/g,
        cr = /[\{,]\s*[\w\$_]+\s*:|('(?:[^'\\]|\\.)*'|"(?:[^"\\]|\\.)*"|`(?:[^`\\]|\\.)*\$\{|\}(?:[^`\\]|\\.)*`|`(?:[^`\\]|\\.)*`)|new |typeof |void /g,
        ur = /"(\d+)"/g,
        fr = /^[A-Za-z_$][\w$]*(?:\.[A-Za-z_$][\w$]*|\['.*?'\]|\[".*?"\]|\[\d+\]|\[[A-Za-z_$][\w$]*\])*$/,
        pr = /[^\w$\.](?:[A-Za-z_$][\w$]*)/g, dr = /^(?:true|false|null|undefined|Infinity|NaN)$/, vr = [],
        mr = Object.freeze({parseExpression: It, isSimplePath: Mt}), gr = [], _r = [], yr = {}, br = {}, wr = !1,
        Cr = 0;
    Ut.prototype.get = function () {
        this.beforeGet();
        var t, e = this.scope || this.vm;
        try {
            t = this.getter.call(e, e);
        } catch (i) {
        }
        return this.deep && Jt(t), this.preProcess && (t = this.preProcess(t)), this.filters && (t = e._applyFilters(t, null, this.filters, !1)), this.postProcess && (t = this.postProcess(t)), this.afterGet(), t;
    }, Ut.prototype.set = function (t) {
        var e = this.scope || this.vm;
        this.filters && (t = e._applyFilters(t, this.value, this.filters, !0));
        try {
            this.setter.call(e, e, t);
        } catch (i) {
        }
        var n = e.$forContext;
        if (n && n.alias === this.expression) {
            if (n.filters) return;
            n._withLock(function () {
                e.$key ? n.rawValue[e.$key] = t : n.rawValue.$set(e.$index, t);
            });
        }
    }, Ut.prototype.beforeGet = function () {
        _t.target = this;
    }, Ut.prototype.addDep = function (t) {
        var e = t.id;
        this.newDepIds.has(e) || (this.newDepIds.add(e), this.newDeps.push(t), this.depIds.has(e) || t.addSub(this));
    }, Ut.prototype.afterGet = function () {
        _t.target = null;
        for (var t = this.deps.length; t--;) {
            var e = this.deps[t];
            this.newDepIds.has(e.id) || e.removeSub(this);
        }
        var i = this.depIds;
        this.depIds = this.newDepIds, this.newDepIds = i, this.newDepIds.clear(), i = this.deps, this.deps = this.newDeps, this.newDeps = i, this.newDeps.length = 0;
    }, Ut.prototype.update = function (t) {
        this.lazy ? this.dirty = !0 : this.sync || !An.async ? this.run() : (this.shallow = this.queued ? t ? this.shallow : !1 : !!t, this.queued = !0, zt(this));
    }, Ut.prototype.run = function () {
        if (this.active) {
            var t = this.get();
            if (t !== this.value || (m(t) || this.deep) && !this.shallow) {
                var e = this.value;
                this.value = t;
                this.prevError;
                this.cb.call(this.vm, t, e);
            }
            this.queued = this.shallow = !1;
        }
    }, Ut.prototype.evaluate = function () {
        var t = _t.target;
        this.value = this.get(), this.dirty = !1, _t.target = t;
    }, Ut.prototype.depend = function () {
        for (var t = this.deps.length; t--;) this.deps[t].depend();
    }, Ut.prototype.teardown = function () {
        if (this.active) {
            this.vm._isBeingDestroyed || this.vm._vForRemoving || this.vm._watchers.$remove(this);
            for (var t = this.deps.length; t--;) this.deps[t].removeSub(this);
            this.active = !1, this.vm = this.cb = this.value = null;
        }
    };
    var $r = new Ki, kr = {
        bind: function () {
            this.attr = 3 === this.el.nodeType ? "data" : "textContent";
        }, update: function (t) {
            this.el[this.attr] = s(t);
        }
    }, xr = new $(1e3), Ar = new $(1e3), Or = {
        efault: [0, "", ""],
        legend: [1, "<fieldset>", "</fieldset>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"]
    };
    Or.td = Or.th = [3, "<table><tbody><tr>", "</tr></tbody></table>"], Or.option = Or.optgroup = [1, '<select multiple="multiple">', "</select>"], Or.thead = Or.tbody = Or.colgroup = Or.caption = Or.tfoot = [1, "<table>", "</table>"], Or.g = Or.defs = Or.symbol = Or.use = Or.image = Or.text = Or.circle = Or.ellipse = Or.line = Or.path = Or.polygon = Or.polyline = Or.rect = [1, '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:ev="http://www.w3.org/2001/xml-events"version="1.1">', "</svg>"];
    var Tr = /<([\w:-]+)/, Nr = /&#?\w+?;/, jr = /<!--/, Er = function () {
        if (Ri) {
            var t = document.createElement("div");
            return t.innerHTML = "<template>1</template>", !t.cloneNode(!0).firstChild.innerHTML;
        }
        return !1;
    }(), Sr = function () {
        if (Ri) {
            var t = document.createElement("textarea");
            return t.placeholder = "t", "t" === t.cloneNode(!0).value;
        }
        return !1;
    }(), Fr = Object.freeze({cloneNode: Zt, parseTemplate: Xt}), Dr = {
        bind: function () {
            8 === this.el.nodeType && (this.nodes = [], this.anchor = nt("v-html"), J(this.el, this.anchor));
        }, update: function (t) {
            t = s(t), this.nodes ? this.swap(t) : this.el.innerHTML = t;
        }, swap: function (t) {
            for (var e = this.nodes.length; e--;) z(this.nodes[e]);
            var i = Xt(t, !0, !0);
            this.nodes = d(i.childNodes), B(i, this.anchor);
        }
    };
    Yt.prototype.callHook = function (t) {
        var e, i;
        for (e = 0, i = this.childFrags.length; i > e; e++) this.childFrags[e].callHook(t);
        for (e = 0, i = this.children.length; i > e; e++) t(this.children[e]);
    }, Yt.prototype.beforeRemove = function () {
        var t, e;
        for (t = 0, e = this.childFrags.length; e > t; t++) this.childFrags[t].beforeRemove(!1);
        for (t = 0, e = this.children.length; e > t; t++) this.children[t].$destroy(!1, !0);
        var i = this.unlink.dirs;
        for (t = 0, e = i.length; e > t; t++) i[t]._watcher && i[t]._watcher.teardown();
    }, Yt.prototype.destroy = function () {
        this.parentFrag && this.parentFrag.childFrags.$remove(this), this.node.__v_frag = null, this.unlink();
    };
    var Pr = new $(5e3);
    se.prototype.create = function (t, e, i) {
        var n = Zt(this.template);
        return new Yt(this.linker, this.vm, n, t, e, i);
    };
    var Rr = 700, Lr = 800, Hr = 850, Ir = 1100, Mr = 1500, Vr = 1500, Br = 1750, Wr = 2100, zr = 2200, Ur = 2300,
        Jr = 0, qr = {
            priority: zr,
            terminal: !0,
            params: ["track-by", "stagger", "enter-stagger", "leave-stagger"],
            bind: function () {
                var t = this.expression.match(/(.*) (?:in|of) (.*)/);
                if (t) {
                    var e = t[1].match(/\((.*),(.*)\)/);
                    e ? (this.iterator = e[1].trim(), this.alias = e[2].trim()) : this.alias = t[1].trim(), this.expression = t[2];
                }
                if (this.alias) {
                    this.id = "__v-for__" + ++Jr;
                    var i = this.el.tagName;
                    this.isOption = ("OPTION" === i || "OPTGROUP" === i) && "SELECT" === this.el.parentNode.tagName, this.start = nt("v-for-start"), this.end = nt("v-for-end"), J(this.el, this.end), B(this.start, this.end), this.cache = Object.create(null), this.factory = new se(this.vm, this.el);
                }
            },
            update: function (t) {
                this.diff(t), this.updateRef(), this.updateModel();
            },
            diff: function (t) {
                var e, n, r, s, o, a, h = t[0], l = this.fromObject = m(h) && i(h, "$key") && i(h, "$value"),
                    c = this.params.trackBy, u = this.frags, f = this.frags = new Array(t.length), p = this.alias,
                    d = this.iterator, v = this.start, g = this.end, _ = H(v), y = !u;
                for (e = 0, n = t.length; n > e; e++) h = t[e], s = l ? h.$key : null, o = l ? h.$value : h, a = !m(o), r = !y && this.getCachedFrag(o, e, s), r ? (r.reused = !0, r.scope.$index = e, s && (r.scope.$key = s), d && (r.scope[d] = null !== s ? s : e), (c || l || a) && yt(function () {
                    r.scope[p] = o;
                })) : (r = this.create(o, p, e, s), r.fresh = !y), f[e] = r, y && r.before(g);
                if (!y) {
                    var b = 0, w = u.length - f.length;
                    for (this.vm._vForRemoving = !0, e = 0, n = u.length; n > e; e++) r = u[e], r.reused || (this.deleteCachedFrag(r), this.remove(r, b++, w, _));
                    this.vm._vForRemoving = !1, b && (this.vm._watchers = this.vm._watchers.filter(function (t) {
                        return t.active;
                    }));
                    var C, $, k, x = 0;
                    for (e = 0, n = f.length; n > e; e++) r = f[e], C = f[e - 1], $ = C ? C.staggerCb ? C.staggerAnchor : C.end || C.node : v, r.reused && !r.staggerCb ? (k = oe(r, v, this.id), k === C || k && oe(k, v, this.id) === C || this.move(r, $)) : this.insert(r, x++, $, _), r.reused = r.fresh = !1;
                }
            },
            create: function (t, e, i, n) {
                var r = this._host, s = this._scope || this.vm, o = Object.create(s);
                o.$refs = Object.create(s.$refs), o.$els = Object.create(s.$els), o.$parent = s, o.$forContext = this, yt(function () {
                    kt(o, e, t);
                }), kt(o, "$index", i), n ? kt(o, "$key", n) : o.$key && _(o, "$key", null), this.iterator && kt(o, this.iterator, null !== n ? n : i);
                var a = this.factory.create(r, o, this._frag);
                return a.forId = this.id, this.cacheFrag(t, a, i, n), a;
            },
            updateRef: function () {
                var t = this.descriptor.ref;
                if (t) {
                    var e, i = (this._scope || this.vm).$refs;
                    this.fromObject ? (e = {}, this.frags.forEach(function (t) {
                        e[t.scope.$key] = ae(t);
                    })) : e = this.frags.map(ae), i[t] = e;
                }
            },
            updateModel: function () {
                if (this.isOption) {
                    var t = this.start.parentNode, e = t && t.__v_model;
                    e && e.forceUpdate();
                }
            },
            insert: function (t, e, i, n) {
                t.staggerCb && (t.staggerCb.cancel(), t.staggerCb = null);
                var r = this.getStagger(t, e, null, "enter");
                if (n && r) {
                    var s = t.staggerAnchor;
                    s || (s = t.staggerAnchor = nt("stagger-anchor"), s.__v_frag = t), W(s, i);
                    var o = t.staggerCb = w(function () {
                        t.staggerCb = null, t.before(s), z(s);
                    });
                    setTimeout(o, r);
                } else {
                    var a = i.nextSibling;
                    a || (W(this.end, i), a = this.end), t.before(a);
                }
            },
            remove: function (t, e, i, n) {
                if (t.staggerCb) return t.staggerCb.cancel(), void(t.staggerCb = null);
                var r = this.getStagger(t, e, i, "leave");
                if (n && r) {
                    var s = t.staggerCb = w(function () {
                        t.staggerCb = null, t.remove();
                    });
                    setTimeout(s, r);
                } else t.remove();
            },
            move: function (t, e) {
                e.nextSibling || this.end.parentNode.appendChild(this.end), t.before(e.nextSibling, !1);
            },
            cacheFrag: function (t, e, n, r) {
                var s, o = this.params.trackBy, a = this.cache, h = !m(t);
                r || o || h ? (s = le(n, r, t, o), a[s] || (a[s] = e)) : (s = this.id, i(t, s) ? null === t[s] && (t[s] = e) : Object.isExtensible(t) && _(t, s, e)), e.raw = t;
            },
            getCachedFrag: function (t, e, i) {
                var n, r = this.params.trackBy, s = !m(t);
                if (i || r || s) {
                    var o = le(e, i, t, r);
                    n = this.cache[o];
                } else n = t[this.id];
                return n && (n.reused || n.fresh), n;
            },
            deleteCachedFrag: function (t) {
                var e = t.raw, n = this.params.trackBy, r = t.scope, s = r.$index, o = i(r, "$key") && r.$key, a = !m(e);
                if (n || o || a) {
                    var h = le(s, o, e, n);
                    this.cache[h] = null;
                } else e[this.id] = null, t.raw = null;
            },
            getStagger: function (t, e, i, n) {
                n += "Stagger";
                var r = t.node.__v_trans, s = r && r.hooks, o = s && (s[n] || s.stagger);
                return o ? o.call(t, e, i) : e * parseInt(this.params[n] || this.params.stagger, 10);
            },
            _preProcess: function (t) {
                return this.rawValue = t, t;
            },
            _postProcess: function (t) {
                if (Di(t)) return t;
                if (g(t)) {
                    for (var e, i = Object.keys(t), n = i.length, r = new Array(n); n--;) e = i[n], r[n] = {
                        $key: e,
                        $value: t[e]
                    };
                    return r;
                }
                return "number" != typeof t || isNaN(t) || (t = he(t)), t || [];
            },
            unbind: function () {
                if (this.descriptor.ref && ((this._scope || this.vm).$refs[this.descriptor.ref] = null), this.frags) for (var t, e = this.frags.length; e--;) t = this.frags[e], this.deleteCachedFrag(t), t.destroy();
            }
        }, Qr = {
            priority: Wr, terminal: !0, bind: function () {
                var t = this.el;
                if (t.__vue__) this.invalid = !0; else {
                    var e = t.nextElementSibling;
                    e && null !== I(e, "v-else") && (z(e), this.elseEl = e), this.anchor = nt("v-if"), J(t, this.anchor);
                }
            }, update: function (t) {
                this.invalid || (t ? this.frag || this.insert() : this.remove());
            }, insert: function () {
                this.elseFrag && (this.elseFrag.remove(), this.elseFrag = null), this.factory || (this.factory = new se(this.vm, this.el)), this.frag = this.factory.create(this._host, this._scope, this._frag), this.frag.before(this.anchor);
            }, remove: function () {
                this.frag && (this.frag.remove(), this.frag = null), this.elseEl && !this.elseFrag && (this.elseFactory || (this.elseFactory = new se(this.elseEl._context || this.vm, this.elseEl)), this.elseFrag = this.elseFactory.create(this._host, this._scope, this._frag), this.elseFrag.before(this.anchor));
            }, unbind: function () {
                this.frag && this.frag.destroy(), this.elseFrag && this.elseFrag.destroy();
            }
        }, Gr = {
            bind: function () {
                var t = this.el.nextElementSibling;
                t && null !== I(t, "v-else") && (this.elseEl = t);
            }, update: function (t) {
                this.apply(this.el, t), this.elseEl && this.apply(this.elseEl, !t);
            }, apply: function (t, e) {
                function i() {
                    t.style.display = e ? "" : "none";
                }

                H(t) ? R(t, e ? 1 : -1, i, this.vm) : i();
            }
        }, Zr = {
            bind: function () {
                var t = this, e = this.el, i = "range" === e.type, n = this.params.lazy, r = this.params.number,
                    s = this.params.debounce, a = !1;
                if (Vi || i || (this.on("compositionstart", function () {
                        a = !0;
                    }), this.on("compositionend", function () {
                        a = !1, n || t.listener();
                    })), this.focused = !1, i || n || (this.on("focus", function () {
                        t.focused = !0;
                    }), this.on("blur", function () {
                        t.focused = !1, (!t._frag || t._frag.inserted) && t.rawListener();
                    })), this.listener = this.rawListener = function () {
                        if (!a && t._bound) {
                            var n = r || i ? o(e.value) : e.value;
                            t.set(n), Yi(function () {
                                t._bound && !t.focused && t.update(t._watcher.value);
                            });
                        }
                    }, s && (this.listener = y(this.listener, s)), this.hasjQuery = "function" == typeof jQuery, this.hasjQuery) {
                    var h = jQuery.fn.on ? "on" : "bind";
                    jQuery(e)[h]("change", this.rawListener), n || jQuery(e)[h]("input", this.listener);
                } else this.on("change", this.rawListener), n || this.on("input", this.listener);
                !n && Mi && (this.on("cut", function () {
                    Yi(t.listener);
                }), this.on("keyup", function (e) {
                    (46 === e.keyCode || 8 === e.keyCode) && t.listener();
                })), (e.hasAttribute("value") || "TEXTAREA" === e.tagName && e.value.trim()) && (this.afterBind = this.listener);
            }, update: function (t) {
                t = s(t), t !== this.el.value && (this.el.value = t);
            }, unbind: function () {
                var t = this.el;
                if (this.hasjQuery) {
                    var e = jQuery.fn.off ? "off" : "unbind";
                    jQuery(t)[e]("change", this.listener), jQuery(t)[e]("input", this.listener);
                }
            }
        }, Xr = {
            bind: function () {
                var t = this, e = this.el;
                this.getValue = function () {
                    if (e.hasOwnProperty("_value")) return e._value;
                    var i = e.value;
                    return t.params.number && (i = o(i)), i;
                }, this.listener = function () {
                    t.set(t.getValue());
                }, this.on("change", this.listener), e.hasAttribute("checked") && (this.afterBind = this.listener);
            }, update: function (t) {
                this.el.checked = C(t, this.getValue());
            }
        }, Yr = {
            bind: function () {
                var t = this, e = this, i = this.el;
                this.forceUpdate = function () {
                    e._watcher && e.update(e._watcher.get());
                };
                var n = this.multiple = i.hasAttribute("multiple");
                this.listener = function () {
                    var t = ce(i, n);
                    t = e.params.number ? Di(t) ? t.map(o) : o(t) : t, e.set(t);
                }, this.on("change", this.listener);
                var r = ce(i, n, !0);
                (n && r.length || !n && null !== r) && (this.afterBind = this.listener), this.vm.$on("hook:attached", function () {
                    Yi(t.forceUpdate);
                }), H(i) || Yi(this.forceUpdate);
            }, update: function (t) {
                var e = this.el;
                e.selectedIndex = -1;
                for (var i, n, r = this.multiple && Di(t), s = e.options, o = s.length; o--;) i = s[o], n = i.hasOwnProperty("_value") ? i._value : i.value, i.selected = r ? ue(t, n) > -1 : C(t, n);
            }, unbind: function () {
                this.vm.$off("hook:attached", this.forceUpdate);
            }
        }, Kr = {
            bind: function () {
                function t() {
                    var t = i.checked;
                    return t && i.hasOwnProperty("_trueValue") ? i._trueValue : !t && i.hasOwnProperty("_falseValue") ? i._falseValue : t;
                }

                var e = this, i = this.el;
                this.getValue = function () {
                    return i.hasOwnProperty("_value") ? i._value : e.params.number ? o(i.value) : i.value;
                }, this.listener = function () {
                    var n = e._watcher.value;
                    if (Di(n)) {
                        var r = e.getValue();
                        i.checked ? b(n, r) < 0 && n.push(r) : n.$remove(r);
                    } else e.set(t());
                }, this.on("change", this.listener), i.hasAttribute("checked") && (this.afterBind = this.listener);
            }, update: function (t) {
                var e = this.el;
                Di(t) ? e.checked = b(t, this.getValue()) > -1 : e.hasOwnProperty("_trueValue") ? e.checked = C(t, e._trueValue) : e.checked = !!t;
            }
        }, ts = {text: Zr, radio: Xr, select: Yr, checkbox: Kr}, es = {
            priority: Lr, twoWay: !0, handlers: ts, params: ["lazy", "number", "debounce"], bind: function () {
                this.checkFilters(), this.hasRead && !this.hasWrite;
                var t, e = this.el, i = e.tagName;
                if ("INPUT" === i) t = ts[e.type] || ts.text; else if ("SELECT" === i) t = ts.select; else {
                    if ("TEXTAREA" !== i) return;
                    t = ts.text;
                }
                e.__v_model = this, t.bind.call(this), this.update = t.update, this._unbind = t.unbind;
            }, checkFilters: function () {
                var t = this.filters;
                if (t) for (var e = t.length; e--;) {
                    var i = gt(this.vm.$options, "filters", t[e].name);
                    ("function" == typeof i || i.read) && (this.hasRead = !0), i.write && (this.hasWrite = !0);
                }
            }, unbind: function () {
                this.el.__v_model = null, this._unbind && this._unbind();
            }
        }, is = {esc: 27, tab: 9, enter: 13, space: 32, "delete": [8, 46], up: 38, left: 37, right: 39, down: 40}, ns = {
            priority: Rr, acceptStatement: !0, keyCodes: is, bind: function () {
                if ("IFRAME" === this.el.tagName && "load" !== this.arg) {
                    var t = this;
                    this.iframeBind = function () {
                        q(t.el.contentWindow, t.arg, t.handler, t.modifiers.capture);
                    }, this.on("load", this.iframeBind);
                }
            }, update: function (t) {
                if (this.descriptor.raw || (t = function () {
                    }), "function" == typeof t) {
                    this.modifiers.stop && (t = pe(t)), this.modifiers.prevent && (t = de(t)), this.modifiers.self && (t = ve(t));
                    var e = Object.keys(this.modifiers).filter(function (t) {
                        return "stop" !== t && "prevent" !== t && "self" !== t && "capture" !== t;
                    });
                    e.length && (t = fe(t, e)), this.reset(), this.handler = t, this.iframeBind ? this.iframeBind() : q(this.el, this.arg, this.handler, this.modifiers.capture);
                }
            }, reset: function () {
                var t = this.iframeBind ? this.el.contentWindow : this.el;
                this.handler && Q(t, this.arg, this.handler);
            }, unbind: function () {
                this.reset();
            }
        }, rs = ["-webkit-", "-moz-", "-ms-"], ss = ["Webkit", "Moz", "ms"], os = /!important;?$/, as = Object.create(null),
        hs = null, ls = {
            deep: !0, update: function (t) {
                "string" == typeof t ? this.el.style.cssText = t : Di(t) ? this.handleObject(t.reduce(v, {})) : this.handleObject(t || {});
            }, handleObject: function (t) {
                var e, i, n = this.cache || (this.cache = {});
                for (e in n) e in t || (this.handleSingle(e, null), delete n[e]);
                for (e in t) i = t[e], i !== n[e] && (n[e] = i, this.handleSingle(e, i));
            }, handleSingle: function (t, e) {
                if (t = me(t)) if (null != e && (e += ""), e) {
                    var i = os.test(e) ? "important" : "";
                    i ? (e = e.replace(os, "").trim(), this.el.style.setProperty(t.kebab, e, i)) : this.el.style[t.camel] = e;
                } else this.el.style[t.camel] = "";
            }
        }, cs = "http://www.w3.org/1999/xlink", us = /^xlink:/,
        fs = /^v-|^:|^@|^(?:is|transition|transition-mode|debounce|track-by|stagger|enter-stagger|leave-stagger)$/,
        ps = /^(?:value|checked|selected|muted)$/, ds = /^(?:draggable|contenteditable|spellcheck)$/,
        vs = {value: "_value", "true-value": "_trueValue", "false-value": "_falseValue"}, ms = {
            priority: Hr, bind: function () {
                var t = this.arg, e = this.el.tagName;
                t || (this.deep = !0);
                var i = this.descriptor, n = i.interp;
                n && (i.hasOneTime && (this.expression = j(n, this._scope || this.vm)), (fs.test(t) || "name" === t && ("PARTIAL" === e || "SLOT" === e)) && (this.el.removeAttribute(t), this.invalid = !0));
            }, update: function (t) {
                if (!this.invalid) {
                    var e = this.arg;
                    this.arg ? this.handleSingle(e, t) : this.handleObject(t || {});
                }
            }, handleObject: ls.handleObject, handleSingle: function (t, e) {
                var i = this.el, n = this.descriptor.interp;
                if (this.modifiers.camel && (t = l(t)), !n && ps.test(t) && t in i) {
                    var r = "value" === t && null == e ? "" : e;
                    i[t] !== r && (i[t] = r);
                }
                var s = vs[t];
                if (!n && s) {
                    i[s] = e;
                    var o = i.__v_model;
                    o && o.listener();
                }
                return "value" === t && "TEXTAREA" === i.tagName ? void i.removeAttribute(t) : void(ds.test(t) ? i.setAttribute(t, e ? "true" : "false") : null != e && e !== !1 ? "class" === t ? (i.__v_trans && (e += " " + i.__v_trans.id + "-transition"), Z(i, e)) : us.test(t) ? i.setAttributeNS(cs, t, e === !0 ? "" : e) : i.setAttribute(t, e === !0 ? "" : e) : i.removeAttribute(t));
            }
        }, gs = {
            priority: Mr, bind: function () {
                if (this.arg) {
                    var t = this.id = l(this.arg), e = (this._scope || this.vm).$els;
                    i(e, t) ? e[t] = this.el : kt(e, t, this.el);
                }
            }, unbind: function () {
                var t = (this._scope || this.vm).$els;
                t[this.id] === this.el && (t[this.id] = null);
            }
        }, _s = {
            bind: function () {
            }
        }, ys = {
            bind: function () {
                var t = this.el;
                this.vm.$once("pre-hook:compiled", function () {
                    t.removeAttribute("v-cloak");
                });
            }
        }, bs = {
            text: kr,
            html: Dr,
            "for": qr,
            "if": Qr,
            show: Gr,
            model: es,
            on: ns,
            bind: ms,
            el: gs,
            ref: _s,
            cloak: ys
        }, ws = {
            deep: !0, update: function (t) {
                t ? "string" == typeof t ? this.setClass(t.trim().split(/\s+/)) : this.setClass(_e(t)) : this.cleanup();
            }, setClass: function (t) {
                this.cleanup(t);
                for (var e = 0, i = t.length; i > e; e++) {
                    var n = t[e];
                    n && ye(this.el, n, X);
                }
                this.prevKeys = t;
            }, cleanup: function (t) {
                var e = this.prevKeys;
                if (e) for (var i = e.length; i--;) {
                    var n = e[i];
                    (!t || t.indexOf(n) < 0) && ye(this.el, n, Y);
                }
            }
        }, Cs = {
            priority: Vr, params: ["keep-alive", "transition-mode", "inline-template"], bind: function () {
                this.el.__vue__ || (this.keepAlive = this.params.keepAlive, this.keepAlive && (this.cache = {}), this.params.inlineTemplate && (this.inlineTemplate = K(this.el, !0)), this.pendingComponentCb = this.Component = null, this.pendingRemovals = 0, this.pendingRemovalCb = null, this.anchor = nt("v-component"), J(this.el, this.anchor), this.el.removeAttribute("is"), this.el.removeAttribute(":is"), this.descriptor.ref && this.el.removeAttribute("v-ref:" + u(this.descriptor.ref)), this.literal && this.setComponent(this.expression));
            }, update: function (t) {
                this.literal || this.setComponent(t);
            }, setComponent: function (t, e) {
                if (this.invalidatePending(), t) {
                    var i = this;
                    this.resolveComponent(t, function () {
                        i.mountComponent(e);
                    });
                } else this.unbuild(!0), this.remove(this.childVM, e), this.childVM = null;
            }, resolveComponent: function (t, e) {
                var i = this;
                this.pendingComponentCb = w(function (n) {
                    i.ComponentName = n.options.name || ("string" == typeof t ? t : null), i.Component = n, e();
                }), this.vm._resolveComponent(t, this.pendingComponentCb);
            }, mountComponent: function (t) {
                this.unbuild(!0);
                var e = this, i = this.Component.options.activate, n = this.getCached(), r = this.build();
                i && !n ? (this.waitingFor = r, be(i, r, function () {
                    e.waitingFor === r && (e.waitingFor = null, e.transition(r, t));
                })) : (n && r._updateRef(), this.transition(r, t));
            }, invalidatePending: function () {
                this.pendingComponentCb && (this.pendingComponentCb.cancel(), this.pendingComponentCb = null);
            }, build: function (t) {
                var e = this.getCached();
                if (e) return e;
                if (this.Component) {
                    var i = {
                        name: this.ComponentName,
                        el: Zt(this.el),
                        template: this.inlineTemplate,
                        parent: this._host || this.vm,
                        _linkerCachable: !this.inlineTemplate,
                        _ref: this.descriptor.ref,
                        _asComponent: !0,
                        _isRouterView: this._isRouterView,
                        _context: this.vm,
                        _scope: this._scope,
                        _frag: this._frag
                    };
                    t && v(i, t);
                    var n = new this.Component(i);
                    return this.keepAlive && (this.cache[this.Component.cid] = n), n;
                }
            }, getCached: function () {
                return this.keepAlive && this.cache[this.Component.cid];
            }, unbuild: function (t) {
                this.waitingFor && (this.keepAlive || this.waitingFor.$destroy(), this.waitingFor = null);
                var e = this.childVM;
                return !e || this.keepAlive ? void(e && (e._inactive = !0, e._updateRef(!0))) : void e.$destroy(!1, t);
            }, remove: function (t, e) {
                var i = this.keepAlive;
                if (t) {
                    this.pendingRemovals++, this.pendingRemovalCb = e;
                    var n = this;
                    t.$remove(function () {
                        n.pendingRemovals--, i || t._cleanup(), !n.pendingRemovals && n.pendingRemovalCb && (n.pendingRemovalCb(), n.pendingRemovalCb = null);
                    });
                } else e && e();
            }, transition: function (t, e) {
                var i = this, n = this.childVM;
                switch (n && (n._inactive = !0), t._inactive = !1, this.childVM = t, i.params.transitionMode) {
                    case"in-out":
                        t.$before(i.anchor, function () {
                            i.remove(n, e);
                        });
                        break;
                    case"out-in":
                        i.remove(n, function () {
                            t.$before(i.anchor, e);
                        });
                        break;
                    default:
                        i.remove(n), t.$before(i.anchor, e);
                }
            }, unbind: function () {
                if (this.invalidatePending(), this.unbuild(), this.cache) {
                    for (var t in this.cache) this.cache[t].$destroy();
                    this.cache = null;
                }
            }
        }, $s = An._propBindingModes, ks = {}, xs = /^[$_a-zA-Z]+[\w$]*$/, As = An._propBindingModes, Os = {
            bind: function () {
                var t = this.vm, e = t._context, i = this.descriptor.prop, n = i.path, r = i.parentPath,
                    s = i.mode === As.TWO_WAY, o = this.parentWatcher = new Ut(e, r, function (e) {
                        xe(t, i, e);
                    }, {twoWay: s, filters: i.filters, scope: this._scope});
                if (ke(t, i, o.value), s) {
                    var a = this;
                    t.$once("pre-hook:created", function () {
                        a.childWatcher = new Ut(t, n, function (t) {
                            o.set(t);
                        }, {sync: !0});
                    });
                }
            }, unbind: function () {
                this.parentWatcher.teardown(), this.childWatcher && this.childWatcher.teardown();
            }
        }, Ts = [], Ns = !1, js = "transition", Es = "animation", Ss = Ji + "Duration", Fs = Qi + "Duration",
        Ds = Ri && window.requestAnimationFrame, Ps = Ds ? function (t) {
            Ds(function () {
                Ds(t);
            });
        } : function (t) {
            setTimeout(t, 50);
        }, Rs = Se.prototype;
    Rs.enter = function (t, e) {
        this.cancelPending(), this.callHook("beforeEnter"), this.cb = e, X(this.el, this.enterClass), t(), this.entered = !1, this.callHookWithCb("enter"), this.entered || (this.cancel = this.hooks && this.hooks.enterCancelled, je(this.enterNextTick));
    }, Rs.enterNextTick = function () {
        var t = this;
        this.justEntered = !0, Ps(function () {
            t.justEntered = !1;
        });
        var e = this.enterDone, i = this.getCssTransitionType(this.enterClass);
        this.pendingJsCb ? i === js && Y(this.el, this.enterClass) : i === js ? (Y(this.el, this.enterClass), this.setupCssCb(qi, e)) : i === Es ? this.setupCssCb(Gi, e) : e();
    }, Rs.enterDone = function () {
        this.entered = !0, this.cancel = this.pendingJsCb = null, Y(this.el, this.enterClass), this.callHook("afterEnter"), this.cb && this.cb();
    }, Rs.leave = function (t, e) {
        this.cancelPending(), this.callHook("beforeLeave"), this.op = t, this.cb = e, X(this.el, this.leaveClass), this.left = !1, this.callHookWithCb("leave"), this.left || (this.cancel = this.hooks && this.hooks.leaveCancelled, this.op && !this.pendingJsCb && (this.justEntered ? this.leaveDone() : je(this.leaveNextTick)));
    }, Rs.leaveNextTick = function () {
        var t = this.getCssTransitionType(this.leaveClass);
        if (t) {
            var e = t === js ? qi : Gi;
            this.setupCssCb(e, this.leaveDone);
        } else this.leaveDone();
    }, Rs.leaveDone = function () {
        this.left = !0, this.cancel = this.pendingJsCb = null, this.op(), Y(this.el, this.leaveClass), this.callHook("afterLeave"), this.cb && this.cb(), this.op = null;
    }, Rs.cancelPending = function () {
        this.op = this.cb = null;
        var t = !1;
        this.pendingCssCb && (t = !0, Q(this.el, this.pendingCssEvent, this.pendingCssCb), this.pendingCssEvent = this.pendingCssCb = null), this.pendingJsCb && (t = !0, this.pendingJsCb.cancel(), this.pendingJsCb = null), t && (Y(this.el, this.enterClass), Y(this.el, this.leaveClass)), this.cancel && (this.cancel.call(this.vm, this.el), this.cancel = null);
    }, Rs.callHook = function (t) {
        this.hooks && this.hooks[t] && this.hooks[t].call(this.vm, this.el);
    }, Rs.callHookWithCb = function (t) {
        var e = this.hooks && this.hooks[t];
        e && (e.length > 1 && (this.pendingJsCb = w(this[t + "Done"])), e.call(this.vm, this.el, this.pendingJsCb));
    }, Rs.getCssTransitionType = function (t) {
        if (!(!qi || document.hidden || this.hooks && this.hooks.css === !1 || Fe(this.el))) {
            var e = this.type || this.typeCache[t];
            if (e) return e;
            var i = this.el.style, n = window.getComputedStyle(this.el), r = i[Ss] || n[Ss];
            if (r && "0s" !== r) e = js; else {
                var s = i[Fs] || n[Fs];
                s && "0s" !== s && (e = Es);
            }
            return e && (this.typeCache[t] = e), e;
        }
    }, Rs.setupCssCb = function (t, e) {
        this.pendingCssEvent = t;
        var i = this, n = this.el, r = this.pendingCssCb = function (s) {
            s.target === n && (Q(n, t, r), i.pendingCssEvent = i.pendingCssCb = null, !i.pendingJsCb && e && e());
        };
        q(n, t, r);
    };
    var Ls = {
            priority: Ir, update: function (t, e) {
                var i = this.el, n = gt(this.vm.$options, "transitions", t);
                t = t || "v", e = e || "v", i.__v_trans = new Se(i, t, n, this.vm), Y(i, e + "-transition"), X(i, t + "-transition");
            }
        }, Hs = {style: ls, "class": ws, component: Cs, prop: Os, transition: Ls}, Is = /^v-bind:|^:/, Ms = /^v-on:|^@/,
        Vs = /^v-([^:]+)(?:$|:(.*)$)/, Bs = /\.[^\.]+/g, Ws = /^(v-bind:|:)?transition$/, zs = 1e3, Us = 2e3;
    Ye.terminal = !0;
    var Js = /[^\w\-:\.]/,
        qs = Object.freeze({compile: De, compileAndLinkProps: Ie, compileRoot: Me, transclude: si, resolveSlots: li}),
        Qs = /^v-on:|^@/;
    di.prototype._bind = function () {
        var t = this.name, e = this.descriptor;
        if (("cloak" !== t || this.vm._isCompiled) && this.el && this.el.removeAttribute) {
            var i = e.attr || "v-" + t;
            this.el.removeAttribute(i);
        }
        var n = e.def;
        if ("function" == typeof n ? this.update = n : v(this, n), this._setupParams(), this.bind && this.bind(), this._bound = !0, this.literal) this.update && this.update(e.raw); else if ((this.expression || this.modifiers) && (this.update || this.twoWay) && !this._checkStatement()) {
            var r = this;
            this.update ? this._update = function (t, e) {
                r._locked || r.update(t, e);
            } : this._update = pi;
            var s = this._preProcess ? p(this._preProcess, this) : null,
                o = this._postProcess ? p(this._postProcess, this) : null,
                a = this._watcher = new Ut(this.vm, this.expression, this._update, {
                    filters: this.filters,
                    twoWay: this.twoWay,
                    deep: this.deep,
                    preProcess: s,
                    postProcess: o,
                    scope: this._scope
                });
            this.afterBind ? this.afterBind() : this.update && this.update(a.value);
        }
    }, di.prototype._setupParams = function () {
        if (this.params) {
            var t = this.params;
            this.params = Object.create(null);
            for (var e, i, n, r = t.length; r--;) e = u(t[r]), n = l(e), i = M(this.el, e), null != i ? this._setupParamWatcher(n, i) : (i = I(this.el, e), null != i && (this.params[n] = "" === i ? !0 : i));
        }
    }, di.prototype._setupParamWatcher = function (t, e) {
        var i = this, n = !1, r = (this._scope || this.vm).$watch(e, function (e, r) {
            if (i.params[t] = e, n) {
                var s = i.paramWatchers && i.paramWatchers[t];
                s && s.call(i, e, r);
            } else n = !0;
        }, {immediate: !0, user: !1});
        (this._paramUnwatchFns || (this._paramUnwatchFns = [])).push(r);
    }, di.prototype._checkStatement = function () {
        var t = this.expression;
        if (t && this.acceptStatement && !Mt(t)) {
            var e = It(t).get, i = this._scope || this.vm, n = function (t) {
                i.$event = t, e.call(i, i), i.$event = null;
            };
            return this.filters && (n = i._applyFilters(n, null, this.filters)), this.update(n), !0;
        }
    }, di.prototype.set = function (t) {
        this.twoWay && this._withLock(function () {
            this._watcher.set(t);
        });
    }, di.prototype._withLock = function (t) {
        var e = this;
        e._locked = !0, t.call(e), Yi(function () {
            e._locked = !1;
        });
    }, di.prototype.on = function (t, e, i) {
        q(this.el, t, e, i), (this._listeners || (this._listeners = [])).push([t, e]);
    }, di.prototype._teardown = function () {
        if (this._bound) {
            this._bound = !1, this.unbind && this.unbind(), this._watcher && this._watcher.teardown();
            var t, e = this._listeners;
            if (e) for (t = e.length; t--;) Q(this.el, e[t][0], e[t][1]);
            var i = this._paramUnwatchFns;
            if (i) for (t = i.length; t--;) i[t]();
            this.vm = this.el = this._watcher = this._listeners = null;
        }
    };
    var Gs = /[^|]\|[^|]/;
    xt(wi), ui(wi), fi(wi), vi(wi), mi(wi), gi(wi), _i(wi), yi(wi), bi(wi);
    var Zs = {
        priority: Ur, params: ["name"], bind: function () {
            var t = this.params.name || "default", e = this.vm._slotContents && this.vm._slotContents[t];
            e && e.hasChildNodes() ? this.compile(e.cloneNode(!0), this.vm._context, this.vm) : this.fallback();
        }, compile: function (t, e, i) {
            if (t && e) {
                if (this.el.hasChildNodes() && 1 === t.childNodes.length && 1 === t.childNodes[0].nodeType && t.childNodes[0].hasAttribute("v-if")) {
                    var n = document.createElement("template");
                    n.setAttribute("v-else", ""), n.innerHTML = this.el.innerHTML, n._context = this.vm, t.appendChild(n);
                }
                var r = i ? i._scope : this._scope;
                this.unlink = e.$compile(t, i, r, this._frag);
            }
            t ? J(this.el, t) : z(this.el);
        }, fallback: function () {
            this.compile(K(this.el, !0), this.vm);
        }, unbind: function () {
            this.unlink && this.unlink();
        }
    }, Xs = {
        priority: Br, params: ["name"], paramWatchers: {
            name: function (t) {
                Qr.remove.call(this), t && this.insert(t);
            }
        }, bind: function () {
            this.anchor = nt("v-partial"), J(this.el, this.anchor), this.insert(this.params.name);
        }, insert: function (t) {
            var e = gt(this.vm.$options, "partials", t, !0);
            e && (this.factory = new se(this.vm, e), Qr.insert.call(this));
        }, unbind: function () {
            this.frag && this.frag.destroy();
        }
    }, Ys = {slot: Zs, partial: Xs}, Ks = qr._postProcess, to = /(\d{3})(?=\d)/g, eo = {
        orderBy: ki, filterBy: $i, limitBy: Ci, json: {
            read: function (t, e) {
                return "string" == typeof t ? t : JSON.stringify(t, null, arguments.length > 1 ? e : 2);
            }, write: function (t) {
                try {
                    return JSON.parse(t);
                } catch (e) {
                    return t;
                }
            }
        }, capitalize: function (t) {
            return t || 0 === t ? (t = t.toString(), t.charAt(0).toUpperCase() + t.slice(1)) : "";
        }, uppercase: function (t) {
            return t || 0 === t ? t.toString().toUpperCase() : "";
        }, lowercase: function (t) {
            return t || 0 === t ? t.toString().toLowerCase() : "";
        }, currency: function (t, e, i) {
            if (t = parseFloat(t), !isFinite(t) || !t && 0 !== t) return "";
            e = null != e ? e : "$", i = null != i ? i : 2;
            var n = Math.abs(t).toFixed(i), r = i ? n.slice(0, -1 - i) : n, s = r.length % 3,
                o = s > 0 ? r.slice(0, s) + (r.length > 3 ? "," : "") : "", a = i ? n.slice(-1 - i) : "",
                h = 0 > t ? "-" : "";
            return h + e + o + r.slice(s).replace(to, "$1,") + a;
        }, pluralize: function (t) {
            var e = d(arguments, 1), i = e.length;
            if (i > 1) {
                var n = t % 10 - 1;
                return n in e ? e[n] : e[i - 1];
            }
            return e[0] + (1 === t ? "" : "s");
        }, debounce: function (t, e) {
            return t ? (e || (e = 300), y(t, e)) : void 0;
        }
    };
    return Ai(wi), wi.version = "1.0.26", setTimeout(function () {
        An.devtools && Li && Li.emit("init", wi);
    }, 0), wi;
});
//# sourceMappingURL=vue.min.js.map
/*! jQuery v2.1.4 | (c) 2005, 2015 jQuery Foundation, Inc. | jquery.org/license */
!function (a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function (a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a);
    } : b(a);
}("undefined" != typeof window ? window : this, function (a, b) {
    var c = [], d = c.slice, e = c.concat, f = c.push, g = c.indexOf, h = {}, i = h.toString, j = h.hasOwnProperty,
        k = {}, l = a.document, m = "2.1.4", n = function (a, b) {
            return new n.fn.init(a, b);
        }, o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, p = /^-ms-/, q = /-([\da-z])/gi, r = function (a, b) {
            return b.toUpperCase();
        };
    n.fn = n.prototype = {
        jquery: m, constructor: n, selector: "", length: 0, toArray: function () {
            return d.call(this);
        }, get: function (a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this);
        }, pushStack: function (a) {
            var b = n.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b;
        }, each: function (a, b) {
            return n.each(this, a, b);
        }, map: function (a) {
            return this.pushStack(n.map(this, function (b, c) {
                return a.call(b, c, b);
            }));
        }, slice: function () {
            return this.pushStack(d.apply(this, arguments));
        }, first: function () {
            return this.eq(0);
        }, last: function () {
            return this.eq(-1);
        }, eq: function (a) {
            var b = this.length, c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : []);
        }, end: function () {
            return this.prevObject || this.constructor(null);
        }, push: f, sort: c.sort, splice: c.splice
    }, n.extend = n.fn.extend = function () {
        var a, b, c, d, e, f, g = arguments[0] || {}, h = 1, i = arguments.length, j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++) if (null != (a = arguments[h])) for (b in a) c = g[b], d = a[b], g !== d && (j && d && (n.isPlainObject(d) || (e = n.isArray(d))) ? (e ? (e = !1, f = c && n.isArray(c) ? c : []) : f = c && n.isPlainObject(c) ? c : {}, g[b] = n.extend(j, f, d)) : void 0 !== d && (g[b] = d));
        return g;
    }, n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (a) {
            throw new Error(a);
        }, noop: function () {
        }, isFunction: function (a) {
            return "function" === n.type(a);
        }, isArray: Array.isArray, isWindow: function (a) {
            return null != a && a === a.window;
        }, isNumeric: function (a) {
            return !n.isArray(a) && a - parseFloat(a) + 1 >= 0;
        }, isPlainObject: function (a) {
            return "object" !== n.type(a) || a.nodeType || n.isWindow(a) ? !1 : a.constructor && !j.call(a.constructor.prototype, "isPrototypeOf") ? !1 : !0;
        }, isEmptyObject: function (a) {
            var b;
            for (b in a) return !1;
            return !0;
        }, type: function (a) {
            return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a;
        }, globalEval: function (a) {
            var b, c = eval;
            a = n.trim(a), a && (1 === a.indexOf("use strict") ? (b = l.createElement("script"), b.text = a, l.head.appendChild(b).parentNode.removeChild(b)) : c(a));
        }, camelCase: function (a) {
            return a.replace(p, "ms-").replace(q, r);
        }, nodeName: function (a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase();
        }, each: function (a, b, c) {
            var d, e = 0, f = a.length, g = s(a);
            if (c) {
                if (g) {
                    for (; f > e; e++) if (d = b.apply(a[e], c), d === !1) break;
                } else for (e in a) if (d = b.apply(a[e], c), d === !1) break;
            } else if (g) {
                for (; f > e; e++) if (d = b.call(a[e], e, a[e]), d === !1) break;
            } else for (e in a) if (d = b.call(a[e], e, a[e]), d === !1) break;
            return a;
        }, trim: function (a) {
            return null == a ? "" : (a + "").replace(o, "");
        }, makeArray: function (a, b) {
            var c = b || [];
            return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)), c;
        }, inArray: function (a, b, c) {
            return null == b ? -1 : g.call(b, a, c);
        }, merge: function (a, b) {
            for (var c = +b.length, d = 0, e = a.length; c > d; d++) a[e++] = b[d];
            return a.length = e, a;
        }, grep: function (a, b, c) {
            for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++) d = !b(a[f], f), d !== h && e.push(a[f]);
            return e;
        }, map: function (a, b, c) {
            var d, f = 0, g = a.length, h = s(a), i = [];
            if (h) for (; g > f; f++) d = b(a[f], f, c), null != d && i.push(d); else for (f in a) d = b(a[f], f, c), null != d && i.push(d);
            return e.apply([], i);
        }, guid: 1, proxy: function (a, b) {
            var c, e, f;
            return "string" == typeof b && (c = a[b], b = a, a = c), n.isFunction(a) ? (e = d.call(arguments, 2), f = function () {
                return a.apply(b || this, e.concat(d.call(arguments)));
            }, f.guid = a.guid = a.guid || n.guid++, f) : void 0;
        }, now: Date.now, support: k
    }), n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
        h["[object " + b + "]"] = b.toLowerCase();
    });

    function s(a) {
        var b = "length" in a && a.length, c = n.type(a);
        return "function" === c || n.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a;
    }

    var t = function (a) {
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + 1 * new Date, v = a.document, w = 0,
            x = 0, y = ha(), z = ha(), A = ha(), B = function (a, b) {
                return a === b && (l = !0), 0;
            }, C = 1 << 31, D = {}.hasOwnProperty, E = [], F = E.pop, G = E.push, H = E.push, I = E.slice,
            J = function (a, b) {
                for (var c = 0, d = a.length; d > c; c++) if (a[c] === b) return c;
                return -1;
            },
            K = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            L = "[\\x20\\t\\r\\n\\f]", M = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", N = M.replace("w", "w#"),
            O = "\\[" + L + "*(" + M + ")(?:" + L + "*([*^$|!~]?=)" + L + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + N + "))|)" + L + "*\\]",
            P = ":(" + M + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + O + ")*)|.*)\\)|)",
            Q = new RegExp(L + "+", "g"), R = new RegExp("^" + L + "+|((?:^|[^\\\\])(?:\\\\.)*)" + L + "+$", "g"),
            S = new RegExp("^" + L + "*," + L + "*"), T = new RegExp("^" + L + "*([>+~]|" + L + ")" + L + "*"),
            U = new RegExp("=" + L + "*([^\\]'\"]*?)" + L + "*\\]", "g"), V = new RegExp(P),
            W = new RegExp("^" + N + "$"), X = {
                ID: new RegExp("^#(" + M + ")"),
                CLASS: new RegExp("^\\.(" + M + ")"),
                TAG: new RegExp("^(" + M.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + O),
                PSEUDO: new RegExp("^" + P),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + L + "*(even|odd|(([+-]|)(\\d*)n|)" + L + "*(?:([+-]|)" + L + "*(\\d+)|))" + L + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + K + ")$", "i"),
                needsContext: new RegExp("^" + L + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + L + "*((?:-\\d)?\\d*)" + L + "*\\)|)(?=[^-]|$)", "i")
            }, Y = /^(?:input|select|textarea|button)$/i, Z = /^h\d$/i, $ = /^[^{]+\{\s*\[native \w/,
            _ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, aa = /[+~]/, ba = /'|\\/g,
            ca = new RegExp("\\\\([\\da-f]{1,6}" + L + "?|(" + L + ")|.)", "ig"), da = function (a, b, c) {
                var d = "0x" + b - 65536;
                return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320);
            }, ea = function () {
                m();
            };
        try {
            H.apply(E = I.call(v.childNodes), v.childNodes), E[v.childNodes.length].nodeType;
        } catch (fa) {
            H = {
                apply: E.length ? function (a, b) {
                    G.apply(a, I.call(b));
                } : function (a, b) {
                    var c = a.length, d = 0;
                    while (a[c++] = b[d++]) ;
                    a.length = c - 1;
                }
            };
        }

        function ga(a, b, d, e) {
            var f, h, j, k, l, o, r, s, w, x;
            if ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, d = d || [], k = b.nodeType, "string" != typeof a || !a || 1 !== k && 9 !== k && 11 !== k) return d;
            if (!e && p) {
                if (11 !== k && (f = _.exec(a))) if (j = f[1]) {
                    if (9 === k) {
                        if (h = b.getElementById(j), !h || !h.parentNode) return d;
                        if (h.id === j) return d.push(h), d;
                    } else if (b.ownerDocument && (h = b.ownerDocument.getElementById(j)) && t(b, h) && h.id === j) return d.push(h), d;
                } else {
                    if (f[2]) return H.apply(d, b.getElementsByTagName(a)), d;
                    if ((j = f[3]) && c.getElementsByClassName) return H.apply(d, b.getElementsByClassName(j)), d;
                }
                if (c.qsa && (!q || !q.test(a))) {
                    if (s = r = u, w = b, x = 1 !== k && a, 1 === k && "object" !== b.nodeName.toLowerCase()) {
                        o = g(a), (r = b.getAttribute("id")) ? s = r.replace(ba, "\\$&") : b.setAttribute("id", s), s = "[id='" + s + "'] ", l = o.length;
                        while (l--) o[l] = s + ra(o[l]);
                        w = aa.test(a) && pa(b.parentNode) || b, x = o.join(",");
                    }
                    if (x) try {
                        return H.apply(d, w.querySelectorAll(x)), d;
                    } catch (y) {
                    } finally {
                        r || b.removeAttribute("id");
                    }
                }
            }
            return i(a.replace(R, "$1"), b, d, e);
        }

        function ha() {
            var a = [];

            function b(c, e) {
                return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e;
            }

            return b;
        }

        function ia(a) {
            return a[u] = !0, a;
        }

        function ja(a) {
            var b = n.createElement("div");
            try {
                return !!a(b);
            } catch (c) {
                return !1;
            } finally {
                b.parentNode && b.parentNode.removeChild(b), b = null;
            }
        }

        function ka(a, b) {
            var c = a.split("|"), e = a.length;
            while (e--) d.attrHandle[c[e]] = b;
        }

        function la(a, b) {
            var c = b && a,
                d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || C) - (~a.sourceIndex || C);
            if (d) return d;
            if (c) while (c = c.nextSibling) if (c === b) return -1;
            return a ? 1 : -1;
        }

        function ma(a) {
            return function (b) {
                var c = b.nodeName.toLowerCase();
                return "input" === c && b.type === a;
            };
        }

        function na(a) {
            return function (b) {
                var c = b.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && b.type === a;
            };
        }

        function oa(a) {
            return ia(function (b) {
                return b = +b, ia(function (c, d) {
                    var e, f = a([], c.length, b), g = f.length;
                    while (g--) c[e = f[g]] && (c[e] = !(d[e] = c[e]));
                });
            });
        }

        function pa(a) {
            return a && "undefined" != typeof a.getElementsByTagName && a;
        }

        c = ga.support = {}, f = ga.isXML = function (a) {
            var b = a && (a.ownerDocument || a).documentElement;
            return b ? "HTML" !== b.nodeName : !1;
        }, m = ga.setDocument = function (a) {
            var b, e, g = a ? a.ownerDocument || a : v;
            return g !== n && 9 === g.nodeType && g.documentElement ? (n = g, o = g.documentElement, e = g.defaultView, e && e !== e.top && (e.addEventListener ? e.addEventListener("unload", ea, !1) : e.attachEvent && e.attachEvent("onunload", ea)), p = !f(g), c.attributes = ja(function (a) {
                return a.className = "i", !a.getAttribute("className");
            }), c.getElementsByTagName = ja(function (a) {
                return a.appendChild(g.createComment("")), !a.getElementsByTagName("*").length;
            }), c.getElementsByClassName = $.test(g.getElementsByClassName), c.getById = ja(function (a) {
                return o.appendChild(a).id = u, !g.getElementsByName || !g.getElementsByName(u).length;
            }), c.getById ? (d.find.ID = function (a, b) {
                if ("undefined" != typeof b.getElementById && p) {
                    var c = b.getElementById(a);
                    return c && c.parentNode ? [c] : [];
                }
            }, d.filter.ID = function (a) {
                var b = a.replace(ca, da);
                return function (a) {
                    return a.getAttribute("id") === b;
                };
            }) : (delete d.find.ID, d.filter.ID = function (a) {
                var b = a.replace(ca, da);
                return function (a) {
                    var c = "undefined" != typeof a.getAttributeNode && a.getAttributeNode("id");
                    return c && c.value === b;
                };
            }), d.find.TAG = c.getElementsByTagName ? function (a, b) {
                return "undefined" != typeof b.getElementsByTagName ? b.getElementsByTagName(a) : c.qsa ? b.querySelectorAll(a) : void 0;
            } : function (a, b) {
                var c, d = [], e = 0, f = b.getElementsByTagName(a);
                if ("*" === a) {
                    while (c = f[e++]) 1 === c.nodeType && d.push(c);
                    return d;
                }
                return f;
            }, d.find.CLASS = c.getElementsByClassName && function (a, b) {
                return p ? b.getElementsByClassName(a) : void 0;
            }, r = [], q = [], (c.qsa = $.test(g.querySelectorAll)) && (ja(function (a) {
                o.appendChild(a).innerHTML = "<a id='" + u + "'></a><select id='" + u + "-\f]' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + L + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || q.push("\\[" + L + "*(?:value|" + K + ")"), a.querySelectorAll("[id~=" + u + "-]").length || q.push("~="), a.querySelectorAll(":checked").length || q.push(":checked"), a.querySelectorAll("a#" + u + "+*").length || q.push(".#.+[+~]");
            }), ja(function (a) {
                var b = g.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + L + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), q.push(",.*:");
            })), (c.matchesSelector = $.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ja(function (a) {
                c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", P);
            }), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), b = $.test(o.compareDocumentPosition), t = b || $.test(o.contains) ? function (a, b) {
                var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
                return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)));
            } : function (a, b) {
                if (b) while (b = b.parentNode) if (b === a) return !0;
                return !1;
            }, B = b ? function (a, b) {
                if (a === b) return l = !0, 0;
                var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
                return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === g || a.ownerDocument === v && t(v, a) ? -1 : b === g || b.ownerDocument === v && t(v, b) ? 1 : k ? J(k, a) - J(k, b) : 0 : 4 & d ? -1 : 1);
            } : function (a, b) {
                if (a === b) return l = !0, 0;
                var c, d = 0, e = a.parentNode, f = b.parentNode, h = [a], i = [b];
                if (!e || !f) return a === g ? -1 : b === g ? 1 : e ? -1 : f ? 1 : k ? J(k, a) - J(k, b) : 0;
                if (e === f) return la(a, b);
                c = a;
                while (c = c.parentNode) h.unshift(c);
                c = b;
                while (c = c.parentNode) i.unshift(c);
                while (h[d] === i[d]) d++;
                return d ? la(h[d], i[d]) : h[d] === v ? -1 : i[d] === v ? 1 : 0;
            }, g) : n;
        }, ga.matches = function (a, b) {
            return ga(a, null, null, b);
        }, ga.matchesSelector = function (a, b) {
            if ((a.ownerDocument || a) !== n && m(a), b = b.replace(U, "='$1']"), !(!c.matchesSelector || !p || r && r.test(b) || q && q.test(b))) try {
                var d = s.call(a, b);
                if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d;
            } catch (e) {
            }
            return ga(b, n, null, [a]).length > 0;
        }, ga.contains = function (a, b) {
            return (a.ownerDocument || a) !== n && m(a), t(a, b);
        }, ga.attr = function (a, b) {
            (a.ownerDocument || a) !== n && m(a);
            var e = d.attrHandle[b.toLowerCase()],
                f = e && D.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0;
            return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null;
        }, ga.error = function (a) {
            throw new Error("Syntax error, unrecognized expression: " + a);
        }, ga.uniqueSort = function (a) {
            var b, d = [], e = 0, f = 0;
            if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) {
                while (b = a[f++]) b === a[f] && (e = d.push(f));
                while (e--) a.splice(d[e], 1);
            }
            return k = null, a;
        }, e = ga.getText = function (a) {
            var b, c = "", d = 0, f = a.nodeType;
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if ("string" == typeof a.textContent) return a.textContent;
                    for (a = a.firstChild; a; a = a.nextSibling) c += e(a);
                } else if (3 === f || 4 === f) return a.nodeValue;
            } else while (b = a[d++]) c += e(b);
            return c;
        }, d = ga.selectors = {
            cacheLength: 50,
            createPseudo: ia,
            match: X,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (a) {
                    return a[1] = a[1].replace(ca, da), a[3] = (a[3] || a[4] || a[5] || "").replace(ca, da), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4);
                }, CHILD: function (a) {
                    return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || ga.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && ga.error(a[0]), a;
                }, PSEUDO: function (a) {
                    var b, c = !a[6] && a[2];
                    return X.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && V.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3));
                }
            },
            filter: {
                TAG: function (a) {
                    var b = a.replace(ca, da).toLowerCase();
                    return "*" === a ? function () {
                        return !0;
                    } : function (a) {
                        return a.nodeName && a.nodeName.toLowerCase() === b;
                    };
                }, CLASS: function (a) {
                    var b = y[a + " "];
                    return b || (b = new RegExp("(^|" + L + ")" + a + "(" + L + "|$)")) && y(a, function (a) {
                        return b.test("string" == typeof a.className && a.className || "undefined" != typeof a.getAttribute && a.getAttribute("class") || "");
                    });
                }, ATTR: function (a, b, c) {
                    return function (d) {
                        var e = ga.attr(d, a);
                        return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e.replace(Q, " ") + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0;
                    };
                }, CHILD: function (a, b, c, d, e) {
                    var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
                    return 1 === d && 0 === e ? function (a) {
                        return !!a.parentNode;
                    } : function (b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode,
                            r = h && b.nodeName.toLowerCase(), s = !i && !h;
                        if (q) {
                            if (f) {
                                while (p) {
                                    l = b;
                                    while (l = l[p]) if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling";
                                }
                                return !0;
                            }
                            if (o = [g ? q.firstChild : q.lastChild], g && s) {
                                k = q[u] || (q[u] = {}), j = k[a] || [], n = j[0] === w && j[1], m = j[0] === w && j[2], l = n && q.childNodes[n];
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop()) if (1 === l.nodeType && ++m && l === b) {
                                    k[a] = [w, n, m];
                                    break;
                                }
                            } else if (s && (j = (b[u] || (b[u] = {}))[a]) && j[0] === w) m = j[1]; else while (l = ++n && l && l[p] || (m = n = 0) || o.pop()) if ((h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) && ++m && (s && ((l[u] || (l[u] = {}))[a] = [w, m]), l === b)) break;
                            return m -= e, m === d || m % d === 0 && m / d >= 0;
                        }
                    };
                }, PSEUDO: function (a, b) {
                    var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || ga.error("unsupported pseudo: " + a);
                    return e[u] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? ia(function (a, c) {
                        var d, f = e(a, b), g = f.length;
                        while (g--) d = J(a, f[g]), a[d] = !(c[d] = f[g]);
                    }) : function (a) {
                        return e(a, 0, c);
                    }) : e;
                }
            },
            pseudos: {
                not: ia(function (a) {
                    var b = [], c = [], d = h(a.replace(R, "$1"));
                    return d[u] ? ia(function (a, b, c, e) {
                        var f, g = d(a, null, e, []), h = a.length;
                        while (h--) (f = g[h]) && (a[h] = !(b[h] = f));
                    }) : function (a, e, f) {
                        return b[0] = a, d(b, null, f, c), b[0] = null, !c.pop();
                    };
                }), has: ia(function (a) {
                    return function (b) {
                        return ga(a, b).length > 0;
                    };
                }), contains: ia(function (a) {
                    return a = a.replace(ca, da), function (b) {
                        return (b.textContent || b.innerText || e(b)).indexOf(a) > -1;
                    };
                }), lang: ia(function (a) {
                    return W.test(a || "") || ga.error("unsupported lang: " + a), a = a.replace(ca, da).toLowerCase(), function (b) {
                        var c;
                        do if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
                        return !1;
                    };
                }), target: function (b) {
                    var c = a.location && a.location.hash;
                    return c && c.slice(1) === b.id;
                }, root: function (a) {
                    return a === o;
                }, focus: function (a) {
                    return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex);
                }, enabled: function (a) {
                    return a.disabled === !1;
                }, disabled: function (a) {
                    return a.disabled === !0;
                }, checked: function (a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && !!a.checked || "option" === b && !!a.selected;
                }, selected: function (a) {
                    return a.parentNode && a.parentNode.selectedIndex, a.selected === !0;
                }, empty: function (a) {
                    for (a = a.firstChild; a; a = a.nextSibling) if (a.nodeType < 6) return !1;
                    return !0;
                }, parent: function (a) {
                    return !d.pseudos.empty(a);
                }, header: function (a) {
                    return Z.test(a.nodeName);
                }, input: function (a) {
                    return Y.test(a.nodeName);
                }, button: function (a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && "button" === a.type || "button" === b;
                }, text: function (a) {
                    var b;
                    return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase());
                }, first: oa(function () {
                    return [0];
                }), last: oa(function (a, b) {
                    return [b - 1];
                }), eq: oa(function (a, b, c) {
                    return [0 > c ? c + b : c];
                }), even: oa(function (a, b) {
                    for (var c = 0; b > c; c += 2) a.push(c);
                    return a;
                }), odd: oa(function (a, b) {
                    for (var c = 1; b > c; c += 2) a.push(c);
                    return a;
                }), lt: oa(function (a, b, c) {
                    for (var d = 0 > c ? c + b : c; --d >= 0;) a.push(d);
                    return a;
                }), gt: oa(function (a, b, c) {
                    for (var d = 0 > c ? c + b : c; ++d < b;) a.push(d);
                    return a;
                })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0}) d.pseudos[b] = ma(b);
        for (b in{submit: !0, reset: !0}) d.pseudos[b] = na(b);

        function qa() {
        }

        qa.prototype = d.filters = d.pseudos, d.setFilters = new qa, g = ga.tokenize = function (a, b) {
            var c, e, f, g, h, i, j, k = z[a + " "];
            if (k) return b ? 0 : k.slice(0);
            h = a, i = [], j = d.preFilter;
            while (h) {
                (!c || (e = S.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = T.exec(h)) && (c = e.shift(), f.push({
                    value: c,
                    type: e[0].replace(R, " ")
                }), h = h.slice(c.length));
                for (g in d.filter) !(e = X[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({
                    value: c,
                    type: g,
                    matches: e
                }), h = h.slice(c.length));
                if (!c) break;
            }
            return b ? h.length : h ? ga.error(a) : z(a, i).slice(0);
        };

        function ra(a) {
            for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value;
            return d;
        }

        function sa(a, b, c) {
            var d = b.dir, e = c && "parentNode" === d, f = x++;
            return b.first ? function (b, c, f) {
                while (b = b[d]) if (1 === b.nodeType || e) return a(b, c, f);
            } : function (b, c, g) {
                var h, i, j = [w, f];
                if (g) {
                    while (b = b[d]) if ((1 === b.nodeType || e) && a(b, c, g)) return !0;
                } else while (b = b[d]) if (1 === b.nodeType || e) {
                    if (i = b[u] || (b[u] = {}), (h = i[d]) && h[0] === w && h[1] === f) return j[2] = h[2];
                    if (i[d] = j, j[2] = a(b, c, g)) return !0;
                }
            };
        }

        function ta(a) {
            return a.length > 1 ? function (b, c, d) {
                var e = a.length;
                while (e--) if (!a[e](b, c, d)) return !1;
                return !0;
            } : a[0];
        }

        function ua(a, b, c) {
            for (var d = 0, e = b.length; e > d; d++) ga(a, b[d], c);
            return c;
        }

        function va(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++) (f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
            return g;
        }

        function wa(a, b, c, d, e, f) {
            return d && !d[u] && (d = wa(d)), e && !e[u] && (e = wa(e, f)), ia(function (f, g, h, i) {
                var j, k, l, m = [], n = [], o = g.length, p = f || ua(b || "*", h.nodeType ? [h] : h, []),
                    q = !a || !f && b ? p : va(p, m, a, h, i), r = c ? e || (f ? a : o || d) ? [] : g : q;
                if (c && c(q, r, h, i), d) {
                    j = va(r, n), d(j, [], h, i), k = j.length;
                    while (k--) (l = j[k]) && (r[n[k]] = !(q[n[k]] = l));
                }
                if (f) {
                    if (e || a) {
                        if (e) {
                            j = [], k = r.length;
                            while (k--) (l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i);
                        }
                        k = r.length;
                        while (k--) (l = r[k]) && (j = e ? J(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l));
                    }
                } else r = va(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : H.apply(g, r);
            });
        }

        function xa(a) {
            for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = sa(function (a) {
                return a === b;
            }, h, !0), l = sa(function (a) {
                return J(b, a) > -1;
            }, h, !0), m = [function (a, c, d) {
                var e = !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d));
                return b = null, e;
            }]; f > i; i++) if (c = d.relative[a[i].type]) m = [sa(ta(m), c)]; else {
                if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) {
                    for (e = ++i; f > e; e++) if (d.relative[a[e].type]) break;
                    return wa(i > 1 && ta(m), i > 1 && ra(a.slice(0, i - 1).concat({value: " " === a[i - 2].type ? "*" : ""})).replace(R, "$1"), c, e > i && xa(a.slice(i, e)), f > e && xa(a = a.slice(e)), f > e && ra(a));
                }
                m.push(c);
            }
            return ta(m);
        }

        function ya(a, b) {
            var c = b.length > 0, e = a.length > 0, f = function (f, g, h, i, k) {
                var l, m, o, p = 0, q = "0", r = f && [], s = [], t = j, u = f || e && d.find.TAG("*", k),
                    v = w += null == t ? 1 : Math.random() || .1, x = u.length;
                for (k && (j = g !== n && g); q !== x && null != (l = u[q]); q++) {
                    if (e && l) {
                        m = 0;
                        while (o = a[m++]) if (o(l, g, h)) {
                            i.push(l);
                            break;
                        }
                        k && (w = v);
                    }
                    c && ((l = !o && l) && p--, f && r.push(l));
                }
                if (p += q, c && q !== p) {
                    m = 0;
                    while (o = b[m++]) o(r, s, g, h);
                    if (f) {
                        if (p > 0) while (q--) r[q] || s[q] || (s[q] = F.call(i));
                        s = va(s);
                    }
                    H.apply(i, s), k && !f && s.length > 0 && p + b.length > 1 && ga.uniqueSort(i);
                }
                return k && (w = v, j = t), r;
            };
            return c ? ia(f) : f;
        }

        return h = ga.compile = function (a, b) {
            var c, d = [], e = [], f = A[a + " "];
            if (!f) {
                b || (b = g(a)), c = b.length;
                while (c--) f = xa(b[c]), f[u] ? d.push(f) : e.push(f);
                f = A(a, ya(e, d)), f.selector = a;
            }
            return f;
        }, i = ga.select = function (a, b, e, f) {
            var i, j, k, l, m, n = "function" == typeof a && a, o = !f && g(a = n.selector || a);
            if (e = e || [], 1 === o.length) {
                if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) {
                    if (b = (d.find.ID(k.matches[0].replace(ca, da), b) || [])[0], !b) return e;
                    n && (b = b.parentNode), a = a.slice(j.shift().value.length);
                }
                i = X.needsContext.test(a) ? 0 : j.length;
                while (i--) {
                    if (k = j[i], d.relative[l = k.type]) break;
                    if ((m = d.find[l]) && (f = m(k.matches[0].replace(ca, da), aa.test(j[0].type) && pa(b.parentNode) || b))) {
                        if (j.splice(i, 1), a = f.length && ra(j), !a) return H.apply(e, f), e;
                        break;
                    }
                }
            }
            return (n || h(a, o))(f, b, !p, e, aa.test(a) && pa(b.parentNode) || b), e;
        }, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, m(), c.sortDetached = ja(function (a) {
            return 1 & a.compareDocumentPosition(n.createElement("div"));
        }), ja(function (a) {
            return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href");
        }) || ka("type|href|height|width", function (a, b, c) {
            return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2);
        }), c.attributes && ja(function (a) {
            return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value");
        }) || ka("value", function (a, b, c) {
            return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue;
        }), ja(function (a) {
            return null == a.getAttribute("disabled");
        }) || ka(K, function (a, b, c) {
            var d;
            return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null;
        }), ga;
    }(a);
    n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
    var u = n.expr.match.needsContext, v = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, w = /^.[^:#\[\.,]*$/;

    function x(a, b, c) {
        if (n.isFunction(b)) return n.grep(a, function (a, d) {
            return !!b.call(a, d, a) !== c;
        });
        if (b.nodeType) return n.grep(a, function (a) {
            return a === b !== c;
        });
        if ("string" == typeof b) {
            if (w.test(b)) return n.filter(b, a, c);
            b = n.filter(b, a);
        }
        return n.grep(a, function (a) {
            return g.call(b, a) >= 0 !== c;
        });
    }

    n.filter = function (a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b, function (a) {
            return 1 === a.nodeType;
        }));
    }, n.fn.extend({
        find: function (a) {
            var b, c = this.length, d = [], e = this;
            if ("string" != typeof a) return this.pushStack(n(a).filter(function () {
                for (b = 0; c > b; b++) if (n.contains(e[b], this)) return !0;
            }));
            for (b = 0; c > b; b++) n.find(a, e[b], d);
            return d = this.pushStack(c > 1 ? n.unique(d) : d), d.selector = this.selector ? this.selector + " " + a : a, d;
        }, filter: function (a) {
            return this.pushStack(x(this, a || [], !1));
        }, not: function (a) {
            return this.pushStack(x(this, a || [], !0));
        }, is: function (a) {
            return !!x(this, "string" == typeof a && u.test(a) ? n(a) : a || [], !1).length;
        }
    });
    var y, z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, A = n.fn.init = function (a, b) {
        var c, d;
        if (!a) return this;
        if ("string" == typeof a) {
            if (c = "<" === a[0] && ">" === a[a.length - 1] && a.length >= 3 ? [null, a, null] : z.exec(a), !c || !c[1] && b) return !b || b.jquery ? (b || y).find(a) : this.constructor(b).find(a);
            if (c[1]) {
                if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : l, !0)), v.test(c[1]) && n.isPlainObject(b)) for (c in b) n.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                return this;
            }
            return d = l.getElementById(c[2]), d && d.parentNode && (this.length = 1, this[0] = d), this.context = l, this.selector = a, this;
        }
        return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : n.isFunction(a) ? "undefined" != typeof y.ready ? y.ready(a) : a(n) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), n.makeArray(a, this));
    };
    A.prototype = n.fn, y = n(l);
    var B = /^(?:parents|prev(?:Until|All))/, C = {children: !0, contents: !0, next: !0, prev: !0};
    n.extend({
        dir: function (a, b, c) {
            var d = [], e = void 0 !== c;
            while ((a = a[b]) && 9 !== a.nodeType) if (1 === a.nodeType) {
                if (e && n(a).is(c)) break;
                d.push(a);
            }
            return d;
        }, sibling: function (a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c;
        }
    }), n.fn.extend({
        has: function (a) {
            var b = n(a, this), c = b.length;
            return this.filter(function () {
                for (var a = 0; c > a; a++) if (n.contains(this, b[a])) return !0;
            });
        }, closest: function (a, b) {
            for (var c, d = 0, e = this.length, f = [], g = u.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++) for (c = this[d]; c && c !== b; c = c.parentNode) if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) {
                f.push(c);
                break;
            }
            return this.pushStack(f.length > 1 ? n.unique(f) : f);
        }, index: function (a) {
            return a ? "string" == typeof a ? g.call(n(a), this[0]) : g.call(this, a.jquery ? a[0] : a) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1;
        }, add: function (a, b) {
            return this.pushStack(n.unique(n.merge(this.get(), n(a, b))));
        }, addBack: function (a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a));
        }
    });

    function D(a, b) {
        while ((a = a[b]) && 1 !== a.nodeType) ;
        return a;
    }

    n.each({
        parent: function (a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null;
        }, parents: function (a) {
            return n.dir(a, "parentNode");
        }, parentsUntil: function (a, b, c) {
            return n.dir(a, "parentNode", c);
        }, next: function (a) {
            return D(a, "nextSibling");
        }, prev: function (a) {
            return D(a, "previousSibling");
        }, nextAll: function (a) {
            return n.dir(a, "nextSibling");
        }, prevAll: function (a) {
            return n.dir(a, "previousSibling");
        }, nextUntil: function (a, b, c) {
            return n.dir(a, "nextSibling", c);
        }, prevUntil: function (a, b, c) {
            return n.dir(a, "previousSibling", c);
        }, siblings: function (a) {
            return n.sibling((a.parentNode || {}).firstChild, a);
        }, children: function (a) {
            return n.sibling(a.firstChild);
        }, contents: function (a) {
            return a.contentDocument || n.merge([], a.childNodes);
        }
    }, function (a, b) {
        n.fn[a] = function (c, d) {
            var e = n.map(this, b, c);
            return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = n.filter(d, e)), this.length > 1 && (C[a] || n.unique(e), B.test(a) && e.reverse()), this.pushStack(e);
        };
    });
    var E = /\S+/g, F = {};

    function G(a) {
        var b = F[a] = {};
        return n.each(a.match(E) || [], function (a, c) {
            b[c] = !0;
        }), b;
    }

    n.Callbacks = function (a) {
        a = "string" == typeof a ? F[a] || G(a) : n.extend({}, a);
        var b, c, d, e, f, g, h = [], i = !a.once && [], j = function (l) {
            for (b = a.memory && l, c = !0, g = e || 0, e = 0, f = h.length, d = !0; h && f > g; g++) if (h[g].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
                b = !1;
                break;
            }
            d = !1, h && (i ? i.length && j(i.shift()) : b ? h = [] : k.disable());
        }, k = {
            add: function () {
                if (h) {
                    var c = h.length;
                    !function g(b) {
                        n.each(b, function (b, c) {
                            var d = n.type(c);
                            "function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && g(c);
                        });
                    }(arguments), d ? f = h.length : b && (e = c, j(b));
                }
                return this;
            }, remove: function () {
                return h && n.each(arguments, function (a, b) {
                    var c;
                    while ((c = n.inArray(b, h, c)) > -1) h.splice(c, 1), d && (f >= c && f--, g >= c && g--);
                }), this;
            }, has: function (a) {
                return a ? n.inArray(a, h) > -1 : !(!h || !h.length);
            }, empty: function () {
                return h = [], f = 0, this;
            }, disable: function () {
                return h = i = b = void 0, this;
            }, disabled: function () {
                return !h;
            }, lock: function () {
                return i = void 0, b || k.disable(), this;
            }, locked: function () {
                return !i;
            }, fireWith: function (a, b) {
                return !h || c && !i || (b = b || [], b = [a, b.slice ? b.slice() : b], d ? i.push(b) : j(b)), this;
            }, fire: function () {
                return k.fireWith(this, arguments), this;
            }, fired: function () {
                return !!c;
            }
        };
        return k;
    }, n.extend({
        Deferred: function (a) {
            var b = [["resolve", "done", n.Callbacks("once memory"), "resolved"], ["reject", "fail", n.Callbacks("once memory"), "rejected"], ["notify", "progress", n.Callbacks("memory")]],
                c = "pending", d = {
                    state: function () {
                        return c;
                    }, always: function () {
                        return e.done(arguments).fail(arguments), this;
                    }, then: function () {
                        var a = arguments;
                        return n.Deferred(function (c) {
                            n.each(b, function (b, f) {
                                var g = n.isFunction(a[b]) && a[b];
                                e[f[1]](function () {
                                    var a = g && g.apply(this, arguments);
                                    a && n.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments);
                                });
                            }), a = null;
                        }).promise();
                    }, promise: function (a) {
                        return null != a ? n.extend(a, d) : d;
                    }
                }, e = {};
            return d.pipe = d.then, n.each(b, function (a, f) {
                var g = f[2], h = f[3];
                d[f[1]] = g.add, h && g.add(function () {
                    c = h;
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function () {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this;
                }, e[f[0] + "With"] = g.fireWith;
            }), d.promise(e), a && a.call(e, e), e;
        }, when: function (a) {
            var b = 0, c = d.call(arguments), e = c.length, f = 1 !== e || a && n.isFunction(a.promise) ? e : 0,
                g = 1 === f ? a : n.Deferred(), h = function (a, b, c) {
                    return function (e) {
                        b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c);
                    };
                }, i, j, k;
            if (e > 1) for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++) c[b] && n.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
            return f || g.resolveWith(k, c), g.promise();
        }
    });
    var H;
    n.fn.ready = function (a) {
        return n.ready.promise().done(a), this;
    }, n.extend({
        isReady: !1, readyWait: 1, holdReady: function (a) {
            a ? n.readyWait++ : n.ready(!0);
        }, ready: function (a) {
            (a === !0 ? --n.readyWait : n.isReady) || (n.isReady = !0, a !== !0 && --n.readyWait > 0 || (H.resolveWith(l, [n]), n.fn.triggerHandler && (n(l).triggerHandler("ready"), n(l).off("ready"))));
        }
    });

    function I() {
        l.removeEventListener("DOMContentLoaded", I, !1), a.removeEventListener("load", I, !1), n.ready();
    }

    n.ready.promise = function (b) {
        return H || (H = n.Deferred(), "complete" === l.readyState ? setTimeout(n.ready) : (l.addEventListener("DOMContentLoaded", I, !1), a.addEventListener("load", I, !1))), H.promise(b);
    }, n.ready.promise();
    var J = n.access = function (a, b, c, d, e, f, g) {
        var h = 0, i = a.length, j = null == c;
        if ("object" === n.type(c)) {
            e = !0;
            for (h in c) n.access(a, b, h, c[h], !0, f, g);
        } else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function (a, b, c) {
                return j.call(n(a), c);
            })), b)) for (; i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
        return e ? a : j ? b.call(a) : i ? b(a[0], c) : f;
    };
    n.acceptData = function (a) {
        return 1 === a.nodeType || 9 === a.nodeType || !+a.nodeType;
    };

    function K() {
        Object.defineProperty(this.cache = {}, 0, {
            get: function () {
                return {};
            }
        }), this.expando = n.expando + K.uid++;
    }

    K.uid = 1, K.accepts = n.acceptData, K.prototype = {
        key: function (a) {
            if (!K.accepts(a)) return 0;
            var b = {}, c = a[this.expando];
            if (!c) {
                c = K.uid++;
                try {
                    b[this.expando] = {value: c}, Object.defineProperties(a, b);
                } catch (d) {
                    b[this.expando] = c, n.extend(a, b);
                }
            }
            return this.cache[c] || (this.cache[c] = {}), c;
        }, set: function (a, b, c) {
            var d, e = this.key(a), f = this.cache[e];
            if ("string" == typeof b) f[b] = c; else if (n.isEmptyObject(f)) n.extend(this.cache[e], b); else for (d in b) f[d] = b[d];
            return f;
        }, get: function (a, b) {
            var c = this.cache[this.key(a)];
            return void 0 === b ? c : c[b];
        }, access: function (a, b, c) {
            var d;
            return void 0 === b || b && "string" == typeof b && void 0 === c ? (d = this.get(a, b), void 0 !== d ? d : this.get(a, n.camelCase(b))) : (this.set(a, b, c), void 0 !== c ? c : b);
        }, remove: function (a, b) {
            var c, d, e, f = this.key(a), g = this.cache[f];
            if (void 0 === b) this.cache[f] = {}; else {
                n.isArray(b) ? d = b.concat(b.map(n.camelCase)) : (e = n.camelCase(b), b in g ? d = [b, e] : (d = e, d = d in g ? [d] : d.match(E) || [])), c = d.length;
                while (c--) delete g[d[c]];
            }
        }, hasData: function (a) {
            return !n.isEmptyObject(this.cache[a[this.expando]] || {});
        }, discard: function (a) {
            a[this.expando] && delete this.cache[a[this.expando]];
        }
    };
    var L = new K, M = new K, N = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, O = /([A-Z])/g;

    function P(a, b, c) {
        var d;
        if (void 0 === c && 1 === a.nodeType) if (d = "data-" + b.replace(O, "-$1").toLowerCase(), c = a.getAttribute(d), "string" == typeof c) {
            try {
                c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : N.test(c) ? n.parseJSON(c) : c;
            } catch (e) {
            }
            M.set(a, b, c);
        } else c = void 0;
        return c;
    }

    n.extend({
        hasData: function (a) {
            return M.hasData(a) || L.hasData(a);
        }, data: function (a, b, c) {
            return M.access(a, b, c);
        }, removeData: function (a, b) {
            M.remove(a, b);
        }, _data: function (a, b, c) {
            return L.access(a, b, c);
        }, _removeData: function (a, b) {
            L.remove(a, b);
        }
    }), n.fn.extend({
        data: function (a, b) {
            var c, d, e, f = this[0], g = f && f.attributes;
            if (void 0 === a) {
                if (this.length && (e = M.get(f), 1 === f.nodeType && !L.get(f, "hasDataAttrs"))) {
                    c = g.length;
                    while (c--) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), P(f, d, e[d])));
                    L.set(f, "hasDataAttrs", !0);
                }
                return e;
            }
            return "object" == typeof a ? this.each(function () {
                M.set(this, a);
            }) : J(this, function (b) {
                var c, d = n.camelCase(a);
                if (f && void 0 === b) {
                    if (c = M.get(f, a), void 0 !== c) return c;
                    if (c = M.get(f, d), void 0 !== c) return c;
                    if (c = P(f, d, void 0), void 0 !== c) return c;
                } else this.each(function () {
                    var c = M.get(this, d);
                    M.set(this, d, b), -1 !== a.indexOf("-") && void 0 !== c && M.set(this, a, b);
                });
            }, null, b, arguments.length > 1, null, !0);
        }, removeData: function (a) {
            return this.each(function () {
                M.remove(this, a);
            });
        }
    }), n.extend({
        queue: function (a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = L.get(a, b), c && (!d || n.isArray(c) ? d = L.access(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0;
        }, dequeue: function (a, b) {
            b = b || "fx";
            var c = n.queue(a, b), d = c.length, e = c.shift(), f = n._queueHooks(a, b), g = function () {
                n.dequeue(a, b);
            };
            "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire();
        }, _queueHooks: function (a, b) {
            var c = b + "queueHooks";
            return L.get(a, c) || L.access(a, c, {
                empty: n.Callbacks("once memory").add(function () {
                    L.remove(a, [b + "queue", c]);
                })
            });
        }
    }), n.fn.extend({
        queue: function (a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this : this.each(function () {
                var c = n.queue(this, a, b);
                n._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a);
            });
        }, dequeue: function (a) {
            return this.each(function () {
                n.dequeue(this, a);
            });
        }, clearQueue: function (a) {
            return this.queue(a || "fx", []);
        }, promise: function (a, b) {
            var c, d = 1, e = n.Deferred(), f = this, g = this.length, h = function () {
                --d || e.resolveWith(f, [f]);
            };
            "string" != typeof a && (b = a, a = void 0), a = a || "fx";
            while (g--) c = L.get(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
            return h(), e.promise(b);
        }
    });
    var Q = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, R = ["Top", "Right", "Bottom", "Left"], S = function (a, b) {
        return a = b || a, "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a);
    }, T = /^(?:checkbox|radio)$/i;
    !function () {
        var a = l.createDocumentFragment(), b = a.appendChild(l.createElement("div")), c = l.createElement("input");
        c.setAttribute("type", "radio"), c.setAttribute("checked", "checked"), c.setAttribute("name", "t"), b.appendChild(c), k.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, b.innerHTML = "<textarea>x</textarea>", k.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue;
    }();
    var U = "undefined";
    k.focusinBubbles = "onfocusin" in a;
    var V = /^key/, W = /^(?:mouse|pointer|contextmenu)|click/, X = /^(?:focusinfocus|focusoutblur)$/,
        Y = /^([^.]*)(?:\.(.+)|)$/;

    function Z() {
        return !0;
    }

    function $() {
        return !1;
    }

    function _() {
        try {
            return l.activeElement;
        } catch (a) {
        }
    }

    n.event = {
        global: {},
        add: function (a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = L.get(a);
            if (r) {
                c.handler && (f = c, c = f.handler, e = f.selector), c.guid || (c.guid = n.guid++), (i = r.events) || (i = r.events = {}), (g = r.handle) || (g = r.handle = function (b) {
                    return typeof n !== U && n.event.triggered !== b.type ? n.event.dispatch.apply(a, arguments) : void 0;
                }), b = (b || "").match(E) || [""], j = b.length;
                while (j--) h = Y.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o && (l = n.event.special[o] || {}, o = (e ? l.delegateType : l.bindType) || o, l = n.event.special[o] || {}, k = n.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && n.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                }, f), (m = i[o]) || (m = i[o] = [], m.delegateCount = 0, l.setup && l.setup.call(a, d, p, g) !== !1 || a.addEventListener && a.addEventListener(o, g, !1)), l.add && (l.add.call(a, k), k.handler.guid || (k.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, k) : m.push(k), n.event.global[o] = !0);
            }
        },
        remove: function (a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = L.hasData(a) && L.get(a);
            if (r && (i = r.events)) {
                b = (b || "").match(E) || [""], j = b.length;
                while (j--) if (h = Y.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                    l = n.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, m = i[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), g = f = m.length;
                    while (f--) k = m[f], !e && q !== k.origType || c && c.guid !== k.guid || h && !h.test(k.namespace) || d && d !== k.selector && ("**" !== d || !k.selector) || (m.splice(f, 1), k.selector && m.delegateCount--, l.remove && l.remove.call(a, k));
                    g && !m.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || n.removeEvent(a, o, r.handle), delete i[o]);
                } else for (o in i) n.event.remove(a, o + b[j], c, d, !0);
                n.isEmptyObject(i) && (delete r.handle, L.remove(a, "events"));
            }
        },
        trigger: function (b, c, d, e) {
            var f, g, h, i, k, m, o, p = [d || l], q = j.call(b, "type") ? b.type : b,
                r = j.call(b, "namespace") ? b.namespace.split(".") : [];
            if (g = h = d = d || l, 3 !== d.nodeType && 8 !== d.nodeType && !X.test(q + n.event.triggered) && (q.indexOf(".") >= 0 && (r = q.split("."), q = r.shift(), r.sort()), k = q.indexOf(":") < 0 && "on" + q, b = b[n.expando] ? b : new n.Event(q, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = r.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + r.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : n.makeArray(c, [b]), o = n.event.special[q] || {}, e || !o.trigger || o.trigger.apply(d, c) !== !1)) {
                if (!e && !o.noBubble && !n.isWindow(d)) {
                    for (i = o.delegateType || q, X.test(i + q) || (g = g.parentNode); g; g = g.parentNode) p.push(g), h = g;
                    h === (d.ownerDocument || l) && p.push(h.defaultView || h.parentWindow || a);
                }
                f = 0;
                while ((g = p[f++]) && !b.isPropagationStopped()) b.type = f > 1 ? i : o.bindType || q, m = (L.get(g, "events") || {})[b.type] && L.get(g, "handle"), m && m.apply(g, c), m = k && g[k], m && m.apply && n.acceptData(g) && (b.result = m.apply(g, c), b.result === !1 && b.preventDefault());
                return b.type = q, e || b.isDefaultPrevented() || o._default && o._default.apply(p.pop(), c) !== !1 || !n.acceptData(d) || k && n.isFunction(d[q]) && !n.isWindow(d) && (h = d[k], h && (d[k] = null), n.event.triggered = q, d[q](), n.event.triggered = void 0, h && (d[k] = h)), b.result;
            }
        },
        dispatch: function (a) {
            a = n.event.fix(a);
            var b, c, e, f, g, h = [], i = d.call(arguments), j = (L.get(this, "events") || {})[a.type] || [],
                k = n.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
                h = n.event.handlers.call(this, a, j), b = 0;
                while ((f = h[b++]) && !a.isPropagationStopped()) {
                    a.currentTarget = f.elem, c = 0;
                    while ((g = f.handlers[c++]) && !a.isImmediatePropagationStopped()) (!a.namespace_re || a.namespace_re.test(g.namespace)) && (a.handleObj = g, a.data = g.data, e = ((n.event.special[g.origType] || {}).handle || g.handler).apply(f.elem, i), void 0 !== e && (a.result = e) === !1 && (a.preventDefault(), a.stopPropagation()));
                }
                return k.postDispatch && k.postDispatch.call(this, a), a.result;
            }
        },
        handlers: function (a, b) {
            var c, d, e, f, g = [], h = b.delegateCount, i = a.target;
            if (h && i.nodeType && (!a.button || "click" !== a.type)) for (; i !== this; i = i.parentNode || this) if (i.disabled !== !0 || "click" !== a.type) {
                for (d = [], c = 0; h > c; c++) f = b[c], e = f.selector + " ", void 0 === d[e] && (d[e] = f.needsContext ? n(e, this).index(i) >= 0 : n.find(e, this, null, [i]).length), d[e] && d.push(f);
                d.length && g.push({elem: i, handlers: d});
            }
            return h < b.length && g.push({elem: this, handlers: b.slice(h)}), g;
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "), filter: function (a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a;
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (a, b) {
                var c, d, e, f = b.button;
                return null == a.pageX && null != b.clientX && (c = a.target.ownerDocument || l, d = c.documentElement, e = c.body, a.pageX = b.clientX + (d && d.scrollLeft || e && e.scrollLeft || 0) - (d && d.clientLeft || e && e.clientLeft || 0), a.pageY = b.clientY + (d && d.scrollTop || e && e.scrollTop || 0) - (d && d.clientTop || e && e.clientTop || 0)), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a;
            }
        },
        fix: function (a) {
            if (a[n.expando]) return a;
            var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
            g || (this.fixHooks[e] = g = W.test(e) ? this.mouseHooks : V.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new n.Event(f), b = d.length;
            while (b--) c = d[b], a[c] = f[c];
            return a.target || (a.target = l), 3 === a.target.nodeType && (a.target = a.target.parentNode), g.filter ? g.filter(a, f) : a;
        },
        special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    return this !== _() && this.focus ? (this.focus(), !1) : void 0;
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    return this === _() && this.blur ? (this.blur(), !1) : void 0;
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    return "checkbox" === this.type && this.click && n.nodeName(this, "input") ? (this.click(), !1) : void 0;
                }, _default: function (a) {
                    return n.nodeName(a.target, "a");
                }
            }, beforeunload: {
                postDispatch: function (a) {
                    void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result);
                }
            }
        },
        simulate: function (a, b, c, d) {
            var e = n.extend(new n.Event, c, {type: a, isSimulated: !0, originalEvent: {}});
            d ? n.event.trigger(e, null, b) : n.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault();
        }
    }, n.removeEvent = function (a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c, !1);
    }, n.Event = function (a, b) {
        return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && a.returnValue === !1 ? Z : $) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b);
    }, n.Event.prototype = {
        isDefaultPrevented: $,
        isPropagationStopped: $,
        isImmediatePropagationStopped: $,
        preventDefault: function () {
            var a = this.originalEvent;
            this.isDefaultPrevented = Z, a && a.preventDefault && a.preventDefault();
        },
        stopPropagation: function () {
            var a = this.originalEvent;
            this.isPropagationStopped = Z, a && a.stopPropagation && a.stopPropagation();
        },
        stopImmediatePropagation: function () {
            var a = this.originalEvent;
            this.isImmediatePropagationStopped = Z, a && a.stopImmediatePropagation && a.stopImmediatePropagation(), this.stopPropagation();
        }
    }, n.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (a, b) {
        n.event.special[a] = {
            delegateType: b, bindType: b, handle: function (a) {
                var c, d = this, e = a.relatedTarget, f = a.handleObj;
                return (!e || e !== d && !n.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c;
            }
        };
    }), k.focusinBubbles || n.each({focus: "focusin", blur: "focusout"}, function (a, b) {
        var c = function (a) {
            n.event.simulate(b, a.target, n.event.fix(a), !0);
        };
        n.event.special[b] = {
            setup: function () {
                var d = this.ownerDocument || this, e = L.access(d, b);
                e || d.addEventListener(a, c, !0), L.access(d, b, (e || 0) + 1);
            }, teardown: function () {
                var d = this.ownerDocument || this, e = L.access(d, b) - 1;
                e ? L.access(d, b, e) : (d.removeEventListener(a, c, !0), L.remove(d, b));
            }
        };
    }), n.fn.extend({
        on: function (a, b, c, d, e) {
            var f, g;
            if ("object" == typeof a) {
                "string" != typeof b && (c = c || b, b = void 0);
                for (g in a) this.on(g, b, c, a[g], e);
                return this;
            }
            if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1) d = $; else if (!d) return this;
            return 1 === e && (f = d, d = function (a) {
                return n().off(a), f.apply(this, arguments);
            }, d.guid = f.guid || (f.guid = n.guid++)), this.each(function () {
                n.event.add(this, a, d, c, b);
            });
        }, one: function (a, b, c, d) {
            return this.on(a, b, c, d, 1);
        }, off: function (a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj, n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this;
            }
            return (b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = $), this.each(function () {
                n.event.remove(this, a, c, b);
            });
        }, trigger: function (a, b) {
            return this.each(function () {
                n.event.trigger(a, b, this);
            });
        }, triggerHandler: function (a, b) {
            var c = this[0];
            return c ? n.event.trigger(a, b, c, !0) : void 0;
        }
    });
    var aa = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, ba = /<([\w:]+)/,
        ca = /<|&#?\w+;/, da = /<(?:script|style|link)/i, ea = /checked\s*(?:[^=]|=\s*.checked.)/i,
        fa = /^$|\/(?:java|ecma)script/i, ga = /^true\/(.*)/, ha = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, ia = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
    ia.optgroup = ia.option, ia.tbody = ia.tfoot = ia.colgroup = ia.caption = ia.thead, ia.th = ia.td;

    function ja(a, b) {
        return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a;
    }

    function ka(a) {
        return a.type = (null !== a.getAttribute("type")) + "/" + a.type, a;
    }

    function la(a) {
        var b = ga.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"), a;
    }

    function ma(a, b) {
        for (var c = 0, d = a.length; d > c; c++) L.set(a[c], "globalEval", !b || L.get(b[c], "globalEval"));
    }

    function na(a, b) {
        var c, d, e, f, g, h, i, j;
        if (1 === b.nodeType) {
            if (L.hasData(a) && (f = L.access(a), g = L.set(b, f), j = f.events)) {
                delete g.handle, g.events = {};
                for (e in j) for (c = 0, d = j[e].length; d > c; c++) n.event.add(b, e, j[e][c]);
            }
            M.hasData(a) && (h = M.access(a), i = n.extend({}, h), M.set(b, i));
        }
    }

    function oa(a, b) {
        var c = a.getElementsByTagName ? a.getElementsByTagName(b || "*") : a.querySelectorAll ? a.querySelectorAll(b || "*") : [];
        return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], c) : c;
    }

    function pa(a, b) {
        var c = b.nodeName.toLowerCase();
        "input" === c && T.test(a.type) ? b.checked = a.checked : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue);
    }

    n.extend({
        clone: function (a, b, c) {
            var d, e, f, g, h = a.cloneNode(!0), i = n.contains(a.ownerDocument, a);
            if (!(k.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a))) for (g = oa(h), f = oa(a), d = 0, e = f.length; e > d; d++) pa(f[d], g[d]);
            if (b) if (c) for (f = f || oa(a), g = g || oa(h), d = 0, e = f.length; e > d; d++) na(f[d], g[d]); else na(a, h);
            return g = oa(h, "script"), g.length > 0 && ma(g, !i && oa(a, "script")), h;
        }, buildFragment: function (a, b, c, d) {
            for (var e, f, g, h, i, j, k = b.createDocumentFragment(), l = [], m = 0, o = a.length; o > m; m++) if (e = a[m], e || 0 === e) if ("object" === n.type(e)) n.merge(l, e.nodeType ? [e] : e); else if (ca.test(e)) {
                f = f || k.appendChild(b.createElement("div")), g = (ba.exec(e) || ["", ""])[1].toLowerCase(), h = ia[g] || ia._default, f.innerHTML = h[1] + e.replace(aa, "<$1></$2>") + h[2], j = h[0];
                while (j--) f = f.lastChild;
                n.merge(l, f.childNodes), f = k.firstChild, f.textContent = "";
            } else l.push(b.createTextNode(e));
            k.textContent = "", m = 0;
            while (e = l[m++]) if ((!d || -1 === n.inArray(e, d)) && (i = n.contains(e.ownerDocument, e), f = oa(k.appendChild(e), "script"), i && ma(f), c)) {
                j = 0;
                while (e = f[j++]) fa.test(e.type || "") && c.push(e);
            }
            return k;
        }, cleanData: function (a) {
            for (var b, c, d, e, f = n.event.special, g = 0; void 0 !== (c = a[g]); g++) {
                if (n.acceptData(c) && (e = c[L.expando], e && (b = L.cache[e]))) {
                    if (b.events) for (d in b.events) f[d] ? n.event.remove(c, d) : n.removeEvent(c, d, b.handle);
                    L.cache[e] && delete L.cache[e];
                }
                delete M.cache[c[M.expando]];
            }
        }
    }), n.fn.extend({
        text: function (a) {
            return J(this, function (a) {
                return void 0 === a ? n.text(this) : this.empty().each(function () {
                    (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && (this.textContent = a);
                });
            }, null, a, arguments.length);
        }, append: function () {
            return this.domManip(arguments, function (a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = ja(this, a);
                    b.appendChild(a);
                }
            });
        }, prepend: function () {
            return this.domManip(arguments, function (a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = ja(this, a);
                    b.insertBefore(a, b.firstChild);
                }
            });
        }, before: function () {
            return this.domManip(arguments, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this);
            });
        }, after: function () {
            return this.domManip(arguments, function (a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling);
            });
        }, remove: function (a, b) {
            for (var c, d = a ? n.filter(a, this) : this, e = 0; null != (c = d[e]); e++) b || 1 !== c.nodeType || n.cleanData(oa(c)), c.parentNode && (b && n.contains(c.ownerDocument, c) && ma(oa(c, "script")), c.parentNode.removeChild(c));
            return this;
        }, empty: function () {
            for (var a, b = 0; null != (a = this[b]); b++) 1 === a.nodeType && (n.cleanData(oa(a, !1)), a.textContent = "");
            return this;
        }, clone: function (a, b) {
            return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function () {
                return n.clone(this, a, b);
            });
        }, html: function (a) {
            return J(this, function (a) {
                var b = this[0] || {}, c = 0, d = this.length;
                if (void 0 === a && 1 === b.nodeType) return b.innerHTML;
                if ("string" == typeof a && !da.test(a) && !ia[(ba.exec(a) || ["", ""])[1].toLowerCase()]) {
                    a = a.replace(aa, "<$1></$2>");
                    try {
                        for (; d > c; c++) b = this[c] || {}, 1 === b.nodeType && (n.cleanData(oa(b, !1)), b.innerHTML = a);
                        b = 0;
                    } catch (e) {
                    }
                }
                b && this.empty().append(a);
            }, null, a, arguments.length);
        }, replaceWith: function () {
            var a = arguments[0];
            return this.domManip(arguments, function (b) {
                a = this.parentNode, n.cleanData(oa(this)), a && a.replaceChild(b, this);
            }), a && (a.length || a.nodeType) ? this : this.remove();
        }, detach: function (a) {
            return this.remove(a, !0);
        }, domManip: function (a, b) {
            a = e.apply([], a);
            var c, d, f, g, h, i, j = 0, l = this.length, m = this, o = l - 1, p = a[0], q = n.isFunction(p);
            if (q || l > 1 && "string" == typeof p && !k.checkClone && ea.test(p)) return this.each(function (c) {
                var d = m.eq(c);
                q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b);
            });
            if (l && (c = n.buildFragment(a, this[0].ownerDocument, !1, this), d = c.firstChild, 1 === c.childNodes.length && (c = d), d)) {
                for (f = n.map(oa(c, "script"), ka), g = f.length; l > j; j++) h = c, j !== o && (h = n.clone(h, !0, !0), g && n.merge(f, oa(h, "script"))), b.call(this[j], h, j);
                if (g) for (i = f[f.length - 1].ownerDocument, n.map(f, la), j = 0; g > j; j++) h = f[j], fa.test(h.type || "") && !L.access(h, "globalEval") && n.contains(i, h) && (h.src ? n._evalUrl && n._evalUrl(h.src) : n.globalEval(h.textContent.replace(ha, "")));
            }
            return this;
        }
    }), n.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (a, b) {
        n.fn[a] = function (a) {
            for (var c, d = [], e = n(a), g = e.length - 1, h = 0; g >= h; h++) c = h === g ? this : this.clone(!0), n(e[h])[b](c), f.apply(d, c.get());
            return this.pushStack(d);
        };
    });
    var qa, ra = {};

    function sa(b, c) {
        var d, e = n(c.createElement(b)).appendTo(c.body),
            f = a.getDefaultComputedStyle && (d = a.getDefaultComputedStyle(e[0])) ? d.display : n.css(e[0], "display");
        return e.detach(), f;
    }

    function ta(a) {
        var b = l, c = ra[a];
        return c || (c = sa(a, b), "none" !== c && c || (qa = (qa || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = qa[0].contentDocument, b.write(), b.close(), c = sa(a, b), qa.detach()), ra[a] = c), c;
    }

    var ua = /^margin/, va = new RegExp("^(" + Q + ")(?!px)[a-z%]+$", "i"), wa = function (b) {
        return b.ownerDocument.defaultView.opener ? b.ownerDocument.defaultView.getComputedStyle(b, null) : a.getComputedStyle(b, null);
    };

    function xa(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || wa(a), c && (g = c.getPropertyValue(b) || c[b]), c && ("" !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), va.test(g) && ua.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 !== g ? g + "" : g;
    }

    function ya(a, b) {
        return {
            get: function () {
                return a() ? void delete this.get : (this.get = b).apply(this, arguments);
            }
        };
    }

    !function () {
        var b, c, d = l.documentElement, e = l.createElement("div"), f = l.createElement("div");
        if (f.style) {
            f.style.backgroundClip = "content-box", f.cloneNode(!0).style.backgroundClip = "", k.clearCloneStyle = "content-box" === f.style.backgroundClip, e.style.cssText = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute", e.appendChild(f);

            function g() {
                f.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", f.innerHTML = "", d.appendChild(e);
                var g = a.getComputedStyle(f, null);
                b = "1%" !== g.top, c = "4px" === g.width, d.removeChild(e);
            }

            a.getComputedStyle && n.extend(k, {
                pixelPosition: function () {
                    return g(), b;
                }, boxSizingReliable: function () {
                    return null == c && g(), c;
                }, reliableMarginRight: function () {
                    var b, c = f.appendChild(l.createElement("div"));
                    return c.style.cssText = f.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", c.style.marginRight = c.style.width = "0", f.style.width = "1px", d.appendChild(e), b = !parseFloat(a.getComputedStyle(c, null).marginRight), d.removeChild(e), f.removeChild(c), b;
                }
            });
        }
    }(), n.swap = function (a, b, c, d) {
        var e, f, g = {};
        for (f in b) g[f] = a.style[f], a.style[f] = b[f];
        e = c.apply(a, d || []);
        for (f in b) a.style[f] = g[f];
        return e;
    };
    var za = /^(none|table(?!-c[ea]).+)/, Aa = new RegExp("^(" + Q + ")(.*)$", "i"),
        Ba = new RegExp("^([+-])=(" + Q + ")", "i"),
        Ca = {position: "absolute", visibility: "hidden", display: "block"},
        Da = {letterSpacing: "0", fontWeight: "400"}, Ea = ["Webkit", "O", "Moz", "ms"];

    function Fa(a, b) {
        if (b in a) return b;
        var c = b[0].toUpperCase() + b.slice(1), d = b, e = Ea.length;
        while (e--) if (b = Ea[e] + c, b in a) return b;
        return d;
    }

    function Ga(a, b, c) {
        var d = Aa.exec(b);
        return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b;
    }

    function Ha(a, b, c, d, e) {
        for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += n.css(a, c + R[f], !0, e)), d ? ("content" === c && (g -= n.css(a, "padding" + R[f], !0, e)), "margin" !== c && (g -= n.css(a, "border" + R[f] + "Width", !0, e))) : (g += n.css(a, "padding" + R[f], !0, e), "padding" !== c && (g += n.css(a, "border" + R[f] + "Width", !0, e)));
        return g;
    }

    function Ia(a, b, c) {
        var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = wa(a),
            g = "border-box" === n.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = xa(a, b, f), (0 > e || null == e) && (e = a.style[b]), va.test(e)) return e;
            d = g && (k.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0;
        }
        return e + Ha(a, b, c || (g ? "border" : "content"), d, f) + "px";
    }

    function Ja(a, b) {
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = L.get(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && S(d) && (f[g] = L.access(d, "olddisplay", ta(d.nodeName)))) : (e = S(d), "none" === c && e || L.set(d, "olddisplay", e ? c : n.css(d, "display"))));
        for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
        return a;
    }

    n.extend({
        cssHooks: {
            opacity: {
                get: function (a, b) {
                    if (b) {
                        var c = xa(a, "opacity");
                        return "" === c ? "1" : c;
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {"float": "cssFloat"},
        style: function (a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = n.camelCase(b), i = a.style;
                return b = n.cssProps[h] || (n.cssProps[h] = Fa(i, h)), g = n.cssHooks[b] || n.cssHooks[h], void 0 === c ? g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b] : (f = typeof c, "string" === f && (e = Ba.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(n.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || n.cssNumber[h] || (c += "px"), k.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), g && "set" in g && void 0 === (c = g.set(a, c, d)) || (i[b] = c)), void 0);
            }
        },
        css: function (a, b, c, d) {
            var e, f, g, h = n.camelCase(b);
            return b = n.cssProps[h] || (n.cssProps[h] = Fa(a.style, h)), g = n.cssHooks[b] || n.cssHooks[h], g && "get" in g && (e = g.get(a, !0, c)), void 0 === e && (e = xa(a, b, d)), "normal" === e && b in Da && (e = Da[b]), "" === c || c ? (f = parseFloat(e), c === !0 || n.isNumeric(f) ? f || 0 : e) : e;
        }
    }), n.each(["height", "width"], function (a, b) {
        n.cssHooks[b] = {
            get: function (a, c, d) {
                return c ? za.test(n.css(a, "display")) && 0 === a.offsetWidth ? n.swap(a, Ca, function () {
                    return Ia(a, b, d);
                }) : Ia(a, b, d) : void 0;
            }, set: function (a, c, d) {
                var e = d && wa(a);
                return Ga(a, c, d ? Ha(a, b, d, "border-box" === n.css(a, "boxSizing", !1, e), e) : 0);
            }
        };
    }), n.cssHooks.marginRight = ya(k.reliableMarginRight, function (a, b) {
        return b ? n.swap(a, {display: "inline-block"}, xa, [a, "marginRight"]) : void 0;
    }), n.each({margin: "", padding: "", border: "Width"}, function (a, b) {
        n.cssHooks[a + b] = {
            expand: function (c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + R[d] + b] = f[d] || f[d - 2] || f[0];
                return e;
            }
        }, ua.test(a) || (n.cssHooks[a + b].set = Ga);
    }), n.fn.extend({
        css: function (a, b) {
            return J(this, function (a, b, c) {
                var d, e, f = {}, g = 0;
                if (n.isArray(b)) {
                    for (d = wa(a), e = b.length; e > g; g++) f[b[g]] = n.css(a, b[g], !1, d);
                    return f;
                }
                return void 0 !== c ? n.style(a, b, c) : n.css(a, b);
            }, a, b, arguments.length > 1);
        }, show: function () {
            return Ja(this, !0);
        }, hide: function () {
            return Ja(this);
        }, toggle: function (a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function () {
                S(this) ? n(this).show() : n(this).hide();
            });
        }
    });

    function Ka(a, b, c, d, e) {
        return new Ka.prototype.init(a, b, c, d, e);
    }

    n.Tween = Ka, Ka.prototype = {
        constructor: Ka, init: function (a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (n.cssNumber[c] ? "" : "px");
        }, cur: function () {
            var a = Ka.propHooks[this.prop];
            return a && a.get ? a.get(this) : Ka.propHooks._default.get(this);
        }, run: function (a) {
            var b, c = Ka.propHooks[this.prop];
            return this.options.duration ? this.pos = b = n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Ka.propHooks._default.set(this), this;
        }
    }, Ka.prototype.init.prototype = Ka.prototype, Ka.propHooks = {
        _default: {
            get: function (a) {
                var b;
                return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = n.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop];
            }, set: function (a) {
                n.fx.step[a.prop] ? n.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[n.cssProps[a.prop]] || n.cssHooks[a.prop]) ? n.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now;
            }
        }
    }, Ka.propHooks.scrollTop = Ka.propHooks.scrollLeft = {
        set: function (a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now);
        }
    }, n.easing = {
        linear: function (a) {
            return a;
        }, swing: function (a) {
            return .5 - Math.cos(a * Math.PI) / 2;
        }
    }, n.fx = Ka.prototype.init, n.fx.step = {};
    var La, Ma, Na = /^(?:toggle|show|hide)$/, Oa = new RegExp("^(?:([+-])=|)(" + Q + ")([a-z%]*)$", "i"),
        Pa = /queueHooks$/, Qa = [Va], Ra = {
            "*": [function (a, b) {
                var c = this.createTween(a, b), d = c.cur(), e = Oa.exec(b), f = e && e[3] || (n.cssNumber[a] ? "" : "px"),
                    g = (n.cssNumber[a] || "px" !== f && +d) && Oa.exec(n.css(c.elem, a)), h = 1, i = 20;
                if (g && g[3] !== f) {
                    f = f || g[3], e = e || [], g = +d || 1;
                    do h = h || ".5", g /= h, n.style(c.elem, a, g + f); while (h !== (h = c.cur() / d) && 1 !== h && --i);
                }
                return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c;
            }]
        };

    function Sa() {
        return setTimeout(function () {
            La = void 0;
        }), La = n.now();
    }

    function Ta(a, b) {
        var c, d = 0, e = {height: a};
        for (b = b ? 1 : 0; 4 > d; d += 2 - b) c = R[d], e["margin" + c] = e["padding" + c] = a;
        return b && (e.opacity = e.width = a), e;
    }

    function Ua(a, b, c) {
        for (var d, e = (Ra[b] || []).concat(Ra["*"]), f = 0, g = e.length; g > f; f++) if (d = e[f].call(c, b, a)) return d;
    }

    function Va(a, b, c) {
        var d, e, f, g, h, i, j, k, l = this, m = {}, o = a.style, p = a.nodeType && S(a), q = L.get(a, "fxshow");
        c.queue || (h = n._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function () {
            h.unqueued || i();
        }), h.unqueued++, l.always(function () {
            l.always(function () {
                h.unqueued--, n.queue(a, "fx").length || h.empty.fire();
            });
        })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [o.overflow, o.overflowX, o.overflowY], j = n.css(a, "display"), k = "none" === j ? L.get(a, "olddisplay") || ta(a.nodeName) : j, "inline" === k && "none" === n.css(a, "float") && (o.display = "inline-block")), c.overflow && (o.overflow = "hidden", l.always(function () {
            o.overflow = c.overflow[0], o.overflowX = c.overflow[1], o.overflowY = c.overflow[2];
        }));
        for (d in b) if (e = b[d], Na.exec(e)) {
            if (delete b[d], f = f || "toggle" === e, e === (p ? "hide" : "show")) {
                if ("show" !== e || !q || void 0 === q[d]) continue;
                p = !0;
            }
            m[d] = q && q[d] || n.style(a, d);
        } else j = void 0;
        if (n.isEmptyObject(m)) "inline" === ("none" === j ? ta(a.nodeName) : j) && (o.display = j); else {
            q ? "hidden" in q && (p = q.hidden) : q = L.access(a, "fxshow", {}), f && (q.hidden = !p), p ? n(a).show() : l.done(function () {
                n(a).hide();
            }), l.done(function () {
                var b;
                L.remove(a, "fxshow");
                for (b in m) n.style(a, b, m[b]);
            });
            for (d in m) g = Ua(p ? q[d] : 0, d, l), d in q || (q[d] = g.start, p && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0));
        }
    }

    function Wa(a, b) {
        var c, d, e, f, g;
        for (c in a) if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = n.cssHooks[d], g && "expand" in g) {
            f = g.expand(f), delete a[d];
            for (c in f) c in a || (a[c] = f[c], b[c] = e);
        } else b[d] = e;
    }

    function Xa(a, b, c) {
        var d, e, f = 0, g = Qa.length, h = n.Deferred().always(function () {
            delete i.elem;
        }), i = function () {
            if (e) return !1;
            for (var b = La || Sa(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f);
            return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1);
        }, j = h.promise({
            elem: a,
            props: n.extend({}, b),
            opts: n.extend(!0, {specialEasing: {}}, c),
            originalProperties: b,
            originalOptions: c,
            startTime: La || Sa(),
            duration: c.duration,
            tweens: [],
            createTween: function (b, c) {
                var d = n.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                return j.tweens.push(d), d;
            },
            stop: function (b) {
                var c = 0, d = b ? j.tweens.length : 0;
                if (e) return this;
                for (e = !0; d > c; c++) j.tweens[c].run(1);
                return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this;
            }
        }), k = j.props;
        for (Wa(k, j.opts.specialEasing); g > f; f++) if (d = Qa[f].call(j, a, k, j.opts)) return d;
        return n.map(k, Ua, j), n.isFunction(j.opts.start) && j.opts.start.call(a, j), n.fx.timer(n.extend(i, {
            elem: a,
            anim: j,
            queue: j.opts.queue
        })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always);
    }

    n.Animation = n.extend(Xa, {
        tweener: function (a, b) {
            n.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
            for (var c, d = 0, e = a.length; e > d; d++) c = a[d], Ra[c] = Ra[c] || [], Ra[c].unshift(b);
        }, prefilter: function (a, b) {
            b ? Qa.unshift(a) : Qa.push(a);
        }
    }), n.speed = function (a, b, c) {
        var d = a && "object" == typeof a ? n.extend({}, a) : {
            complete: c || !c && b || n.isFunction(a) && a,
            duration: a,
            easing: c && b || b && !n.isFunction(b) && b
        };
        return d.duration = n.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in n.fx.speeds ? n.fx.speeds[d.duration] : n.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function () {
            n.isFunction(d.old) && d.old.call(this), d.queue && n.dequeue(this, d.queue);
        }, d;
    }, n.fn.extend({
        fadeTo: function (a, b, c, d) {
            return this.filter(S).css("opacity", 0).show().end().animate({opacity: b}, a, c, d);
        }, animate: function (a, b, c, d) {
            var e = n.isEmptyObject(a), f = n.speed(b, c, d), g = function () {
                var b = Xa(this, n.extend({}, a), f);
                (e || L.get(this, "finish")) && b.stop(!0);
            };
            return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g);
        }, stop: function (a, b, c) {
            var d = function (a) {
                var b = a.stop;
                delete a.stop, b(c);
            };
            return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function () {
                var b = !0, e = null != a && a + "queueHooks", f = n.timers, g = L.get(this);
                if (e) g[e] && g[e].stop && d(g[e]); else for (e in g) g[e] && g[e].stop && Pa.test(e) && d(g[e]);
                for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                (b || !c) && n.dequeue(this, a);
            });
        }, finish: function (a) {
            return a !== !1 && (a = a || "fx"), this.each(function () {
                var b, c = L.get(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = n.timers, g = d ? d.length : 0;
                for (c.finish = !0, n.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                delete c.finish;
            });
        }
    }), n.each(["toggle", "show", "hide"], function (a, b) {
        var c = n.fn[b];
        n.fn[b] = function (a, d, e) {
            return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(Ta(b, !0), a, d, e);
        };
    }), n.each({
        slideDown: Ta("show"),
        slideUp: Ta("hide"),
        slideToggle: Ta("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (a, b) {
        n.fn[a] = function (a, c, d) {
            return this.animate(b, a, c, d);
        };
    }), n.timers = [], n.fx.tick = function () {
        var a, b = 0, c = n.timers;
        for (La = n.now(); b < c.length; b++) a = c[b], a() || c[b] !== a || c.splice(b--, 1);
        c.length || n.fx.stop(), La = void 0;
    }, n.fx.timer = function (a) {
        n.timers.push(a), a() ? n.fx.start() : n.timers.pop();
    }, n.fx.interval = 13, n.fx.start = function () {
        Ma || (Ma = setInterval(n.fx.tick, n.fx.interval));
    }, n.fx.stop = function () {
        clearInterval(Ma), Ma = null;
    }, n.fx.speeds = {slow: 600, fast: 200, _default: 400}, n.fn.delay = function (a, b) {
        return a = n.fx ? n.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function (b, c) {
            var d = setTimeout(b, a);
            c.stop = function () {
                clearTimeout(d);
            };
        });
    }, function () {
        var a = l.createElement("input"), b = l.createElement("select"), c = b.appendChild(l.createElement("option"));
        a.type = "checkbox", k.checkOn = "" !== a.value, k.optSelected = c.selected, b.disabled = !0, k.optDisabled = !c.disabled, a = l.createElement("input"), a.value = "t", a.type = "radio", k.radioValue = "t" === a.value;
    }();
    var Ya, Za, $a = n.expr.attrHandle;
    n.fn.extend({
        attr: function (a, b) {
            return J(this, n.attr, a, b, arguments.length > 1);
        }, removeAttr: function (a) {
            return this.each(function () {
                n.removeAttr(this, a);
            });
        }
    }), n.extend({
        attr: function (a, b, c) {
            var d, e, f = a.nodeType;
            if (a && 3 !== f && 8 !== f && 2 !== f) return typeof a.getAttribute === U ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), d = n.attrHooks[b] || (n.expr.match.bool.test(b) ? Za : Ya)),
                void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = n.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void n.removeAttr(a, b));
        }, removeAttr: function (a, b) {
            var c, d, e = 0, f = b && b.match(E);
            if (f && 1 === a.nodeType) while (c = f[e++]) d = n.propFix[c] || c, n.expr.match.bool.test(c) && (a[d] = !1), a.removeAttribute(c);
        }, attrHooks: {
            type: {
                set: function (a, b) {
                    if (!k.radioValue && "radio" === b && n.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b), c && (a.value = c), b;
                    }
                }
            }
        }
    }), Za = {
        set: function (a, b, c) {
            return b === !1 ? n.removeAttr(a, c) : a.setAttribute(c, c), c;
        }
    }, n.each(n.expr.match.bool.source.match(/\w+/g), function (a, b) {
        var c = $a[b] || n.find.attr;
        $a[b] = function (a, b, d) {
            var e, f;
            return d || (f = $a[b], $a[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, $a[b] = f), e;
        };
    });
    var _a = /^(?:input|select|textarea|button)$/i;
    n.fn.extend({
        prop: function (a, b) {
            return J(this, n.prop, a, b, arguments.length > 1);
        }, removeProp: function (a) {
            return this.each(function () {
                delete this[n.propFix[a] || a];
            });
        }
    }), n.extend({
        propFix: {"for": "htmlFor", "class": "className"}, prop: function (a, b, c) {
            var d, e, f, g = a.nodeType;
            if (a && 3 !== g && 8 !== g && 2 !== g) return f = 1 !== g || !n.isXMLDoc(a), f && (b = n.propFix[b] || b, e = n.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b];
        }, propHooks: {
            tabIndex: {
                get: function (a) {
                    return a.hasAttribute("tabindex") || _a.test(a.nodeName) || a.href ? a.tabIndex : -1;
                }
            }
        }
    }), k.optSelected || (n.propHooks.selected = {
        get: function (a) {
            var b = a.parentNode;
            return b && b.parentNode && b.parentNode.selectedIndex, null;
        }
    }), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        n.propFix[this.toLowerCase()] = this;
    });
    var ab = /[\t\r\n\f]/g;
    n.fn.extend({
        addClass: function (a) {
            var b, c, d, e, f, g, h = "string" == typeof a && a, i = 0, j = this.length;
            if (n.isFunction(a)) return this.each(function (b) {
                n(this).addClass(a.call(this, b, this.className));
            });
            if (h) for (b = (a || "").match(E) || []; j > i; i++) if (c = this[i], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ab, " ") : " ")) {
                f = 0;
                while (e = b[f++]) d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                g = n.trim(d), c.className !== g && (c.className = g);
            }
            return this;
        }, removeClass: function (a) {
            var b, c, d, e, f, g, h = 0 === arguments.length || "string" == typeof a && a, i = 0, j = this.length;
            if (n.isFunction(a)) return this.each(function (b) {
                n(this).removeClass(a.call(this, b, this.className));
            });
            if (h) for (b = (a || "").match(E) || []; j > i; i++) if (c = this[i], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ab, " ") : "")) {
                f = 0;
                while (e = b[f++]) while (d.indexOf(" " + e + " ") >= 0) d = d.replace(" " + e + " ", " ");
                g = a ? n.trim(d) : "", c.className !== g && (c.className = g);
            }
            return this;
        }, toggleClass: function (a, b) {
            var c = typeof a;
            return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(n.isFunction(a) ? function (c) {
                n(this).toggleClass(a.call(this, c, this.className, b), b);
            } : function () {
                if ("string" === c) {
                    var b, d = 0, e = n(this), f = a.match(E) || [];
                    while (b = f[d++]) e.hasClass(b) ? e.removeClass(b) : e.addClass(b);
                } else (c === U || "boolean" === c) && (this.className && L.set(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : L.get(this, "__className__") || "");
            });
        }, hasClass: function (a) {
            for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++) if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(ab, " ").indexOf(b) >= 0) return !0;
            return !1;
        }
    });
    var bb = /\r/g;
    n.fn.extend({
        val: function (a) {
            var b, c, d, e = this[0];
            {
                if (arguments.length) return d = n.isFunction(a), this.each(function (c) {
                    var e;
                    1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : n.isArray(e) && (e = n.map(e, function (a) {
                        return null == a ? "" : a + "";
                    })), b = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e));
                });
                if (e) return b = n.valHooks[e.type] || n.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(bb, "") : null == c ? "" : c);
            }
        }
    }), n.extend({
        valHooks: {
            option: {
                get: function (a) {
                    var b = n.find.attr(a, "value");
                    return null != b ? b : n.trim(n.text(a));
                }
            }, select: {
                get: function (a) {
                    for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++) if (c = d[i], !(!c.selected && i !== e || (k.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && n.nodeName(c.parentNode, "optgroup"))) {
                        if (b = n(c).val(), f) return b;
                        g.push(b);
                    }
                    return g;
                }, set: function (a, b) {
                    var c, d, e = a.options, f = n.makeArray(b), g = e.length;
                    while (g--) d = e[g], (d.selected = n.inArray(d.value, f) >= 0) && (c = !0);
                    return c || (a.selectedIndex = -1), f;
                }
            }
        }
    }), n.each(["radio", "checkbox"], function () {
        n.valHooks[this] = {
            set: function (a, b) {
                return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) >= 0 : void 0;
            }
        }, k.checkOn || (n.valHooks[this].get = function (a) {
            return null === a.getAttribute("value") ? "on" : a.value;
        });
    }), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
        n.fn[b] = function (a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b);
        };
    }), n.fn.extend({
        hover: function (a, b) {
            return this.mouseenter(a).mouseleave(b || a);
        }, bind: function (a, b, c) {
            return this.on(a, null, b, c);
        }, unbind: function (a, b) {
            return this.off(a, null, b);
        }, delegate: function (a, b, c, d) {
            return this.on(b, a, c, d);
        }, undelegate: function (a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c);
        }
    });
    var cb = n.now(), db = /\?/;
    n.parseJSON = function (a) {
        return JSON.parse(a + "");
    }, n.parseXML = function (a) {
        var b, c;
        if (!a || "string" != typeof a) return null;
        try {
            c = new DOMParser, b = c.parseFromString(a, "text/xml");
        } catch (d) {
            b = void 0;
        }
        return (!b || b.getElementsByTagName("parsererror").length) && n.error("Invalid XML: " + a), b;
    };
    var eb = /#.*$/, fb = /([?&])_=[^&]*/, gb = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        hb = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, ib = /^(?:GET|HEAD)$/, jb = /^\/\//,
        kb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, lb = {}, mb = {}, nb = "*/".concat("*"),
        ob = a.location.href, pb = kb.exec(ob.toLowerCase()) || [];

    function qb(a) {
        return function (b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0, f = b.toLowerCase().match(E) || [];
            if (n.isFunction(c)) while (d = f[e++]) "+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c);
        };
    }

    function rb(a, b, c, d) {
        var e = {}, f = a === mb;

        function g(h) {
            var i;
            return e[h] = !0, n.each(a[h] || [], function (a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1);
            }), i;
        }

        return g(b.dataTypes[0]) || !e["*"] && g("*");
    }

    function sb(a, b) {
        var c, d, e = n.ajaxSettings.flatOptions || {};
        for (c in b) void 0 !== b[c] && ((e[c] ? a : d || (d = {}))[c] = b[c]);
        return d && n.extend(!0, a, d), a;
    }

    function tb(a, b, c) {
        var d, e, f, g, h = a.contents, i = a.dataTypes;
        while ("*" === i[0]) i.shift(), void 0 === d && (d = a.mimeType || b.getResponseHeader("Content-Type"));
        if (d) for (e in h) if (h[e] && h[e].test(d)) {
            i.unshift(e);
            break;
        }
        if (i[0] in c) f = i[0]; else {
            for (e in c) {
                if (!i[0] || a.converters[e + " " + i[0]]) {
                    f = e;
                    break;
                }
                g || (g = e);
            }
            f = f || g;
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0;
    }

    function ub(a, b, c, d) {
        var e, f, g, h, i, j = {}, k = a.dataTypes.slice();
        if (k[1]) for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        f = k.shift();
        while (f) if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift()) if ("*" === f) f = i; else if ("*" !== i && i !== f) {
            if (g = j[i + " " + f] || j["* " + f], !g) for (e in j) if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
                break;
            }
            if (g !== !0) if (g && a["throws"]) b = g(b); else try {
                b = g(b);
            } catch (l) {
                return {state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f};
            }
        }
        return {state: "success", data: b};
    }

    n.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: ob,
            type: "GET",
            isLocal: hb.test(pb[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": nb,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /xml/, html: /html/, json: /json/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": n.parseJSON, "text xml": n.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (a, b) {
            return b ? sb(sb(a, n.ajaxSettings), b) : sb(n.ajaxSettings, a);
        },
        ajaxPrefilter: qb(lb),
        ajaxTransport: qb(mb),
        ajax: function (a, b) {
            "object" == typeof a && (b = a, a = void 0), b = b || {};
            var c, d, e, f, g, h, i, j, k = n.ajaxSetup({}, b), l = k.context || k,
                m = k.context && (l.nodeType || l.jquery) ? n(l) : n.event, o = n.Deferred(),
                p = n.Callbacks("once memory"), q = k.statusCode || {}, r = {}, s = {}, t = 0, u = "canceled", v = {
                    readyState: 0, getResponseHeader: function (a) {
                        var b;
                        if (2 === t) {
                            if (!f) {
                                f = {};
                                while (b = gb.exec(e)) f[b[1].toLowerCase()] = b[2];
                            }
                            b = f[a.toLowerCase()];
                        }
                        return null == b ? null : b;
                    }, getAllResponseHeaders: function () {
                        return 2 === t ? e : null;
                    }, setRequestHeader: function (a, b) {
                        var c = a.toLowerCase();
                        return t || (a = s[c] = s[c] || a, r[a] = b), this;
                    }, overrideMimeType: function (a) {
                        return t || (k.mimeType = a), this;
                    }, statusCode: function (a) {
                        var b;
                        if (a) if (2 > t) for (b in a) q[b] = [q[b], a[b]]; else v.always(a[v.status]);
                        return this;
                    }, abort: function (a) {
                        var b = a || u;
                        return c && c.abort(b), x(0, b), this;
                    }
                };
            if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || ob) + "").replace(eb, "").replace(jb, pb[1] + "//"), k.type = b.method || b.type || k.method || k.type, k.dataTypes = n.trim(k.dataType || "*").toLowerCase().match(E) || [""], null == k.crossDomain && (h = kb.exec(k.url.toLowerCase()), k.crossDomain = !(!h || h[1] === pb[1] && h[2] === pb[2] && (h[3] || ("http:" === h[1] ? "80" : "443")) === (pb[3] || ("http:" === pb[1] ? "80" : "443")))), k.data && k.processData && "string" != typeof k.data && (k.data = n.param(k.data, k.traditional)), rb(lb, k, b, v), 2 === t) return v;
            i = n.event && k.global, i && 0 === n.active++ && n.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), k.hasContent = !ib.test(k.type), d = k.url, k.hasContent || (k.data && (d = k.url += (db.test(d) ? "&" : "?") + k.data, delete k.data), k.cache === !1 && (k.url = fb.test(d) ? d.replace(fb, "$1_=" + cb++) : d + (db.test(d) ? "&" : "?") + "_=" + cb++)), k.ifModified && (n.lastModified[d] && v.setRequestHeader("If-Modified-Since", n.lastModified[d]), n.etag[d] && v.setRequestHeader("If-None-Match", n.etag[d])), (k.data && k.hasContent && k.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + nb + "; q=0.01" : "") : k.accepts["*"]);
            for (j in k.headers) v.setRequestHeader(j, k.headers[j]);
            if (k.beforeSend && (k.beforeSend.call(l, v, k) === !1 || 2 === t)) return v.abort();
            u = "abort";
            for (j in{success: 1, error: 1, complete: 1}) v[j](k[j]);
            if (c = rb(mb, k, b, v)) {
                v.readyState = 1, i && m.trigger("ajaxSend", [v, k]), k.async && k.timeout > 0 && (g = setTimeout(function () {
                    v.abort("timeout");
                }, k.timeout));
                try {
                    t = 1, c.send(r, x);
                } catch (w) {
                    if (!(2 > t)) throw w;
                    x(-1, w);
                }
            } else x(-1, "No Transport");

            function x(a, b, f, h) {
                var j, r, s, u, w, x = b;
                2 !== t && (t = 2, g && clearTimeout(g), c = void 0, e = h || "", v.readyState = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, f && (u = tb(k, v, f)), u = ub(k, u, v, j), j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (n.lastModified[d] = w), w = v.getResponseHeader("etag"), w && (n.etag[d] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v.statusCode(q), q = void 0, i && m.trigger(j ? "ajaxSuccess" : "ajaxError", [v, k, j ? r : s]), p.fireWith(l, [v, x]), i && (m.trigger("ajaxComplete", [v, k]), --n.active || n.event.trigger("ajaxStop")));
            }

            return v;
        },
        getJSON: function (a, b, c) {
            return n.get(a, b, c, "json");
        },
        getScript: function (a, b) {
            return n.get(a, void 0, b, "script");
        }
    }), n.each(["get", "post"], function (a, b) {
        n[b] = function (a, c, d, e) {
            return n.isFunction(c) && (e = e || d, d = c, c = void 0), n.ajax({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            });
        };
    }), n._evalUrl = function (a) {
        return n.ajax({url: a, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0});
    }, n.fn.extend({
        wrapAll: function (a) {
            var b;
            return n.isFunction(a) ? this.each(function (b) {
                n(this).wrapAll(a.call(this, b));
            }) : (this[0] && (b = n(a, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
                var a = this;
                while (a.firstElementChild) a = a.firstElementChild;
                return a;
            }).append(this)), this);
        }, wrapInner: function (a) {
            return this.each(n.isFunction(a) ? function (b) {
                n(this).wrapInner(a.call(this, b));
            } : function () {
                var b = n(this), c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a);
            });
        }, wrap: function (a) {
            var b = n.isFunction(a);
            return this.each(function (c) {
                n(this).wrapAll(b ? a.call(this, c) : a);
            });
        }, unwrap: function () {
            return this.parent().each(function () {
                n.nodeName(this, "body") || n(this).replaceWith(this.childNodes);
            }).end();
        }
    }), n.expr.filters.hidden = function (a) {
        return a.offsetWidth <= 0 && a.offsetHeight <= 0;
    }, n.expr.filters.visible = function (a) {
        return !n.expr.filters.hidden(a);
    };
    var vb = /%20/g, wb = /\[\]$/, xb = /\r?\n/g, yb = /^(?:submit|button|image|reset|file)$/i,
        zb = /^(?:input|select|textarea|keygen)/i;

    function Ab(a, b, c, d) {
        var e;
        if (n.isArray(b)) n.each(b, function (b, e) {
            c || wb.test(a) ? d(a, e) : Ab(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d);
        }); else if (c || "object" !== n.type(b)) d(a, b); else for (e in b) Ab(a + "[" + e + "]", b[e], c, d);
    }

    n.param = function (a, b) {
        var c, d = [], e = function (a, b) {
            b = n.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b);
        };
        if (void 0 === b && (b = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a, function () {
            e(this.name, this.value);
        }); else for (c in a) Ab(c, a[c], b, e);
        return d.join("&").replace(vb, "+");
    }, n.fn.extend({
        serialize: function () {
            return n.param(this.serializeArray());
        }, serializeArray: function () {
            return this.map(function () {
                var a = n.prop(this, "elements");
                return a ? n.makeArray(a) : this;
            }).filter(function () {
                var a = this.type;
                return this.name && !n(this).is(":disabled") && zb.test(this.nodeName) && !yb.test(a) && (this.checked || !T.test(a));
            }).map(function (a, b) {
                var c = n(this).val();
                return null == c ? null : n.isArray(c) ? n.map(c, function (a) {
                    return {name: b.name, value: a.replace(xb, "\r\n")};
                }) : {name: b.name, value: c.replace(xb, "\r\n")};
            }).get();
        }
    }), n.ajaxSettings.xhr = function () {
        try {
            return new XMLHttpRequest;
        } catch (a) {
        }
    };
    var Bb = 0, Cb = {}, Db = {0: 200, 1223: 204}, Eb = n.ajaxSettings.xhr();
    a.attachEvent && a.attachEvent("onunload", function () {
        for (var a in Cb) Cb[a]();
    }), k.cors = !!Eb && "withCredentials" in Eb, k.ajax = Eb = !!Eb, n.ajaxTransport(function (a) {
        var b;
        return k.cors || Eb && !a.crossDomain ? {
            send: function (c, d) {
                var e, f = a.xhr(), g = ++Bb;
                if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields) for (e in a.xhrFields) f[e] = a.xhrFields[e];
                a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
                for (e in c) f.setRequestHeader(e, c[e]);
                b = function (a) {
                    return function () {
                        b && (delete Cb[g], b = f.onload = f.onerror = null, "abort" === a ? f.abort() : "error" === a ? d(f.status, f.statusText) : d(Db[f.status] || f.status, f.statusText, "string" == typeof f.responseText ? {text: f.responseText} : void 0, f.getAllResponseHeaders()));
                    };
                }, f.onload = b(), f.onerror = b("error"), b = Cb[g] = b("abort");
                try {
                    f.send(a.hasContent && a.data || null);
                } catch (h) {
                    if (b) throw h;
                }
            }, abort: function () {
                b && b();
            }
        } : void 0;
    }), n.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /(?:java|ecma)script/},
        converters: {
            "text script": function (a) {
                return n.globalEval(a), a;
            }
        }
    }), n.ajaxPrefilter("script", function (a) {
        void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET");
    }), n.ajaxTransport("script", function (a) {
        if (a.crossDomain) {
            var b, c;
            return {
                send: function (d, e) {
                    b = n("<script>").prop({
                        async: !0,
                        charset: a.scriptCharset,
                        src: a.url
                    }).on("load error", c = function (a) {
                        b.remove(), c = null, a && e("error" === a.type ? 404 : 200, a.type);
                    }), l.head.appendChild(b[0]);
                }, abort: function () {
                    c && c();
                }
            };
        }
    });
    var Fb = [], Gb = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var a = Fb.pop() || n.expando + "_" + cb++;
            return this[a] = !0, a;
        }
    }), n.ajaxPrefilter("json jsonp", function (b, c, d) {
        var e, f, g,
            h = b.jsonp !== !1 && (Gb.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && Gb.test(b.data) && "data");
        return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(Gb, "$1" + e) : b.jsonp !== !1 && (b.url += (db.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function () {
            return g || n.error(e + " was not called"), g[0];
        }, b.dataTypes[0] = "json", f = a[e], a[e] = function () {
            g = arguments;
        }, d.always(function () {
            a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, Fb.push(e)), g && n.isFunction(f) && f(g[0]), g = f = void 0;
        }), "script") : void 0;
    }), n.parseHTML = function (a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1), b = b || l;
        var d = v.exec(a), e = !c && [];
        return d ? [b.createElement(d[1])] : (d = n.buildFragment([a], b, e), e && e.length && n(e).remove(), n.merge([], d.childNodes));
    };
    var Hb = n.fn.load;
    n.fn.load = function (a, b, c) {
        if ("string" != typeof a && Hb) return Hb.apply(this, arguments);
        var d, e, f, g = this, h = a.indexOf(" ");
        return h >= 0 && (d = n.trim(a.slice(h)), a = a.slice(0, h)), n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (e = "POST"), g.length > 0 && n.ajax({
            url: a,
            type: e,
            dataType: "html",
            data: b
        }).done(function (a) {
            f = arguments, g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a);
        }).complete(c && function (a, b) {
            g.each(c, f || [a.responseText, b, a]);
        }), this;
    }, n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (a, b) {
        n.fn[b] = function (a) {
            return this.on(b, a);
        };
    }), n.expr.filters.animated = function (a) {
        return n.grep(n.timers, function (b) {
            return a === b.elem;
        }).length;
    };
    var Ib = a.document.documentElement;

    function Jb(a) {
        return n.isWindow(a) ? a : 9 === a.nodeType && a.defaultView;
    }

    n.offset = {
        setOffset: function (a, b, c) {
            var d, e, f, g, h, i, j, k = n.css(a, "position"), l = n(a), m = {};
            "static" === k && (a.style.position = "relative"), h = l.offset(), f = n.css(a, "top"), i = n.css(a, "left"), j = ("absolute" === k || "fixed" === k) && (f + i).indexOf("auto") > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), n.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using" in b ? b.using.call(a, m) : l.css(m);
        }
    }, n.fn.extend({
        offset: function (a) {
            if (arguments.length) return void 0 === a ? this : this.each(function (b) {
                n.offset.setOffset(this, a, b);
            });
            var b, c, d = this[0], e = {top: 0, left: 0}, f = d && d.ownerDocument;
            if (f) return b = f.documentElement, n.contains(b, d) ? (typeof d.getBoundingClientRect !== U && (e = d.getBoundingClientRect()), c = Jb(f), {
                top: e.top + c.pageYOffset - b.clientTop,
                left: e.left + c.pageXOffset - b.clientLeft
            }) : e;
        }, position: function () {
            if (this[0]) {
                var a, b, c = this[0], d = {top: 0, left: 0};
                return "fixed" === n.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (d = a.offset()), d.top += n.css(a[0], "borderTopWidth", !0), d.left += n.css(a[0], "borderLeftWidth", !0)), {
                    top: b.top - d.top - n.css(c, "marginTop", !0),
                    left: b.left - d.left - n.css(c, "marginLeft", !0)
                };
            }
        }, offsetParent: function () {
            return this.map(function () {
                var a = this.offsetParent || Ib;
                while (a && !n.nodeName(a, "html") && "static" === n.css(a, "position")) a = a.offsetParent;
                return a || Ib;
            });
        }
    }), n.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (b, c) {
        var d = "pageYOffset" === c;
        n.fn[b] = function (e) {
            return J(this, function (b, e, f) {
                var g = Jb(b);
                return void 0 === f ? g ? g[c] : b[e] : void(g ? g.scrollTo(d ? a.pageXOffset : f, d ? f : a.pageYOffset) : b[e] = f);
            }, b, e, arguments.length, null);
        };
    }), n.each(["top", "left"], function (a, b) {
        n.cssHooks[b] = ya(k.pixelPosition, function (a, c) {
            return c ? (c = xa(a, b), va.test(c) ? n(a).position()[b] + "px" : c) : void 0;
        });
    }), n.each({Height: "height", Width: "width"}, function (a, b) {
        n.each({padding: "inner" + a, content: b, "": "outer" + a}, function (c, d) {
            n.fn[d] = function (d, e) {
                var f = arguments.length && (c || "boolean" != typeof d),
                    g = c || (d === !0 || e === !0 ? "margin" : "border");
                return J(this, function (b, c, d) {
                    var e;
                    return n.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g);
                }, b, f ? d : void 0, f, null);
            };
        });
    }), n.fn.size = function () {
        return this.length;
    }, n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function () {
        return n;
    });
    var Kb = a.jQuery, Lb = a.$;
    return n.noConflict = function (b) {
        return a.$ === n && (a.$ = Lb), b && a.jQuery === n && (a.jQuery = Kb), n;
    }, typeof b === U && (a.jQuery = a.$ = n), n;
});
//# sourceMappingURL=jquery.min.map
/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
+function (a) {
    "use strict";
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 2) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3");
}(jQuery), +function (a) {
    "use strict";

    function b() {
        var a = document.createElement("bootstrap"), b = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var c in b) if (void 0 !== a.style[c]) return {end: b[c]};
        return !1;
    }

    a.fn.emulateTransitionEnd = function (b) {
        var c = !1, d = this;
        a(this).one("bsTransitionEnd", function () {
            c = !0;
        });
        var e = function () {
            c || a(d).trigger(a.support.transition.end);
        };
        return setTimeout(e, b), this;
    }, a(function () {
        a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
            bindType: a.support.transition.end,
            delegateType: a.support.transition.end,
            handle: function (b) {
                return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0;
            }
        });
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.alert");
            e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c);
        });
    }

    var c = '[data-dismiss="alert"]', d = function (b) {
        a(b).on("click", c, this.close);
    };
    d.VERSION = "3.3.6", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
        function c() {
            g.detach().trigger("closed.bs.alert").remove();
        }

        var e = a(this), f = e.attr("data-target");
        f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
        var g = a(f);
        b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c());
    };
    var e = a.fn.alert;
    a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
        return a.fn.alert = e, this;
    }, a(document).on("click.bs.alert.data-api", c, d.prototype.close);
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.button"), f = "object" == typeof b && b;
            e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b);
        });
    }

    var c = function (b, d) {
        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1;
    };
    c.VERSION = "3.3.6", c.DEFAULTS = {loadingText: "loading..."}, c.prototype.setState = function (b) {
        var c = "disabled", d = this.$element, e = d.is("input") ? "val" : "html", f = d.data();
        b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
            d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c));
        }, this), 0);
    }, c.prototype.toggle = function () {
        var a = !0, b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") ? (c.prop("checked") && (a = !1), b.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == c.prop("type") && (c.prop("checked") !== this.$element.hasClass("active") && (a = !1), this.$element.toggleClass("active")), c.prop("checked", this.$element.hasClass("active")), a && c.trigger("change");
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active");
    };
    var d = a.fn.button;
    a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
        return a.fn.button = d, this;
    }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
        var d = a(c.target);
        d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), a(c.target).is('input[type="radio"]') || a(c.target).is('input[type="checkbox"]') || c.preventDefault();
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
        a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type));
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.carousel"),
                f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
                g = "string" == typeof b ? b : f.slide;
            e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle();
        });
    }

    var c = function (b, c) {
        this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this));
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, c.prototype.keydown = function (a) {
        if (!/input|textarea/i.test(a.target.tagName)) {
            switch (a.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return;
            }
            a.preventDefault();
        }
    }, c.prototype.cycle = function (b) {
        return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this;
    }, c.prototype.getItemIndex = function (a) {
        return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active);
    }, c.prototype.getItemForDirection = function (a, b) {
        var c = this.getItemIndex(b), d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;
        if (d && !this.options.wrap) return b;
        var e = "prev" == a ? -1 : 1, f = (c + e) % this.$items.length;
        return this.$items.eq(f);
    }, c.prototype.to = function (a) {
        var b = this, c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
            b.to(a);
        }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a));
    }, c.prototype.pause = function (b) {
        return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this;
    }, c.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next");
    }, c.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev");
    }, c.prototype.slide = function (b, d) {
        var e = this.$element.find(".item.active"), f = d || this.getItemForDirection(b, e), g = this.interval,
            h = "next" == b ? "left" : "right", i = this;
        if (f.hasClass("active")) return this.sliding = !1;
        var j = f[0], k = a.Event("slide.bs.carousel", {relatedTarget: j, direction: h});
        if (this.$element.trigger(k), !k.isDefaultPrevented()) {
            if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var l = a(this.$indicators.children()[this.getItemIndex(f)]);
                l && l.addClass("active");
            }
            var m = a.Event("slid.bs.carousel", {relatedTarget: j, direction: h});
            return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
                f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), i.sliding = !1, setTimeout(function () {
                    i.$element.trigger(m);
                }, 0);
            }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g && this.cycle(), this;
        }
    };
    var d = a.fn.carousel;
    a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
        return a.fn.carousel = d, this;
    };
    var e = function (c) {
        var d, e = a(this), f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));
        if (f.hasClass("carousel")) {
            var g = a.extend({}, f.data(), e.data()), h = e.attr("data-slide-to");
            h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault();
        }
    };
    a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
        a('[data-ride="carousel"]').each(function () {
            var c = a(this);
            b.call(c, c.data());
        });
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
        return a(d);
    }

    function c(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.collapse"),
                f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
            !e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]();
        });
    }

    var d = function (b, c) {
        this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a('[data-toggle="collapse"][href="#' + b.id + '"],[data-toggle="collapse"][data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle();
    };
    d.VERSION = "3.3.6", d.TRANSITION_DURATION = 350, d.DEFAULTS = {toggle: !0}, d.prototype.dimension = function () {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height";
    }, d.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b, e = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                var f = a.Event("show.bs.collapse");
                if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                    e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                    var g = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var h = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse");
                    };
                    if (!a.support.transition) return h.call(this);
                    var i = a.camelCase(["scroll", g].join("-"));
                    this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i]);
                }
            }
        }
    }, d.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var e = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse");
                };
                return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this);
            }
        }
    }, d.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]();
    }, d.prototype.getParent = function () {
        return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
            var e = a(d);
            this.addAriaAndCollapsedClass(b(e), e);
        }, this)).end();
    }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c);
    };
    var e = a.fn.collapse;
    a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
        return a.fn.collapse = e, this;
    }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
        var e = a(this);
        e.attr("data-target") || d.preventDefault();
        var f = b(e), g = f.data("bs.collapse"), h = g ? "toggle" : e.data();
        c.call(f, h);
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        var c = b.attr("data-target");
        c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
        var d = c && a(c);
        return d && d.length ? d : b.parent();
    }

    function c(c) {
        c && 3 === c.which || (a(e).remove(), a(f).each(function () {
            var d = a(this), e = b(d), f = {relatedTarget: this};
            e.hasClass("open") && (c && "click" == c.type && /input|textarea/i.test(c.target.tagName) && a.contains(e[0], c.target) || (e.trigger(c = a.Event("hide.bs.dropdown", f)), c.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger(a.Event("hidden.bs.dropdown", f)))));
        }));
    }

    function d(b) {
        return this.each(function () {
            var c = a(this), d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c);
        });
    }

    var e = ".dropdown-backdrop", f = '[data-toggle="dropdown"]', g = function (b) {
        a(b).on("click.bs.dropdown", this.toggle);
    };
    g.VERSION = "3.3.6", g.prototype.toggle = function (d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
            var f = b(e), g = f.hasClass("open");
            if (c(), !g) {
                "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", c);
                var h = {relatedTarget: this};
                if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
                e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger(a.Event("shown.bs.dropdown", h));
            }
            return !1;
        }
    }, g.prototype.keydown = function (c) {
        if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
            var d = a(this);
            if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
                var e = b(d), g = e.hasClass("open");
                if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(f).trigger("focus"), d.trigger("click");
                var h = " li:not(.disabled):visible a", i = e.find(".dropdown-menu" + h);
                if (i.length) {
                    var j = i.index(c.target);
                    38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus");
                }
            }
        }
    };
    var h = a.fn.dropdown;
    a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
        return a.fn.dropdown = h, this;
    }, a(document).on("click.bs.dropdown.data-api", c).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
        a.stopPropagation();
    }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown);
}(jQuery), +function (a) {
    "use strict";

    function b(b, d) {
        return this.each(function () {
            var e = a(this), f = e.data("bs.modal"), g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
            f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d);
        });
    }

    var c = function (b, c) {
        this.options = c, this.$body = a(document.body), this.$element = a(b), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
            this.$element.trigger("loaded.bs.modal");
        }, this));
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, c.prototype.toggle = function (a) {
        return this.isShown ? this.hide() : this.show(a);
    }, c.prototype.show = function (b) {
        var d = this, e = a.Event("show.bs.modal", {relatedTarget: b});
        this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
            d.$element.one("mouseup.dismiss.bs.modal", function (b) {
                a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0);
            });
        }), this.backdrop(function () {
            var e = a.support.transition && d.$element.hasClass("fade");
            d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in"), d.enforceFocus();
            var f = a.Event("shown.bs.modal", {relatedTarget: b});
            e ? d.$dialog.one("bsTransitionEnd", function () {
                d.$element.trigger("focus").trigger(f);
            }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f);
        }));
    }, c.prototype.hide = function (b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal());
    }, c.prototype.enforceFocus = function () {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
            this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus");
        }, this));
    }, c.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
            27 == a.which && this.hide();
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal");
    }, c.prototype.resize = function () {
        this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal");
    }, c.prototype.hideModal = function () {
        var a = this;
        this.$element.hide(), this.backdrop(function () {
            a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal");
        });
    }, c.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null;
    }, c.prototype.backdrop = function (b) {
        var d = this, e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var f = a.support.transition && e;
            if (this.$backdrop = a(document.createElement("div")).addClass("modal-backdrop " + e).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", a.proxy(function (a) {
                    return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()));
                }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;
            f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b();
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var g = function () {
                d.removeBackdrop(), b && b();
            };
            a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g();
        } else b && b();
    }, c.prototype.handleUpdate = function () {
        this.adjustDialog();
    }, c.prototype.adjustDialog = function () {
        var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
        });
    }, c.prototype.resetAdjustments = function () {
        this.$element.css({paddingLeft: "", paddingRight: ""});
    }, c.prototype.checkScrollbar = function () {
        var a = window.innerWidth;
        if (!a) {
            var b = document.documentElement.getBoundingClientRect();
            a = b.right - Math.abs(b.left);
        }
        this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth = this.measureScrollbar();
    }, c.prototype.setScrollbar = function () {
        var a = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth);
    }, c.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad);
    }, c.prototype.measureScrollbar = function () {
        var a = document.createElement("div");
        a.className = "modal-scrollbar-measure", this.$body.append(a);
        var b = a.offsetWidth - a.clientWidth;
        return this.$body[0].removeChild(a), b;
    };
    var d = a.fn.modal;
    a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
        return a.fn.modal = d, this;
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
        var d = a(this), e = d.attr("href"), f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
            g = f.data("bs.modal") ? "toggle" : a.extend({remote: !/#/.test(e) && e}, f.data(), d.data());
        d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
            a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
                d.is(":visible") && d.trigger("focus");
            });
        }), b.call(f, g, this);
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tooltip"), f = "object" == typeof b && b;
            (e || !/destroy|hide/.test(b)) && (e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]());
        });
    }

    var c = function (a, b) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", a, b);
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {selector: "body", padding: 0}
    }, c.prototype.init = function (b, c, d) {
        if (this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(a.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this)); else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin", i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this));
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle();
    }, c.prototype.getDefaults = function () {
        return c.DEFAULTS;
    }, c.prototype.getOptions = function (b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b;
    }, c.prototype.getDelegateOptions = function () {
        var b = {}, c = this.getDefaults();
        return this._options && a.each(this._options, function (a, d) {
            c[a] != d && (b[a] = d);
        }), b;
    }, c.prototype.enter = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusin" == b.type ? "focus" : "hover"] = !0), c.tip().hasClass("in") || "in" == c.hoverState ? void(c.hoverState = "in") : (clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function () {
            "in" == c.hoverState && c.show();
        }, c.options.delay.show)) : c.show());
    }, c.prototype.isInStateTrue = function () {
        for (var a in this.inState) if (this.inState[a]) return !0;
        return !1;
    }, c.prototype.leave = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusout" == b.type ? "focus" : "hover"] = !1), c.isInStateTrue() ? void 0 : (clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function () {
            "out" == c.hoverState && c.hide();
        }, c.options.delay.hide)) : c.hide());
    }, c.prototype.show = function () {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(b);
            var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (b.isDefaultPrevented() || !d) return;
            var e = this, f = this.tip(), g = this.getUID(this.type);
            this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
            var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
                i = /\s?auto?\s?/i, j = i.test(h);
            j && (h = h.replace(i, "") || "top"), f.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var k = this.getPosition(), l = f[0].offsetWidth, m = f[0].offsetHeight;
            if (j) {
                var n = h, o = this.getPosition(this.$viewport);
                h = "bottom" == h && k.bottom + m > o.bottom ? "top" : "top" == h && k.top - m < o.top ? "bottom" : "right" == h && k.right + l > o.width ? "left" : "left" == h && k.left - l < o.left ? "right" : h, f.removeClass(n).addClass(h);
            }
            var p = this.getCalculatedOffset(h, k, l, m);
            this.applyPlacement(p, h);
            var q = function () {
                var a = e.hoverState;
                e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e);
            };
            a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", q).emulateTransitionEnd(c.TRANSITION_DURATION) : q();
        }
    }, c.prototype.applyPlacement = function (b, c) {
        var d = this.tip(), e = d[0].offsetWidth, f = d[0].offsetHeight, g = parseInt(d.css("margin-top"), 10),
            h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top += g, b.left += h, a.offset.setOffset(d[0], a.extend({
            using: function (a) {
                d.css({top: Math.round(a.top), left: Math.round(a.left)});
            }
        }, b), 0), d.addClass("in");
        var i = d[0].offsetWidth, j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? b.left += k.left : b.top += k.top;
        var l = /top|bottom/.test(c), m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
            n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l);
    }, c.prototype.replaceArrow = function (a, b, c) {
        this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "");
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right");
    }, c.prototype.hide = function (b) {
        function d() {
            "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b();
        }

        var e = this, f = a(this.$tip), g = a.Event("hide.bs." + this.type);
        return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this);
    }, c.prototype.fixTitle = function () {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "");
    }, c.prototype.hasContent = function () {
        return this.getTitle();
    }, c.prototype.getPosition = function (b) {
        b = b || this.$element;
        var c = b[0], d = "BODY" == c.tagName, e = c.getBoundingClientRect();
        null == e.width && (e = a.extend({}, e, {width: e.right - e.left, height: e.bottom - e.top}));
        var f = d ? {top: 0, left: 0} : b.offset(),
            g = {scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()},
            h = d ? {width: a(window).width(), height: a(window).height()} : null;
        return a.extend({}, e, g, h, f);
    }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {top: b.top + b.height / 2 - d / 2, left: b.left - c} : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        };
    }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
        var e = {top: 0, left: 0};
        if (!this.$viewport) return e;
        var f = this.options.viewport && this.options.viewport.padding || 0, g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
            var h = b.top - f - g.scroll, i = b.top + f - g.scroll + d;
            h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i);
        } else {
            var j = b.left - f, k = b.left + f + c;
            j < g.left ? e.left = g.left - j : k > g.right && (e.left = g.left + g.width - k);
        }
        return e;
    }, c.prototype.getTitle = function () {
        var a, b = this.$element, c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title);
    }, c.prototype.getUID = function (a) {
        do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
        return a;
    }, c.prototype.tip = function () {
        if (!this.$tip && (this.$tip = a(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip;
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow");
    }, c.prototype.enable = function () {
        this.enabled = !0;
    }, c.prototype.disable = function () {
        this.enabled = !1;
    }, c.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled;
    }, c.prototype.toggle = function (b) {
        var c = this;
        b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), b ? (c.inState.click = !c.inState.click, c.isInStateTrue() ? c.enter(c) : c.leave(c)) : c.tip().hasClass("in") ? c.leave(c) : c.enter(c);
    }, c.prototype.destroy = function () {
        var a = this;
        clearTimeout(this.timeout), this.hide(function () {
            a.$element.off("." + a.type).removeData("bs." + a.type), a.$tip && a.$tip.detach(), a.$tip = null, a.$arrow = null, a.$viewport = null;
        });
    };
    var d = a.fn.tooltip;
    a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
        return a.fn.tooltip = d, this;
    };
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.popover"), f = "object" == typeof b && b;
            (e || !/destroy|hide/.test(b)) && (e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]());
        });
    }

    var c = function (a, b) {
        this.init("popover", a, b);
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    c.VERSION = "3.3.6", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
        return c.DEFAULTS;
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle(), c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide();
    }, c.prototype.hasContent = function () {
        return this.getTitle() || this.getContent();
    }, c.prototype.getContent = function () {
        var a = this.$element, b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content);
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow");
    };
    var d = a.fn.popover;
    a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
        return a.fn.popover = d, this;
    };
}(jQuery), +function (a) {
    "use strict";

    function b(c, d) {
        this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process();
    }

    function c(c) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.scrollspy"), f = "object" == typeof c && c;
            e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]();
        });
    }

    b.VERSION = "3.3.6", b.DEFAULTS = {offset: 10}, b.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight);
    }, b.prototype.refresh = function () {
        var b = this, c = "offset", d = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var b = a(this), e = b.data("target") || b.attr("href"), f = /^#./.test(e) && a(e);
            return f && f.length && f.is(":visible") && [[f[c]().top + d, e]] || null;
        }).sort(function (a, b) {
            return a[0] - b[0];
        }).each(function () {
            b.offsets.push(this[0]), b.targets.push(this[1]);
        });
    }, b.prototype.process = function () {
        var a, b = this.$scrollElement.scrollTop() + this.options.offset, c = this.getScrollHeight(),
            d = this.options.offset + c - this.$scrollElement.height(), e = this.offsets, f = this.targets,
            g = this.activeTarget;
        if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);
        if (g && b < e[0]) return this.activeTarget = null, this.clear();
        for (a = e.length; a--;) g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b < e[a + 1]) && this.activate(f[a]);
    }, b.prototype.activate = function (b) {
        this.activeTarget = b, this.clear();
        var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
            d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy");
    }, b.prototype.clear = function () {
        a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
    };
    var d = a.fn.scrollspy;
    a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
        return a.fn.scrollspy = d, this;
    }, a(window).on("load.bs.scrollspy.data-api", function () {
        a('[data-spy="scroll"]').each(function () {
            var b = a(this);
            c.call(b, b.data());
        });
    });
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tab");
            e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]();
        });
    }

    var c = function (b) {
        this.element = a(b);
    };
    c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
        var b = this.element, c = b.closest("ul:not(.dropdown-menu)"), d = b.data("target");
        if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
            var e = c.find(".active:last a"), f = a.Event("hide.bs.tab", {relatedTarget: b[0]}),
                g = a.Event("show.bs.tab", {relatedTarget: e[0]});
            if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
                var h = a(d);
                this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
                    e.trigger({type: "hidden.bs.tab", relatedTarget: b[0]}), b.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: e[0]
                    });
                });
            }
        }
    }, c.prototype.activate = function (b, d, e) {
        function f() {
            g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e();
        }

        var g = d.find("> .active"),
            h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);
        g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in");
    };
    var d = a.fn.tab;
    a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
        return a.fn.tab = d, this;
    };
    var e = function (c) {
        c.preventDefault(), b.call(a(this), "show");
    };
    a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e);
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.affix"), f = "object" == typeof b && b;
            e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]();
        });
    }

    var c = function (b, d) {
        this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition();
    };
    c.VERSION = "3.3.6", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
        offset: 0,
        target: window
    }, c.prototype.getState = function (a, b, c, d) {
        var e = this.$target.scrollTop(), f = this.$element.offset(), g = this.$target.height();
        if (null != c && "top" == this.affixed) return c > e ? "top" : !1;
        if ("bottom" == this.affixed) return null != c ? e + this.unpin <= f.top ? !1 : "bottom" : a - d >= e + g ? !1 : "bottom";
        var h = null == this.affixed, i = h ? e : f.top, j = h ? g : b;
        return null != c && c >= e ? "top" : null != d && i + j >= a - d ? "bottom" : !1;
    }, c.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(c.RESET).addClass("affix");
        var a = this.$target.scrollTop(), b = this.$element.offset();
        return this.pinnedOffset = b.top - a;
    }, c.prototype.checkPositionWithEventLoop = function () {
        setTimeout(a.proxy(this.checkPosition, this), 1);
    }, c.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var b = this.$element.height(), d = this.options.offset, e = d.top, f = d.bottom,
                g = Math.max(a(document).height(), a(document.body).height());
            "object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
            var h = this.getState(g, b, e, f);
            if (this.affixed != h) {
                null != this.unpin && this.$element.css("top", "");
                var i = "affix" + (h ? "-" + h : ""), j = a.Event(i + ".bs.affix");
                if (this.$element.trigger(j), j.isDefaultPrevented()) return;
                this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix");
            }
            "bottom" == h && this.$element.offset({top: g - b - f});
        }
    };
    var d = a.fn.affix;
    a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
        return a.fn.affix = d, this;
    }, a(window).on("load", function () {
        a('[data-spy="affix"]').each(function () {
            var c = a(this), d = c.data();
            d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d);
        });
    });
}(jQuery);
/* global define */

/* ================================================
 * Make use of Bootstrap's modal more monkey-friendly.
 *
 * For Bootstrap 3.
 *
 * javanoob@hotmail.com
 *
 * https://github.com/nakupanda/bootstrap3-dialog
 *
 * Licensed under The MIT License.
 * ================================================ */
(function(root, factory) {

    "use strict";

    // CommonJS module is defined
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('jquery'), require('bootstrap'));
    }
    // AMD module is defined
    else if (typeof define === "function" && define.amd) {
        define("bootstrap-dialog", ["jquery", "bootstrap"], function($) {
            return factory($);
        });
    } else {
        // planted over the root!
        root.BootstrapDialog = factory(root.jQuery);
    }

}(this, function($) {

    "use strict";

    /* ================================================
     * Definition of BootstrapDialogModal.
     * Extend Bootstrap Modal and override some functions.
     * BootstrapDialogModal === Modified Modal.
     * ================================================ */
    var Modal = $.fn.modal.Constructor;
    var BootstrapDialogModal = function(element, options) {
        Modal.call(this, element, options);
    };
    BootstrapDialogModal.getModalVersion = function() {
        var version = null;
        if (typeof $.fn.modal.Constructor.VERSION === 'undefined') {
            version = 'v3.1';
        } else if (/3\.2\.\d+/.test($.fn.modal.Constructor.VERSION)) {
            version = 'v3.2';
        } else if (/3\.3\.[1,2]/.test($.fn.modal.Constructor.VERSION)) {
            version = 'v3.3';  // v3.3.1, v3.3.2
        } else {
            version = 'v3.3.4';
        }

        return version;
    };
    BootstrapDialogModal.ORIGINAL_BODY_PADDING = parseInt(($('body').css('padding-right') || 0), 10);
    BootstrapDialogModal.METHODS_TO_OVERRIDE = {};
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.1'] = {};
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.2'] = {
        hide: function(e) {
            if (e) {
                e.preventDefault();
            }
            e = $.Event('hide.bs.modal');

            this.$element.trigger(e);

            if (!this.isShown || e.isDefaultPrevented()) {
                return;
            }

            this.isShown = false;

            // Remove css class 'modal-open' when the last opened dialog is closing.
            var openedDialogs = this.getGlobalOpenedDialogs();
            if (openedDialogs.length === 0) {
                this.$body.removeClass('modal-open');
            }

            this.resetScrollbar();
            this.escape();

            $(document).off('focusin.bs.modal');

            this.$element
            .removeClass('in')
            .attr('aria-hidden', true)
            .off('click.dismiss.bs.modal');

            $.support.transition && this.$element.hasClass('fade') ?
            this.$element
            .one('bsTransitionEnd', $.proxy(this.hideModal, this))
            .emulateTransitionEnd(300) :
            this.hideModal();
        }
    };
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3'] = {
        /**
         * Overrided.
         *
         * @returns {undefined}
         */
        setScrollbar: function() {
            var bodyPad = BootstrapDialogModal.ORIGINAL_BODY_PADDING;
            if (this.bodyIsOverflowing) {
                this.$body.css('padding-right', bodyPad + this.scrollbarWidth);
            }
        },
        /**
         * Overrided.
         *
         * @returns {undefined}
         */
        resetScrollbar: function() {
            var openedDialogs = this.getGlobalOpenedDialogs();
            if (openedDialogs.length === 0) {
                this.$body.css('padding-right', BootstrapDialogModal.ORIGINAL_BODY_PADDING);
            }
        },
        /**
         * Overrided.
         *
         * @returns {undefined}
         */
        hideModal: function() {
            this.$element.hide();
            this.backdrop($.proxy(function() {
                var openedDialogs = this.getGlobalOpenedDialogs();
                if (openedDialogs.length === 0) {
                    this.$body.removeClass('modal-open');
                }
                this.resetAdjustments();
                this.resetScrollbar();
                this.$element.trigger('hidden.bs.modal');
            }, this));
        }
    };
    BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3.4'] = $.extend({}, BootstrapDialogModal.METHODS_TO_OVERRIDE['v3.3']);
    BootstrapDialogModal.prototype = {
        constructor: BootstrapDialogModal,
        /**
         * New function, to get the dialogs that opened by BootstrapDialog.
         *
         * @returns {undefined}
         */
        getGlobalOpenedDialogs: function() {
            var openedDialogs = [];
            $.each(BootstrapDialog.dialogs, function(id, dialogInstance) {
                if (dialogInstance.isRealized() && dialogInstance.isOpened()) {
                    openedDialogs.push(dialogInstance);
                }
            });

            return openedDialogs;
        }
    };

    // Add compatible methods.
    BootstrapDialogModal.prototype = $.extend(BootstrapDialogModal.prototype, Modal.prototype, BootstrapDialogModal.METHODS_TO_OVERRIDE[BootstrapDialogModal.getModalVersion()]);

    /* ================================================
     * Definition of BootstrapDialog.
     * ================================================ */
    var BootstrapDialog = function(options) {
        this.defaultOptions = $.extend(true, {
            id: BootstrapDialog.newGuid(),
            buttons: [],
            data: {},
            onshow: null,
            onshown: null,
            onhide: null,
            onhidden: null
        }, BootstrapDialog.defaultOptions);
        this.indexedButtons = {};
        this.registeredButtonHotkeys = {};
        this.draggableData = {
            isMouseDown: false,
            mouseOffset: {}
        };
        this.realized = false;
        this.opened = false;
        this.initOptions(options);
        this.holdThisInstance();
    };

    BootstrapDialog.BootstrapDialogModal = BootstrapDialogModal;

    /**
     *  Some constants.
     */
    BootstrapDialog.NAMESPACE = 'bootstrap-dialog';
    BootstrapDialog.TYPE_DEFAULT = 'type-default';
    BootstrapDialog.TYPE_INFO = 'type-info';
    BootstrapDialog.TYPE_PRIMARY = 'type-primary';
    BootstrapDialog.TYPE_SUCCESS = 'type-success';
    BootstrapDialog.TYPE_WARNING = 'type-warning';
    BootstrapDialog.TYPE_DANGER = 'type-danger';
    BootstrapDialog.DEFAULT_TEXTS = {};
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = 'Information';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = 'Success';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = 'Warning';
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = 'Danger';
    BootstrapDialog.DEFAULT_TEXTS['OK'] = 'OK';
    BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = 'Cancel';
    BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = 'Confirmation';
    BootstrapDialog.DEFAULT_TEXTS['SUBMIT'] = 'Congratulations, You submit saved.';
    BootstrapDialog.SIZE_NORMAL = 'size-normal';
    BootstrapDialog.SIZE_SMALL = 'size-small';
    BootstrapDialog.SIZE_WIDE = 'size-wide';    // size-wide is equal to modal-lg
    BootstrapDialog.SIZE_LARGE = 'size-large';
    BootstrapDialog.BUTTON_SIZES = {};
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_NORMAL] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_SMALL] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_WIDE] = '';
    BootstrapDialog.BUTTON_SIZES[BootstrapDialog.SIZE_LARGE] = 'btn-lg';
    BootstrapDialog.ICON_SPINNER = 'glyphicon glyphicon-asterisk';

    /**
     * Default options.
     */
    BootstrapDialog.defaultOptions = {
        type: BootstrapDialog.TYPE_PRIMARY,
        size: BootstrapDialog.SIZE_NORMAL,
        cssClass: '',
        title: null,
        message: null,
        nl2br: true,
        closable: true,
        closeByBackdrop: true,
        closeByKeyboard: true,
        spinicon: BootstrapDialog.ICON_SPINNER,
        autodestroy: true,
        draggable: false,
        animate: true,
        description: '',
        tabindex: -1
    };

    /**
     * Config default options.
     */
    BootstrapDialog.configDefaultOptions = function(options) {
        BootstrapDialog.defaultOptions = $.extend(true, BootstrapDialog.defaultOptions, options);
    };

    /**
     * Open / Close all created dialogs all at once.
     */
    BootstrapDialog.dialogs = {};
    BootstrapDialog.openAll = function() {
        $.each(BootstrapDialog.dialogs, function(id, dialogInstance) {
            dialogInstance.open();
        });
    };
    BootstrapDialog.closeAll = function() {
        $.each(BootstrapDialog.dialogs, function(id, dialogInstance) {
            dialogInstance.close();
        });
    };

    /**
     * Move focus to next visible dialog.
     */
    BootstrapDialog.moveFocus = function() {
        var lastDialogInstance = null;
        $.each(BootstrapDialog.dialogs, function(id, dialogInstance) {
            lastDialogInstance = dialogInstance;
        });
        if (lastDialogInstance !== null && lastDialogInstance.isRealized()) {
            lastDialogInstance.getModal().focus();
        }
    };

    BootstrapDialog.METHODS_TO_OVERRIDE = {};
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.1'] = {
        handleModalBackdropEvent: function() {
            this.getModal().on('click', {dialog: this}, function(event) {
                event.target === this && event.data.dialog.isClosable() && event.data.dialog.canCloseByBackdrop() && event.data.dialog.close();
            });

            return this;
        },
        /**
         * To make multiple opened dialogs look better.
         *
         * Will be removed in later version, after Bootstrap Modal >= 3.3.0, updating z-index is unnecessary.
         */
        updateZIndex: function() {
            var zIndexBackdrop = 1040;
            var zIndexModal = 1050;
            var dialogCount = 0;
            $.each(BootstrapDialog.dialogs, function(dialogId, dialogInstance) {
                dialogCount++;
            });
            var $modal = this.getModal();
            var $backdrop = $modal.data('bs.modal').$backdrop;
            $modal.css('z-index', zIndexModal + (dialogCount - 1) * 20);
            $backdrop.css('z-index', zIndexBackdrop + (dialogCount - 1) * 20);

            return this;
        },
        open: function() {
            !this.isRealized() && this.realize();
            this.getModal().modal('show');
            this.updateZIndex();

            return this;
        }
    };
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.2'] = {
        handleModalBackdropEvent: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['handleModalBackdropEvent'],
        updateZIndex: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['updateZIndex'],
        open: BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']['open']
    };
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.3'] = {};
    BootstrapDialog.METHODS_TO_OVERRIDE['v3.3.4'] = $.extend({}, BootstrapDialog.METHODS_TO_OVERRIDE['v3.1']);
    BootstrapDialog.prototype = {
        constructor: BootstrapDialog,
        initOptions: function(options) {
            this.options = $.extend(true, this.defaultOptions, options);

            return this;
        },
        holdThisInstance: function() {
            BootstrapDialog.dialogs[this.getId()] = this;

            return this;
        },
        initModalStuff: function() {
            this.setModal(this.createModal())
            .setModalDialog(this.createModalDialog())
            .setModalContent(this.createModalContent())
            .setModalHeader(this.createModalHeader())
            .setModalBody(this.createModalBody())
            .setModalFooter(this.createModalFooter());

            this.getModal().append(this.getModalDialog());
            this.getModalDialog().append(this.getModalContent());
            this.getModalContent()
            .append(this.getModalHeader())
            .append(this.getModalBody())
            .append(this.getModalFooter());

            return this;
        },
        createModal: function() {
            var $modal = $('<div class="modal" role="dialog" aria-hidden="true"></div>');
            $modal.prop('id', this.getId());
            $modal.attr('aria-labelledby', this.getId() + '_title');

            return $modal;
        },
        getModal: function() {
            return this.$modal;
        },
        setModal: function($modal) {
            this.$modal = $modal;

            return this;
        },
        createModalDialog: function() {
            return $('<div class="modal-dialog"></div>');
        },
        getModalDialog: function() {
            return this.$modalDialog;
        },
        setModalDialog: function($modalDialog) {
            this.$modalDialog = $modalDialog;

            return this;
        },
        createModalContent: function() {
            return $('<div class="modal-content"></div>');
        },
        getModalContent: function() {
            return this.$modalContent;
        },
        setModalContent: function($modalContent) {
            this.$modalContent = $modalContent;

            return this;
        },
        createModalHeader: function() {
            return $('<div class="modal-header"></div>');
        },
        getModalHeader: function() {
            return this.$modalHeader;
        },
        setModalHeader: function($modalHeader) {
            this.$modalHeader = $modalHeader;

            return this;
        },
        createModalBody: function() {
            return $('<div class="modal-body"></div>');
        },
        getModalBody: function() {
            return this.$modalBody;
        },
        setModalBody: function($modalBody) {
            this.$modalBody = $modalBody;

            return this;
        },
        createModalFooter: function() {
            return $('<div class="modal-footer"></div>');
        },
        getModalFooter: function() {
            return this.$modalFooter;
        },
        setModalFooter: function($modalFooter) {
            this.$modalFooter = $modalFooter;

            return this;
        },
        createDynamicContent: function(rawContent) {
            var content = null;
            if (typeof rawContent === 'function') {
                content = rawContent.call(rawContent, this);
            } else {
                content = rawContent;
            }
            if (typeof content === 'string') {
                content = this.formatStringContent(content);
            }
            return content;
        },
        formatStringContent: function(content) {
            if (this.options.nl2br) {
                return content.replace(/\r\n/g, '<br />').replace(/[\r\n]/g, '<br />');
            }

            return content;
        },
        setData: function(key, value) {
            this.options.data[key] = value;

            return this;
        },
        getData: function(key) {
            return this.options.data[key];
        },
        setId: function(id) {
            this.options.id = id;

            return this;
        },
        getId: function() {
            return this.options.id;
        },
        getType: function() {
            return this.options.type;
        },
        setType: function(type) {
            this.options.type = type;
            this.updateType();

            return this;
        },
        updateType: function() {
            if (this.isRealized()) {
                var types = [BootstrapDialog.TYPE_DEFAULT,
                    BootstrapDialog.TYPE_INFO,
                    BootstrapDialog.TYPE_PRIMARY,
                    BootstrapDialog.TYPE_SUCCESS,
                    BootstrapDialog.TYPE_WARNING,
                    BootstrapDialog.TYPE_DANGER];

                this.getModal().removeClass(types.join(' ')).addClass(this.getType());
            }

            return this;
        },
        getSize: function() {
            return this.options.size;
        },
        setSize: function(size) {
            this.options.size = size;
            this.updateSize();

            return this;
        },
        updateSize: function() {
            if (this.isRealized()) {
                var dialog = this;

                // Dialog size
                this.getModal().removeClass(BootstrapDialog.SIZE_NORMAL)
                .removeClass(BootstrapDialog.SIZE_SMALL)
                .removeClass(BootstrapDialog.SIZE_WIDE)
                .removeClass(BootstrapDialog.SIZE_LARGE);
                this.getModal().addClass(this.getSize());

                // Smaller dialog.
                this.getModalDialog().removeClass('modal-sm');
                if (this.getSize() === BootstrapDialog.SIZE_SMALL) {
                    this.getModalDialog().addClass('modal-sm');
                }

                // Wider dialog.
                this.getModalDialog().removeClass('modal-lg');
                if (this.getSize() === BootstrapDialog.SIZE_WIDE) {
                    this.getModalDialog().addClass('modal-lg');
                }

                // Button size
                $.each(this.options.buttons, function(index, button) {
                    var $button = dialog.getButton(button.id);
                    var buttonSizes = ['btn-lg', 'btn-sm', 'btn-xs'];
                    var sizeClassSpecified = false;
                    if (typeof button['cssClass'] === 'string') {
                        var btnClasses = button['cssClass'].split(' ');
                        $.each(btnClasses, function(index, btnClass) {
                            if ($.inArray(btnClass, buttonSizes) !== -1) {
                                sizeClassSpecified = true;
                            }
                        });
                    }
                    if (!sizeClassSpecified) {
                        $button.removeClass(buttonSizes.join(' '));
                        $button.addClass(dialog.getButtonSize());
                    }
                });
            }

            return this;
        },
        getCssClass: function() {
            return this.options.cssClass;
        },
        setCssClass: function(cssClass) {
            this.options.cssClass = cssClass;

            return this;
        },
        getTitle: function() {
            return this.options.title;
        },
        setTitle: function(title) {
            this.options.title = title;
            this.updateTitle();

            return this;
        },
        updateTitle: function() {
            if (this.isRealized()) {
                var title = this.getTitle() !== null ? this.createDynamicContent(this.getTitle()) : this.getDefaultText();
                this.getModalHeader().find('.' + this.getNamespace('title')).html('').append(title).prop('id', this.getId() + '_title');
            }

            return this;
        },
        getMessage: function() {
            return this.options.message;
        },
        setMessage: function(message) {
            this.options.message = message;
            this.updateMessage();

            return this;
        },
        updateMessage: function() {

            if (this.isRealized()) {
                var message = this.createDynamicContent(this.getMessage());
                console.log(message);
                this.getModalBody().find('.' + this.getNamespace('message')).html('').append(message);
            }

            return this;
        },
        isClosable: function() {
            return this.options.closable;
        },
        setClosable: function(closable) {
            this.options.closable = closable;
            this.updateClosable();

            return this;
        },
        setCloseByBackdrop: function(closeByBackdrop) {
            this.options.closeByBackdrop = closeByBackdrop;

            return this;
        },
        canCloseByBackdrop: function() {
            return this.options.closeByBackdrop;
        },
        setCloseByKeyboard: function(closeByKeyboard) {
            this.options.closeByKeyboard = closeByKeyboard;

            return this;
        },
        canCloseByKeyboard: function() {
            return this.options.closeByKeyboard;
        },
        isAnimate: function() {
            return this.options.animate;
        },
        setAnimate: function(animate) {
            this.options.animate = animate;

            return this;
        },
        updateAnimate: function() {
            if (this.isRealized()) {
                this.getModal().toggleClass('fade', this.isAnimate());
            }

            return this;
        },
        getSpinicon: function() {
            return this.options.spinicon;
        },
        setSpinicon: function(spinicon) {
            this.options.spinicon = spinicon;

            return this;
        },
        addButton: function(button) {
            this.options.buttons.push(button);

            return this;
        },
        addButtons: function(buttons) {
            var that = this;
            $.each(buttons, function(index, button) {
                that.addButton(button);
            });

            return this;
        },
        getButtons: function() {
            return this.options.buttons;
        },
        setButtons: function(buttons) {
            this.options.buttons = buttons;
            this.updateButtons();

            return this;
        },
        /**
         * If there is id provided for a button option, it will be in dialog.indexedButtons list.
         *
         * In that case you can use dialog.getButton(id) to find the button.
         *
         * @param {type} id
         * @returns {undefined}
         */
        getButton: function(id) {
            if (typeof this.indexedButtons[id] !== 'undefined') {
                return this.indexedButtons[id];
            }

            return null;
        },
        /**
         * by ado add methods in next begin line
         * @param type
         * @returns {*}
         */
        getExistButtons:function(type){
            if (this.isRealized()) {
                var buttons = this.getModalBody().find('.btn[type="' + type + '"]');
                if (typeof buttons !== 'undefined') {
                    return buttons;
                }
            }
            return null;
        },

        getExistForm:function(){
            if (this.isRealized()) {
                var form = this.getModalBody().find('form');
                if (typeof form !== 'undefined') {
                    return form[0];
                }
            }
            return null;
        },

        setExistButtonsInitClose:function(){
            var that = this;
            var buttons = this.getExistButtons('button');
            if(buttons){
            $.each(buttons,function(i,button){
                $(button).on('click',function(){
                    that.close();
                });
            });
            }
            this.setExistButtonsInitSubmit();
        },

        setExistButtonsInitSubmit:function(){
            var that = this;
            var buttons = this.getExistButtons('submit');
            var form = this.getExistForm();
            if(buttons && form){
                $.each(buttons,function(i,button){
                    $(button).on('click',function(){
                        $(this).attr('readonly',true);
                        var type = $(form).attr('method');
                        var url = $(form).attr('action');
                        $.ajax({
                            type: type,
                            url: url,
                            data:$(form).serialize(),
                            dataType: "html",
                            success: function(data){
                               that.setMessage(BootstrapDialog.DEFAULT_TEXTS.SUBMIT);
                            }
                        });
                        that.close();
                        return false;
                    });
                });
            }
        },

        /**
         * by ado end
         * ========================
         */

        getButtonSize: function() {
            if (typeof BootstrapDialog.BUTTON_SIZES[this.getSize()] !== 'undefined') {
                return BootstrapDialog.BUTTON_SIZES[this.getSize()];
            }

            return '';
        },
        updateButtons: function() {
            if (this.isRealized()) {
                if (this.getButtons().length === 0) {
                    this.getModalFooter().hide();
                } else {
                    this.getModalFooter().show().find('.' + this.getNamespace('footer')).html('').append(this.createFooterButtons());
                }
            }

            return this;
        },
        isAutodestroy: function() {
            return this.options.autodestroy;
        },
        setAutodestroy: function(autodestroy) {
            this.options.autodestroy = autodestroy;
        },
        getDescription: function() {
            return this.options.description;
        },
        setDescription: function(description) {
            this.options.description = description;

            return this;
        },
        setTabindex: function(tabindex) {
            this.options.tabindex = tabindex;

            return this;
        },
        getTabindex: function() {
            return this.options.tabindex;
        },
        updateTabindex: function() {
            if (this.isRealized()) {
                this.getModal().attr('tabindex', this.getTabindex());
            }

            return this;
        },
        getDefaultText: function() {
            return BootstrapDialog.DEFAULT_TEXTS[this.getType()];
        },
        getNamespace: function(name) {
            return BootstrapDialog.NAMESPACE + '-' + name;
        },
        createHeaderContent: function() {
            var $container = $('<div></div>');
            $container.addClass(this.getNamespace('header'));

            // title
            $container.append(this.createTitleContent());

            // Close button
            $container.prepend(this.createCloseButton());

            return $container;
        },
        createTitleContent: function() {
            var $title = $('<div></div>');
            $title.addClass(this.getNamespace('title'));

            return $title;
        },
        createCloseButton: function() {
            var $container = $('<div></div>');
            $container.addClass(this.getNamespace('close-button'));
            var $icon = $('<button class="close">&times;</button>');
            $container.append($icon);
            $container.on('click', {dialog: this}, function(event) {
                event.data.dialog.close();
            });

            return $container;
        },
        createBodyContent: function() {
            var $container = $('<div></div>');
            $container.addClass(this.getNamespace('body'));

            // Message
            $container.append(this.createMessageContent());

            return $container;
        },
        createMessageContent: function() {
            var $message = $('<div></div>');
            $message.addClass(this.getNamespace('message'));

            return $message;
        },
        createFooterContent: function() {
            var $container = $('<div></div>');
            $container.addClass(this.getNamespace('footer'));

            return $container;
        },
        createFooterButtons: function() {
            var that = this;
            var $container = $('<div></div>');
            $container.addClass(this.getNamespace('footer-buttons'));
            this.indexedButtons = {};
            $.each(this.options.buttons, function(index, button) {
                if (!button.id) {
                    button.id = BootstrapDialog.newGuid();
                }
                var $button = that.createButton(button);
                that.indexedButtons[button.id] = $button;
                $container.append($button);
            });

            return $container;
        },
        createButton: function(button) {
            var $button = $('<button class="btn"></button>');
            $button.prop('id', button.id);
            $button.data('button', button);

            // Icon
            if (typeof button.icon !== 'undefined' && $.trim(button.icon) !== '') {
                $button.append(this.createButtonIcon(button.icon));
            }

            // Label
            if (typeof button.label !== 'undefined') {
                $button.append(button.label);
            }

            // Css class
            if (typeof button.cssClass !== 'undefined' && $.trim(button.cssClass) !== '') {
                $button.addClass(button.cssClass);
            } else {
                $button.addClass('btn-default');
            }

            // Hotkey
            if (typeof button.hotkey !== 'undefined') {
                this.registeredButtonHotkeys[button.hotkey] = $button;
            }

            // Button on click
            $button.on('click', {dialog: this, $button: $button, button: button}, function(event) {
                var dialog = event.data.dialog;
                var $button = event.data.$button;
                var button = $button.data('button');
                if (typeof button.action === 'function') {
                    button.action.call($button, dialog, event);
                }

                if (button.autospin) {
                    $button.toggleSpin(true);
                }
            });

            // Dynamically add extra functions to $button
            this.enhanceButton($button);

            return $button;
        },
        /**
         * Dynamically add extra functions to $button
         *
         * Using '$this' to reference 'this' is just for better readability.
         *
         * @param {type} $button
         * @returns {_L13.BootstrapDialog.prototype}
         */
        enhanceButton: function($button) {
            $button.dialog = this;

            // Enable / Disable
            $button.toggleEnable = function(enable) {
                var $this = this;
                if (typeof enable !== 'undefined') {
                    $this.prop("disabled", !enable).toggleClass('disabled', !enable);
                } else {
                    $this.prop("disabled", !$this.prop("disabled"));
                }

                return $this;
            };
            $button.enable = function() {
                var $this = this;
                $this.toggleEnable(true);

                return $this;
            };
            $button.disable = function() {
                var $this = this;
                $this.toggleEnable(false);

                return $this;
            };

            // Icon spinning, helpful for indicating ajax loading status.
            $button.toggleSpin = function(spin) {
                var $this = this;
                var dialog = $this.dialog;
                var $icon = $this.find('.' + dialog.getNamespace('button-icon'));
                if (typeof spin === 'undefined') {
                    spin = !($button.find('.icon-spin').length > 0);
                }
                if (spin) {
                    $icon.hide();
                    $button.prepend(dialog.createButtonIcon(dialog.getSpinicon()).addClass('icon-spin'));
                } else {
                    $icon.show();
                    $button.find('.icon-spin').remove();
                }

                return $this;
            };
            $button.spin = function() {
                var $this = this;
                $this.toggleSpin(true);

                return $this;
            };
            $button.stopSpin = function() {
                var $this = this;
                $this.toggleSpin(false);

                return $this;
            };

            return this;
        },
        createButtonIcon: function(icon) {
            var $icon = $('<span></span>');
            $icon.addClass(this.getNamespace('button-icon')).addClass(icon);

            return $icon;
        },
        /**
         * Invoke this only after the dialog is realized.
         *
         * @param {type} enable
         * @returns {undefined}
         */
        enableButtons: function(enable) {
            $.each(this.indexedButtons, function(id, $button) {
                $button.toggleEnable(enable);
            });

            return this;
        },
        /**
         * Invoke this only after the dialog is realized.
         *
         * @returns {undefined}
         */
        updateClosable: function() {
            if (this.isRealized()) {
                // Close button
                this.getModalHeader().find('.' + this.getNamespace('close-button')).toggle(this.isClosable());
            }

            return this;
        },
        /**
         * Set handler for modal event 'show.bs.modal'.
         * This is a setter!
         */
        onShow: function(onshow) {
            this.options.onshow = onshow;

            return this;
        },
        /**
         * Set handler for modal event 'shown.bs.modal'.
         * This is a setter!
         */
        onShown: function(onshown) {
            this.options.onshown = onshown;

            return this;
        },
        /**
         * Set handler for modal event 'hide.bs.modal'.
         * This is a setter!
         */
        onHide: function(onhide) {
            this.options.onhide = onhide;

            return this;
        },
        /**
         * Set handler for modal event 'hidden.bs.modal'.
         * This is a setter!
         */
        onHidden: function(onhidden) {
            this.options.onhidden = onhidden;

            return this;
        },
        isRealized: function() {
            return this.realized;
        },
        setRealized: function(realized) {
            this.realized = realized;

            return this;
        },
        isOpened: function() {
            return this.opened;
        },
        setOpened: function(opened) {
            this.opened = opened;

            return this;
        },
        handleModalEvents: function() {
            this.getModal().on('show.bs.modal', {dialog: this}, function(event) {
                var dialog = event.data.dialog;
                dialog.setOpened(true);
                if (dialog.isModalEvent(event) && typeof dialog.options.onshow === 'function') {
                    var openIt = dialog.options.onshow(dialog);
                    if (openIt === false) {
                        dialog.setOpened(false);
                    }

                    return openIt;
                }
            });
            this.getModal().on('shown.bs.modal', {dialog: this}, function(event) {
                var dialog = event.data.dialog;
                dialog.isModalEvent(event) && typeof dialog.options.onshown === 'function' && dialog.options.onshown(dialog);
            });
            this.getModal().on('hide.bs.modal', {dialog: this}, function(event) {
                var dialog = event.data.dialog;
                dialog.setOpened(false);
                if (dialog.isModalEvent(event) && typeof dialog.options.onhide === 'function') {
                    var hideIt = dialog.options.onhide(dialog);
                    if (hideIt === false) {
                        dialog.setOpened(true);
                    }

                    return hideIt;
                }
            });
            this.getModal().on('hidden.bs.modal', {dialog: this}, function(event) {
                var dialog = event.data.dialog;
                dialog.isModalEvent(event) && typeof dialog.options.onhidden === 'function' && dialog.options.onhidden(dialog);
                if (dialog.isAutodestroy()) {
                    delete BootstrapDialog.dialogs[dialog.getId()];
                    $(this).remove();
                }
                BootstrapDialog.moveFocus();
            });

            // Backdrop, I did't find a way to change bs3 backdrop option after the dialog is popped up, so here's a new wheel.
            this.handleModalBackdropEvent();

            // ESC key support
            this.getModal().on('keyup', {dialog: this}, function(event) {
                event.which === 27 && event.data.dialog.isClosable() && event.data.dialog.canCloseByKeyboard() && event.data.dialog.close();
            });

            // Button hotkey
            this.getModal().on('keyup', {dialog: this}, function(event) {
                var dialog = event.data.dialog;
                if (typeof dialog.registeredButtonHotkeys[event.which] !== 'undefined') {
                    var $button = $(dialog.registeredButtonHotkeys[event.which]);
                    !$button.prop('disabled') && $button.focus().trigger('click');
                }
            });

            return this;
        },
        handleModalBackdropEvent: function() {
            this.getModal().on('click', {dialog: this}, function(event) {
                $(event.target).hasClass('modal-backdrop') && event.data.dialog.isClosable() && event.data.dialog.canCloseByBackdrop() && event.data.dialog.close();
            });

            return this;
        },
        isModalEvent: function(event) {
            return typeof event.namespace !== 'undefined' && event.namespace === 'bs.modal';
        },
        makeModalDraggable: function() {
            if (this.options.draggable) {
                this.getModalHeader().addClass(this.getNamespace('draggable')).on('mousedown', {dialog: this}, function(event) {
                    var dialog = event.data.dialog;
                    dialog.draggableData.isMouseDown = true;
                    var dialogOffset = dialog.getModalDialog().offset();
                    dialog.draggableData.mouseOffset = {
                        top: event.clientY - dialogOffset.top,
                        left: event.clientX - dialogOffset.left
                    };
                });
                this.getModal().on('mouseup mouseleave', {dialog: this}, function(event) {
                    event.data.dialog.draggableData.isMouseDown = false;
                });
                $('body').on('mousemove', {dialog: this}, function(event) {
                    var dialog = event.data.dialog;
                    if (!dialog.draggableData.isMouseDown) {
                        return;
                    }
                    dialog.getModalDialog().offset({
                        top: event.clientY - dialog.draggableData.mouseOffset.top,
                        left: event.clientX - dialog.draggableData.mouseOffset.left
                    });
                });
            }

            return this;
        },
        realize: function() {
            this.initModalStuff();
            this.getModal().addClass(BootstrapDialog.NAMESPACE)
            .addClass(this.getCssClass());
            this.updateSize();
            if (this.getDescription()) {
                this.getModal().attr('aria-describedby', this.getDescription());
            }
            this.getModalFooter().append(this.createFooterContent());
            this.getModalHeader().append(this.createHeaderContent());
            this.getModalBody().append(this.createBodyContent());
            this.getModal().data('bs.modal', new BootstrapDialogModal(this.getModal(), {
                backdrop: 'static',
                keyboard: false,
                show: false
            }));
            this.makeModalDraggable();
            this.handleModalEvents();
            this.setRealized(true);
            this.updateButtons();
            this.updateType();
            this.updateTitle();
            this.updateMessage();
            this.updateClosable();
            this.updateAnimate();
            this.updateSize();
            this.updateTabindex();
            this.setExistButtonsInitClose();
            return this;
        },
        open: function() {
            !this.isRealized() && this.realize();
            this.getModal().modal('show');

            return this;
        },
        close: function() {
            !this.isRealized() && this.realize();
            this.getModal().modal('hide');

            return this;
        }
    };

    // Add compatible methods.
    BootstrapDialog.prototype = $.extend(BootstrapDialog.prototype, BootstrapDialog.METHODS_TO_OVERRIDE[BootstrapDialogModal.getModalVersion()]);

    /**
     * RFC4122 version 4 compliant unique id creator.
     *
     * Added by https://github.com/tufanbarisyildirim/
     *
     *  @returns {String}
     */
    BootstrapDialog.newGuid = function() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    };

    /* ================================================
     * For lazy people
     * ================================================ */

    /**
     * Shortcut function: show
     *
     * @param {type} options
     * @returns the created dialog instance
     */
    BootstrapDialog.show = function(options) {
        return new BootstrapDialog(options).open();
    };

    /**
     * Alert window
     *
     * @returns the created dialog instance
     */
    BootstrapDialog.alert = function() {
        var options = {};
        var defaultOptions = {
            type: BootstrapDialog.TYPE_PRIMARY,
            title: null,
            message: null,
            closable: false,
            draggable: false,
            buttonLabel: BootstrapDialog.DEFAULT_TEXTS.OK,
            callback: null
        };

        if (typeof arguments[0] === 'object' && arguments[0].constructor === {}.constructor) {
            options = $.extend(true, defaultOptions, arguments[0]);
        } else {
            options = $.extend(true, defaultOptions, {
                message: arguments[0],
                callback: typeof arguments[1] !== 'undefined' ? arguments[1] : null
            });
        }

        return new BootstrapDialog({
            type: options.type,
            title: options.title,
            message: options.message,
            closable: options.closable,
            draggable: options.draggable,
            data: {
                callback: options.callback
            },
            onhide: function(dialog) {
                !dialog.getData('btnClicked') && dialog.isClosable() && typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
            },
            buttons: [{
                    label: options.buttonLabel,
                    action: function(dialog) {
                        dialog.setData('btnClicked', true);
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                        dialog.close();
                    }
                }]
        }).open();
    };

    /**
     * Confirm window
     *
     * @returns the created dialog instance
     */
    BootstrapDialog.confirm = function() {
        var options = {};
        var defaultOptions = {
            type: BootstrapDialog.TYPE_PRIMARY,
            title: null,
            message: null,
            closable: false,
            draggable: false,
            btnCancelLabel: BootstrapDialog.DEFAULT_TEXTS.CANCEL,
            btnOKLabel: BootstrapDialog.DEFAULT_TEXTS.OK,
            btnOKClass: null,
            callback: null
        };
        if (typeof arguments[0] === 'object' && arguments[0].constructor === {}.constructor) {
            options = $.extend(true, defaultOptions, arguments[0]);
        } else {
            options = $.extend(true, defaultOptions, {
                message: arguments[0],
                closable: false,
                buttonLabel: BootstrapDialog.DEFAULT_TEXTS.OK,
                callback: typeof arguments[1] !== 'undefined' ? arguments[1] : null
            });
        }
        if (options.btnOKClass === null) {
            options.btnOKClass = ['btn', options.type.split('-')[1]].join('-');
        }

        return new BootstrapDialog({
            type: options.type,
            title: options.title,
            message: options.message,
            closable: options.closable,
            draggable: options.draggable,
            data: {
                callback: options.callback
            },
            buttons: [{
                    label: options.btnCancelLabel,
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                        dialog.close();
                    }
                }, {
                    label: options.btnOKLabel,
                    cssClass: options.btnOKClass,
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                        dialog.close();
                    }
                }]
        }).open();
    };

    /**
     * Warning window
     *
     * @param {type} message
     * @returns the created dialog instance
     */
    BootstrapDialog.warning = function(message, callback) {
        return new BootstrapDialog({
            type: BootstrapDialog.TYPE_WARNING,
            message: message
        }).open();
    };

    /**
     * Danger window
     *
     * @param {type} message
     * @returns the created dialog instance
     */
    BootstrapDialog.danger = function(message, callback) {
        return new BootstrapDialog({
            type: BootstrapDialog.TYPE_DANGER,
            message: message
        }).open();
    };

    /**
     * Success window
     *
     * @param {type} message
     * @returns the created dialog instance
     */
    BootstrapDialog.success = function(message, callback) {
        return new BootstrapDialog({
            type: BootstrapDialog.TYPE_SUCCESS,
            message: message
        }).open();
    };

    return BootstrapDialog;

}));

/*! Select2 4.0.1 | https://github.com/select2/select2/blob/master/LICENSE.md */
!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : jQuery);
}(function (a) {
    var b = function () {
        if (a && a.fn && a.fn.select2 && a.fn.select2.amd) var b = a.fn.select2.amd;
        var b;
        return function () {
            if (!b || !b.requirejs) {
                b ? c = b : b = {};
                var a, c, d;
                !function (b) {
                    function e(a, b) {
                        return u.call(a, b);
                    }

                    function f(a, b) {
                        var c, d, e, f, g, h, i, j, k, l, m, n = b && b.split("/"), o = s.map, p = o && o["*"] || {};
                        if (a && "." === a.charAt(0)) if (b) {
                            for (a = a.split("/"), g = a.length - 1, s.nodeIdCompat && w.test(a[g]) && (a[g] = a[g].replace(w, "")), a = n.slice(0, n.length - 1).concat(a), k = 0; k < a.length; k += 1) if (m = a[k], "." === m) a.splice(k, 1), k -= 1; else if (".." === m) {
                                if (1 === k && (".." === a[2] || ".." === a[0])) break;
                                k > 0 && (a.splice(k - 1, 2), k -= 2);
                            }
                            a = a.join("/");
                        } else 0 === a.indexOf("./") && (a = a.substring(2));
                        if ((n || p) && o) {
                            for (c = a.split("/"), k = c.length; k > 0; k -= 1) {
                                if (d = c.slice(0, k).join("/"), n) for (l = n.length; l > 0; l -= 1) if (e = o[n.slice(0, l).join("/")], e && (e = e[d])) {
                                    f = e, h = k;
                                    break;
                                }
                                if (f) break;
                                !i && p && p[d] && (i = p[d], j = k);
                            }
                            !f && i && (f = i, h = j), f && (c.splice(0, h, f), a = c.join("/"));
                        }
                        return a;
                    }

                    function g(a, c) {
                        return function () {
                            var d = v.call(arguments, 0);
                            return "string" != typeof d[0] && 1 === d.length && d.push(null), n.apply(b, d.concat([a, c]));
                        };
                    }

                    function h(a) {
                        return function (b) {
                            return f(b, a);
                        };
                    }

                    function i(a) {
                        return function (b) {
                            q[a] = b;
                        };
                    }

                    function j(a) {
                        if (e(r, a)) {
                            var c = r[a];
                            delete r[a], t[a] = !0, m.apply(b, c);
                        }
                        if (!e(q, a) && !e(t, a)) throw new Error("No " + a);
                        return q[a];
                    }

                    function k(a) {
                        var b, c = a ? a.indexOf("!") : -1;
                        return c > -1 && (b = a.substring(0, c), a = a.substring(c + 1, a.length)), [b, a];
                    }

                    function l(a) {
                        return function () {
                            return s && s.config && s.config[a] || {};
                        };
                    }

                    var m, n, o, p, q = {}, r = {}, s = {}, t = {}, u = Object.prototype.hasOwnProperty, v = [].slice,
                        w = /\.js$/;
                    o = function (a, b) {
                        var c, d = k(a), e = d[0];
                        return a = d[1], e && (e = f(e, b), c = j(e)), e ? a = c && c.normalize ? c.normalize(a, h(b)) : f(a, b) : (a = f(a, b), d = k(a), e = d[0], a = d[1], e && (c = j(e))), {
                            f: e ? e + "!" + a : a,
                            n: a,
                            pr: e,
                            p: c
                        };
                    }, p = {
                        require: function (a) {
                            return g(a);
                        }, exports: function (a) {
                            var b = q[a];
                            return "undefined" != typeof b ? b : q[a] = {};
                        }, module: function (a) {
                            return {id: a, uri: "", exports: q[a], config: l(a)};
                        }
                    }, m = function (a, c, d, f) {
                        var h, k, l, m, n, s, u = [], v = typeof d;
                        if (f = f || a, "undefined" === v || "function" === v) {
                            for (c = !c.length && d.length ? ["require", "exports", "module"] : c, n = 0; n < c.length; n += 1) if (m = o(c[n], f), k = m.f, "require" === k) u[n] = p.require(a); else if ("exports" === k) u[n] = p.exports(a), s = !0; else if ("module" === k) h = u[n] = p.module(a); else if (e(q, k) || e(r, k) || e(t, k)) u[n] = j(k); else {
                                if (!m.p) throw new Error(a + " missing " + k);
                                m.p.load(m.n, g(f, !0), i(k), {}), u[n] = q[k];
                            }
                            l = d ? d.apply(q[a], u) : void 0, a && (h && h.exports !== b && h.exports !== q[a] ? q[a] = h.exports : l === b && s || (q[a] = l));
                        } else a && (q[a] = d);
                    }, a = c = n = function (a, c, d, e, f) {
                        if ("string" == typeof a) return p[a] ? p[a](c) : j(o(a, c).f);
                        if (!a.splice) {
                            if (s = a, s.deps && n(s.deps, s.callback), !c) return;
                            c.splice ? (a = c, c = d, d = null) : a = b;
                        }
                        return c = c || function () {
                        }, "function" == typeof d && (d = e, e = f), e ? m(b, a, c, d) : setTimeout(function () {
                            m(b, a, c, d);
                        }, 4), n;
                    }, n.config = function (a) {
                        return n(a);
                    }, a._defined = q, d = function (a, b, c) {
                        if ("string" != typeof a) throw new Error("See almond README: incorrect module build, no module name");
                        b.splice || (c = b, b = []), e(q, a) || e(r, a) || (r[a] = [a, b, c]);
                    }, d.amd = {jQuery: !0};
                }(), b.requirejs = a, b.require = c, b.define = d;
            }
        }(), b.define("almond", function () {
        }), b.define("jquery", [], function () {
            var b = a || $;
            return null == b && console && console.error && console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."), b;
        }), b.define("select2/utils", ["jquery"], function (a) {
            function b(a) {
                var b = a.prototype, c = [];
                for (var d in b) {
                    var e = b[d];
                    "function" == typeof e && "constructor" !== d && c.push(d);
                }
                return c;
            }

            var c = {};
            c.Extend = function (a, b) {
                function c() {
                    this.constructor = a;
                }

                var d = {}.hasOwnProperty;
                for (var e in b) d.call(b, e) && (a[e] = b[e]);
                return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a;
            }, c.Decorate = function (a, c) {
                function d() {
                    var b = Array.prototype.unshift, d = c.prototype.constructor.length, e = a.prototype.constructor;
                    d > 0 && (b.call(arguments, a.prototype.constructor), e = c.prototype.constructor), e.apply(this, arguments);
                }

                function e() {
                    this.constructor = d;
                }

                var f = b(c), g = b(a);
                c.displayName = a.displayName, d.prototype = new e;
                for (var h = 0; h < g.length; h++) {
                    var i = g[h];
                    d.prototype[i] = a.prototype[i];
                }
                for (var j = (function (a) {
                    var b = function () {
                    };
                    a in d.prototype && (b = d.prototype[a]);
                    var e = c.prototype[a];
                    return function () {
                        var a = Array.prototype.unshift;
                        return a.call(arguments, b), e.apply(this, arguments);
                    };
                }), k = 0; k < f.length; k++) {
                    var l = f[k];
                    d.prototype[l] = j(l);
                }
                return d;
            };
            var d = function () {
                this.listeners = {};
            };
            return d.prototype.on = function (a, b) {
                this.listeners = this.listeners || {}, a in this.listeners ? this.listeners[a].push(b) : this.listeners[a] = [b];
            }, d.prototype.trigger = function (a) {
                var b = Array.prototype.slice;
                this.listeners = this.listeners || {}, a in this.listeners && this.invoke(this.listeners[a], b.call(arguments, 1)), "*" in this.listeners && this.invoke(this.listeners["*"], arguments);
            }, d.prototype.invoke = function (a, b) {
                for (var c = 0, d = a.length; d > c; c++) a[c].apply(this, b);
            }, c.Observable = d, c.generateChars = function (a) {
                for (var b = "", c = 0; a > c; c++) {
                    var d = Math.floor(36 * Math.random());
                    b += d.toString(36);
                }
                return b;
            }, c.bind = function (a, b) {
                return function () {
                    a.apply(b, arguments);
                };
            }, c._convertData = function (a) {
                for (var b in a) {
                    var c = b.split("-"), d = a;
                    if (1 !== c.length) {
                        for (var e = 0; e < c.length; e++) {
                            var f = c[e];
                            f = f.substring(0, 1).toLowerCase() + f.substring(1), f in d || (d[f] = {}), e == c.length - 1 && (d[f] = a[b]), d = d[f];
                        }
                        delete a[b];
                    }
                }
                return a;
            }, c.hasScroll = function (b, c) {
                var d = a(c), e = c.style.overflowX, f = c.style.overflowY;
                return e !== f || "hidden" !== f && "visible" !== f ? "scroll" === e || "scroll" === f ? !0 : d.innerHeight() < c.scrollHeight || d.innerWidth() < c.scrollWidth : !1;
            }, c.escapeMarkup = function (a) {
                var b = {
                    "\\": "&#92;",
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    '"': "&quot;",
                    "'": "&#39;",
                    "/": "&#47;"
                };
                return "string" != typeof a ? a : String(a).replace(/[&<>"'\/\\]/g, function (a) {
                    return b[a];
                });
            }, c.appendMany = function (b, c) {
                if ("1.7" === a.fn.jquery.substr(0, 3)) {
                    var d = a();
                    a.map(c, function (a) {
                        d = d.add(a);
                    }), c = d;
                }
                b.append(c);
            }, c;
        }), b.define("select2/results", ["jquery", "./utils"], function (a, b) {
            function c(a, b, d) {
                this.$element = a, this.data = d, this.options = b, c.__super__.constructor.call(this);
            }

            return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<ul class="select2-results__options" role="tree"></ul>');
                return this.options.get("multiple") && b.attr("aria-multiselectable", "true"), this.$results = b, b;
            }, c.prototype.clear = function () {
                this.$results.empty();
            }, c.prototype.displayMessage = function (b) {
                var c = this.options.get("escapeMarkup");
                this.clear(), this.hideLoading();
                var d = a('<li role="treeitem" aria-live="assertive" class="select2-results__option"></li>'),
                    e = this.options.get("translations").get(b.message);
                d.append(c(e(b.args))), d[0].className += " select2-results__message", this.$results.append(d);
            }, c.prototype.hideMessages = function () {
                this.$results.find(".select2-results__message").remove();
            }, c.prototype.append = function (a) {
                this.hideLoading();
                var b = [];
                if (null == a.results || 0 === a.results.length) return void(0 === this.$results.children().length && this.trigger("results:message", {message: "noResults"}));
                a.results = this.sort(a.results);
                for (var c = 0; c < a.results.length; c++) {
                    var d = a.results[c], e = this.option(d);
                    b.push(e);
                }
                this.$results.append(b);
            }, c.prototype.position = function (a, b) {
                var c = b.find(".select2-results");
                c.append(a);
            }, c.prototype.sort = function (a) {
                var b = this.options.get("sorter");
                return b(a);
            }, c.prototype.setClasses = function () {
                var b = this;
                this.data.current(function (c) {
                    var d = a.map(c, function (a) {
                        return a.id.toString();
                    }), e = b.$results.find(".select2-results__option[aria-selected]");
                    e.each(function () {
                        var b = a(this), c = a.data(this, "data"), e = "" + c.id;
                        null != c.element && c.element.selected || null == c.element && a.inArray(e, d) > -1 ? b.attr("aria-selected", "true") : b.attr("aria-selected", "false");
                    });
                    var f = e.filter("[aria-selected=true]");
                    f.length > 0 ? f.first().trigger("mouseenter") : e.first().trigger("mouseenter");
                });
            }, c.prototype.showLoading = function (a) {
                this.hideLoading();
                var b = this.options.get("translations").get("searching"), c = {disabled: !0, loading: !0, text: b(a)},
                    d = this.option(c);
                d.className += " loading-results", this.$results.prepend(d);
            }, c.prototype.hideLoading = function () {
                this.$results.find(".loading-results").remove();
            }, c.prototype.option = function (b) {
                var c = document.createElement("li");
                c.className = "select2-results__option";
                var d = {role: "treeitem", "aria-selected": "false"};
                b.disabled && (delete d["aria-selected"], d["aria-disabled"] = "true"), null == b.id && delete d["aria-selected"], null != b._resultId && (c.id = b._resultId), b.title && (c.title = b.title), b.children && (d.role = "group", d["aria-label"] = b.text, delete d["aria-selected"]);
                for (var e in d) {
                    var f = d[e];
                    c.setAttribute(e, f);
                }
                if (b.children) {
                    var g = a(c), h = document.createElement("strong");
                    h.className = "select2-results__group";
                    a(h);
                    this.template(b, h);
                    for (var i = [], j = 0; j < b.children.length; j++) {
                        var k = b.children[j], l = this.option(k);
                        i.push(l);
                    }
                    var m = a("<ul></ul>", {"class": "select2-results__options select2-results__options--nested"});
                    m.append(i), g.append(h), g.append(m);
                } else this.template(b, c);
                return a.data(c, "data", b), c;
            }, c.prototype.bind = function (b, c) {
                var d = this, e = b.id + "-results";
                this.$results.attr("id", e), b.on("results:all", function (a) {
                    d.clear(), d.append(a.data), b.isOpen() && d.setClasses();
                }), b.on("results:append", function (a) {
                    d.append(a.data), b.isOpen() && d.setClasses();
                }), b.on("query", function (a) {
                    d.hideMessages(), d.showLoading(a);
                }), b.on("select", function () {
                    b.isOpen() && d.setClasses();
                }), b.on("unselect", function () {
                    b.isOpen() && d.setClasses();
                }), b.on("open", function () {
                    d.$results.attr("aria-expanded", "true"), d.$results.attr("aria-hidden", "false"), d.setClasses(), d.ensureHighlightVisible();
                }), b.on("close", function () {
                    d.$results.attr("aria-expanded", "false"), d.$results.attr("aria-hidden", "true"), d.$results.removeAttr("aria-activedescendant");
                }), b.on("results:toggle", function () {
                    var a = d.getHighlightedResults();
                    0 !== a.length && a.trigger("mouseup");
                }), b.on("results:select", function () {
                    var a = d.getHighlightedResults();
                    if (0 !== a.length) {
                        var b = a.data("data");
                        "true" == a.attr("aria-selected") ? d.trigger("close", {}) : d.trigger("select", {data: b});
                    }
                }), b.on("results:previous", function () {
                    var a = d.getHighlightedResults(), b = d.$results.find("[aria-selected]"), c = b.index(a);
                    if (0 !== c) {
                        var e = c - 1;
                        0 === a.length && (e = 0);
                        var f = b.eq(e);
                        f.trigger("mouseenter");
                        var g = d.$results.offset().top, h = f.offset().top, i = d.$results.scrollTop() + (h - g);
                        0 === e ? d.$results.scrollTop(0) : 0 > h - g && d.$results.scrollTop(i);
                    }
                }), b.on("results:next", function () {
                    var a = d.getHighlightedResults(), b = d.$results.find("[aria-selected]"), c = b.index(a),
                        e = c + 1;
                    if (!(e >= b.length)) {
                        var f = b.eq(e);
                        f.trigger("mouseenter");
                        var g = d.$results.offset().top + d.$results.outerHeight(!1),
                            h = f.offset().top + f.outerHeight(!1), i = d.$results.scrollTop() + h - g;
                        0 === e ? d.$results.scrollTop(0) : h > g && d.$results.scrollTop(i);
                    }
                }), b.on("results:focus", function (a) {
                    a.element.addClass("select2-results__option--highlighted");
                }), b.on("results:message", function (a) {
                    d.displayMessage(a);
                }), a.fn.mousewheel && this.$results.on("mousewheel", function (a) {
                    var b = d.$results.scrollTop(),
                        c = d.$results.get(0).scrollHeight - d.$results.scrollTop() + a.deltaY,
                        e = a.deltaY > 0 && b - a.deltaY <= 0, f = a.deltaY < 0 && c <= d.$results.height();
                    e ? (d.$results.scrollTop(0), a.preventDefault(), a.stopPropagation()) : f && (d.$results.scrollTop(d.$results.get(0).scrollHeight - d.$results.height()), a.preventDefault(), a.stopPropagation());
                }), this.$results.on("mouseup", ".select2-results__option[aria-selected]", function (b) {
                    var c = a(this), e = c.data("data");
                    return "true" === c.attr("aria-selected") ? void(d.options.get("multiple") ? d.trigger("unselect", {
                        originalEvent: b,
                        data: e
                    }) : d.trigger("close", {})) : void d.trigger("select", {originalEvent: b, data: e});
                }), this.$results.on("mouseenter", ".select2-results__option[aria-selected]", function (b) {
                    var c = a(this).data("data");
                    d.getHighlightedResults().removeClass("select2-results__option--highlighted"), d.trigger("results:focus", {
                        data: c,
                        element: a(this)
                    });
                });
            }, c.prototype.getHighlightedResults = function () {
                var a = this.$results.find(".select2-results__option--highlighted");
                return a;
            }, c.prototype.destroy = function () {
                this.$results.remove();
            }, c.prototype.ensureHighlightVisible = function () {
                var a = this.getHighlightedResults();
                if (0 !== a.length) {
                    var b = this.$results.find("[aria-selected]"), c = b.index(a), d = this.$results.offset().top,
                        e = a.offset().top, f = this.$results.scrollTop() + (e - d), g = e - d;
                    f -= 2 * a.outerHeight(!1), 2 >= c ? this.$results.scrollTop(0) : (g > this.$results.outerHeight() || 0 > g) && this.$results.scrollTop(f);
                }
            }, c.prototype.template = function (b, c) {
                var d = this.options.get("templateResult"), e = this.options.get("escapeMarkup"), f = d(b, c);
                null == f ? c.style.display = "none" : "string" == typeof f ? c.innerHTML = e(f) : a(c).append(f);
            }, c;
        }), b.define("select2/keys", [], function () {
            var a = {
                BACKSPACE: 8,
                TAB: 9,
                ENTER: 13,
                SHIFT: 16,
                CTRL: 17,
                ALT: 18,
                ESC: 27,
                SPACE: 32,
                PAGE_UP: 33,
                PAGE_DOWN: 34,
                END: 35,
                HOME: 36,
                LEFT: 37,
                UP: 38,
                RIGHT: 39,
                DOWN: 40,
                DELETE: 46
            };
            return a;
        }), b.define("select2/selection/base", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this);
            }

            return b.Extend(d, b.Observable), d.prototype.render = function () {
                var b = a('<span class="select2-selection" role="combobox"  aria-haspopup="true" aria-expanded="false"></span>');
                return this._tabindex = 0, null != this.$element.data("old-tabindex") ? this._tabindex = this.$element.data("old-tabindex") : null != this.$element.attr("tabindex") && (this._tabindex = this.$element.attr("tabindex")), b.attr("title", this.$element.attr("title")), b.attr("tabindex", this._tabindex), this.$selection = b, b;
            }, d.prototype.bind = function (a, b) {
                var d = this, e = (a.id + "-container", a.id + "-results");
                this.container = a, this.$selection.on("focus", function (a) {
                    d.trigger("focus", a);
                }), this.$selection.on("blur", function (a) {
                    d._handleBlur(a);
                }), this.$selection.on("keydown", function (a) {
                    d.trigger("keypress", a), a.which === c.SPACE && a.preventDefault();
                }), a.on("results:focus", function (a) {
                    d.$selection.attr("aria-activedescendant", a.data._resultId);
                }), a.on("selection:update", function (a) {
                    d.update(a.data);
                }), a.on("open", function () {
                    d.$selection.attr("aria-expanded", "true"), d.$selection.attr("aria-owns", e), d._attachCloseHandler(a);
                }), a.on("close", function () {
                    d.$selection.attr("aria-expanded", "false"), d.$selection.removeAttr("aria-activedescendant"), d.$selection.removeAttr("aria-owns"), d.$selection.focus(), d._detachCloseHandler(a);
                }), a.on("enable", function () {
                    d.$selection.attr("tabindex", d._tabindex);
                }), a.on("disable", function () {
                    d.$selection.attr("tabindex", "-1");
                });
            }, d.prototype._handleBlur = function (b) {
                var c = this;
                window.setTimeout(function () {
                    document.activeElement == c.$selection[0] || a.contains(c.$selection[0], document.activeElement) || c.trigger("blur", b);
                }, 1);
            }, d.prototype._attachCloseHandler = function (b) {
                a(document.body).on("mousedown.select2." + b.id, function (b) {
                    var c = a(b.target), d = c.closest(".select2"), e = a(".select2.select2-container--open");
                    e.each(function () {
                        var b = a(this);
                        if (this != d[0]) {
                            var c = b.data("element");
                            c.select2("close");
                        }
                    });
                });
            }, d.prototype._detachCloseHandler = function (b) {
                a(document.body).off("mousedown.select2." + b.id);
            }, d.prototype.position = function (a, b) {
                var c = b.find(".selection");
                c.append(a);
            }, d.prototype.destroy = function () {
                this._detachCloseHandler(this.container);
            }, d.prototype.update = function (a) {
                throw new Error("The `update` method must be defined in child classes.");
            }, d;
        }), b.define("select2/selection/single", ["jquery", "./base", "../utils", "../keys"], function (a, b, c, d) {
            function e() {
                e.__super__.constructor.apply(this, arguments);
            }

            return c.Extend(e, b), e.prototype.render = function () {
                var a = e.__super__.render.call(this);
                return a.addClass("select2-selection--single"), a.html('<span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'), a;
            }, e.prototype.bind = function (a, b) {
                var c = this;
                e.__super__.bind.apply(this, arguments);
                var d = a.id + "-container";
                this.$selection.find(".select2-selection__rendered").attr("id", d), this.$selection.attr("aria-labelledby", d), this.$selection.on("mousedown", function (a) {
                    1 === a.which && c.trigger("toggle", {originalEvent: a});
                }), this.$selection.on("focus", function (a) {
                }), this.$selection.on("blur", function (a) {
                }), a.on("selection:update", function (a) {
                    c.update(a.data);
                });
            }, e.prototype.clear = function () {
                this.$selection.find(".select2-selection__rendered").empty();
            }, e.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection"), d = this.options.get("escapeMarkup");
                return d(c(a, b));
            }, e.prototype.selectionContainer = function () {
                return a("<span></span>");
            }, e.prototype.update = function (a) {
                if (0 === a.length) return void this.clear();
                var b = a[0], c = this.$selection.find(".select2-selection__rendered"), d = this.display(b, c);
                c.empty().append(d), c.prop("title", b.title || b.text);
            }, e;
        }), b.define("select2/selection/multiple", ["jquery", "./base", "../utils"], function (a, b, c) {
            function d(a, b) {
                d.__super__.constructor.apply(this, arguments);
            }

            return c.Extend(d, b), d.prototype.render = function () {
                var a = d.__super__.render.call(this);
                return a.addClass("select2-selection--multiple"), a.html('<ul class="select2-selection__rendered"></ul>'), a;
            }, d.prototype.bind = function (b, c) {
                var e = this;
                d.__super__.bind.apply(this, arguments), this.$selection.on("click", function (a) {
                    e.trigger("toggle", {originalEvent: a});
                }), this.$selection.on("click", ".select2-selection__choice__remove", function (b) {
                    if (!e.options.get("disabled")) {
                        var c = a(this), d = c.parent(), f = d.data("data");
                        e.trigger("unselect", {originalEvent: b, data: f});
                    }
                });
            }, d.prototype.clear = function () {
                this.$selection.find(".select2-selection__rendered").empty();
            }, d.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection"), d = this.options.get("escapeMarkup");
                return d(c(a, b));
            }, d.prototype.selectionContainer = function () {
                var b = a('<li class="select2-selection__choice"><span class="select2-selection__choice__remove" role="presentation">&times;</span></li>');
                return b;
            }, d.prototype.update = function (a) {
                if (this.clear(), 0 !== a.length) {
                    for (var b = [], d = 0; d < a.length; d++) {
                        var e = a[d], f = this.selectionContainer(), g = this.display(e, f);
                        f.append(g), f.prop("title", e.title || e.text), f.data("data", e), b.push(f);
                    }
                    var h = this.$selection.find(".select2-selection__rendered");
                    c.appendMany(h, b);
                }
            }, d;
        }), b.define("select2/selection/placeholder", ["../utils"], function (a) {
            function b(a, b, c) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c);
            }

            return b.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = {id: "", text: b}), b;
            }, b.prototype.createPlaceholder = function (a, b) {
                var c = this.selectionContainer();
                return c.html(this.display(b)), c.addClass("select2-selection__placeholder").removeClass("select2-selection__choice"), c;
            }, b.prototype.update = function (a, b) {
                var c = 1 == b.length && b[0].id != this.placeholder.id, d = b.length > 1;
                if (d || c) return a.call(this, b);
                this.clear();
                var e = this.createPlaceholder(this.placeholder);
                this.$selection.find(".select2-selection__rendered").append(e);
            }, b;
        }), b.define("select2/selection/allowClear", ["jquery", "../keys"], function (a, b) {
            function c() {
            }

            return c.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), null == this.placeholder && this.options.get("debug") && window.console && console.error && console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option."), this.$selection.on("mousedown", ".select2-selection__clear", function (a) {
                    d._handleClear(a);
                }), b.on("keypress", function (a) {
                    d._handleKeyboardClear(a, b);
                });
            }, c.prototype._handleClear = function (a, b) {
                if (!this.options.get("disabled")) {
                    var c = this.$selection.find(".select2-selection__clear");
                    if (0 !== c.length) {
                        b.stopPropagation();
                        for (var d = c.data("data"), e = 0; e < d.length; e++) {
                            var f = {data: d[e]};
                            if (this.trigger("unselect", f), f.prevented) return;
                        }
                        this.$element.val(this.placeholder.id).trigger("change"), this.trigger("toggle", {});
                    }
                }
            }, c.prototype._handleKeyboardClear = function (a, c, d) {
                d.isOpen() || (c.which == b.DELETE || c.which == b.BACKSPACE) && this._handleClear(c);
            }, c.prototype.update = function (b, c) {
                if (b.call(this, c), !(this.$selection.find(".select2-selection__placeholder").length > 0 || 0 === c.length)) {
                    var d = a('<span class="select2-selection__clear">&times;</span>');
                    d.data("data", c), this.$selection.find(".select2-selection__rendered").prepend(d);
                }
            }, c;
        }), b.define("select2/selection/search", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b, c) {
                a.call(this, b, c);
            }

            return d.prototype.render = function (b) {
                var c = a('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" /></li>');
                this.$searchContainer = c, this.$search = c.find("input");
                var d = b.call(this);
                return this._transferTabIndex(), d;
            }, d.prototype.bind = function (a, b, d) {
                var e = this;
                a.call(this, b, d), b.on("open", function () {
                    e.$search.trigger("focus");
                }), b.on("close", function () {
                    e.$search.val(""), e.$search.removeAttr("aria-activedescendant"), e.$search.trigger("focus");
                }), b.on("enable", function () {
                    e.$search.prop("disabled", !1), e._transferTabIndex();
                }), b.on("disable", function () {
                    e.$search.prop("disabled", !0);
                }), b.on("focus", function (a) {
                    e.$search.trigger("focus");
                }), b.on("results:focus", function (a) {
                    e.$search.attr("aria-activedescendant", a.id);
                }), this.$selection.on("focusin", ".select2-search--inline", function (a) {
                    e.trigger("focus", a);
                }), this.$selection.on("focusout", ".select2-search--inline", function (a) {
                    e._handleBlur(a);
                }), this.$selection.on("keydown", ".select2-search--inline", function (a) {
                    a.stopPropagation(), e.trigger("keypress", a), e._keyUpPrevented = a.isDefaultPrevented();
                    var b = a.which;
                    if (b === c.BACKSPACE && "" === e.$search.val()) {
                        var d = e.$searchContainer.prev(".select2-selection__choice");
                        if (d.length > 0) {
                            var f = d.data("data");
                            e.searchRemoveChoice(f), a.preventDefault();
                        }
                    }
                });
                var f = document.documentMode, g = f && 11 >= f;
                this.$selection.on("input.searchcheck", ".select2-search--inline", function (a) {
                    return g ? void e.$selection.off("input.search input.searchcheck") : void e.$selection.off("keyup.search");
                }), this.$selection.on("keyup.search input.search", ".select2-search--inline", function (a) {
                    if (g && "input" === a.type) return void e.$selection.off("input.search input.searchcheck");
                    var b = a.which;
                    b != c.SHIFT && b != c.CTRL && b != c.ALT && b != c.TAB && e.handleSearch(a);
                });
            }, d.prototype._transferTabIndex = function (a) {
                this.$search.attr("tabindex", this.$selection.attr("tabindex")), this.$selection.attr("tabindex", "-1");
            }, d.prototype.createPlaceholder = function (a, b) {
                this.$search.attr("placeholder", b.text);
            }, d.prototype.update = function (a, b) {
                var c = this.$search[0] == document.activeElement;
                this.$search.attr("placeholder", ""), a.call(this, b), this.$selection.find(".select2-selection__rendered").append(this.$searchContainer), this.resizeSearch(), c && this.$search.focus();
            }, d.prototype.handleSearch = function () {
                if (this.resizeSearch(), !this._keyUpPrevented) {
                    var a = this.$search.val();
                    this.trigger("query", {term: a});
                }
                this._keyUpPrevented = !1;
            }, d.prototype.searchRemoveChoice = function (a, b) {
                this.trigger("unselect", {data: b}), this.$search.val(b.text), this.handleSearch();
            }, d.prototype.resizeSearch = function () {
                this.$search.css("width", "25px");
                var a = "";
                if ("" !== this.$search.attr("placeholder")) a = this.$selection.find(".select2-selection__rendered").innerWidth(); else {
                    var b = this.$search.val().length + 1;
                    a = .75 * b + "em";
                }
                this.$search.css("width", a);
            }, d;
        }), b.define("select2/selection/eventRelay", ["jquery"], function (a) {
            function b() {
            }

            return b.prototype.bind = function (b, c, d) {
                var e = this,
                    f = ["open", "opening", "close", "closing", "select", "selecting", "unselect", "unselecting"],
                    g = ["opening", "closing", "selecting", "unselecting"];
                b.call(this, c, d), c.on("*", function (b, c) {
                    if (-1 !== a.inArray(b, f)) {
                        c = c || {};
                        var d = a.Event("select2:" + b, {params: c});
                        e.$element.trigger(d), -1 !== a.inArray(b, g) && (c.prevented = d.isDefaultPrevented());
                    }
                });
            }, b;
        }), b.define("select2/translation", ["jquery", "require"], function (a, b) {
            function c(a) {
                this.dict = a || {};
            }

            return c.prototype.all = function () {
                return this.dict;
            }, c.prototype.get = function (a) {
                return this.dict[a];
            }, c.prototype.extend = function (b) {
                this.dict = a.extend({}, b.all(), this.dict);
            }, c._cache = {}, c.loadPath = function (a) {
                if (!(a in c._cache)) {
                    var d = b(a);
                    c._cache[a] = d;
                }
                return new c(c._cache[a]);
            }, c;
        }), b.define("select2/diacritics", [], function () {
            var a = {
                "Ⓐ": "A",
                "Ａ": "A",
                "À": "A",
                "Á": "A",
                "Â": "A",
                "Ầ": "A",
                "Ấ": "A",
                "Ẫ": "A",
                "Ẩ": "A",
                "Ã": "A",
                "Ā": "A",
                "Ă": "A",
                "Ằ": "A",
                "Ắ": "A",
                "Ẵ": "A",
                "Ẳ": "A",
                "Ȧ": "A",
                "Ǡ": "A",
                "Ä": "A",
                "Ǟ": "A",
                "Ả": "A",
                "Å": "A",
                "Ǻ": "A",
                "Ǎ": "A",
                "Ȁ": "A",
                "Ȃ": "A",
                "Ạ": "A",
                "Ậ": "A",
                "Ặ": "A",
                "Ḁ": "A",
                "Ą": "A",
                "Ⱥ": "A",
                "Ɐ": "A",
                "Ꜳ": "AA",
                "Æ": "AE",
                "Ǽ": "AE",
                "Ǣ": "AE",
                "Ꜵ": "AO",
                "Ꜷ": "AU",
                "Ꜹ": "AV",
                "Ꜻ": "AV",
                "Ꜽ": "AY",
                "Ⓑ": "B",
                "Ｂ": "B",
                "Ḃ": "B",
                "Ḅ": "B",
                "Ḇ": "B",
                "Ƀ": "B",
                "Ƃ": "B",
                "Ɓ": "B",
                "Ⓒ": "C",
                "Ｃ": "C",
                "Ć": "C",
                "Ĉ": "C",
                "Ċ": "C",
                "Č": "C",
                "Ç": "C",
                "Ḉ": "C",
                "Ƈ": "C",
                "Ȼ": "C",
                "Ꜿ": "C",
                "Ⓓ": "D",
                "Ｄ": "D",
                "Ḋ": "D",
                "Ď": "D",
                "Ḍ": "D",
                "Ḑ": "D",
                "Ḓ": "D",
                "Ḏ": "D",
                "Đ": "D",
                "Ƌ": "D",
                "Ɗ": "D",
                "Ɖ": "D",
                "Ꝺ": "D",
                "Ǳ": "DZ",
                "Ǆ": "DZ",
                "ǲ": "Dz",
                "ǅ": "Dz",
                "Ⓔ": "E",
                "Ｅ": "E",
                "È": "E",
                "É": "E",
                "Ê": "E",
                "Ề": "E",
                "Ế": "E",
                "Ễ": "E",
                "Ể": "E",
                "Ẽ": "E",
                "Ē": "E",
                "Ḕ": "E",
                "Ḗ": "E",
                "Ĕ": "E",
                "Ė": "E",
                "Ë": "E",
                "Ẻ": "E",
                "Ě": "E",
                "Ȅ": "E",
                "Ȇ": "E",
                "Ẹ": "E",
                "Ệ": "E",
                "Ȩ": "E",
                "Ḝ": "E",
                "Ę": "E",
                "Ḙ": "E",
                "Ḛ": "E",
                "Ɛ": "E",
                "Ǝ": "E",
                "Ⓕ": "F",
                "Ｆ": "F",
                "Ḟ": "F",
                "Ƒ": "F",
                "Ꝼ": "F",
                "Ⓖ": "G",
                "Ｇ": "G",
                "Ǵ": "G",
                "Ĝ": "G",
                "Ḡ": "G",
                "Ğ": "G",
                "Ġ": "G",
                "Ǧ": "G",
                "Ģ": "G",
                "Ǥ": "G",
                "Ɠ": "G",
                "Ꞡ": "G",
                "Ᵹ": "G",
                "Ꝿ": "G",
                "Ⓗ": "H",
                "Ｈ": "H",
                "Ĥ": "H",
                "Ḣ": "H",
                "Ḧ": "H",
                "Ȟ": "H",
                "Ḥ": "H",
                "Ḩ": "H",
                "Ḫ": "H",
                "Ħ": "H",
                "Ⱨ": "H",
                "Ⱶ": "H",
                "Ɥ": "H",
                "Ⓘ": "I",
                "Ｉ": "I",
                "Ì": "I",
                "Í": "I",
                "Î": "I",
                "Ĩ": "I",
                "Ī": "I",
                "Ĭ": "I",
                "İ": "I",
                "Ï": "I",
                "Ḯ": "I",
                "Ỉ": "I",
                "Ǐ": "I",
                "Ȉ": "I",
                "Ȋ": "I",
                "Ị": "I",
                "Į": "I",
                "Ḭ": "I",
                "Ɨ": "I",
                "Ⓙ": "J",
                "Ｊ": "J",
                "Ĵ": "J",
                "Ɉ": "J",
                "Ⓚ": "K",
                "Ｋ": "K",
                "Ḱ": "K",
                "Ǩ": "K",
                "Ḳ": "K",
                "Ķ": "K",
                "Ḵ": "K",
                "Ƙ": "K",
                "Ⱪ": "K",
                "Ꝁ": "K",
                "Ꝃ": "K",
                "Ꝅ": "K",
                "Ꞣ": "K",
                "Ⓛ": "L",
                "Ｌ": "L",
                "Ŀ": "L",
                "Ĺ": "L",
                "Ľ": "L",
                "Ḷ": "L",
                "Ḹ": "L",
                "Ļ": "L",
                "Ḽ": "L",
                "Ḻ": "L",
                "Ł": "L",
                "Ƚ": "L",
                "Ɫ": "L",
                "Ⱡ": "L",
                "Ꝉ": "L",
                "Ꝇ": "L",
                "Ꞁ": "L",
                "Ǉ": "LJ",
                "ǈ": "Lj",
                "Ⓜ": "M",
                "Ｍ": "M",
                "Ḿ": "M",
                "Ṁ": "M",
                "Ṃ": "M",
                "Ɱ": "M",
                "Ɯ": "M",
                "Ⓝ": "N",
                "Ｎ": "N",
                "Ǹ": "N",
                "Ń": "N",
                "Ñ": "N",
                "Ṅ": "N",
                "Ň": "N",
                "Ṇ": "N",
                "Ņ": "N",
                "Ṋ": "N",
                "Ṉ": "N",
                "Ƞ": "N",
                "Ɲ": "N",
                "Ꞑ": "N",
                "Ꞥ": "N",
                "Ǌ": "NJ",
                "ǋ": "Nj",
                "Ⓞ": "O",
                "Ｏ": "O",
                "Ò": "O",
                "Ó": "O",
                "Ô": "O",
                "Ồ": "O",
                "Ố": "O",
                "Ỗ": "O",
                "Ổ": "O",
                "Õ": "O",
                "Ṍ": "O",
                "Ȭ": "O",
                "Ṏ": "O",
                "Ō": "O",
                "Ṑ": "O",
                "Ṓ": "O",
                "Ŏ": "O",
                "Ȯ": "O",
                "Ȱ": "O",
                "Ö": "O",
                "Ȫ": "O",
                "Ỏ": "O",
                "Ő": "O",
                "Ǒ": "O",
                "Ȍ": "O",
                "Ȏ": "O",
                "Ơ": "O",
                "Ờ": "O",
                "Ớ": "O",
                "Ỡ": "O",
                "Ở": "O",
                "Ợ": "O",
                "Ọ": "O",
                "Ộ": "O",
                "Ǫ": "O",
                "Ǭ": "O",
                "Ø": "O",
                "Ǿ": "O",
                "Ɔ": "O",
                "Ɵ": "O",
                "Ꝋ": "O",
                "Ꝍ": "O",
                "Ƣ": "OI",
                "Ꝏ": "OO",
                "Ȣ": "OU",
                "Ⓟ": "P",
                "Ｐ": "P",
                "Ṕ": "P",
                "Ṗ": "P",
                "Ƥ": "P",
                "Ᵽ": "P",
                "Ꝑ": "P",
                "Ꝓ": "P",
                "Ꝕ": "P",
                "Ⓠ": "Q",
                "Ｑ": "Q",
                "Ꝗ": "Q",
                "Ꝙ": "Q",
                "Ɋ": "Q",
                "Ⓡ": "R",
                "Ｒ": "R",
                "Ŕ": "R",
                "Ṙ": "R",
                "Ř": "R",
                "Ȑ": "R",
                "Ȓ": "R",
                "Ṛ": "R",
                "Ṝ": "R",
                "Ŗ": "R",
                "Ṟ": "R",
                "Ɍ": "R",
                "Ɽ": "R",
                "Ꝛ": "R",
                "Ꞧ": "R",
                "Ꞃ": "R",
                "Ⓢ": "S",
                "Ｓ": "S",
                "ẞ": "S",
                "Ś": "S",
                "Ṥ": "S",
                "Ŝ": "S",
                "Ṡ": "S",
                "Š": "S",
                "Ṧ": "S",
                "Ṣ": "S",
                "Ṩ": "S",
                "Ș": "S",
                "Ş": "S",
                "Ȿ": "S",
                "Ꞩ": "S",
                "Ꞅ": "S",
                "Ⓣ": "T",
                "Ｔ": "T",
                "Ṫ": "T",
                "Ť": "T",
                "Ṭ": "T",
                "Ț": "T",
                "Ţ": "T",
                "Ṱ": "T",
                "Ṯ": "T",
                "Ŧ": "T",
                "Ƭ": "T",
                "Ʈ": "T",
                "Ⱦ": "T",
                "Ꞇ": "T",
                "Ꜩ": "TZ",
                "Ⓤ": "U",
                "Ｕ": "U",
                "Ù": "U",
                "Ú": "U",
                "Û": "U",
                "Ũ": "U",
                "Ṹ": "U",
                "Ū": "U",
                "Ṻ": "U",
                "Ŭ": "U",
                "Ü": "U",
                "Ǜ": "U",
                "Ǘ": "U",
                "Ǖ": "U",
                "Ǚ": "U",
                "Ủ": "U",
                "Ů": "U",
                "Ű": "U",
                "Ǔ": "U",
                "Ȕ": "U",
                "Ȗ": "U",
                "Ư": "U",
                "Ừ": "U",
                "Ứ": "U",
                "Ữ": "U",
                "Ử": "U",
                "Ự": "U",
                "Ụ": "U",
                "Ṳ": "U",
                "Ų": "U",
                "Ṷ": "U",
                "Ṵ": "U",
                "Ʉ": "U",
                "Ⓥ": "V",
                "Ｖ": "V",
                "Ṽ": "V",
                "Ṿ": "V",
                "Ʋ": "V",
                "Ꝟ": "V",
                "Ʌ": "V",
                "Ꝡ": "VY",
                "Ⓦ": "W",
                "Ｗ": "W",
                "Ẁ": "W",
                "Ẃ": "W",
                "Ŵ": "W",
                "Ẇ": "W",
                "Ẅ": "W",
                "Ẉ": "W",
                "Ⱳ": "W",
                "Ⓧ": "X",
                "Ｘ": "X",
                "Ẋ": "X",
                "Ẍ": "X",
                "Ⓨ": "Y",
                "Ｙ": "Y",
                "Ỳ": "Y",
                "Ý": "Y",
                "Ŷ": "Y",
                "Ỹ": "Y",
                "Ȳ": "Y",
                "Ẏ": "Y",
                "Ÿ": "Y",
                "Ỷ": "Y",
                "Ỵ": "Y",
                "Ƴ": "Y",
                "Ɏ": "Y",
                "Ỿ": "Y",
                "Ⓩ": "Z",
                "Ｚ": "Z",
                "Ź": "Z",
                "Ẑ": "Z",
                "Ż": "Z",
                "Ž": "Z",
                "Ẓ": "Z",
                "Ẕ": "Z",
                "Ƶ": "Z",
                "Ȥ": "Z",
                "Ɀ": "Z",
                "Ⱬ": "Z",
                "Ꝣ": "Z",
                "ⓐ": "a",
                "ａ": "a",
                "ẚ": "a",
                "à": "a",
                "á": "a",
                "â": "a",
                "ầ": "a",
                "ấ": "a",
                "ẫ": "a",
                "ẩ": "a",
                "ã": "a",
                "ā": "a",
                "ă": "a",
                "ằ": "a",
                "ắ": "a",
                "ẵ": "a",
                "ẳ": "a",
                "ȧ": "a",
                "ǡ": "a",
                "ä": "a",
                "ǟ": "a",
                "ả": "a",
                "å": "a",
                "ǻ": "a",
                "ǎ": "a",
                "ȁ": "a",
                "ȃ": "a",
                "ạ": "a",
                "ậ": "a",
                "ặ": "a",
                "ḁ": "a",
                "ą": "a",
                "ⱥ": "a",
                "ɐ": "a",
                "ꜳ": "aa",
                "æ": "ae",
                "ǽ": "ae",
                "ǣ": "ae",
                "ꜵ": "ao",
                "ꜷ": "au",
                "ꜹ": "av",
                "ꜻ": "av",
                "ꜽ": "ay",
                "ⓑ": "b",
                "ｂ": "b",
                "ḃ": "b",
                "ḅ": "b",
                "ḇ": "b",
                "ƀ": "b",
                "ƃ": "b",
                "ɓ": "b",
                "ⓒ": "c",
                "ｃ": "c",
                "ć": "c",
                "ĉ": "c",
                "ċ": "c",
                "č": "c",
                "ç": "c",
                "ḉ": "c",
                "ƈ": "c",
                "ȼ": "c",
                "ꜿ": "c",
                "ↄ": "c",
                "ⓓ": "d",
                "ｄ": "d",
                "ḋ": "d",
                "ď": "d",
                "ḍ": "d",
                "ḑ": "d",
                "ḓ": "d",
                "ḏ": "d",
                "đ": "d",
                "ƌ": "d",
                "ɖ": "d",
                "ɗ": "d",
                "ꝺ": "d",
                "ǳ": "dz",
                "ǆ": "dz",
                "ⓔ": "e",
                "ｅ": "e",
                "è": "e",
                "é": "e",
                "ê": "e",
                "ề": "e",
                "ế": "e",
                "ễ": "e",
                "ể": "e",
                "ẽ": "e",
                "ē": "e",
                "ḕ": "e",
                "ḗ": "e",
                "ĕ": "e",
                "ė": "e",
                "ë": "e",
                "ẻ": "e",
                "ě": "e",
                "ȅ": "e",
                "ȇ": "e",
                "ẹ": "e",
                "ệ": "e",
                "ȩ": "e",
                "ḝ": "e",
                "ę": "e",
                "ḙ": "e",
                "ḛ": "e",
                "ɇ": "e",
                "ɛ": "e",
                "ǝ": "e",
                "ⓕ": "f",
                "ｆ": "f",
                "ḟ": "f",
                "ƒ": "f",
                "ꝼ": "f",
                "ⓖ": "g",
                "ｇ": "g",
                "ǵ": "g",
                "ĝ": "g",
                "ḡ": "g",
                "ğ": "g",
                "ġ": "g",
                "ǧ": "g",
                "ģ": "g",
                "ǥ": "g",
                "ɠ": "g",
                "ꞡ": "g",
                "ᵹ": "g",
                "ꝿ": "g",
                "ⓗ": "h",
                "ｈ": "h",
                "ĥ": "h",
                "ḣ": "h",
                "ḧ": "h",
                "ȟ": "h",
                "ḥ": "h",
                "ḩ": "h",
                "ḫ": "h",
                "ẖ": "h",
                "ħ": "h",
                "ⱨ": "h",
                "ⱶ": "h",
                "ɥ": "h",
                "ƕ": "hv",
                "ⓘ": "i",
                "ｉ": "i",
                "ì": "i",
                "í": "i",
                "î": "i",
                "ĩ": "i",
                "ī": "i",
                "ĭ": "i",
                "ï": "i",
                "ḯ": "i",
                "ỉ": "i",
                "ǐ": "i",
                "ȉ": "i",
                "ȋ": "i",
                "ị": "i",
                "į": "i",
                "ḭ": "i",
                "ɨ": "i",
                "ı": "i",
                "ⓙ": "j",
                "ｊ": "j",
                "ĵ": "j",
                "ǰ": "j",
                "ɉ": "j",
                "ⓚ": "k",
                "ｋ": "k",
                "ḱ": "k",
                "ǩ": "k",
                "ḳ": "k",
                "ķ": "k",
                "ḵ": "k",
                "ƙ": "k",
                "ⱪ": "k",
                "ꝁ": "k",
                "ꝃ": "k",
                "ꝅ": "k",
                "ꞣ": "k",
                "ⓛ": "l",
                "ｌ": "l",
                "ŀ": "l",
                "ĺ": "l",
                "ľ": "l",
                "ḷ": "l",
                "ḹ": "l",
                "ļ": "l",
                "ḽ": "l",
                "ḻ": "l",
                "ſ": "l",
                "ł": "l",
                "ƚ": "l",
                "ɫ": "l",
                "ⱡ": "l",
                "ꝉ": "l",
                "ꞁ": "l",
                "ꝇ": "l",
                "ǉ": "lj",
                "ⓜ": "m",
                "ｍ": "m",
                "ḿ": "m",
                "ṁ": "m",
                "ṃ": "m",
                "ɱ": "m",
                "ɯ": "m",
                "ⓝ": "n",
                "ｎ": "n",
                "ǹ": "n",
                "ń": "n",
                "ñ": "n",
                "ṅ": "n",
                "ň": "n",
                "ṇ": "n",
                "ņ": "n",
                "ṋ": "n",
                "ṉ": "n",
                "ƞ": "n",
                "ɲ": "n",
                "ŉ": "n",
                "ꞑ": "n",
                "ꞥ": "n",
                "ǌ": "nj",
                "ⓞ": "o",
                "ｏ": "o",
                "ò": "o",
                "ó": "o",
                "ô": "o",
                "ồ": "o",
                "ố": "o",
                "ỗ": "o",
                "ổ": "o",
                "õ": "o",
                "ṍ": "o",
                "ȭ": "o",
                "ṏ": "o",
                "ō": "o",
                "ṑ": "o",
                "ṓ": "o",
                "ŏ": "o",
                "ȯ": "o",
                "ȱ": "o",
                "ö": "o",
                "ȫ": "o",
                "ỏ": "o",
                "ő": "o",
                "ǒ": "o",
                "ȍ": "o",
                "ȏ": "o",
                "ơ": "o",
                "ờ": "o",
                "ớ": "o",
                "ỡ": "o",
                "ở": "o",
                "ợ": "o",
                "ọ": "o",
                "ộ": "o",
                "ǫ": "o",
                "ǭ": "o",
                "ø": "o",
                "ǿ": "o",
                "ɔ": "o",
                "ꝋ": "o",
                "ꝍ": "o",
                "ɵ": "o",
                "ƣ": "oi",
                "ȣ": "ou",
                "ꝏ": "oo",
                "ⓟ": "p",
                "ｐ": "p",
                "ṕ": "p",
                "ṗ": "p",
                "ƥ": "p",
                "ᵽ": "p",
                "ꝑ": "p",
                "ꝓ": "p",
                "ꝕ": "p",
                "ⓠ": "q",
                "ｑ": "q",
                "ɋ": "q",
                "ꝗ": "q",
                "ꝙ": "q",
                "ⓡ": "r",
                "ｒ": "r",
                "ŕ": "r",
                "ṙ": "r",
                "ř": "r",
                "ȑ": "r",
                "ȓ": "r",
                "ṛ": "r",
                "ṝ": "r",
                "ŗ": "r",
                "ṟ": "r",
                "ɍ": "r",
                "ɽ": "r",
                "ꝛ": "r",
                "ꞧ": "r",
                "ꞃ": "r",
                "ⓢ": "s",
                "ｓ": "s",
                "ß": "s",
                "ś": "s",
                "ṥ": "s",
                "ŝ": "s",
                "ṡ": "s",
                "š": "s",
                "ṧ": "s",
                "ṣ": "s",
                "ṩ": "s",
                "ș": "s",
                "ş": "s",
                "ȿ": "s",
                "ꞩ": "s",
                "ꞅ": "s",
                "ẛ": "s",
                "ⓣ": "t",
                "ｔ": "t",
                "ṫ": "t",
                "ẗ": "t",
                "ť": "t",
                "ṭ": "t",
                "ț": "t",
                "ţ": "t",
                "ṱ": "t",
                "ṯ": "t",
                "ŧ": "t",
                "ƭ": "t",
                "ʈ": "t",
                "ⱦ": "t",
                "ꞇ": "t",
                "ꜩ": "tz",
                "ⓤ": "u",
                "ｕ": "u",
                "ù": "u",
                "ú": "u",
                "û": "u",
                "ũ": "u",
                "ṹ": "u",
                "ū": "u",
                "ṻ": "u",
                "ŭ": "u",
                "ü": "u",
                "ǜ": "u",
                "ǘ": "u",
                "ǖ": "u",
                "ǚ": "u",
                "ủ": "u",
                "ů": "u",
                "ű": "u",
                "ǔ": "u",
                "ȕ": "u",
                "ȗ": "u",
                "ư": "u",
                "ừ": "u",
                "ứ": "u",
                "ữ": "u",
                "ử": "u",
                "ự": "u",
                "ụ": "u",
                "ṳ": "u",
                "ų": "u",
                "ṷ": "u",
                "ṵ": "u",
                "ʉ": "u",
                "ⓥ": "v",
                "ｖ": "v",
                "ṽ": "v",
                "ṿ": "v",
                "ʋ": "v",
                "ꝟ": "v",
                "ʌ": "v",
                "ꝡ": "vy",
                "ⓦ": "w",
                "ｗ": "w",
                "ẁ": "w",
                "ẃ": "w",
                "ŵ": "w",
                "ẇ": "w",
                "ẅ": "w",
                "ẘ": "w",
                "ẉ": "w",
                "ⱳ": "w",
                "ⓧ": "x",
                "ｘ": "x",
                "ẋ": "x",
                "ẍ": "x",
                "ⓨ": "y",
                "ｙ": "y",
                "ỳ": "y",
                "ý": "y",
                "ŷ": "y",
                "ỹ": "y",
                "ȳ": "y",
                "ẏ": "y",
                "ÿ": "y",
                "ỷ": "y",
                "ẙ": "y",
                "ỵ": "y",
                "ƴ": "y",
                "ɏ": "y",
                "ỿ": "y",
                "ⓩ": "z",
                "ｚ": "z",
                "ź": "z",
                "ẑ": "z",
                "ż": "z",
                "ž": "z",
                "ẓ": "z",
                "ẕ": "z",
                "ƶ": "z",
                "ȥ": "z",
                "ɀ": "z",
                "ⱬ": "z",
                "ꝣ": "z",
                "Ά": "Α",
                "Έ": "Ε",
                "Ή": "Η",
                "Ί": "Ι",
                "Ϊ": "Ι",
                "Ό": "Ο",
                "Ύ": "Υ",
                "Ϋ": "Υ",
                "Ώ": "Ω",
                "ά": "α",
                "έ": "ε",
                "ή": "η",
                "ί": "ι",
                "ϊ": "ι",
                "ΐ": "ι",
                "ό": "ο",
                "ύ": "υ",
                "ϋ": "υ",
                "ΰ": "υ",
                "ω": "ω",
                "ς": "σ"
            };
            return a;
        }), b.define("select2/data/base", ["../utils"], function (a) {
            function b(a, c) {
                b.__super__.constructor.call(this);
            }

            return a.Extend(b, a.Observable), b.prototype.current = function (a) {
                throw new Error("The `current` method must be defined in child classes.");
            }, b.prototype.query = function (a, b) {
                throw new Error("The `query` method must be defined in child classes.");
            }, b.prototype.bind = function (a, b) {
            }, b.prototype.destroy = function () {
            }, b.prototype.generateResultId = function (b, c) {
                var d = b.id + "-result-";
                return d += a.generateChars(4), d += null != c.id ? "-" + c.id.toString() : "-" + a.generateChars(4);
            }, b;
        }), b.define("select2/data/select", ["./base", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this);
            }

            return b.Extend(d, a), d.prototype.current = function (a) {
                var b = [], d = this;
                this.$element.find(":selected").each(function () {
                    var a = c(this), e = d.item(a);
                    b.push(e);
                }), a(b);
            }, d.prototype.select = function (a) {
                var b = this;
                if (a.selected = !0, c(a.element).is("option")) return a.element.selected = !0, void this.$element.trigger("change");
                if (this.$element.prop("multiple")) this.current(function (d) {
                    var e = [];
                    a = [a], a.push.apply(a, d);
                    for (var f = 0; f < a.length; f++) {
                        var g = a[f].id;
                        -1 === c.inArray(g, e) && e.push(g);
                    }
                    b.$element.val(e), b.$element.trigger("change");
                }); else {
                    var d = a.id;
                    this.$element.val(d), this.$element.trigger("change");
                }
            }, d.prototype.unselect = function (a) {
                var b = this;
                if (this.$element.prop("multiple")) return a.selected = !1, c(a.element).is("option") ? (a.element.selected = !1, void this.$element.trigger("change")) : void this.current(function (d) {
                    for (var e = [], f = 0; f < d.length; f++) {
                        var g = d[f].id;
                        g !== a.id && -1 === c.inArray(g, e) && e.push(g);
                    }
                    b.$element.val(e), b.$element.trigger("change");
                });
            }, d.prototype.bind = function (a, b) {
                var c = this;
                this.container = a, a.on("select", function (a) {
                    c.select(a.data);
                }), a.on("unselect", function (a) {
                    c.unselect(a.data);
                });
            }, d.prototype.destroy = function () {
                this.$element.find("*").each(function () {
                    c.removeData(this, "data");
                });
            }, d.prototype.query = function (a, b) {
                var d = [], e = this, f = this.$element.children();
                f.each(function () {
                    var b = c(this);
                    if (b.is("option") || b.is("optgroup")) {
                        var f = e.item(b), g = e.matches(a, f);
                        null !== g && d.push(g);
                    }
                }), b({results: d});
            }, d.prototype.addOptions = function (a) {
                b.appendMany(this.$element, a);
            }, d.prototype.option = function (a) {
                var b;
                a.children ? (b = document.createElement("optgroup"), b.label = a.text) : (b = document.createElement("option"), void 0 !== b.textContent ? b.textContent = a.text : b.innerText = a.text), a.id && (b.value = a.id), a.disabled && (b.disabled = !0), a.selected && (b.selected = !0), a.title && (b.title = a.title);
                var d = c(b), e = this._normalizeItem(a);
                return e.element = b, c.data(b, "data", e), d;
            }, d.prototype.item = function (a) {
                var b = {};
                if (b = c.data(a[0], "data"), null != b) return b;
                if (a.is("option")) b = {
                    id: a.val(),
                    text: a.text(),
                    disabled: a.prop("disabled"),
                    selected: a.prop("selected"),
                    title: a.prop("title")
                }; else if (a.is("optgroup")) {
                    b = {text: a.prop("label"), children: [], title: a.prop("title")};
                    for (var d = a.children("option"), e = [], f = 0; f < d.length; f++) {
                        var g = c(d[f]), h = this.item(g);
                        e.push(h);
                    }
                    b.children = e;
                }
                return b = this._normalizeItem(b), b.element = a[0], c.data(a[0], "data", b), b;
            }, d.prototype._normalizeItem = function (a) {
                c.isPlainObject(a) || (a = {id: a, text: a}), a = c.extend({}, {text: ""}, a);
                var b = {selected: !1, disabled: !1};
                return null != a.id && (a.id = a.id.toString()), null != a.text && (a.text = a.text.toString()), null == a._resultId && a.id && null != this.container && (a._resultId = this.generateResultId(this.container, a)), c.extend({}, b, a);
            }, d.prototype.matches = function (a, b) {
                var c = this.options.get("matcher");
                return c(a, b);
            }, d;
        }), b.define("select2/data/array", ["./select", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                var c = b.get("data") || [];
                d.__super__.constructor.call(this, a, b), this.addOptions(this.convertToOptions(c));
            }

            return b.Extend(d, a), d.prototype.select = function (a) {
                var b = this.$element.find("option").filter(function (b, c) {
                    return c.value == a.id.toString();
                });
                0 === b.length && (b = this.option(a), this.addOptions(b)), d.__super__.select.call(this, a);
            }, d.prototype.convertToOptions = function (a) {
                function d(a) {
                    return function () {
                        return c(this).val() == a.id;
                    };
                }

                for (var e = this, f = this.$element.find("option"), g = f.map(function () {
                    return e.item(c(this)).id;
                }).get(), h = [], i = 0; i < a.length; i++) {
                    var j = this._normalizeItem(a[i]);
                    if (c.inArray(j.id, g) >= 0) {
                        var k = f.filter(d(j)), l = this.item(k), m = c.extend(!0, {}, l, j), n = this.option(m);
                        k.replaceWith(n);
                    } else {
                        var o = this.option(j);
                        if (j.children) {
                            var p = this.convertToOptions(j.children);
                            b.appendMany(o, p);
                        }
                        h.push(o);
                    }
                }
                return h;
            }, d;
        }), b.define("select2/data/ajax", ["./array", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.ajaxOptions = this._applyDefaults(b.get("ajax")), null != this.ajaxOptions.processResults && (this.processResults = this.ajaxOptions.processResults), d.__super__.constructor.call(this, a, b);
            }

            return b.Extend(d, a), d.prototype._applyDefaults = function (a) {
                var b = {
                    data: function (a) {
                        return c.extend({}, a, {q: a.term});
                    }, transport: function (a, b, d) {
                        var e = c.ajax(a);
                        return e.then(b), e.fail(d), e;
                    }
                };
                return c.extend({}, b, a, !0);
            }, d.prototype.processResults = function (a) {
                return a;
            }, d.prototype.query = function (a, b) {
                function d() {
                    var d = f.transport(f, function (d) {
                        var f = e.processResults(d, a);
                        e.options.get("debug") && window.console && console.error && (f && f.results && c.isArray(f.results) || console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")), b(f);
                    }, function () {
                    });
                    e._request = d;
                }

                var e = this;
                null != this._request && (c.isFunction(this._request.abort) && this._request.abort(), this._request = null);
                var f = c.extend({type: "GET"}, this.ajaxOptions);
                "function" == typeof f.url && (f.url = f.url.call(this.$element, a)), "function" == typeof f.data && (f.data = f.data.call(this.$element, a)), this.ajaxOptions.delay && "" !== a.term ? (this._queryTimeout && window.clearTimeout(this._queryTimeout), this._queryTimeout = window.setTimeout(d, this.ajaxOptions.delay)) : d();
            }, d;
        }), b.define("select2/data/tags", ["jquery"], function (a) {
            function b(b, c, d) {
                var e = d.get("tags"), f = d.get("createTag");
                if (void 0 !== f && (this.createTag = f), b.call(this, c, d), a.isArray(e)) for (var g = 0; g < e.length; g++) {
                    var h = e[g], i = this._normalizeItem(h), j = this.option(i);
                    this.$element.append(j);
                }
            }

            return b.prototype.query = function (a, b, c) {
                function d(a, f) {
                    for (var g = a.results, h = 0; h < g.length; h++) {
                        var i = g[h], j = null != i.children && !d({results: i.children}, !0), k = i.text === b.term;
                        if (k || j) return f ? !1 : (a.data = g, void c(a));
                    }
                    if (f) return !0;
                    var l = e.createTag(b);
                    if (null != l) {
                        var m = e.option(l);
                        m.attr("data-select2-tag", !0), e.addOptions([m]), e.insertTag(g, l);
                    }
                    a.results = g, c(a);
                }

                var e = this;
                return this._removeOldTags(), null == b.term || null != b.page ? void a.call(this, b, c) : void a.call(this, b, d);
            }, b.prototype.createTag = function (b, c) {
                var d = a.trim(c.term);
                return "" === d ? null : {id: d, text: d};
            }, b.prototype.insertTag = function (a, b, c) {
                b.unshift(c);
            }, b.prototype._removeOldTags = function (b) {
                var c = (this._lastTag, this.$element.find("option[data-select2-tag]"));
                c.each(function () {
                    this.selected || a(this).remove();
                });
            }, b;
        }), b.define("select2/data/tokenizer", ["jquery"], function (a) {
            function b(a, b, c) {
                var d = c.get("tokenizer");
                void 0 !== d && (this.tokenizer = d), a.call(this, b, c);
            }

            return b.prototype.bind = function (a, b, c) {
                a.call(this, b, c), this.$search = b.dropdown.$search || b.selection.$search || c.find(".select2-search__field");
            }, b.prototype.query = function (a, b, c) {
                function d(a) {
                    e.trigger("select", {data: a});
                }

                var e = this;
                b.term = b.term || "";
                var f = this.tokenizer(b, this.options, d);
                f.term !== b.term && (this.$search.length && (this.$search.val(f.term), this.$search.focus()), b.term = f.term), a.call(this, b, c);
            }, b.prototype.tokenizer = function (b, c, d, e) {
                for (var f = d.get("tokenSeparators") || [], g = c.term, h = 0, i = this.createTag || function (a) {
                    return {id: a.term, text: a.term};
                }; h < g.length;) {
                    var j = g[h];
                    if (-1 !== a.inArray(j, f)) {
                        var k = g.substr(0, h), l = a.extend({}, c, {term: k}), m = i(l);
                        null != m ? (e(m), g = g.substr(h + 1) || "", h = 0) : h++;
                    } else h++;
                }
                return {term: g};
            }, b;
        }), b.define("select2/data/minimumInputLength", [], function () {
            function a(a, b, c) {
                this.minimumInputLength = c.get("minimumInputLength"), a.call(this, b, c);
            }

            return a.prototype.query = function (a, b, c) {
                return b.term = b.term || "", b.term.length < this.minimumInputLength ? void this.trigger("results:message", {
                    message: "inputTooShort",
                    args: {minimum: this.minimumInputLength, input: b.term, params: b}
                }) : void a.call(this, b, c);
            }, a;
        }), b.define("select2/data/maximumInputLength", [], function () {
            function a(a, b, c) {
                this.maximumInputLength = c.get("maximumInputLength"), a.call(this, b, c);
            }

            return a.prototype.query = function (a, b, c) {
                return b.term = b.term || "", this.maximumInputLength > 0 && b.term.length > this.maximumInputLength ? void this.trigger("results:message", {
                    message: "inputTooLong",
                    args: {maximum: this.maximumInputLength, input: b.term, params: b}
                }) : void a.call(this, b, c);
            }, a;
        }), b.define("select2/data/maximumSelectionLength", [], function () {
            function a(a, b, c) {
                this.maximumSelectionLength = c.get("maximumSelectionLength"), a.call(this, b, c);
            }

            return a.prototype.query = function (a, b, c) {
                var d = this;
                this.current(function (e) {
                    var f = null != e ? e.length : 0;
                    return d.maximumSelectionLength > 0 && f >= d.maximumSelectionLength ? void d.trigger("results:message", {
                        message: "maximumSelected",
                        args: {maximum: d.maximumSelectionLength}
                    }) : void a.call(d, b, c);
                });
            }, a;
        }), b.define("select2/dropdown", ["jquery", "./utils"], function (a, b) {
            function c(a, b) {
                this.$element = a, this.options = b, c.__super__.constructor.call(this);
            }

            return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<span class="select2-dropdown"><span class="select2-results"></span></span>');
                return b.attr("dir", this.options.get("dir")), this.$dropdown = b, b;
            }, c.prototype.bind = function () {
            }, c.prototype.position = function (a, b) {
            }, c.prototype.destroy = function () {
                this.$dropdown.remove();
            }, c;
        }), b.define("select2/dropdown/search", ["jquery", "../utils"], function (a, b) {
            function c() {
            }

            return c.prototype.render = function (b) {
                var c = b.call(this),
                    d = a('<span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" /></span>');
                return this.$searchContainer = d, this.$search = d.find("input"), c.prepend(d), c;
            }, c.prototype.bind = function (b, c, d) {
                var e = this;
                b.call(this, c, d), this.$search.on("keydown", function (a) {
                    e.trigger("keypress", a), e._keyUpPrevented = a.isDefaultPrevented();
                }), this.$search.on("input", function (b) {
                    a(this).off("keyup");
                }), this.$search.on("keyup input", function (a) {
                    e.handleSearch(a);
                }), c.on("open", function () {
                    e.$search.attr("tabindex", 0), e.$search.focus(), window.setTimeout(function () {
                        e.$search.focus();
                    }, 0);
                }), c.on("close", function () {
                    e.$search.attr("tabindex", -1), e.$search.val("");
                }), c.on("results:all", function (a) {
                    if (null == a.query.term || "" === a.query.term) {
                        var b = e.showSearch(a);
                        b ? e.$searchContainer.removeClass("select2-search--hide") : e.$searchContainer.addClass("select2-search--hide");
                    }
                });
            }, c.prototype.handleSearch = function (a) {
                if (!this._keyUpPrevented) {
                    var b = this.$search.val();
                    this.trigger("query", {term: b});
                }
                this._keyUpPrevented = !1;
            }, c.prototype.showSearch = function (a, b) {
                return !0;
            }, c;
        }), b.define("select2/dropdown/hidePlaceholder", [], function () {
            function a(a, b, c, d) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c, d);
            }

            return a.prototype.append = function (a, b) {
                b.results = this.removePlaceholder(b.results), a.call(this, b);
            }, a.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = {id: "", text: b}), b;
            }, a.prototype.removePlaceholder = function (a, b) {
                for (var c = b.slice(0), d = b.length - 1; d >= 0; d--) {
                    var e = b[d];
                    this.placeholder.id === e.id && c.splice(d, 1);
                }
                return c;
            }, a;
        }), b.define("select2/dropdown/infiniteScroll", ["jquery"], function (a) {
            function b(a, b, c, d) {
                this.lastParams = {}, a.call(this, b, c, d), this.$loadingMore = this.createLoadingMore(), this.loading = !1;
            }

            return b.prototype.append = function (a, b) {
                this.$loadingMore.remove(), this.loading = !1, a.call(this, b), this.showLoadingMore(b) && this.$results.append(this.$loadingMore);
            }, b.prototype.bind = function (b, c, d) {
                var e = this;
                b.call(this, c, d), c.on("query", function (a) {
                    e.lastParams = a, e.loading = !0;
                }), c.on("query:append", function (a) {
                    e.lastParams = a, e.loading = !0;
                }), this.$results.on("scroll", function () {
                    var b = a.contains(document.documentElement, e.$loadingMore[0]);
                    if (!e.loading && b) {
                        var c = e.$results.offset().top + e.$results.outerHeight(!1),
                            d = e.$loadingMore.offset().top + e.$loadingMore.outerHeight(!1);
                        c + 50 >= d && e.loadMore();
                    }
                });
            }, b.prototype.loadMore = function () {
                this.loading = !0;
                var b = a.extend({}, {page: 1}, this.lastParams);
                b.page++, this.trigger("query:append", b);
            }, b.prototype.showLoadingMore = function (a, b) {
                return b.pagination && b.pagination.more;
            }, b.prototype.createLoadingMore = function () {
                var b = a('<li class="select2-results__option select2-results__option--load-more"role="treeitem" aria-disabled="true"></li>'),
                    c = this.options.get("translations").get("loadingMore");
                return b.html(c(this.lastParams)), b;
            }, b;
        }), b.define("select2/dropdown/attachBody", ["jquery", "../utils"], function (a, b) {
            function c(b, c, d) {
                this.$dropdownParent = d.get("dropdownParent") || a(document.body), b.call(this, c, d);
            }

            return c.prototype.bind = function (a, b, c) {
                var d = this, e = !1;
                a.call(this, b, c), b.on("open", function () {
                    d._showDropdown(), d._attachPositioningHandler(b), e || (e = !0, b.on("results:all", function () {
                        d._positionDropdown(), d._resizeDropdown();
                    }), b.on("results:append", function () {
                        d._positionDropdown(), d._resizeDropdown();
                    }));
                }), b.on("close", function () {
                    d._hideDropdown(), d._detachPositioningHandler(b);
                }), this.$dropdownContainer.on("mousedown", function (a) {
                    a.stopPropagation();
                });
            }, c.prototype.destroy = function (a) {
                a.call(this), this.$dropdownContainer.remove();
            }, c.prototype.position = function (a, b, c) {
                b.attr("class", c.attr("class")), b.removeClass("select2"), b.addClass("select2-container--open"), b.css({
                    position: "absolute",
                    top: -999999
                }), this.$container = c;
            }, c.prototype.render = function (b) {
                var c = a("<span></span>"), d = b.call(this);
                return c.append(d), this.$dropdownContainer = c, c;
            }, c.prototype._hideDropdown = function (a) {
                this.$dropdownContainer.detach();
            }, c.prototype._attachPositioningHandler = function (c, d) {
                var e = this, f = "scroll.select2." + d.id, g = "resize.select2." + d.id,
                    h = "orientationchange.select2." + d.id, i = this.$container.parents().filter(b.hasScroll);
                i.each(function () {
                    a(this).data("select2-scroll-position", {x: a(this).scrollLeft(), y: a(this).scrollTop()});
                }), i.on(f, function (b) {
                    var c = a(this).data("select2-scroll-position");
                    a(this).scrollTop(c.y);
                }), a(window).on(f + " " + g + " " + h, function (a) {
                    e._positionDropdown(), e._resizeDropdown();
                });
            }, c.prototype._detachPositioningHandler = function (c, d) {
                var e = "scroll.select2." + d.id, f = "resize.select2." + d.id, g = "orientationchange.select2." + d.id,
                    h = this.$container.parents().filter(b.hasScroll);
                h.off(e), a(window).off(e + " " + f + " " + g);
            }, c.prototype._positionDropdown = function () {
                var b = a(window), c = this.$dropdown.hasClass("select2-dropdown--above"),
                    d = this.$dropdown.hasClass("select2-dropdown--below"), e = null,
                    f = (this.$container.position(), this.$container.offset());
                f.bottom = f.top + this.$container.outerHeight(!1);
                var g = {height: this.$container.outerHeight(!1)};
                g.top = f.top, g.bottom = f.top + g.height;
                var h = {height: this.$dropdown.outerHeight(!1)},
                    i = {top: b.scrollTop(), bottom: b.scrollTop() + b.height()}, j = i.top < f.top - h.height,
                    k = i.bottom > f.bottom + h.height, l = {left: f.left, top: g.bottom};
                if ("static" !== this.$dropdownParent[0].style.position) {
                    var m = this.$dropdownParent.offset();
                    l.top -= m.top, l.left -= m.left;
                }
                c || d || (e = "below"), k || !j || c ? !j && k && c && (e = "below") : e = "above", ("above" == e || c && "below" !== e) && (l.top = g.top - h.height), null != e && (this.$dropdown.removeClass("select2-dropdown--below select2-dropdown--above").addClass("select2-dropdown--" + e), this.$container.removeClass("select2-container--below select2-container--above").addClass("select2-container--" + e)), this.$dropdownContainer.css(l);
            }, c.prototype._resizeDropdown = function () {
                var a = {width: this.$container.outerWidth(!1) + "px"};
                this.options.get("dropdownAutoWidth") && (a.minWidth = a.width, a.width = "auto"), this.$dropdown.css(a);
            }, c.prototype._showDropdown = function (a) {
                this.$dropdownContainer.appendTo(this.$dropdownParent), this._positionDropdown(), this._resizeDropdown();
            }, c;
        }), b.define("select2/dropdown/minimumResultsForSearch", [], function () {
            function a(b) {
                for (var c = 0, d = 0; d < b.length; d++) {
                    var e = b[d];
                    e.children ? c += a(e.children) : c++;
                }
                return c;
            }

            function b(a, b, c, d) {
                this.minimumResultsForSearch = c.get("minimumResultsForSearch"), this.minimumResultsForSearch < 0 && (this.minimumResultsForSearch = 1 / 0), a.call(this, b, c, d);
            }

            return b.prototype.showSearch = function (b, c) {
                return a(c.data.results) < this.minimumResultsForSearch ? !1 : b.call(this, c);
            }, b;
        }), b.define("select2/dropdown/selectOnClose", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), b.on("close", function () {
                    d._handleSelectOnClose();
                });
            }, a.prototype._handleSelectOnClose = function () {
                var a = this.getHighlightedResults();
                if (!(a.length < 1)) {
                    var b = a.data("data");
                    null != b.element && b.element.selected || null == b.element && b.selected || this.trigger("select", {data: b});
                }
            }, a;
        }), b.define("select2/dropdown/closeOnSelect", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), b.on("select", function (a) {
                    d._selectTriggered(a);
                }), b.on("unselect", function (a) {
                    d._selectTriggered(a);
                });
            }, a.prototype._selectTriggered = function (a, b) {
                var c = b.originalEvent;
                c && c.ctrlKey || this.trigger("close", {});
            }, a;
        }), b.define("select2/i18n/en", [], function () {
            return {
                errorLoading: function () {
                    return "The results could not be loaded.";
                }, inputTooLong: function (a) {
                    var b = a.input.length - a.maximum, c = "Please delete " + b + " character";
                    return 1 != b && (c += "s"), c;
                }, inputTooShort: function (a) {
                    var b = a.minimum - a.input.length, c = "Please enter " + b + " or more characters";
                    return c;
                }, loadingMore: function () {
                    return "Loading more results…";
                }, maximumSelected: function (a) {
                    var b = "You can only select " + a.maximum + " item";
                    return 1 != a.maximum && (b += "s"), b;
                }, noResults: function () {
                    return "No results found";
                }, searching: function () {
                    return "Searching…";
                }
            };
        }), b.define("select2/defaults", ["jquery", "require", "./results", "./selection/single", "./selection/multiple", "./selection/placeholder", "./selection/allowClear", "./selection/search", "./selection/eventRelay", "./utils", "./translation", "./diacritics", "./data/select", "./data/array", "./data/ajax", "./data/tags", "./data/tokenizer", "./data/minimumInputLength", "./data/maximumInputLength", "./data/maximumSelectionLength", "./dropdown", "./dropdown/search", "./dropdown/hidePlaceholder", "./dropdown/infiniteScroll", "./dropdown/attachBody", "./dropdown/minimumResultsForSearch", "./dropdown/selectOnClose", "./dropdown/closeOnSelect", "./i18n/en"], function (a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C) {
            function D() {
                this.reset();
            }

            D.prototype.apply = function (l) {
                if (l = a.extend({}, this.defaults, l), null == l.dataAdapter) {
                    if (null != l.ajax ? l.dataAdapter = o : null != l.data ? l.dataAdapter = n : l.dataAdapter = m, l.minimumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, r)), l.maximumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, s)), l.maximumSelectionLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, t)), l.tags && (l.dataAdapter = j.Decorate(l.dataAdapter, p)), (null != l.tokenSeparators || null != l.tokenizer) && (l.dataAdapter = j.Decorate(l.dataAdapter, q)), null != l.query) {
                        var C = b(l.amdBase + "compat/query");
                        l.dataAdapter = j.Decorate(l.dataAdapter, C);
                    }
                    if (null != l.initSelection) {
                        var D = b(l.amdBase + "compat/initSelection");
                        l.dataAdapter = j.Decorate(l.dataAdapter, D);
                    }
                }
                if (null == l.resultsAdapter && (l.resultsAdapter = c, null != l.ajax && (l.resultsAdapter = j.Decorate(l.resultsAdapter, x)), null != l.placeholder && (l.resultsAdapter = j.Decorate(l.resultsAdapter, w)), l.selectOnClose && (l.resultsAdapter = j.Decorate(l.resultsAdapter, A))), null == l.dropdownAdapter) {
                    if (l.multiple) l.dropdownAdapter = u; else {
                        var E = j.Decorate(u, v);
                        l.dropdownAdapter = E;
                    }
                    if (0 !== l.minimumResultsForSearch && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, z)), l.closeOnSelect && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, B)), null != l.dropdownCssClass || null != l.dropdownCss || null != l.adaptDropdownCssClass) {
                        var F = b(l.amdBase + "compat/dropdownCss");
                        l.dropdownAdapter = j.Decorate(l.dropdownAdapter, F);
                    }
                    l.dropdownAdapter = j.Decorate(l.dropdownAdapter, y);
                }
                if (null == l.selectionAdapter) {
                    if (l.multiple ? l.selectionAdapter = e : l.selectionAdapter = d, null != l.placeholder && (l.selectionAdapter = j.Decorate(l.selectionAdapter, f)), l.allowClear && (l.selectionAdapter = j.Decorate(l.selectionAdapter, g)), l.multiple && (l.selectionAdapter = j.Decorate(l.selectionAdapter, h)), null != l.containerCssClass || null != l.containerCss || null != l.adaptContainerCssClass) {
                        var G = b(l.amdBase + "compat/containerCss");
                        l.selectionAdapter = j.Decorate(l.selectionAdapter, G);
                    }
                    l.selectionAdapter = j.Decorate(l.selectionAdapter, i);
                }
                if ("string" == typeof l.language) if (l.language.indexOf("-") > 0) {
                    var H = l.language.split("-"), I = H[0];
                    l.language = [l.language, I];
                } else l.language = [l.language];
                if (a.isArray(l.language)) {
                    var J = new k;
                    l.language.push("en");
                    for (var K = l.language, L = 0; L < K.length; L++) {
                        var M = K[L], N = {};
                        try {
                            N = k.loadPath(M);
                        } catch (O) {
                            try {
                                M = this.defaults.amdLanguageBase + M, N = k.loadPath(M);
                            } catch (P) {
                                l.debug && window.console && console.warn && console.warn('Select2: The language file for "' + M + '" could not be automatically loaded. A fallback will be used instead.');
                                continue;
                            }
                        }
                        J.extend(N);
                    }
                    l.translations = J;
                } else {
                    var Q = k.loadPath(this.defaults.amdLanguageBase + "en"), R = new k(l.language);
                    R.extend(Q), l.translations = R;
                }
                return l;
            }, D.prototype.reset = function () {
                function b(a) {
                    function b(a) {
                        return l[a] || a;
                    }

                    return a.replace(/[^\u0000-\u007E]/g, b);
                }

                function c(d, e) {
                    if ("" === a.trim(d.term)) return e;
                    if (e.children && e.children.length > 0) {
                        for (var f = a.extend(!0, {}, e), g = e.children.length - 1; g >= 0; g--) {
                            var h = e.children[g], i = c(d, h);
                            null == i && f.children.splice(g, 1);
                        }
                        return f.children.length > 0 ? f : c(d, f);
                    }
                    var j = b(e.text).toUpperCase(), k = b(d.term).toUpperCase();
                    return j.indexOf(k) > -1 ? e : null;
                }

                this.defaults = {
                    amdBase: "./",
                    amdLanguageBase: "./i18n/",
                    closeOnSelect: !0,
                    debug: !1,
                    dropdownAutoWidth: !1,
                    escapeMarkup: j.escapeMarkup,
                    language: C,
                    matcher: c,
                    minimumInputLength: 0,
                    maximumInputLength: 0,
                    maximumSelectionLength: 0,
                    minimumResultsForSearch: 0,
                    selectOnClose: !1,
                    sorter: function (a) {
                        return a;
                    },
                    templateResult: function (a) {
                        return a.text;
                    },
                    templateSelection: function (a) {
                        return a.text;
                    },
                    theme: "default",
                    width: "resolve"
                };
            }, D.prototype.set = function (b, c) {
                var d = a.camelCase(b), e = {};
                e[d] = c;
                var f = j._convertData(e);
                a.extend(this.defaults, f);
            };
            var E = new D;
            return E;
        }), b.define("select2/options", ["require", "jquery", "./defaults", "./utils"], function (a, b, c, d) {
            function e(b, e) {
                if (this.options = b, null != e && this.fromElement(e), this.options = c.apply(this.options), e && e.is("input")) {
                    var f = a(this.get("amdBase") + "compat/inputData");
                    this.options.dataAdapter = d.Decorate(this.options.dataAdapter, f);
                }
            }

            return e.prototype.fromElement = function (a) {
                var c = ["select2"];
                null == this.options.multiple && (this.options.multiple = a.prop("multiple")), null == this.options.disabled && (this.options.disabled = a.prop("disabled")), null == this.options.language && (a.prop("lang") ? this.options.language = a.prop("lang").toLowerCase() : a.closest("[lang]").prop("lang") && (this.options.language = a.closest("[lang]").prop("lang"))), null == this.options.dir && (a.prop("dir") ? this.options.dir = a.prop("dir") : a.closest("[dir]").prop("dir") ? this.options.dir = a.closest("[dir]").prop("dir") : this.options.dir = "ltr"), a.prop("disabled", this.options.disabled), a.prop("multiple", this.options.multiple), a.data("select2Tags") && (this.options.debug && window.console && console.warn && console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags="true"` attributes and will be removed in future versions of Select2.'), a.data("data", a.data("select2Tags")), a.data("tags", !0)), a.data("ajaxUrl") && (this.options.debug && window.console && console.warn && console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."), a.attr("ajax--url", a.data("ajaxUrl")), a.data("ajax--url", a.data("ajaxUrl")));
                var e = {};
                e = b.fn.jquery && "1." == b.fn.jquery.substr(0, 2) && a[0].dataset ? b.extend(!0, {}, a[0].dataset, a.data()) : a.data();
                var f = b.extend(!0, {}, e);
                f = d._convertData(f);
                for (var g in f) b.inArray(g, c) > -1 || (b.isPlainObject(this.options[g]) ? b.extend(this.options[g], f[g]) : this.options[g] = f[g]);
                return this;
            }, e.prototype.get = function (a) {
                return this.options[a];
            }, e.prototype.set = function (a, b) {
                this.options[a] = b;
            }, e;
        }), b.define("select2/core", ["jquery", "./options", "./utils", "./keys"], function (a, b, c, d) {
            var e = function (a, c) {
                null != a.data("select2") && a.data("select2").destroy(), this.$element = a, this.id = this._generateId(a), c = c || {}, this.options = new b(c, a), e.__super__.constructor.call(this);
                var d = a.attr("tabindex") || 0;
                a.data("old-tabindex", d), a.attr("tabindex", "-1");
                var f = this.options.get("dataAdapter");
                this.dataAdapter = new f(a, this.options);
                var g = this.render();
                this._placeContainer(g);
                var h = this.options.get("selectionAdapter");
                this.selection = new h(a, this.options), this.$selection = this.selection.render(), this.selection.position(this.$selection, g);
                var i = this.options.get("dropdownAdapter");
                this.dropdown = new i(a, this.options), this.$dropdown = this.dropdown.render(), this.dropdown.position(this.$dropdown, g);
                var j = this.options.get("resultsAdapter");
                this.results = new j(a, this.options, this.dataAdapter), this.$results = this.results.render(), this.results.position(this.$results, this.$dropdown);
                var k = this;
                this._bindAdapters(), this._registerDomEvents(), this._registerDataEvents(), this._registerSelectionEvents(), this._registerDropdownEvents(), this._registerResultsEvents(), this._registerEvents(), this.dataAdapter.current(function (a) {
                    k.trigger("selection:update", {data: a});
                }), a.addClass("select2-hidden-accessible"), a.attr("aria-hidden", "true"), this._syncAttributes(), a.data("select2", this);
            };
            return c.Extend(e, c.Observable), e.prototype._generateId = function (a) {
                var b = "";
                return b = null != a.attr("id") ? a.attr("id") : null != a.attr("name") ? a.attr("name") + "-" + c.generateChars(2) : c.generateChars(4), b = "select2-" + b;
            }, e.prototype._placeContainer = function (a) {
                a.insertAfter(this.$element);
                var b = this._resolveWidth(this.$element, this.options.get("width"));
                null != b && a.css("width", b);
            }, e.prototype._resolveWidth = function (a, b) {
                var c = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;
                if ("resolve" == b) {
                    var d = this._resolveWidth(a, "style");
                    return null != d ? d : this._resolveWidth(a, "element");
                }
                if ("element" == b) {
                    var e = a.outerWidth(!1);
                    return 0 >= e ? "auto" : e + "px";
                }
                if ("style" == b) {
                    var f = a.attr("style");
                    if ("string" != typeof f) return null;
                    for (var g = f.split(";"), h = 0, i = g.length; i > h; h += 1) {
                        var j = g[h].replace(/\s/g, ""), k = j.match(c);
                        if (null !== k && k.length >= 1) return k[1];
                    }
                    return null;
                }
                return b;
            }, e.prototype._bindAdapters = function () {
                this.dataAdapter.bind(this, this.$container), this.selection.bind(this, this.$container), this.dropdown.bind(this, this.$container), this.results.bind(this, this.$container);
            }, e.prototype._registerDomEvents = function () {
                var b = this;
                this.$element.on("change.select2", function () {
                    b.dataAdapter.current(function (a) {
                        b.trigger("selection:update", {data: a});
                    });
                }), this._sync = c.bind(this._syncAttributes, this), this.$element[0].attachEvent && this.$element[0].attachEvent("onpropertychange", this._sync);
                var d = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
                null != d ? (this._observer = new d(function (c) {
                    a.each(c, b._sync);
                }), this._observer.observe(this.$element[0], {
                    attributes: !0,
                    subtree: !1
                })) : this.$element[0].addEventListener && this.$element[0].addEventListener("DOMAttrModified", b._sync, !1);
            }, e.prototype._registerDataEvents = function () {
                var a = this;
                this.dataAdapter.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerSelectionEvents = function () {
                var b = this, c = ["toggle", "focus"];
                this.selection.on("toggle", function () {
                    b.toggleDropdown();
                }), this.selection.on("focus", function (a) {
                    b.focus(a);
                }), this.selection.on("*", function (d, e) {
                    -1 === a.inArray(d, c) && b.trigger(d, e);
                });
            }, e.prototype._registerDropdownEvents = function () {
                var a = this;
                this.dropdown.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerResultsEvents = function () {
                var a = this;
                this.results.on("*", function (b, c) {
                    a.trigger(b, c);
                });
            }, e.prototype._registerEvents = function () {
                var a = this;
                this.on("open", function () {
                    a.$container.addClass("select2-container--open");
                }), this.on("close", function () {
                    a.$container.removeClass("select2-container--open");
                }), this.on("enable", function () {
                    a.$container.removeClass("select2-container--disabled");
                }), this.on("disable", function () {
                    a.$container.addClass("select2-container--disabled");
                }), this.on("blur", function () {
                    a.$container.removeClass("select2-container--focus");
                }), this.on("query", function (b) {
                    a.isOpen() || a.trigger("open", {}), this.dataAdapter.query(b, function (c) {
                        a.trigger("results:all", {data: c, query: b});
                    });
                }), this.on("query:append", function (b) {
                    this.dataAdapter.query(b, function (c) {
                        a.trigger("results:append", {data: c, query: b});
                    });
                }), this.on("keypress", function (b) {
                    var c = b.which;
                    a.isOpen() ? c === d.ESC || c === d.TAB || c === d.UP && b.altKey ? (a.close(), b.preventDefault()) : c === d.ENTER ? (a.trigger("results:select", {}), b.preventDefault()) : c === d.SPACE && b.ctrlKey ? (a.trigger("results:toggle", {}), b.preventDefault()) : c === d.UP ? (a.trigger("results:previous", {}), b.preventDefault()) : c === d.DOWN && (a.trigger("results:next", {}), b.preventDefault()) : (c === d.ENTER || c === d.SPACE || c === d.DOWN && b.altKey) && (a.open(), b.preventDefault());
                });
            }, e.prototype._syncAttributes = function () {
                this.options.set("disabled", this.$element.prop("disabled")), this.options.get("disabled") ? (this.isOpen() && this.close(), this.trigger("disable", {})) : this.trigger("enable", {});
            }, e.prototype.trigger = function (a, b) {
                var c = e.__super__.trigger,
                    d = {open: "opening", close: "closing", select: "selecting", unselect: "unselecting"};
                if (void 0 === b && (b = {}), a in d) {
                    var f = d[a], g = {prevented: !1, name: a, args: b};
                    if (c.call(this, f, g), g.prevented) return void(b.prevented = !0);
                }
                c.call(this, a, b);
            }, e.prototype.toggleDropdown = function () {
                this.options.get("disabled") || (this.isOpen() ? this.close() : this.open());
            }, e.prototype.open = function () {
                this.isOpen() || this.trigger("query", {});
            }, e.prototype.close = function () {
                this.isOpen() && this.trigger("close", {});
            }, e.prototype.isOpen = function () {
                return this.$container.hasClass("select2-container--open");
            }, e.prototype.hasFocus = function () {
                return this.$container.hasClass("select2-container--focus");
            }, e.prototype.focus = function (a) {
                this.hasFocus() || (this.$container.addClass("select2-container--focus"), this.trigger("focus", {}));
            }, e.prototype.enable = function (a) {
                this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'), (null == a || 0 === a.length) && (a = [!0]);
                var b = !a[0];
                this.$element.prop("disabled", b);
            }, e.prototype.data = function () {
                this.options.get("debug") && arguments.length > 0 && window.console && console.warn && console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.');
                var a = [];
                return this.dataAdapter.current(function (b) {
                    a = b;
                }), a;
            }, e.prototype.val = function (b) {
                if (this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'), null == b || 0 === b.length) return this.$element.val();
                var c = b[0];
                a.isArray(c) && (c = a.map(c, function (a) {
                    return a.toString();
                })), this.$element.val(c).trigger("change");
            }, e.prototype.destroy = function () {
                this.$container.remove(), this.$element[0].detachEvent && this.$element[0].detachEvent("onpropertychange", this._sync), null != this._observer ? (this._observer.disconnect(), this._observer = null) : this.$element[0].removeEventListener && this.$element[0].removeEventListener("DOMAttrModified", this._sync, !1), this._sync = null, this.$element.off(".select2"), this.$element.attr("tabindex", this.$element.data("old-tabindex")), this.$element.removeClass("select2-hidden-accessible"), this.$element.attr("aria-hidden", "false"), this.$element.removeData("select2"), this.dataAdapter.destroy(), this.selection.destroy(), this.dropdown.destroy(), this.results.destroy(), this.dataAdapter = null, this.selection = null, this.dropdown = null, this.results = null;
            }, e.prototype.render = function () {
                var b = a('<span class="select2 select2-container"><span class="selection"></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>');
                return b.attr("dir", this.options.get("dir")), this.$container = b, this.$container.addClass("select2-container--" + this.options.get("theme")), b.data("element", this.$element), b;
            }, e;
        }), b.define("select2/compat/utils", ["jquery"], function (a) {
            function b(b, c, d) {
                var e, f, g = [];
                e = a.trim(b.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 === this.indexOf("select2-") && g.push(this);
                })), e = a.trim(c.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 !== this.indexOf("select2-") && (f = d(this), null != f && g.push(f));
                })), b.attr("class", g.join(" "));
            }

            return {syncCssClasses: b};
        }), b.define("select2/compat/containerCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null;
            }

            function d() {
            }

            return d.prototype.render = function (d) {
                var e = d.call(this), f = this.options.get("containerCssClass") || "";
                a.isFunction(f) && (f = f(this.$element));
                var g = this.options.get("adaptContainerCssClass");
                if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");
                    var h = g;
                    g = function (a) {
                        var b = h(a);
                        return null != b ? b + " " + a : a;
                    };
                }
                var i = this.options.get("containerCss") || {};
                return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e;
            }, d;
        }), b.define("select2/compat/dropdownCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null;
            }

            function d() {
            }

            return d.prototype.render = function (d) {
                var e = d.call(this), f = this.options.get("dropdownCssClass") || "";
                a.isFunction(f) && (f = f(this.$element));
                var g = this.options.get("adaptDropdownCssClass");
                if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");
                    var h = g;
                    g = function (a) {
                        var b = h(a);
                        return null != b ? b + " " + a : a;
                    };
                }
                var i = this.options.get("dropdownCss") || {};
                return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e;
            }, d;
        }), b.define("select2/compat/initSelection", ["jquery"], function (a) {
            function b(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `initSelection` option has been deprecated in favor of a custom data adapter that overrides the `current` method. This method is now called multiple times instead of a single time when the instance is initialized. Support will be removed for the `initSelection` option in future versions of Select2"), this.initSelection = c.get("initSelection"), this._isInitialized = !1, a.call(this, b, c);
            }

            return b.prototype.current = function (b, c) {
                var d = this;
                return this._isInitialized ? void b.call(this, c) : void this.initSelection.call(null, this.$element, function (b) {
                    d._isInitialized = !0, a.isArray(b) || (b = [b]), c(b);
                });
            }, b;
        }), b.define("select2/compat/inputData", ["jquery"], function (a) {
            function b(a, b, c) {
                this._currentData = [], this._valueSeparator = c.get("valueSeparator") || ",", "hidden" === b.prop("type") && c.get("debug") && console && console.warn && console.warn("Select2: Using a hidden input with Select2 is no longer supported and may stop working in the future. It is recommended to use a `<select>` element instead."), a.call(this, b, c);
            }

            return b.prototype.current = function (b, c) {
                function d(b, c) {
                    var e = [];
                    return b.selected || -1 !== a.inArray(b.id, c) ? (b.selected = !0, e.push(b)) : b.selected = !1, b.children && e.push.apply(e, d(b.children, c)), e;
                }

                for (var e = [], f = 0; f < this._currentData.length; f++) {
                    var g = this._currentData[f];
                    e.push.apply(e, d(g, this.$element.val().split(this._valueSeparator)));
                }
                c(e);
            }, b.prototype.select = function (b, c) {
                if (this.options.get("multiple")) {
                    var d = this.$element.val();
                    d += this._valueSeparator + c.id, this.$element.val(d), this.$element.trigger("change");
                } else this.current(function (b) {
                    a.map(b, function (a) {
                        a.selected = !1;
                    });
                }), this.$element.val(c.id), this.$element.trigger("change");
            }, b.prototype.unselect = function (a, b) {
                var c = this;
                b.selected = !1, this.current(function (a) {
                    for (var d = [], e = 0; e < a.length; e++) {
                        var f = a[e];
                        b.id != f.id && d.push(f.id);
                    }
                    c.$element.val(d.join(c._valueSeparator)), c.$element.trigger("change");
                });
            }, b.prototype.query = function (a, b, c) {
                for (var d = [], e = 0; e < this._currentData.length; e++) {
                    var f = this._currentData[e], g = this.matches(b, f);
                    null !== g && d.push(g);
                }
                c({results: d});
            }, b.prototype.addOptions = function (b, c) {
                var d = a.map(c, function (b) {
                    return a.data(b[0], "data");
                });
                this._currentData.push.apply(this._currentData, d);
            }, b;
        }), b.define("select2/compat/matcher", ["jquery"], function (a) {
            function b(b) {
                function c(c, d) {
                    var e = a.extend(!0, {}, d);
                    if (null == c.term || "" === a.trim(c.term)) return e;
                    if (d.children) {
                        for (var f = d.children.length - 1; f >= 0; f--) {
                            var g = d.children[f], h = b(c.term, g.text, g);
                            h || e.children.splice(f, 1);
                        }
                        if (e.children.length > 0) return e;
                    }
                    return b(c.term, d.text, d) ? e : null;
                }

                return c;
            }

            return b;
        }), b.define("select2/compat/query", [], function () {
            function a(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `query` option has been deprecated in favor of a custom data adapter that overrides the `query` method. Support will be removed for the `query` option in future versions of Select2."), a.call(this, b, c);
            }

            return a.prototype.query = function (a, b, c) {
                b.callback = c;
                var d = this.options.get("query");
                d.call(null, b);
            }, a;
        }), b.define("select2/dropdown/attachContainer", [], function () {
            function a(a, b, c) {
                a.call(this, b, c);
            }

            return a.prototype.position = function (a, b, c) {
                var d = c.find(".dropdown-wrapper");
                d.append(b), b.addClass("select2-dropdown--below"), c.addClass("select2-container--below");
            }, a;
        }), b.define("select2/dropdown/stopPropagation", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);
                var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];
                this.$dropdown.on(d.join(" "), function (a) {
                    a.stopPropagation();
                });
            }, a;
        }), b.define("select2/selection/stopPropagation", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);
                var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];
                this.$selection.on(d.join(" "), function (a) {
                    a.stopPropagation();
                });
            }, a;
        }), function (c) {
            "function" == typeof b.define && b.define.amd ? b.define("jquery-mousewheel", ["jquery"], c) : "object" == typeof exports ? module.exports = c : c(a);
        }(function (a) {
            function b(b) {
                var g = b || window.event, h = i.call(arguments, 1), j = 0, l = 0, m = 0, n = 0, o = 0, p = 0;
                if (b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
                    if (1 === g.deltaMode) {
                        var q = a.data(this, "mousewheel-line-height");
                        j *= q, m *= q, l *= q;
                    } else if (2 === g.deltaMode) {
                        var r = a.data(this, "mousewheel-page-height");
                        j *= r, m *= r, l *= r;
                    }
                    if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
                        var s = this.getBoundingClientRect();
                        o = b.clientX - s.left, p = b.clientY - s.top;
                    }
                    return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h);
                }
            }

            function c() {
                f = null;
            }

            function d(a, b) {
                return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 === 0;
            }

            var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
                h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
                i = Array.prototype.slice;
            if (a.event.fixHooks) for (var j = g.length; j;) a.event.fixHooks[g[--j]] = a.event.mouseHooks;
            var k = a.event.special.mousewheel = {
                version: "3.1.12", setup: function () {
                    if (this.addEventListener) for (var c = h.length; c;) this.addEventListener(h[--c], b, !1); else this.onmousewheel = b;
                    a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this));
                }, teardown: function () {
                    if (this.removeEventListener) for (var c = h.length; c;) this.removeEventListener(h[--c], b, !1); else this.onmousewheel = null;
                    a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height");
                }, getLineHeight: function (b) {
                    var c = a(b), d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
                    return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16;
                }, getPageHeight: function (b) {
                    return a(b).height();
                }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
            };
            a.fn.extend({
                mousewheel: function (a) {
                    return a ? this.bind("mousewheel", a) : this.trigger("mousewheel");
                }, unmousewheel: function (a) {
                    return this.unbind("mousewheel", a);
                }
            });
        }), b.define("jquery.select2", ["jquery", "jquery-mousewheel", "./select2/core", "./select2/defaults"], function (a, b, c, d) {
            if (null == a.fn.select2) {
                var e = ["open", "close", "destroy"];
                a.fn.select2 = function (b) {
                    if (b = b || {}, "object" == typeof b) return this.each(function () {
                        var d = a.extend(!0, {}, b);
                        new c(a(this), d);
                    }), this;
                    if ("string" == typeof b) {
                        var d;
                        return this.each(function () {
                            var c = a(this).data("select2");
                            null == c && window.console && console.error && console.error("The select2('" + b + "') method was called on an element that is not using Select2.");
                            var e = Array.prototype.slice.call(arguments, 1);
                            d = c[b].apply(c, e);
                        }), a.inArray(b, e) > -1 ? this : d;
                    }
                    throw new Error("Invalid arguments for Select2: " + b);
                };
            }
            return null == a.fn.select2.defaults && (a.fn.select2.defaults = d), c;
        }), {define: b.define, require: b.require};
    }(), c = b.require("jquery.select2");
    return a.fn.select2.amd = b, c;
});
var cal;
var isFocus = false; //是否为焦点
var pickMode = {
    "second": 1,
    "minute": 2,
    "hour": 3,
    "day": 4,
    "month": 5,
    "year": 6
};
var topY = 0, leftX = 0; //自定义定位偏移量 2007-02-11 由 寒羽枫添加
//选择日期 → 由 寒羽枫 2007-06-10 添加，通过 ID 来选日期
function SelectDateById(id, strFormat, x, y) {
    var obj = document.getElementById(id);
    if (obj == null) {
        return false;
    }
    obj.focus();
    if (obj.onclick != null) {
        obj.onclick();
    }
    else if (obj.click != null) {
        obj.click();
    }
    else {
        SelectDate(obj, strFormat, x, y);
    }
}

//选择日期 → 由 寒羽枫 2006-06-25 添加
function SelectDate(obj, strFormat, x, y) {
    leftX = (x == null) ? leftX : x;
    topY = (y == null) ? topY : y;//自定义定位偏移量 2007-02-11 由 寒羽枫添加
    if (document.getElementById("ContainerPanel") == null) {
        InitContainerPanel();
    }
    var date = new Date();
    var by = date.getFullYear() - 50; //最小值 → 50 年前
    var ey = date.getFullYear() + 50; //最大值 → 50 年后
//cal = new Calendar(by, ey,1,strFormat); //初始化英文版，0 为中文版
    cal = (cal == null) ? new Calendar(by, ey, 1) : cal; //不用每次都初始化 2006-12-03 修正
    cal.DateMode = pickMode["second"]; //复位
    if (strFormat.indexOf('s') < 0) {
        cal.DateMode = pickMode["minute"];
    }//精度为分
    if (strFormat.indexOf('m') < 0) {
        cal.DateMode = pickMode["hour"];
    }//精度为时
    if (strFormat.indexOf('h') < 0) {
        cal.DateMode = pickMode["day"];
    }//精度为日
    if (strFormat.indexOf('d') < 0) {
        cal.DateMode = pickMode["month"];
    }//精度为月
    if (strFormat.indexOf('M') < 0) {
        cal.DateMode = pickMode["year"];
    }//精度为年
    if (strFormat.indexOf('y') < 0) {
        cal.DateMode = pickMode["second"];
    }//默认精度为秒
    cal.dateFormatStyleOld = cal.dateFormatStyle;
    cal.dateFormatStyle = strFormat;
    cal.show(obj);
}

/**/
/**/
/**/
/**/
/**/
/**/
/**/
/**
 * 返回日期
 * @param d the delimiter
 * @param p the pattern of your date
 2006-06-25 由 寒羽枫 修改为根据用户指定的 style 来确定；
 */
String.prototype.toDate = function (style) {
    var y = this.substring(style.indexOf('y'), style.lastIndexOf('y') + 1);//年
    var M = this.substring(style.indexOf('M'), style.lastIndexOf('M') + 1);//月
    var d = this.substring(style.indexOf('d'), style.lastIndexOf('d') + 1);//日
    var h = this.substring(style.indexOf('h'), style.lastIndexOf('h') + 1);//时
    var m = this.substring(style.indexOf('m'), style.lastIndexOf('m') + 1);//分
    var s = this.substring(style.indexOf('s'), style.lastIndexOf('s') + 1);//秒
    if (s == null || s == "" || isNaN(s)) {
        s = new Date().getSeconds();
    }
    if (m == null || m == "" || isNaN(m)) {
        m = new Date().getMinutes();
    }
    if (h == null || h == "" || isNaN(h)) {
        h = new Date().getHours();
    }
    if (d == null || d == "" || isNaN(d)) {
        d = new Date().getDate();
    }
    if (M == null || M == "" || isNaN(M)) {
        M = new Date().getMonth() + 1;
    }
    if (y == null || y == "" || isNaN(y)) {
        y = new Date().getFullYear();
    }
    var dt;
    eval("dt = new Date('" + y + "', '" + (M - 1) + "','" + d + "','" + h + "','" + m + "','" + s + "')");
    return dt;
};
/**/
/**/
/**/
/**/
/**/
/**/
/**/
/**
 * 格式化日期
 * @param d the delimiter
 * @param p the pattern of your date
 * @author meizz
 */
Date.prototype.format = function (style) {
    var o = {
        "M+": this.getMonth() + 1, //month
        "d+": this.getDate(), //day
        "h+": this.getHours(), //hour
        "m+": this.getMinutes(), //minute
        "s+": this.getSeconds(), //second
        "w+": "天一二三四五六".charAt(this.getDay()), //week
        "q+": Math.floor((this.getMonth() + 3) / 3), //quarter
        "S": this.getMilliseconds() //millisecond
    };
    if (/(y+)/.test(style)) {
        style = style.replace(RegExp.$1,
            (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(style)) {
            style = style.replace(RegExp.$1,
                RegExp.$1.length == 1 ? o[k] :
                    ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return style;
};
//2007-09-14 由寒羽枫添加返回所选日期
Calendar.prototype.ReturnDate = function (dt) {
    if (this.dateControl != null) {
        this.dateControl.value = dt;
    }
    calendar.hide();
    if (this.dateControl.onchange == null) {
        return;
    }
//将 onchange 转成其它函数，以免触发验证事件
    var ev = this.dateControl.onchange.toString(); //找出函数的字串
    ev = ev.substring(
        ((ev.indexOf("ValidatorOnChange();") > 0) ? ev.indexOf("ValidatorOnChange();") + 20 : ev.indexOf("{") + 1)
        , ev.lastIndexOf("}"));//去除验证函数 ValidatorOnChange();
    var fun = new Function(ev); //重新定义函数
    this.dateControl.changeEvent = fun;
    this.dateControl.changeEvent();//触发自定义 changeEvent 函数
};
/**/
/**/
/**/
/**/
/**/
/**/

/**/
/**
 * 日历类
 * @param beginYear 1990
 * @param endYear 2010
 * @param lang 0(中文)|1(英语) 可自由扩充
 * @param dateFormatStyle "yyyy-MM-dd";
 * @version 2006-04-01
 * @author KimSoft (jinqinghua [at] gmail.com)
 * @update
 */
function Calendar(beginYear, endYear, lang, dateFormatStyle) {
    this.beginYear = 1950;
    this.endYear = 2050;
    this.lang = 1; //0(中文) | 1(英文)
    this.dateFormatStyle = "yyyy-MM-dd hh:mm:ss";
    if (beginYear != null && endYear != null) {
        this.beginYear = beginYear;
        this.endYear = endYear;
    }
    if (lang != null) {
        this.lang = lang;
    }
    if (dateFormatStyle != null) {
        this.dateFormatStyle = dateFormatStyle;
    }
    this.dateControl = null;
    this.panel = this.getElementById("calendarPanel");
    this.container = this.getElementById("ContainerPanel");
    this.form = null;
    this.date = new Date();
    this.year = this.date.getFullYear();
    this.month = this.date.getMonth();
    this.day = this.date.getDate();
    this.hour = this.date.getHours();
    this.minute = this.date.getMinutes();
    this.second = this.date.getSeconds();
    this.colors = {
        "cur_word": "#FFFFFF", //当日日期文字颜色
        "cur_bg": "#00FF00", //当日日期单元格背影色
        "sel_bg": "#FFCCCC", //已被选择的日期单元格背影色
        "sun_word": "#FF0000", //星期天文字颜色
        "sat_word": "#0000FF", //星期六文字颜色
        "td_word_light": "#333333", //单元格文字颜色
        "td_word_dark": "#CCCCCC", //单元格文字暗色
        "td_bg_out": "#EFEFEF", //单元格背影色
        "td_bg_over": "#FFCC00", //单元格背影色
        "tr_word": "#FFFFFF", //日历头文字颜色
        "tr_bg": "#666666", //日历头背影色
        "input_border": "#CCCCCC", //input控件的边框颜色
        "input_bg": "#fff" //input控件的背影色
    };
    /* //2008-01-29 放到了 show ，因为要做 pickMode 判断
    this.draw();
    this.bindYear();
    this.bindMonth();
    */
//this.changeSelect();
//this.bindData(); //2006-12-30 由民工.砖家注释
}

/**/
/**/
/**/
/**/
/**/
/**/
/**/
/**
 * 日历类属性（语言包，可自由扩展）
 */
Calendar.language = {
    "year": [[""], [""]],
    "months": [["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"]
    ],
    "weeks": [["日", "一", "二", "三", "四", "五", "六"],
        ["SUN", "MON", "TUR", "WED", "THU", "FRI", "SAT"]
    ],
    "hour": [["时"], ["H"]],
    "minute": [["分"], ["M"]],
    "second": [["秒"], ["S"]],
    "clear": [["清空"], ["CLS"]],
    "today": [["今天"], ["TODAY"]],
    "pickTxt": [["确定"], ["OK"]],//pickMode 精确到年、月时把今天变成“确定”
    "close": [["关闭"], ["CLOSE"]]
};
Calendar.prototype.draw = function () {
    calendar = this;
    var mvAry = [];
//mvAry[mvAry.length] = ' <form name="calendarForm" style="margin: 0px;">'; //因 <form> 不能嵌套， 2006-12-01 由寒羽枫改用 Div
    mvAry[mvAry.length] = ' <div name="calendarForm" style="margin: 0px;">';
    mvAry[mvAry.length] = ' <table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-size:12px;">';
    mvAry[mvAry.length] = ' <tr>';
    mvAry[mvAry.length] = ' <th align="left" width="1%"><input style="border: 1px solid ' + calendar.colors["input_border"] + ';background-color:' + calendar.colors["input_bg"] + ';width:16px;height:20px;';
    if (calendar.DateMode > pickMode["month"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到年时隐藏“月”
    mvAry[mvAry.length] = '" name="prevMonth" type="button" id="prevMonth" value="&lt;" /></th>';
    mvAry[mvAry.length] = ' <th align="center" width="98%" nowrap="nowrap"><select name="calendarYear" id="calendarYear" style="font-size:12px;"></select><select name="calendarMonth" id="calendarMonth" style="font-size:12px;';
    if (calendar.DateMode > pickMode["month"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到年时隐藏“月”
    mvAry[mvAry.length] = '"></select></th>';
    mvAry[mvAry.length] = ' <th align="right" width="1%"><input style="border: 1px solid ' + calendar.colors["input_border"] + ';background-color:' + calendar.colors["input_bg"] + ';width:16px;height:20px;';
    if (calendar.DateMode > pickMode["month"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到年时隐藏“月”
    mvAry[mvAry.length] = '" name="nextMonth" type="button" id="nextMonth" value="&gt;" /></th>';
    mvAry[mvAry.length] = ' </tr>';
    mvAry[mvAry.length] = ' </table>';
    mvAry[mvAry.length] = ' <table id="calendarTable" width="100%" style="border:0px solid #CCCCCC;background-color:#FFFFFF;font-size:12px;';
    if (calendar.DateMode >= pickMode["month"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到年、月时隐藏“天”
    mvAry[mvAry.length] = '" border="0" cellpadding="3" cellspacing="1">';
    mvAry[mvAry.length] = ' <tr>';
    for (var i = 0; i < 7; i++) {
        mvAry[mvAry.length] = ' <th style="font-weight:normal;background-color:' + calendar.colors["tr_bg"] + ';color:' + calendar.colors["tr_word"] + ';">' + Calendar.language["weeks"][this.lang][i] + '</th>';
    }
    mvAry[mvAry.length] = ' </tr>';
    for (var i = 0; i < 6; i++) {
        mvAry[mvAry.length] = ' <tr align="center">';
        for (var j = 0; j < 7; j++) {
            if (j == 0) {
                mvAry[mvAry.length] = ' <td style="cursor:default;color:' + calendar.colors["sun_word"] + ';"></td>';
            } else if (j == 6) {
                mvAry[mvAry.length] = ' <td style="cursor:default;color:' + calendar.colors["sat_word"] + ';"></td>';
            } else {
                mvAry[mvAry.length] = ' <td style="cursor:default;"></td>';
            }
        }
        mvAry[mvAry.length] = ' </tr>';
    }
//2009-03-03 添加的代码，放置时间的行
    mvAry[mvAry.length] = ' <tr style="';
    if (calendar.DateMode >= pickMode["day"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到时日隐藏“时间”
    mvAry[mvAry.length] = '"><td align="center" colspan="7">';
    mvAry[mvAry.length] = ' <select name="calendarHour" id="calendarHour" style="font-size:12px;"></select>' + Calendar.language["hour"][this.lang];
    mvAry[mvAry.length] = '<span style="';
    if (calendar.DateMode >= pickMode["hour"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到小时时隐藏“分”
    mvAry[mvAry.length] = '"><select name="calendarMinute" id="calendarMinute" style="font-size:12px;"></select>' + Calendar.language["minute"][this.lang] + '</span>';
    mvAry[mvAry.length] = '<span style="';
    if (calendar.DateMode >= pickMode["minute"]) {
        mvAry[mvAry.length] = 'display:none;';
    }//pickMode 精确到小时、分时隐藏“秒”
    mvAry[mvAry.length] = '"><select name="calendarSecond" id="calendarSecond" style="font-size:12px;"></select>' + Calendar.language["second"][this.lang] + '</span>';
    mvAry[mvAry.length] = ' </td></tr>';
    mvAry[mvAry.length] = ' </table>';
//mvAry[mvAry.length] = ' </from>';
    mvAry[mvAry.length] = ' <div align="center" style="padding:4px 4px 4px 4px;background-color:' + calendar.colors["input_bg"] + ';">';
    mvAry[mvAry.length] = ' <input name="calendarClear" type="button" id="calendarClear" value="' + Calendar.language["clear"][this.lang] + '" style="border: 1px solid ' + calendar.colors["input_border"] + ';background-color:' + calendar.colors["input_bg"] + ';width:40px;height:20px;font-size:12px;cursor:pointer;"/>';
    mvAry[mvAry.length] = ' <input name="calendarToday" type="button" id="calendarToday" value="';
    mvAry[mvAry.length] = (calendar.DateMode == pickMode["day"]) ? Calendar.language["today"][this.lang] : Calendar.language["pickTxt"][this.lang];
    mvAry[mvAry.length] = '" style="border: 1px solid ' + calendar.colors["input_border"] + ';background-color:' + calendar.colors["input_bg"] + ';width:60px;height:20px;font-size:12px;cursor:pointer"/>';
    mvAry[mvAry.length] = ' <input name="calendarClose" type="button" id="calendarClose" value="' + Calendar.language["close"][this.lang] + '" style="border: 1px solid ' + calendar.colors["input_border"] + ';background-color:' + calendar.colors["input_bg"] + ';width:40px;height:20px;font-size:12px;cursor:pointer"/>';
    mvAry[mvAry.length] = ' </div>';
    mvAry[mvAry.length] = ' </div>';
    this.panel.innerHTML = mvAry.join("");
    /**/
    /**/
    /**/
    /******** 以下代码由寒羽枫 2006-12-01 添加 **********/
    var obj = this.getElementById("prevMonth");
    obj.onclick = function () {
        calendar.goPrevMonth(calendar);
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.prevMonth = obj;
    obj = this.getElementById("nextMonth");
    obj.onclick = function () {
        calendar.goNextMonth(calendar);
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.nextMonth = obj;
    obj = this.getElementById("calendarClear");
    obj.onclick = function () {
        calendar.ReturnDate("");
        /*calendar.dateControl.value = "";calendar.hide();*///2007-09-14 由寒羽枫注释
    };
    this.calendarClear = obj;
    obj = this.getElementById("calendarClose");
    obj.onclick = function () {
        calendar.hide();
    };
    this.calendarClose = obj;
    obj = this.getElementById("calendarYear");
    obj.onchange = function () {
        calendar.update(calendar);
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.calendarYear = obj;
    obj = this.getElementById("calendarMonth");
    with (obj) {
        onchange = function () {
            calendar.update(calendar);
        };
        onblur = function () {
            calendar.onblur();
        };
    }
    this.calendarMonth = obj;
    obj = this.getElementById("calendarHour");
    obj.onchange = function () {
        calendar.hour = this.options[this.selectedIndex].value;
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.calendarHour = obj;
    obj = this.getElementById("calendarMinute");
    obj.onchange = function () {
        calendar.minute = this.options[this.selectedIndex].value;
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.calendarMinute = obj;
    obj = this.getElementById("calendarSecond");
    obj.onchange = function () {
        calendar.second = this.options[this.selectedIndex].value;
    };
    obj.onblur = function () {
        calendar.onblur();
    };
    this.calendarSecond = obj;
    obj = this.getElementById("calendarToday");
    obj.onclick = function () {
        var today = (calendar.DateMode != pickMode["day"]) ?
            new Date(calendar.year, calendar.month, calendar.day, calendar.hour, calendar.minute, calendar.second)
            : new Date();//2008-01-29
        calendar.ReturnDate(today.format(calendar.dateFormatStyle));
    };
    this.calendarToday = obj;
};
//年份下拉框绑定数据
Calendar.prototype.bindYear = function () {
    var cy = this.calendarYear;//2006-12-01 由寒羽枫修改
    cy.length = 0;
    for (var i = this.beginYear; i <= this.endYear; i++) {
        cy.options[cy.length] = new Option(i + Calendar.language["year"][this.lang], i);
    }
};
//月份下拉框绑定数据
Calendar.prototype.bindMonth = function () {
    var cm = this.calendarMonth;//2006-12-01 由寒羽枫修改
    cm.length = 0;
    for (var i = 0; i < 12; i++) {
        cm.options[cm.length] = new Option(Calendar.language["months"][this.lang][i], i);
    }
};
//小时下拉框绑定数据
Calendar.prototype.bindHour = function () {
    var ch = this.calendarHour;
    if (ch.length > 0) {
        return;
    }//2009-03-03 不需要重新绑定，提高性能
//ch.length = 0;
    var h;
    for (var i = 0; i < 24; i++) {
        h = ("00" + i + "").substr(("" + i).length);
        ch.options[ch.length] = new Option(h, h);
    }
};
//分钟下拉框绑定数据
Calendar.prototype.bindMinute = function () {
    var cM = this.calendarMinute;
    if (cM.length > 0) {
        return;
    }//2009-03-03 不需要重新绑定，提高性能
//cM.length = 0;
    var M;
    for (var i = 0; i < 60; i++) {
        M = ("00" + i + "").substr(("" + i).length);
        cM.options[cM.length] = new Option(M, M);
    }
};
//秒钟下拉框绑定数据
Calendar.prototype.bindSecond = function () {
    var cs = this.calendarSecond;
    if (cs.length > 0) {
        return;
    }//2009-03-03 不需要重新绑定，提高性能
//cs.length = 0;
    var s;
    for (var i = 0; i < 60; i++) {
        s = ("00" + i + "").substr(("" + i).length);
        cs.options[cs.length] = new Option(s, s);
    }
};
//向前一月
Calendar.prototype.goPrevMonth = function (e) {
    if (this.year == this.beginYear && this.month == 0) {
        return;
    }
    this.month--;
    if (this.month == -1) {
        this.year--;
        this.month = 11;
    }
    this.date = new Date(this.year, this.month, 1);
    this.changeSelect();
    this.bindData();
};
//向后一月
Calendar.prototype.goNextMonth = function (e) {
    if (this.year == this.endYear && this.month == 11) {
        return;
    }
    this.month++;
    if (this.month == 12) {
        this.year++;
        this.month = 0;
    }
    this.date = new Date(this.year, this.month, 1);
    this.changeSelect();
    this.bindData();
};
//改变SELECT选中状态
Calendar.prototype.changeSelect = function () {
    var cy = this.calendarYear;//2006-12-01 由寒羽枫修改
    var cm = this.calendarMonth;
    var ch = this.calendarHour;
    var cM = this.calendarMinute;
    var cs = this.calendarSecond;
//2006-12-30 由民工.砖家修改，减少运算次数
    cy[this.date.getFullYear() - this.beginYear].selected = true;
    cm[this.date.getMonth()].selected = true;
//2009-03-03 添加，初始化时间的值
    ch[this.hour].selected = true;
    cM[this.minute].selected = true;
    cs[this.second].selected = true;
};
//更新年、月
Calendar.prototype.update = function (e) {
    this.year = e.calendarYear.options[e.calendarYear.selectedIndex].value;//2006-12-01 由寒羽枫修改
    this.month = e.calendarMonth.options[e.calendarMonth.selectedIndex].value;
    this.date = new Date(this.year, this.month, 1);
//this.changeSelect();
    this.bindData();
};
//绑定数据到月视图
Calendar.prototype.bindData = function () {
    var calendar = this;
    if (calendar.DateMode >= pickMode["month"]) {
        return;
    }//2008-01-29
// var dateArray = this.getMonthViewArray(this.date.getYear(), this.date.getMonth());
//2006-12-30 由民工.砖家修改 在Firefox 下年份错误
    var dateArray = this.getMonthViewArray(this.date.getFullYear(), this.date.getMonth());
    var tds = this.getElementById("calendarTable").getElementsByTagName("td");
    for (var i = 0; i < tds.length; i++) {
        tds[i].style.backgroundColor = calendar.colors["td_bg_out"];
        tds[i].onclick = function () {
            return;
        };
        tds[i].onmouseover = function () {
            return;
        };
        tds[i].onmouseout = function () {
            return;
        };
        if (i > dateArray.length - 1) break;
        tds[i].innerHTML = dateArray[i];
        if (dateArray[i] != "&nbsp;") {
            tds[i].bgColorTxt = "td_bg_out"; //2009-03-03 保存背景色的class
            var cur = new Date();
            tds[i].isToday = false;
            if (cur.getFullYear() == calendar.date.getFullYear() && cur.getMonth() == calendar.date.getMonth() && cur.getDate() == dateArray[i]) {
//是今天的单元格
                tds[i].style.backgroundColor = calendar.colors["cur_bg"];
                tds[i].bgColorTxt = "cur_bg";
                tds[i].isToday = true;
            }
            if (calendar.dateControl != null) {
                cur = calendar.dateControl.value.toDate(calendar.dateFormatStyle);
                if (cur.getFullYear() == calendar.date.getFullYear() && cur.getMonth() == calendar.date.getMonth() && cur.getDate() == dateArray[i]) {
//是已被选中的单元格
                    calendar.selectedDayTD = tds[i];
                    tds[i].style.backgroundColor = calendar.colors["sel_bg"];
                    tds[i].bgColorTxt = "sel_bg";
                }
            }
            tds[i].onclick = function () {
                if (calendar.DateMode == pickMode["day"]) //2009-03-03 当选择日期时，点击格子即返回值
                {
                    calendar.ReturnDate(new Date(calendar.date.getFullYear(),
                        calendar.date.getMonth(),
                        this.innerHTML).format(calendar.dateFormatStyle));
                }
                else {
                    if (calendar.selectedDayTD != null) //2009-03-03 清除已选中的背景色
                    {
                        calendar.selectedDayTD.style.backgroundColor = (calendar.selectedDayTD.isToday) ? calendar.colors["cur_bg"] : calendar.colors["td_bg_out"];
                    }
                    this.style.backgroundColor = calendar.colors["sel_bg"];
                    calendar.day = this.innerHTML;
                    calendar.selectedDayTD = this; //2009-03-03 记录已选中的日子
                }
            };
            tds[i].style.cursor = "pointer"; //2007-08-06 由寒羽枫添加，鼠标变成手指状
            tds[i].onmouseover = function () {
                this.style.backgroundColor = calendar.colors["td_bg_over"];
            };
            tds[i].onmouseout = function () {
                if (calendar.selectedDayTD != this) {
                    this.style.backgroundColor = calendar.colors[this.bgColorTxt];
                }
            };
            tds[i].onblur = function () {
                calendar.onblur();
            };
        }
    }
};
//根据年、月得到月视图数据(数组形式)
Calendar.prototype.getMonthViewArray = function (y, m) {
    var mvArray = [];
    var dayOfFirstDay = new Date(y, m, 1).getDay();
    var daysOfMonth = new Date(y, m + 1, 0).getDate();
    for (var i = 0; i < 42; i++) {
        mvArray[i] = "&nbsp;";
    }
    for (var i = 0; i < daysOfMonth; i++) {
        mvArray[i + dayOfFirstDay] = i + 1;
    }
    return mvArray;
};
//扩展 document.getElementById(id) 多浏览器兼容性 from meizz tree source
Calendar.prototype.getElementById = function (id) {
    if (typeof(id) != "string" || id == "") return null;
    if (document.getElementById) return document.getElementById(id);
    if (document.all) return document.all(id);
    try {
        return eval(id);
    } catch (e) {
        return null;
    }
};
//扩展 object.getElementsByTagName(tagName)
Calendar.prototype.getElementsByTagName = function (object, tagName) {
    if (document.getElementsByTagName) return document.getElementsByTagName(tagName);
    if (document.all) return document.all.tags(tagName);
};
//取得HTML控件绝对位置
Calendar.prototype.getAbsPoint = function (e) {
    var x = e.offsetLeft;
    var y = e.offsetTop;
    while (e = e.offsetParent) {
        x += e.offsetLeft;
        y += e.offsetTop;
    }
    return {"x": x, "y": y};
};
//显示日历
Calendar.prototype.show = function (dateObj, popControl) {
    if (dateObj == null) {
        throw new Error("arguments[0] is necessary");
    }
    this.dateControl = dateObj;
    var now = new Date();
    this.date = (dateObj.value.length > 0) ? new Date(dateObj.value.toDate(this.dateFormatStyle)) : now.format(this.dateFormatStyle).toDate(this.dateFormatStyle);//2008-01-29 寒羽枫添加 → 若为空则根据dateFormatStyle初始化日期
    if (this.panel.innerHTML == "" || cal.dateFormatStyleOld != cal.dateFormatStyle)//2008-01-29 把构造表格放在此处，2009-03-03 若请示的样式改变，则重新初始化
    {
        this.draw();
        this.bindYear();
        this.bindMonth();
        this.bindHour();
        this.bindMinute();
        this.bindSecond();
    }
    this.year = this.date.getFullYear();
    this.month = this.date.getMonth();
    this.day = this.date.getDate();
    this.hour = this.date.getHours();
    this.minute = this.date.getMinutes();
    this.second = this.date.getSeconds();
    this.changeSelect();
    this.bindData();
    if (popControl == null) {
        popControl = dateObj;
    }
    var xy = this.getAbsPoint(popControl);
//this.panel.style.left = xy.x + "px";
//this.panel.style.top = (xy.y + dateObj.offsetHeight) + "px";
    this.panel.style.left = (xy.x + leftX) + "px"; //由寒羽枫 2007-02-11 修改 → 加入自定义偏移量
    this.panel.style.top = (xy.y + topY + dateObj.offsetHeight) + "px";
//由寒羽枫 2006-06-25 修改 → 把 visibility 变为 display，并添加失去焦点的事件 //this.setDisplayStyle("select", "hidden");
//this.panel.style.visibility = "visible";
//this.container.style.visibility = "visible";
    this.panel.style.display = "";
    this.container.style.display = "";
    if (!this.dateControl.isTransEvent) {
        this.dateControl.isTransEvent = true;
        /* 已写在返回值的时候 ReturnDate 函数中，去除验证事件的函数
        this.dateControl.changeEvent = this.dateControl.onchange;//将 onchange 转成其它函数，以免触发验证事件
        this.dateControl.onchange = function()
        {if(typeof(this.changeEvent) =='function'){this.changeEvent();}}*/
        if (this.dateControl.onblur != null) {
            this.dateControl.blurEvent = this.dateControl.onblur;
        }//2007-09-14 保存主文本框的 onblur ，使其原本的事件不被覆盖
        this.dateControl.onblur = function () {
            calendar.onblur();
            if (typeof(this.blurEvent) == 'function') {
                this.blurEvent();
            }
        };
    }
    this.container.onmouseover = function () {
        isFocus = true;
    };
    this.container.onmouseout = function () {
        isFocus = false;
    };
};
//隐藏日历
Calendar.prototype.hide = function () {
//this.setDisplayStyle("select", "visible");
//this.panel.style.visibility = "hidden";
//this.container.style.visibility = "hidden";
    this.panel.style.display = "none";
    this.container.style.display = "none";
    isFocus = false;
};
//焦点转移时隐藏日历 → 由寒羽枫 2006-06-25 添加
Calendar.prototype.onblur = function () {
    if (!isFocus) {
        this.hide();
    }
};

//以下由寒羽枫 2007-07-26 修改 → 确保日历容器节点在 body 最后，否则 FireFox 中不能出现在最上方
function InitContainerPanel() //初始化容器
{
    var str = '<div id="calendarPanel" style="position: absolute;display: none;z-index:9999; background-color: #FFFFFF;border: 1px solid #CCCCCC;width:175px;font-size:12px;"></div>';
    if (document.all) {
        str += '<iframe style="position:absolute;z-index:2000;width:expression(this.previousSibling.offsetWidth);';
        str += 'height:expression(this.previousSibling.offsetHeight);';
        str += 'left:expression(this.previousSibling.offsetLeft);top:expression(this.previousSibling.offsetTop);';
        str += 'display:expression(this.previousSibling.style.display);" scrolling="no" frameborder="no"></iframe>';
    }
    var div = document.createElement("div");
    div.innerHTML = str;
    div.id = "ContainerPanel";
    div.style.display = "none";
    document.body.appendChild(div);
}//调用calendar.show(dateControl, popControl);
//-->
/*!
 * @copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2015
 * @version 3.5.4
 *
 * A simple yet powerful JQuery star rating plugin that allows rendering
 * fractional star ratings and supports Right to Left (RTL) input.
 *
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
!function (t) {
    "use strict";
    var e = 0, a = 5, n = .5, r = function (e, a) {
        return null === e || void 0 === e || 0 === e.length || a && "" === t.trim(e);
    }, i = function (t, e) {
        t.removeClass(e).addClass(e);
    }, l = function (t, e, a) {
        var n = r(t.data(e)) ? t.attr(e) : t.data(e);
        return n ? n : a[e];
    }, o = function (t) {
        var e = ("" + t).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        return e ? Math.max(0, (e[1] ? e[1].length : 0) - (e[2] ? +e[2] : 0)) : 0;
    }, s = function (t, e) {
        return parseFloat(t.toFixed(e));
    }, c = function (e, a) {
        this.$element = t(e), this.init(a);
    };
    c.prototype = {
        constructor: c, _parseAttr: function (t, i) {
            var o = this, s = o.$element;
            if ("range" === s.attr("type") || "number" === s.attr("type")) {
                var c, u, g = l(s, t, i);
                switch (t) {
                    case"min":
                        c = e;
                        break;
                    case"max":
                        c = a;
                        break;
                    default:
                        c = n;
                }
                return u = r(g) ? c : g, parseFloat(u);
            }
            return parseFloat(i[t]);
        }, listenClick: function (t, e) {
            t.on("click touchstart", function (t) {
                return t.stopPropagation(), t.preventDefault(), t.handled === !0 ? !1 : (e(t), void(t.handled = !0));
            });
        }, setDefault: function (t, e) {
            var a = this;
            r(a[t]) && (a[t] = e);
        }, getPosition: function (t) {
            var e = t.pageX || t.originalEvent.touches[0].pageX;
            return e - this.$rating.offset().left;
        }, listen: function () {
            var e, a, n = this;
            n.initTouch(), n.listenClick(n.$rating, function (t) {
                return n.inactive ? !1 : (e = n.getPosition(t), n.setStars(e), n.$element.trigger("change").trigger("rating.change", [n.$element.val(), n.$caption.html()]), void(n.starClicked = !0));
            }), n.$rating.on("mousemove", function (t) {
                n.hoverEnabled && !n.inactive && (n.starClicked = !1, e = n.getPosition(t), a = n.calculate(e), n.toggleHover(a), n.$element.trigger("rating.hover", [a.val, a.caption, "stars"]));
            }), n.$rating.on("mouseleave", function () {
                !n.hoverEnabled || n.inactive || n.starClicked || (a = n.cache, n.toggleHover(a), n.$element.trigger("rating.hoverleave", ["stars"]));
            }), n.$clear.on("mousemove", function () {
                if (n.hoverEnabled && !n.inactive && n.hoverOnClear) {
                    n.clearClicked = !1;
                    var t = '<span class="' + n.clearCaptionClass + '">' + n.clearCaption + "</span>", e = n.clearValue,
                        r = n.getWidthFromValue(e);
                    a = {
                        caption: t,
                        width: r,
                        val: e
                    }, n.toggleHover(a), n.$element.trigger("rating.hover", [e, t, "clear"]);
                }
            }), n.$clear.on("mouseleave", function () {
                n.hoverEnabled && !n.inactive && !n.clearClicked && n.hoverOnClear && (a = n.cache, n.toggleHover(a), n.$element.trigger("rating.hoverleave", ["clear"]));
            }), n.listenClick(n.$clear, function () {
                n.inactive || (n.clear(), n.clearClicked = !0);
            }), t(n.$element[0].form).on("reset", function () {
                n.inactive || n.reset();
            });
        }, destroy: function () {
            var e = this, a = e.$element;
            r(e.$container) || e.$container.before(a).remove(), t.removeData(a.get(0)), a.off("rating").removeClass("hide");
        }, create: function (t) {
            var e = this, a = e.$element;
            t = t || e.options || {}, e.destroy(), a.rating(t);
        }, setTouch: function (t, e) {
            var a = this,
                n = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch;
            if (n && !a.inactive) {
                var r = t.originalEvent, i = r.touches || r.changedTouches, l = a.getPosition(i[0]);
                if (e) a.setStars(l), a.$element.trigger("change").trigger("rating.change", [a.$element.val(), a.$caption.html()]), a.starClicked = !0; else {
                    var o = a.calculate(l), s = o.val <= a.clearValue ? a.fetchCaption(a.clearValue) : o.caption,
                        c = a.getWidthFromValue(a.clearValue),
                        u = o.val <= a.clearValue ? a.rtl ? 100 - c + "%" : c + "%" : o.width;
                    a.$caption.html(s), a.$stars.css("width", u);
                }
            }
        }, initTouch: function () {
            var t = this;
            t.$rating.on("touchstart touchmove touchend", function (e) {
                var a = "touchend" === e.type;
                t.setTouch(e, a);
            });
        }, initSlider: function (t) {
            var i = this;
            r(i.$element.val()) && i.$element.val(0), i.initialValue = i.$element.val(), i.setDefault("min", i._parseAttr("min", t)), i.setDefault("max", i._parseAttr("max", t)), i.setDefault("step", i._parseAttr("step", t)), (isNaN(i.min) || r(i.min)) && (i.min = e), (isNaN(i.max) || r(i.max)) && (i.max = a), (isNaN(i.step) || r(i.step) || 0 === i.step) && (i.step = n), i.diff = i.max - i.min;
        }, init: function (e) {
            var a, n, l, o = this, s = o.$element;
            o.options = e, t.each(e, function (t, e) {
                o[t] = e;
            }), o.starClicked = !1, o.clearClicked = !1, o.initSlider(e), o.checkDisabled(), o.setDefault("rtl", s.attr("dir")), o.rtl && s.attr("dir", "rtl"), a = o.glyphicon ? "" : "★", o.setDefault("symbol", a), o.setDefault("clearButtonBaseClass", "clear-rating"), o.setDefault("clearButtonActiveClass", "clear-rating-active"), o.setDefault("clearValue", o.min), i(s, "form-control hide"), o.$clearElement = r(e.clearElement) ? null : t(e.clearElement), o.$captionElement = r(e.captionElement) ? null : t(e.captionElement), void 0 === o.$rating && void 0 === o.$container && (o.$rating = t(document.createElement("div")).html('<div class="rating-stars"></div>'), o.$container = t(document.createElement("div")), o.$container.before(o.$rating).append(o.$rating), s.before(o.$container).appendTo(o.$rating)), o.$stars = o.$rating.find(".rating-stars"), o.generateRating(), o.$clear = r(o.$clearElement) ? o.$container.find("." + o.clearButtonBaseClass) : o.$clearElement, o.$caption = r(o.$captionElement) ? o.$container.find(".caption") : o.$captionElement, o.setStars(), o.listen(), o.showClear && o.$clear.attr({"class": o.getClearClass()}), n = s.val(), l = o.getWidthFromValue(n), o.cache = {
                caption: o.$caption.html(),
                width: (o.rtl ? 100 - l : l) + "%",
                val: n
            }, s.removeClass("rating-loading");
        }, checkDisabled: function () {
            var t = this;
            t.disabled = l(t.$element, "disabled", t.options), t.readonly = l(t.$element, "readonly", t.options), t.inactive = t.disabled || t.readonly;
        }, getClearClass: function () {
            return this.clearButtonBaseClass + " " + (this.inactive ? "" : this.clearButtonActiveClass);
        }, generateRating: function () {
            var t = this, e = t.renderClear(), a = t.renderCaption(),
                n = t.rtl ? "rating-container-rtl" : "rating-container", l = t.getStars();
            n += t.glyphicon ? ("" === t.symbol ? " rating-gly-star" : " rating-gly") + t.ratingClass : r(t.ratingClass) ? " rating-uni" : " " + t.ratingClass, t.$rating.attr("class", n), t.$rating.attr("data-content", l), t.$stars.attr("data-content", l), n = t.rtl ? "star-rating-rtl" : "star-rating", t.$container.attr("class", n + " rating-" + t.size), t.$container.removeClass("rating-active rating-disabled"), t.$container.addClass(t.inactive ? "rating-disabled" : "rating-active"), r(t.$caption) && (t.rtl ? t.$container.prepend(a) : t.$container.append(a)), r(t.$clear) && (t.rtl ? t.$container.append(e) : t.$container.prepend(e)), r(t.containerClass) || i(t.$container, t.containerClass);
        }, getStars: function () {
            var t, e = this, a = e.stars, n = "";
            for (t = 1; a >= t; t++) n += e.symbol;
            return n;
        }, renderClear: function () {
            var t, e = this;
            return e.showClear ? (t = e.getClearClass(), r(e.$clearElement) ? '<div class="' + t + '" title="' + e.clearButtonTitle + '">' + e.clearButton + "</div>" : (i(e.$clearElement, t), e.$clearElement.attr({title: e.clearButtonTitle}).html(e.clearButton), "")) : "";
        }, renderCaption: function () {
            var t, e = this, a = e.$element.val();
            return e.showCaption ? (t = e.fetchCaption(a), r(e.$captionElement) ? '<div class="caption">' + t + "</div>" : (i(e.$captionElement, "caption"), e.$captionElement.html(t), "")) : "";
        }, fetchCaption: function (t) {
            var e, a, n, i, l, o = this, s = parseFloat(t), c = o.starCaptions, u = o.starCaptionClasses;
            return i = "function" == typeof u ? u(s) : u[s], n = "function" == typeof c ? c(s) : c[s], a = r(n) ? o.defaultCaption.replace(/\{rating\}/g, s) : n, e = r(i) ? o.clearCaptionClass : i, l = s === o.clearValue ? o.clearCaption : a, '<span class="' + e + '">' + l + "</span>";
        }, getWidthFromValue: function (t) {
            var e = this, a = e.min, n = e.max;
            return a >= t || a === n ? 0 : t >= n ? 100 : 100 * (t - a) / (n - a);
        }, getValueFromPosition: function (t) {
            var e, a, n = this, r = o(n.step), i = n.$rating.width();
            return a = n.diff * t / (i * n.step), a = n.rtl ? Math.floor(a) : Math.ceil(a), e = s(parseFloat(n.min + a * n.step), r), e = Math.max(Math.min(e, n.max), n.min), n.rtl ? n.max - e : e;
        }, toggleHover: function (t) {
            var e, a, n, r = this;
            r.hoverChangeCaption && (n = t.val <= r.clearValue ? r.fetchCaption(r.clearValue) : t.caption, r.$caption.html(n)), r.hoverChangeStars && (e = r.getWidthFromValue(r.clearValue), a = t.val <= r.clearValue ? r.rtl ? 100 - e + "%" : e + "%" : t.width, r.$stars.css("width", a));
        }, calculate: function (t) {
            var e = this, a = r(e.$element.val()) ? 0 : e.$element.val(),
                n = arguments.length ? e.getValueFromPosition(t) : a, i = e.fetchCaption(n), l = e.getWidthFromValue(n);
            return e.rtl && (l = 100 - l), l += "%", {caption: i, width: l, val: n};
        }, setStars: function (t) {
            var e = this, a = arguments.length ? e.calculate(t) : e.calculate();
            e.$element.val(a.val), e.$stars.css("width", a.width), e.$caption.html(a.caption), e.cache = a;
        }, clear: function () {
            var t = this, e = '<span class="' + t.clearCaptionClass + '">' + t.clearCaption + "</span>";
            t.$stars.removeClass("rated"), t.inactive || t.$caption.html(e), t.$element.val(t.clearValue), t.setStars(), t.$element.trigger("rating.clear");
        }, reset: function () {
            var t = this;
            t.$element.val(t.initialValue), t.setStars(), t.$element.trigger("rating.reset");
        }, update: function (t) {
            var e = this;
            arguments.length && (e.$element.val(t), e.setStars());
        }, refresh: function (e) {
            var a = this;
            arguments.length && (a.$rating.off("rating"), void 0 !== a.$clear && a.$clear.off(), a.init(t.extend(a.options, e)), a.showClear ? a.$clear.show() : a.$clear.hide(), a.showCaption ? a.$caption.show() : a.$caption.hide(), a.$element.trigger("rating.refresh"));
        }
    }, t.fn.rating = function (e) {
        var a = Array.apply(null, arguments);
        return a.shift(), this.each(function () {
            var n = t(this), r = n.data("rating"), i = "object" == typeof e && e;
            r || n.data("rating", r = new c(this, t.extend({}, t.fn.rating.defaults, i, t(this).data()))), "string" == typeof e && r[e].apply(r, a);
        });
    }, t.fn.rating.defaults = {
        stars: 5,
        glyphicon: !0,
        symbol: null,
        ratingClass: "",
        disabled: !1,
        readonly: !1,
        rtl: !1,
        size: "md",
        showClear: !0,
        showCaption: !0,
        defaultCaption: "{rating} Stars",
        starCaptions: {
            .5: "Half Star",
            1: "One Star",
            1.5: "One & Half Star",
            2: "Two Stars",
            2.5: "Two & Half Stars",
            3: "Three Stars",
            3.5: "Three & Half Stars",
            4: "Four Stars",
            4.5: "Four & Half Stars",
            5: "Five Stars"
        },
        starCaptionClasses: {
            .5: "label label-danger",
            1: "label label-danger",
            1.5: "label label-warning",
            2: "label label-warning",
            2.5: "label label-info",
            3: "label label-info",
            3.5: "label label-primary",
            4: "label label-primary",
            4.5: "label label-success",
            5: "label label-success"
        },
        clearButton: '<i class="glyphicon glyphicon-minus-sign"></i>',
        clearButtonTitle: "Clear",
        clearButtonBaseClass: "clear-rating",
        clearButtonActiveClass: "clear-rating-active",
        clearCaption: "Not Rated",
        clearCaptionClass: "label label-default",
        clearValue: null,
        captionElement: null,
        clearElement: null,
        containerClass: null,
        hoverEnabled: !0,
        hoverChangeCaption: !0,
        hoverChangeStars: !0,
        hoverOnClear: !0
    }, t.fn.rating.Constructor = c, t("input.rating").addClass("rating-loading"), t(document).ready(function () {
        var e = t("input.rating"), a = Object.keys(e).length;
        a > 0 && e.rating();
    });
}(window.jQuery);
/* custom js here */
$(function() { $('.carousel').carousel(); });

/**
 * Created by ado on 2016/4/5.
 */
/******** start upload by ado *********/
function getExt(file){
    return (-1!==file.indexOf('.'))?file.replace(/.*[.]/, ''):'';
}
function valid(el){
    var ext = getExt(el.value);
    var lc = ext.toLowerCase();
    var maxsize = 2*1048576;
    if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
        el.value = '';
        alert(window.parent.litb.jpg_only);
    }else if(el.files && el.files[0] ){
        if (el.files[0].size > maxsize) {
            el.value = '';
            window.parent.alert("3 images max, 2MB max per image.");
        }else{
            autoFillLiarLabel(el);
        }
    }else{
        var img = document.createElement("img");
        el.select();
        window.parent.document.body.focus();
        var imgSrc = document.selection.createRange().text;
        img.onload = function ()
        {
            var filesize = img.fileSize;
            if(filesize < maxsize && filesize > 0){
                autoFillLiarLabel(el);
            }else{
                img = null;
                el.value = '';
                window.parent.alert("3 images max, 2MB max per image.");
            }
        };
        img.src = imgSrc;
    }
}
function valfrm(frm){
    for(var o in frm.elements){
        var el = frm.elements[o];
        if(el.type=='file'&&el.value!=''){
            var ext = getExt(el.value);
            var lc = ext.toLowerCase();
            if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
                el.value = '';
            }
        }
    }
}

var _fileFields = jQuery('.review_image_files');
var _fileFieldsNumber = _fileFields.size();
var _alertMsg=_fileFieldsNumber+' images max, 2MB max per image.';
if(_fileFieldsNumber>0){
    jQuery(_fileFields).change(function(){
        validField(this);
        fileFieldsChange();
    });
}


function validField(el){
    var ext = getExt(el.value);
    var lc = ext.toLowerCase();
    var maxsize = 2*1048576;
    if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
        el.value = '';
        alert('file is not a jpg/png file format');
    }else if(el.files && el.files[0] ){
        if (el.files[0].size > maxsize) {
            el.value = '';
            alert(_alertMsg);
        }else{
            fileFieldsChange(el);
        }
    }else{
        var img = document.createElement("img");
        el.select();
        window.document.body.focus();
        var imgSrc = document.selection.createRange().text;
        img.onload = function ()
        {
            var filesize = img.fileSize;
            if(filesize < maxsize && filesize > 0){
                fileFieldsChange(el);
            }else{
                img = null;
                el.value = '';
                alert(_alertMsg);
            }
        };
        img.src = imgSrc;
    }
}

function _bisIe(){
    var userAgent = navigator.userAgent.toLowerCase();
    /*IE11*/
    var isIE = ((/msie/.test(userAgent) && !/opera/.test(userAgent)) || (/Trident\/7\./).test(navigator.userAgent) ) ? true : false;
    return isIE;
}

var count = 0;

/**
 * 文件域叠放
 * 显示 隐藏某个文件域
 * @param index
 * @param idpx
 */
function fileFieldsChange(el){
    var _file_label = 'file';
    var _imgIdEndWith='LiarLabel';
    var _maskIdLabelClassName = '.liar-label';
    var _fileFields = jQuery('.review_image_files');
    var _fileFieldsNumber = _fileFields.size();
    if(_fileFields && _fileFieldsNumber>0){
        var _shown=false;
        var _showIndex = 1;
        jQuery(_fileFields).each(function(index,element){
            var _index=index+1;
            var _cur_file_label = _file_label+_index;
            if(jQuery(this).val()){
                _showIndex = _index+1;
                if(_index>=_fileFieldsNumber)_showIndex=1;
                var _cur_file_img_label = _file_label+_index+_imgIdEndWith;
                if(jQuery("#"+_cur_file_img_label).size() == 0){
                    //  console.log(_cur_file_img_label);
                    jQuery(_maskIdLabelClassName).append(jQuery('<span><img class="img" id="'+_cur_file_img_label+'"/><a></a></span>'));
                    preview_pic(_cur_file_img_label,_cur_file_label);
                }
                jQuery("#"+_cur_file_label).css("display","none");
            }

            if(!_shown && _index==_showIndex){
                jQuery("#"+_cur_file_label).css("display","inline-block");
                _shown = true;
            }
        });

        jQuery(_maskIdLabelClassName).delegate("a","click", function() {
            if(_bisIe()){
                for(i=1;i<=_fileFieldsNumber;i++){
                    jQuery(this).closest("span").remove();
                    var _cur_fileField = jQuery('#'+_file_label+i);
                    var _cur_file_img_label = _file_label+i+_imgIdEndWith;
                    if(jQuery(this).prev("img").attr("id") == _cur_file_img_label){
                        _cur_fileField.after(_cur_fileField.clone().val(""));
                        _cur_fileField.remove();
                        _cur_fileField.css("display","inline-block");
                    }else{
                        _cur_fileField.css("display","none");
                    }
                }
            }else{
                for(i=1;i<=_fileFieldsNumber;i++){
                    jQuery(this).closest("span").remove();
                    var _cur_fileField = jQuery('#'+_file_label+i);
                    var _cur_file_img_label = _file_label+i+_imgIdEndWith;
                    if(jQuery("#"+_cur_file_img_label).size() == 0){
                        jQuery(_cur_fileField).val('');
                        _cur_fileField.css("display","inline-block");
                    }else{
                        _cur_fileField.css("display","none");
                    }
                }
            }
        }).delegate("img","click", function() {
            return false;
        });
    }
}

function checkChinese(str) {
    var len = 0;
    var reg = /^[\u4E00-\u9FA5]+jQuery/;
    for(var i = 0;i< str.length;i++) {
        len++;
        if(reg.test(str[i])) {
            len++;
        }
    }
    return len;
}

function cutChinese(str) {
    for(var i = 0;i<str.length;i++) {
        if(reg.test(str[i])) {
            len++;
        }
    }
}

function getFileNameFromPath(str) {
    var n = str.lastIndexOf("\\");
    var filename = str.substring(n + 1);
    var str1 = filename.subCHString(0, 10);
    var str2 = filename.subCHStr((filename.strLen()-10), 10);
    if (checkChinese(filename) > 23) {
        filename = str1 + '...' + str2;
    }
    return filename;
}

String.prototype.strLen = function() {
    var len = 0;
    for (var i = 0; i < this.length; i++) {
        if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0) len += 2; else len++;
    }
    return len;
};
//将字符串拆成字符，并存到数组中
String.prototype.strToChars = function(){
    var chars = new Array();
    for (var i = 0; i < this.length; i++){
        chars[i] = [this.substr(i, 1), this.isCHS(i)];
    }
    String.prototype.charsArray = chars;
    return chars;
};
//判断某个字符是否是汉字
String.prototype.isCHS = function(i){
    if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0)
        return true;
    else
        return false;
};
//截取字符串（从start字节到end字节）
String.prototype.subCHString = function(start, end){
    var len = 0;
    var str = "";
    this.strToChars();
    for (var i = 0; i < this.length; i++) {
        if(this.charsArray[i][1])
            len += 2;
        else
            len++;
        if (end < len)
            return str;
        else if (start < len) {
            str += this.charsArray[i][0];
        }

    }
    return str;
};
//截取字符串（从start字节截取length个字节）
String.prototype.subCHStr = function(start, length){
    return this.subCHString(start, start + length);
};

function html5Reader(file,pic_id){
    var file = file.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e){
        var pic = document.getElementById(pic_id);
        pic.src=this.result;
    };
}


function preview_pic(pic_id,file_id) {
    var pic = document.getElementById(pic_id);
    var file = document.getElementById(file_id);

    // IE浏览器
    if (document.all) {
        file.select();
        window.parent.document.body.focus();
        var reallocalpath = document.selection.createRange().text;
        var ie6 = /msie 6/i.test(navigator.userAgent);
        // IE6浏览器设置img的src为本地路径可以直接显示图片
        if (ie6) pic.src = reallocalpath;
        else {
            // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
            pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src=\"" + reallocalpath + "\")";
            // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
            pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
        }
    }else{
        html5Reader(file,pic_id);
    }
}
/******** end upload by ado *********/
//# sourceMappingURL=app.js.map
