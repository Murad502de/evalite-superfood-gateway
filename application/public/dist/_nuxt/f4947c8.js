(window.webpackJsonp=window.webpackJsonp||[]).push([[28],{592:function(t,e,n){"use strict";n.r(e);var o=n(19);n(110),n(31),n(84),n(49);e.default={props:{value:{type:String|Array,default:""},range:{type:Boolean,default:!1}},data:function(){return{dates:null,dateFormatted:null,menu:!1}},computed:{dateRangeText:function(){var t;return this.range?null===(t=this.dateFormatted)||void 0===t?void 0:t.join(" - "):this.dateFormatted}},methods:{formatDate:function(t){if(!t)return null;var e=t.split("-"),n=Object(o.a)(e,3),d=n[0],r=n[1],h=n[2];return"".concat(h,".").concat(r,".").concat(d)},cancel:function(){this.menu=!1},ok:function(){this.menu=!1,this.range?this.dates.length>1&&(Date.parse(this.dates[0])>Date.parse(this.dates[1])?this.$emit("ok",[this.dates[1],this.dates[0]]):this.$emit("ok",this.dates)):this.$emit("ok",this.dates)}},watch:{dates:function(t){console.debug("AppPickerDate/watch/dates/newVal",t),this.range&&t?t.length>1&&Date.parse(t[0])>Date.parse(t[1])?this.dateFormatted=[this.formatDate(this.dates[1]),this.formatDate(this.dates[0])]:this.dateFormatted=[this.formatDate(this.dates[0]),this.formatDate(this.dates[1])]:this.dateFormatted=this.formatDate(this.dates)},value:function(t,e){this.dates=t}},created:function(){}}}}]);