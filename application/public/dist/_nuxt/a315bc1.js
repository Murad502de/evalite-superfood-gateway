(window.webpackJsonp=window.webpackJsonp||[]).push([[47],{820:function(t,e,n){"use strict";n.r(e);n(84);e.default={components:{},props:{email:{type:String,require:!0},confirmCodeLoading:{type:Boolean,default:!1},sendCodeLoading:{type:Boolean,default:!1}},data:function(){return{valid:!0,code:"",codeLength:4,timerCount:30,timer:null}},computed:{isConfirmCodeActive:function(){return this.code.length===this.codeLength},isSendCodeActive:function(){return!this.timerCount},sendCodeTitle:function(){return this.timerCount?"Отправить повторно через ".concat(this.timerCount," сек"):"Отправить повторно"}},watch:{timerCount:function(t){t||clearInterval(this.timer)},sendCodeLoading:function(t){t||this.startTimer()}},methods:{startTimer:function(){var t=this;this.timerCount=30,this.timer=setInterval((function(){t.timerCount--}),1e3)},sendCodeToConfirm:function(){this.$emit("sendCodeToConfirm",this.code)},sendCodeToEmail:function(){this.$emit("sendCodeToEmail",this.email)}},created:function(){console.debug("pages/forgot/ConfirmCard/created"),this.startTimer()},mounted:function(){console.debug("pages/forgot/ConfirmCard/mounted")}}}}]);