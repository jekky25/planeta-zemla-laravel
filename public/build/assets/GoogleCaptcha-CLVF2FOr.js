import{_ as a}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{f as o,o as p}from"./app-DBkbaeVX.js";const n={props:["sitekey"],methods:{initReCaptcha(){var e=this.$page.props.config.google_recaptcha_key;setTimeout(function(){typeof grecaptcha>"u"?this.initReCaptcha():grecaptcha.ready(function(){grecaptcha.execute(e,{action:"contact"}).then(function(t){var c=document.getElementById("recaptchaResponse");c.value=t})})},100)}},mounted(){document.contains(document.getElementById("recaptcha"))&&document.getElementById("recaptcha").remove();let e=document.createElement("script");e.setAttribute("id","recaptcha"),e.setAttribute("src","https://www.google.com/recaptcha/api.js?render="+this.$page.props.config.google_recaptcha_key),document.head.appendChild(e);var t=this;t.initReCaptcha()}},r=["value"];function s(e,t,c,i,h,d){return p(),o("input",{type:"hidden",name:"recaptcha_response",value:e.$page.props.config.google_recaptcha_key,id:"recaptchaResponse"},null,8,r)}const m=a(n,[["render",s]]);export{m as G};
