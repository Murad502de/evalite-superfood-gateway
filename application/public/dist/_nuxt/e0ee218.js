(window.webpackJsonp=window.webpackJsonp||[]).push([[31],{525:function(t,o,n){var content=n(616);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,n(45).default)("92e70f9e",content,!0,{sourceMap:!1})},615:function(t,o,n){"use strict";n(525)},616:function(t,o,n){var e=n(44)(!1);e.push([t.i,'.forgot-pass-card{padding:24px!important;border-radius:16px!important;margin-top:32px!important}.forgot-pass-card__title{display:flex;justify-content:center;font-weight:700!important;font-size:24px!important;line-height:24px!important;color:#263043!important}.forgot-pass-card__form{margin-top:16px!important}.forgot-pass-card__info{font-weight:400!important;font-size:16px!important;line-height:20px!important;color:#7a91a9!important}.forgot-pass-card__btn{width:100%;margin-top:18px!important;font-family:"Source Sans Pro";font-style:normal!important;font-weight:700!important;font-size:14px!important;line-height:24px!important;color:#fff!important;letter-spacing:.04em!important;text-transform:uppercase!important}',""]),t.exports=e},636:function(t,o,n){"use strict";n.r(o);n(24);var e={components:{},props:{loading:{type:Boolean,default:!1}},data:function(){return{valid:!0,password:"",password1:"",showPass:!1,showPass1:!1,passwordRules:[function(t){return!!t||"Данное поле обязательно к заполнению"},function(t){return!/\s/g.test(t)||"Пароль не должен содержать пробелы"},function(t){return!/[а-яА-Я]/g.test(t)||"Пароль не должен содержать кириллицу"},function(t){return t.length>=8||"Длина пароля должна быть не менее 8 символов"},function(t){return/[A-Z]+/g.test(t)||"Пароль должен содержать заглавные буквы"},function(t){return/[a-z]+/g.test(t)||"Пароль должен содержать строчные буквы"},function(t){return/[\W\d_]/g.test(t)||"Пароль должен содержать цифры или спец. символы"}]}},computed:{isBtnDisabled:function(){return!this.password.length||!this.password1.length||!this.valid||this.password!==this.password1}},watch:{},methods:{updatePassword:function(){this.$emit("updatePassword",this.password)}},created:function(){console.debug("pages/forgot/PassCard/created")},mounted:function(){console.debug("pages/forgot/PassCard/mounted")}},r=(n(615),n(59)),d=n(106),l=n.n(d),c=n(406),f=n(643),m=n(411),w=n(478),h=n(500),component=Object(r.a)(e,(function(){var t=this,o=t.$createElement,n=t._self._c||o;return n("v-card",{staticClass:"forgot-pass-card",attrs:{elevation:"3",outlined:"",width:"360"}},[n("v-card-subtitle",{staticClass:"forgot-pass-card__title"},[t._v("Введите новый пароль")]),n("v-form",{ref:"form",staticClass:"forgot-pass-card__form",attrs:{"lazy-validation":""},model:{value:t.valid,callback:function(o){t.valid=o},expression:"valid"}},[n("v-text-field",{attrs:{type:t.showPass?"text":"password","append-icon":t.showPass?"mdi-eye":"mdi-eye-off",rules:t.passwordRules,disabled:t.loading,label:"Введите новый пароль",required:"",outlined:""},on:{"click:append":function(o){t.showPass=!t.showPass}},model:{value:t.password,callback:function(o){t.password=o},expression:"password"}}),n("v-text-field",{attrs:{type:t.showPass1?"text":"password","append-icon":t.showPass1?"mdi-eye":"mdi-eye-off",rules:t.passwordRules,disabled:t.loading,label:"Введите новый пароль повторно",required:"",outlined:""},on:{"click:append":function(o){t.showPass1=!t.showPass1}},model:{value:t.password1,callback:function(o){t.password1=o},expression:"password1"}}),n("div",{staticClass:"forgot-pass-card__info"},[n("span",[t._v("Требования к паролю:")]),n("br"),n("span",[t._v("длина — не менее 8 символов;")]),n("br"),n("span",[t._v("заглавные буквы;")]),n("br"),n("span",[t._v("строчные буквы;")]),n("br"),n("span",[t._v("цифры или специальные символы: %, #, $ и другие.")])]),n("v-btn",{staticClass:"forgot-pass-card__btn",attrs:{disabled:t.isBtnDisabled,loading:t.loading,color:"#0082DE"},on:{click:t.updatePassword}},[t._v("обновить пароль")])],1)],1)}),[],!1,null,null,null);o.default=component.exports;l()(component,{VBtn:c.a,VCard:f.a,VCardSubtitle:m.a,VForm:w.a,VTextField:h.a})}}]);