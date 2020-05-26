/* Placeholders.js v4.0.1 */
/*!
 * The MIT License
 *
 * Copyright (c) 2012 James Allardice
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

!function(t){"use strict";function e(){}function r(){try{return document.activeElement}catch(t){}}function a(t,e){for(var r=0,a=t.length;a>r;r++)if(t[r]===e)return!0;return!1}function n(t,e,r){return t.addEventListener?t.addEventListener(e,r,!1):t.attachEvent?t.attachEvent("on"+e,r):void 0}function u(t,e){var r;t.createTextRange?(r=t.createTextRange(),r.move("character",e),r.select()):t.selectionStart&&(t.focus(),t.setSelectionRange(e,e))}function i(t,e){try{return t.type=e,!0}catch(r){return!1}}function l(t,e){if(t&&t.getAttribute(S))e(t);else for(var r,a=t?t.getElementsByTagName("input"):z,n=t?t.getElementsByTagName("textarea"):F,u=a?a.length:0,i=n?n.length:0,l=u+i,o=0;l>o;o++)r=u>o?a[o]:n[o-u],e(r)}function o(t){l(t,s)}function c(t){l(t,d)}function s(t,e){var r=!!e&&t.value!==e,a=t.value===t.getAttribute(S);if((r||a)&&"true"===t.getAttribute(L)){t.removeAttribute(L),t.value=t.value.replace(t.getAttribute(S),""),t.className=t.className.replace(B,"");var n=t.getAttribute(P);parseInt(n,10)>=0&&(t.setAttribute("maxLength",n),t.removeAttribute(P));var u=t.getAttribute(k);return u&&(t.type=u),!0}return!1}function d(t){var e=t.getAttribute(S);if(""===t.value&&e){t.setAttribute(L,"true"),t.value=e,t.className+=" "+w;var r=t.getAttribute(P);r||(t.setAttribute(P,t.maxLength),t.removeAttribute("maxLength"));var a=t.getAttribute(k);return a?t.type="text":"password"===t.type&&i(t,"text")&&t.setAttribute(k,"password"),!0}return!1}function v(t){return function(){G&&t.value===t.getAttribute(S)&&"true"===t.getAttribute(L)?u(t,0):s(t)}}function g(t){return function(){d(t)}}function p(t){return function(){o(t)}}function f(t){return function(e){return x=t.value,"true"===t.getAttribute(L)&&x===t.getAttribute(S)&&a(N,e.keyCode)?(e.preventDefault&&e.preventDefault(),!1):void 0}}function h(t){return function(){s(t,x),""===t.value&&(t.blur(),u(t,0))}}function b(t){return function(){t===r()&&t.value===t.getAttribute(S)&&"true"===t.getAttribute(L)&&u(t,0)}}function m(t){var e=t.form;e&&"string"==typeof e&&(e=document.getElementById(e),e.getAttribute(I)||(n(e,"submit",p(e)),e.setAttribute(I,"true"))),n(t,"focus",v(t)),n(t,"blur",g(t)),G&&(n(t,"keydown",f(t)),n(t,"keyup",h(t)),n(t,"click",b(t))),t.setAttribute(R,"true"),t.setAttribute(S,M),(G||t!==r())&&d(t)}var A=document.createElement("input"),y=void 0!==A.placeholder;if(t.Placeholders={nativeSupport:y,disable:y?e:o,enable:y?e:c},!y){var x,E=["text","search","url","tel","email","password","number","textarea"],N=[27,33,34,35,36,37,38,39,40,8,46],T="#ccc",w="placeholdersjs",B=new RegExp("(?:^|\\s)"+w+"(?!\\S)"),S="data-placeholder-value",L="data-placeholder-active",k="data-placeholder-type",I="data-placeholder-submit",R="data-placeholder-bound",q="data-placeholder-focus",C="data-placeholder-live",P="data-placeholder-maxlength",V=100,j=document.getElementsByTagName("head")[0],D=document.documentElement,Q=t.Placeholders,z=document.getElementsByTagName("input"),F=document.getElementsByTagName("textarea"),G="false"===D.getAttribute(q),H="false"!==D.getAttribute(C),J=document.createElement("style");J.type="text/css";var K=document.createTextNode("."+w+" {color:"+T+";}");J.styleSheet?J.styleSheet.cssText=K.nodeValue:J.appendChild(K),j.insertBefore(J,j.firstChild);for(var M,O,U=0,W=z.length+F.length;W>U;U++)O=U<z.length?z[U]:F[U-z.length],M=O.attributes.placeholder,M&&(M=M.nodeValue,M&&a(E,O.type)&&m(O));var X=setInterval(function(){for(var t=0,e=z.length+F.length;e>t;t++)O=t<z.length?z[t]:F[t-z.length],M=O.attributes.placeholder,M?(M=M.nodeValue,M&&a(E,O.type)&&(O.getAttribute(R)||m(O),(M!==O.getAttribute(S)||"password"===O.type&&!O.getAttribute(k))&&("password"===O.type&&!O.getAttribute(k)&&i(O,"text")&&O.setAttribute(k,"password"),O.value===O.getAttribute(S)&&(O.value=M),O.setAttribute(S,M)))):O.getAttribute(L)&&(s(O),O.removeAttribute(S));H||clearInterval(X)},V);n(t,"beforeunload",function(){Q.disable()})}}(this),function(t,e){"use strict";var r=t.fn.val,a=t.fn.prop;e.Placeholders.nativeSupport||(t.fn.val=function(t){var e=r.apply(this,arguments),a=this.eq(0).data("placeholder-value");return void 0===t&&this.eq(0).data("placeholder-active")&&e===a?"":e},t.fn.prop=function(t,e){return void 0===e&&this.eq(0).data("placeholder-active")&&"value"===t?"":a.apply(this,arguments)})}(jQuery,this);

jQuery(function() {
	jQuery('input, textarea').placeholder();
});