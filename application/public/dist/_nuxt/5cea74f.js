(window.webpackJsonp=window.webpackJsonp||[]).push([[32],{682:function(t,n,o){"use strict";o.r(n);o(24);n.default={components:{},props:{loading:{type:Boolean,default:!1}},data:function(){return{valid:!0,password:"",password1:"",showPass:!1,showPass1:!1,passwordRules:[function(t){return!!t||"Данное поле обязательно к заполнению"},function(t){return!/\s/g.test(t)||"Пароль не должен содержать пробелы"},function(t){return!/[а-яА-Я]/g.test(t)||"Пароль не должен содержать кириллицу"},function(t){return t.length>=8||"Длина пароля должна быть не менее 8 символов"},function(t){return/[A-Z]+/g.test(t)||"Пароль должен содержать заглавные буквы"},function(t){return/[a-z]+/g.test(t)||"Пароль должен содержать строчные буквы"},function(t){return/[\W\d_]/g.test(t)||"Пароль должен содержать цифры или спец. символы"}]}},computed:{isBtnDisabled:function(){return!this.password.length||!this.password1.length||!this.valid||this.password!==this.password1}},watch:{},methods:{updatePassword:function(){this.$emit("updatePassword",this.password)}},created:function(){console.debug("pages/forgot/PassCard/created")},mounted:function(){console.debug("pages/forgot/PassCard/mounted")}}}}]);