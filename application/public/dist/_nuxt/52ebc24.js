(window.webpackJsonp=window.webpackJsonp||[]).push([[16,41],{365:function(t,e,o){"use strict";o.d(e,"a",(function(){return d}));var n=o(145);var l=o(185),r=o(112);function d(t){return function(t){if(Array.isArray(t))return Object(n.a)(t)}(t)||Object(l.a)(t)||Object(r.a)(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}},380:function(t,e,o){"use strict";var n=o(365),l={components:{DropIconSvg:o(390).a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{drag:!1}},computed:{},watch:{},methods:{dragStart:function(){this.disabled||(this.drag=!0)},dragLeave:function(){this.disabled||(this.drag=!1)},dragOver:function(){this.disabled||(this.drag=!0)},drop:function(t){this.disabled||(this.$emit("upload",Object(n.a)(t.dataTransfer.files)[0]),this.drag=!1)}},created:function(){},mounted:function(){}},r=(o(426),o(10)),component=Object(r.a)(l,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-upload-file-drop",class:{"app-upload-file-drop_disabled":t.disabled},on:{dragstart:function(e){return e.preventDefault(),t.dragStart.apply(null,arguments)},dragleave:function(e){return e.preventDefault(),t.dragLeave.apply(null,arguments)},dragover:function(e){return e.preventDefault(),t.dragOver.apply(null,arguments)},drop:function(e){return e.preventDefault(),t.drop.apply(null,arguments)}}},[o("DropIconSvg",{staticClass:"app-upload-file-drop__icon"}),o("div",{directives:[{name:"show",rawName:"v-show",value:!t.drag,expression:"!drag"}],staticClass:"app-upload-file-drop__title"},[t._v("Перетащите сюда файл")]),o("div",{directives:[{name:"show",rawName:"v-show",value:t.drag,expression:"drag"}],staticClass:"app-upload-file-drop__title"},[t._v("Отпустите файл")])],1)}),[],!1,null,null,null);e.a=component.exports},381:function(t,e,o){"use strict";var n=o(368),l=o(400),r={components:{AppButton:n.a,CameraIconSvg:l.a},props:{disabled:{type:Boolean,default:!1},title:{type:String,default:"снять фото с камеры"}},data:function(){return{}},computed:{},watch:{},methods:{selectFile:function(t){console.debug("selectFile"),this.$refs.input.click()},selectedFile:function(t){this.$emit("upload",t.target.files[0]),this.inputReset()},inputReset:function(){this.$refs.input.value=null}},created:function(){},mounted:function(){}},d=(o(428),o(10)),component=Object(d.a)(r,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-upload-file"},[o("AppButton",{staticClass:"app-upload-file__container",class:{"app-upload-file_disabled":t.disabled},attrs:{disabled:t.disabled},on:{click:t.selectFile}},[o("CameraIconSvg",{staticClass:"app-upload-file--icon"}),o("div",{staticClass:"app-upload-file--title"},[t._v(t._s(t.title))])],1),o("input",{ref:"input",staticClass:"app-upload-file__input",attrs:{type:"file",accept:"image/*",capture:"environment"},on:{change:t.selectedFile}})],1)}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppButton:o(377).default})},383:function(t,e,o){"use strict";o.r(e);var n=o(368),l=o(393);e.default={components:{AppButton:n.a,FileIconSvg:l.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{}},computed:{},watch:{},methods:{selectFile:function(t){this.$refs.input.click()},selectedFile:function(t){this.$emit("upload",t.target.files[0]),this.inputReset()},inputReset:function(){this.$refs.input.value=null}},created:function(){},mounted:function(){}}},387:function(t,e,o){"use strict";var n=o(10),component=Object(n.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M14 10v7M10 10v7M18 6H6v14a1 1 0 001 1h10a1 1 0 001-1V6zM4 6h16M15 3H9a1 1 0 00-1 1v2h8V4a1 1 0 00-1-1z",stroke:"#EB4D3D","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},388:function(t,e,o){var content=o(427);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("1717f47c",content,!0,{sourceMap:!1})},389:function(t,e,o){var content=o(429);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("709d5a60",content,!0,{sourceMap:!1})},390:function(t,e,o){"use strict";var n=o(10),component=Object(n.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"42",height:"38",viewBox:"0 0 42 38",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M7.648 13.474A7.67 7.67 0 009.5 28.584h1.916M21 19v17.25V19zm0 0l-4.792 3.833L21 19zm0 0l4.791 3.833L21 19z",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M28.34 9.681a10.541 10.541 0 00-20.692 3.795s.294 1.69.893 2.649",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M30.583 28.583a9.586 9.586 0 009.51-10.712 9.583 9.583 0 00-11.752-8.19l-2.55.694",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},400:function(t,e,o){"use strict";var n=o(10),component=Object(n.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M12 16a3 3 0 100-6 3 3 0 000 6z",stroke:"#fff","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1zM14.28 4H9.72a1 1 0 00-.948.684l-.333 1A1 1 0 009.387 7h5.226a1 1 0 00.948-1.316l-.333-1A1 1 0 0014.279 4z",stroke:"#fff","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},416:function(t,e,o){"use strict";o.r(e);var n=o(365),l=o(390);e.default={components:{DropIconSvg:l.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{drag:!1}},computed:{},watch:{},methods:{dragStart:function(){this.disabled||(this.drag=!0)},dragLeave:function(){this.disabled||(this.drag=!1)},dragOver:function(){this.disabled||(this.drag=!0)},drop:function(t){this.disabled||(this.$emit("upload",Object(n.a)(t.dataTransfer.files)[0]),this.drag=!1)}},created:function(){},mounted:function(){}}},421:function(t,e,o){"use strict";var n=o(7),l=o(258);n({target:"String",proto:!0,forced:o(259)("fixed")},{fixed:function(){return l(this,"tt","","")}})},426:function(t,e,o){"use strict";o(388)},427:function(t,e,o){var n=o(44)(!1);n.push([t.i,".app-upload-file-drop{box-sizing:border-box;max-width:306px;width:100%;height:146px;background:#f8f8f8;border:1px dashed #bcbcbc;border-radius:10px;display:flex;flex-direction:column;flex-wrap:nowrap;justify-content:center;align-items:center}.app-upload-file-drop__title{font-weight:600;font-size:16px;line-height:125%;color:#263043;margin-top:16px;-webkit-user-select:none;-moz-user-select:none;user-select:none}.app-upload-file-drop__icon,.app-upload-file-drop__title{pointer-events:none}.app-upload-file-drop_disabled{background:#d9d9d9}.app-upload-file-drop_disabled .app-upload-file-drop__title{color:#949594}.app-upload-file-drop_disabled .app-upload-file-drop__icon{opacity:.5}",""]),t.exports=n},428:function(t,e,o){"use strict";o(389)},429:function(t,e,o){var n=o(44)(!1);n.push([t.i,".app-upload-file,.app-upload-file__container{width:100%}.app-upload-file__input{display:none}.app-upload-file_disabled .app-upload-file--icon path:first-child,.app-upload-file_disabled .app-upload-file--icon path:nth-child(2){stroke:#afacac}",""]),t.exports=n},525:function(t,e,o){var content=o(561);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("7ada0f4a",content,!0,{sourceMap:!1})},526:function(t,e,o){var content=o(563);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("50a2c407",content,!0,{sourceMap:!1})},527:function(t,e,o){"use strict";var n=o(380),l=o(367),r={components:{AppUploadFileDrop:n.a,AppUploadFile:l.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{title:"или загрузите",media:null,file:null}},computed:{},watch:{},methods:{upload:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.$emit("upload",t)}},created:function(){},mounted:function(){}},d=r,c=(o(560),o(10)),component=Object(c.a)(d,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-form-media-desktop"},[o("AppUploadFileDrop",{staticClass:"app-form-media-desktop__drop",attrs:{disabled:t.disabled},on:{upload:t.upload}}),o("div",{staticClass:"app-form-media-desktop__title"},[t._v(t._s(t.title))]),o("AppUploadFile",{staticClass:"app-form-media-desktop__file",attrs:{disabled:t.disabled},on:{upload:t.upload}})],1)}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppUploadFileDrop:o(416).default,AppUploadFile:o(383).default})},528:function(t,e,o){"use strict";var n=o(367),l=o(381),r={components:{AppUploadFile:n.a,AppUploadFileCamera:l.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{}},computed:{},watch:{},methods:{upload:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.$emit("upload",t)}},created:function(){},mounted:function(){}},d=r,c=(o(562),o(10)),component=Object(c.a)(d,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-form-media-mobile"},[o("div",{staticClass:"app-form-media-mobile__title"},[t._v("Загрузите документ")]),o("div",{staticClass:"app-form-media-mobile__files"},[o("AppUploadFileCamera",{staticClass:"app-form-media-mobile__file",attrs:{disabled:t.disabled},on:{upload:t.upload}}),o("AppUploadFile",{staticClass:"app-form-media-mobile__file",attrs:{disabled:t.disabled},on:{upload:t.upload}})],1)])}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppUploadFileCamera:o(552).default,AppUploadFile:o(383).default})},530:function(t,e,o){"use strict";var n=o(7),l=o(258);n({target:"String",proto:!0,forced:o(259)("small")},{small:function(){return l(this,"small","","")}})},552:function(t,e,o){"use strict";o.r(e);var n=o(368),l=o(400);e.default={components:{AppButton:n.a,CameraIconSvg:l.a},props:{disabled:{type:Boolean,default:!1},title:{type:String,default:"снять фото с камеры"}},data:function(){return{}},computed:{},watch:{},methods:{selectFile:function(t){console.debug("selectFile"),this.$refs.input.click()},selectedFile:function(t){this.$emit("upload",t.target.files[0]),this.inputReset()},inputReset:function(){this.$refs.input.value=null}},created:function(){},mounted:function(){}}},560:function(t,e,o){"use strict";o(525)},561:function(t,e,o){var n=o(44)(!1);n.push([t.i,".app-form-media-desktop{display:flex;flex-direction:column;flex-wrap:nowrap;align-items:center}.app-form-media-desktop__title{font-weight:600;font-size:16px;line-height:20px;color:#9398a1;margin:16px 0;-webkit-user-select:none;-moz-user-select:none;user-select:none}.app-form-media-desktop__file{max-width:306px}",""]),t.exports=n},562:function(t,e,o){"use strict";o(526)},563:function(t,e,o){var n=o(44)(!1);n.push([t.i,".app-form-media-mobile{display:flex;flex-direction:column;flex-wrap:nowrap;align-items:center}.app-form-media-mobile__title{font-weight:700;font-size:18px;line-height:125%;color:#263043}.app-form-media-mobile__files{margin-top:32px}.app-form-media-mobile__file{margin-top:14px}.app-form-media-mobile__file:first-child{margin-top:0}",""]),t.exports=n},568:function(t,e,o){"use strict";var n=o(7),l=o(258);n({target:"String",proto:!0,forced:o(259)("link")},{link:function(t){return l(this,"a","href",t)}})},596:function(t,e,o){"use strict";o.r(e);var n=o(527),l=o(528),r=o(387);e.default={components:{AppFormMediaDesktop:n.a,AppFormMediaMobile:l.a,TrashIconSvg:r.a},props:{mediaName:{type:String,default:null},mediaUrl:{type:String,default:null}},data:function(){return{mediaNameDefault:"Образец"}},computed:{disabled:function(){return!!this.mediaUrl}},watch:{},methods:{upload:function(t){this.$emit("upload",t)},deleteFile:function(){this.$emit("delete")},open:function(){window.open(this.mediaUrl,"_blank").focus()}},created:function(){},mounted:function(){}}}}]);