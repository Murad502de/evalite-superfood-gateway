(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{370:function(t,e,n){"use strict";n.d(e,"a",(function(){return c}));var o=n(147);var r=n(187),d=n(112);function c(t){return function(t){if(Array.isArray(t))return Object(o.a)(t)}(t)||Object(r.a)(t)||Object(d.a)(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}},411:function(t,e,n){"use strict";n.r(e);var o=n(401),r=n(402),d=n(404),c=n(405),l=n(381);e.default={components:{AppFormMediaDocDesktop:o.a,AppFormMediaDocMobile:r.a,DocLogoSvg:d.a,PdfLogoSvg:c.a,TrashIconSvg:l.a},props:{mediaName:{type:String,default:null},mediaUrl:{type:String,default:null},type:{type:String,default:null},disabledForm:{type:Boolean,default:!1},readonly:{type:Boolean,default:!1}},data:function(){return{mediaNameDefault:"Образец"}},computed:{disabled:function(){return!!this.mediaUrl||this.disabledForm}},watch:{},methods:{getDocType:function(){return"pdf"===this.type?"pdf":"default"},upload:function(t){this.$emit("upload",t)},deleteFile:function(){this.$emit("delete")},openFile:function(){window.open(this.mediaUrl,"_blank").focus()}},created:function(){},mounted:function(){}}},416:function(t,e,n){"use strict";var o=n(7),r=n(260);o({target:"String",proto:!0,forced:n(261)("fixed")},{fixed:function(){return r(this,"tt","","")}})},477:function(t,e,n){"use strict";var o=n(7),r=n(260);o({target:"String",proto:!0,forced:n(261)("small")},{small:function(){return r(this,"small","","")}})},563:function(t,e,n){"use strict";var o=n(7),r=n(260);o({target:"String",proto:!0,forced:n(261)("link")},{link:function(t){return r(this,"a","href",t)}})}}]);