var Froogaloop=function(){function t(n){return new t.fn.init(n)}var n={},e=!1,r=(Array.prototype.slice,"");function i(t,n,e){if(!e.contentWindow.postMessage)return!1;var r=e.getAttribute("src").split("?")[0],i=JSON.stringify({method:t,value:n});"//"===r.substr(0,2)&&(r=window.location.protocol+r),e.contentWindow.postMessage(i,r)}function o(t){var i,o;try{o=(i=JSON.parse(t.data)).event||i.method}catch(t){}if("ready"!=o||e||(e=!0),t.origin!=r)return!1;if(!i)return!1;var l=i.value,u=i.data,a=""===a?null:i.player_id,s=function(t,e){return e?n[e][t]:n[t]}(o,a),d=[];return!!s&&(void 0!==l&&d.push(l),u&&d.push(u),a&&d.push(a),d.length>0?s.apply(null,d):s.call())}function l(t,e,r){r?(n[r]||(n[r]={}),n[r][t]=e):n[t]=e}function u(t){return!!(t&&t.constructor&&t.call&&t.apply)}return t.fn=t.prototype={element:null,init:function(t){return"string"==typeof t&&(t=document.getElementById(t)),this.element=t,r=function(t){"//"===t.substr(0,2)&&(t=window.location.protocol+t);for(var n=t.split("/"),e="",r=0,i=n.length;r<i&&r<3;r++)e+=n[r],r<2&&(e+="/");return e}(this.element.getAttribute("src")),this},api:function(t,n){if(!this.element||!t)return!1;var e=this.element,r=""!==e.id?e.id:null,o=u(n)?null:n,a=u(n)?n:null;return a&&l(t,a,r),i(t,o,e),this},addEvent:function(t,n){if(!this.element)return!1;var r=this.element,o=""!==r.id?r.id:null;return l(t,n,o),"ready"!=t?i("addEventListener",t,r):"ready"==t&&e&&n.call(null,o),this},removeEvent:function(t){if(!this.element)return!1;var e=this.element,r=function(t,e){if(e&&n[e]){if(!n[e][t])return!1;n[e][t]=null}else{if(!n[t])return!1;n[t]=null}return!0}(t,""!==e.id?e.id:null);"ready"!=t&&r&&i("removeEventListener",t,e)}},t.fn.init.prototype=t.fn,window.addEventListener?window.addEventListener("message",o,!1):window.attachEvent("onmessage",o),window.Froogaloop=window.$f=t}();