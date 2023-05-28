(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{378:function(t,e,o){"use strict";var l=o(368),n={components:{DropIconSvg:o(393).a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{drag:!1}},computed:{},watch:{},methods:{dragStart:function(){this.disabled||(this.drag=!0)},dragLeave:function(){this.disabled||(this.drag=!1)},dragOver:function(){this.disabled||(this.drag=!0)},drop:function(t){this.disabled||(this.$emit("upload",Object(l.a)(t.dataTransfer.files)[0]),this.drag=!1)}},created:function(){},mounted:function(){}},r=(o(424),o(10)),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-upload-file-drop",class:{"app-upload-file-drop_disabled":t.disabled},on:{dragstart:function(e){return e.preventDefault(),t.dragStart.apply(null,arguments)},dragleave:function(e){return e.preventDefault(),t.dragLeave.apply(null,arguments)},dragover:function(e){return e.preventDefault(),t.dragOver.apply(null,arguments)},drop:function(e){return e.preventDefault(),t.drop.apply(null,arguments)}}},[o("DropIconSvg",{staticClass:"app-upload-file-drop__icon"}),o("div",{directives:[{name:"show",rawName:"v-show",value:!t.drag,expression:"!drag"}],staticClass:"app-upload-file-drop__title"},[t._v("Перетащите сюда файл")]),o("div",{directives:[{name:"show",rawName:"v-show",value:t.drag,expression:"drag"}],staticClass:"app-upload-file-drop__title"},[t._v("Отпустите файл")])],1)}),[],!1,null,null,null);e.a=component.exports},379:function(t,e,o){"use strict";var l=o(371),n=o(399),r={components:{AppButton:l.a,CameraIconSvg:n.a},props:{disabled:{type:Boolean,default:!1},title:{type:String,default:"снять фото с камеры"}},data:function(){return{}},computed:{},watch:{},methods:{selectFile:function(t){console.debug("selectFile"),this.$refs.input.click()},selectedFile:function(t){this.$emit("upload",t.target.files[0]),this.inputReset()},inputReset:function(){this.$refs.input.value=null}},created:function(){},mounted:function(){}},d=(o(426),o(10)),component=Object(d.a)(r,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-upload-file"},[o("AppButton",{staticClass:"app-upload-file__container",class:{"app-upload-file_disabled":t.disabled},attrs:{disabled:t.disabled},on:{click:t.selectFile}},[o("CameraIconSvg",{staticClass:"app-upload-file--icon"}),o("div",{staticClass:"app-upload-file--title"},[t._v(t._s(t.title))])],1),o("input",{ref:"input",staticClass:"app-upload-file__input",attrs:{type:"file",accept:"image/*",capture:"environment"},on:{change:t.selectedFile}})],1)}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppButton:o(381).default})},380:function(t,e,o){"use strict";o.r(e);var l=o(371),n=o(396);e.default={components:{AppButton:l.a,FileIconSvg:n.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{}},computed:{},watch:{},methods:{selectFile:function(t){this.$refs.input.click()},selectedFile:function(t){this.$emit("upload",t.target.files[0]),this.inputReset()},inputReset:function(){this.$refs.input.value=null}},created:function(){},mounted:function(){}}},384:function(t,e,o){"use strict";var l=o(10),component=Object(l.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M14 10v7M10 10v7M18 6H6v14a1 1 0 001 1h10a1 1 0 001-1V6zM4 6h16M15 3H9a1 1 0 00-1 1v2h8V4a1 1 0 00-1-1z",stroke:"#EB4D3D","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},390:function(t,e,o){var content=o(425);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("1717f47c",content,!0,{sourceMap:!1})},391:function(t,e,o){var content=o(427);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("709d5a60",content,!0,{sourceMap:!1})},393:function(t,e,o){"use strict";var l=o(10),component=Object(l.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"42",height:"38",viewBox:"0 0 42 38",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M7.648 13.474A7.67 7.67 0 009.5 28.584h1.916M21 19v17.25V19zm0 0l-4.792 3.833L21 19zm0 0l4.791 3.833L21 19z",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M28.34 9.681a10.541 10.541 0 00-20.692 3.795s.294 1.69.893 2.649",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M30.583 28.583a9.586 9.586 0 009.51-10.712 9.583 9.583 0 00-11.752-8.19l-2.55.694",stroke:"#0082DE","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},399:function(t,e,o){"use strict";var l=o(10),component=Object(l.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},t.$listeners),[o("path",{attrs:{d:"M12 16a3 3 0 100-6 3 3 0 000 6z",stroke:"#fff","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}}),o("path",{attrs:{d:"M20 7H4a1 1 0 00-1 1v10a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1zM14.28 4H9.72a1 1 0 00-.948.684l-.333 1A1 1 0 009.387 7h5.226a1 1 0 00.948-1.316l-.333-1A1 1 0 0014.279 4z",stroke:"#fff","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"}})])}),[],!1,null,null,null);e.a=component.exports},406:function(t,e,o){var content=o(451);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("36ebedb6",content,!0,{sourceMap:!1})},407:function(t,e,o){var content=o(453);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(45).default)("f261bfce",content,!0,{sourceMap:!1})},410:function(t,e,o){"use strict";o.r(e);var l=o(368),n=o(393);e.default={components:{DropIconSvg:n.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{drag:!1}},computed:{},watch:{},methods:{dragStart:function(){this.disabled||(this.drag=!0)},dragLeave:function(){this.disabled||(this.drag=!1)},dragOver:function(){this.disabled||(this.drag=!0)},drop:function(t){this.disabled||(this.$emit("upload",Object(l.a)(t.dataTransfer.files)[0]),this.drag=!1)}},created:function(){},mounted:function(){}}},411:function(t,e,o){"use strict";var l=o(378),n=o(367),r={components:{AppUploadFileDrop:l.a,AppUploadFile:n.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{title:"или загрузите",media:null,file:null}},computed:{},watch:{},methods:{upload:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.$emit("upload",t)}},created:function(){},mounted:function(){}},d=r,c=(o(450),o(10)),component=Object(c.a)(d,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-form-media-doc-desktop"},[o("div",{staticClass:"app-form-media-doc-desktop__container"},[o("AppUploadFileDrop",{staticClass:"app-form-media-doc-desktop__drop",attrs:{disabled:t.disabled},on:{upload:t.upload}}),o("div",{staticClass:"app-form-media-doc-desktop__title"},[t._v(t._s(t.title))]),o("AppUploadFile",{staticClass:"app-form-media-doc-desktop__file",attrs:{disabled:t.disabled},on:{upload:t.upload}})],1)])}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppUploadFileDrop:o(410).default,AppUploadFile:o(380).default})},412:function(t,e,o){"use strict";var l=o(367),n=o(379),r={components:{AppUploadFile:l.a,AppUploadFileCamera:n.a},props:{disabled:{type:Boolean,default:!1}},data:function(){return{}},computed:{},watch:{},methods:{upload:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.$emit("upload",t)}},created:function(){},mounted:function(){}},d=r,c=(o(452),o(10)),component=Object(c.a)(d,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"app-form-media-doc-mobile"},[o("div",{staticClass:"app-form-media-doc-mobile__title"},[t._v("Загрузите документ")]),o("div",{staticClass:"app-form-media-doc-mobile__files"},[o("AppUploadFile",{staticClass:"app-form-media-doc-mobile__file",attrs:{disabled:t.disabled},on:{upload:t.upload}})],1)])}),[],!1,null,null,null);e.a=component.exports;installComponents(component,{AppUploadFile:o(380).default})},413:function(t,e,o){"use strict";var l=o(10),component=Object(l.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{width:"47",height:"65",viewBox:"0 0 47 65",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},t.$listeners),[o("defs",[o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__a"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__c"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__f"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__h"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__j"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__l"}}),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",id:"doc_logo_svg__n"}}),o("radialGradient",{attrs:{cx:"3.168%",cy:"2.717%",fx:"3.168%",fy:"2.717%",r:"161.249%",gradientTransform:"matrix(1 0 0 .72308 0 .008)",id:"doc_logo_svg__p"}},[o("stop",{attrs:{"stop-color":"#FFF","stop-opacity":".1",offset:"0%"}}),o("stop",{attrs:{"stop-color":"#FFF","stop-opacity":"0",offset:"100%"}})],1),o("linearGradient",{attrs:{x1:"50.005%",y1:"8.586%",x2:"50.005%",y2:"100.014%",id:"doc_logo_svg__d"}},[o("stop",{attrs:{"stop-color":"#1A237E","stop-opacity":".2",offset:"0%"}}),o("stop",{attrs:{"stop-color":"#1A237E","stop-opacity":".02",offset:"100%"}})],1)],1),o("g",{attrs:{fill:"none","fill-rule":"evenodd"}},[o("g",[o("mask",{attrs:{id:"doc_logo_svg__b",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__a"}})]),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L36.719 10.34 29.375 0z",fill:"#4285F4","fill-rule":"nonzero",mask:"url(#doc_logo_svg__b)"}})]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__e",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__c"}})]),o("path",{attrs:{fill:"url(#doc_logo_svg__d)","fill-rule":"nonzero",mask:"url(#doc_logo_svg__e)",d:"M30.664 16.431L47 32.858v-15.13z"}})]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__g",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__f"}})]),o("path",{attrs:{d:"M11.75 47.273h23.5v-2.955h-23.5v2.955zm0 5.909h17.625v-2.955H11.75v2.955zm0-20.682v2.955h23.5V32.5h-23.5zm0 8.864h23.5v-2.955h-23.5v2.955z",fill:"#F1F1F1","fill-rule":"nonzero",mask:"url(#doc_logo_svg__g)"}})]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__i",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__h"}})]),o("g",{attrs:{mask:"url(#doc_logo_svg__i)"}},[o("path",{attrs:{d:"M29.375 0v13.295c0 2.449 1.972 4.432 4.406 4.432H47L29.375 0z",fill:"#A1C2FA","fill-rule":"nonzero"}})])]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__k",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__j"}})]),o("path",{attrs:{d:"M4.406 0C1.983 0 0 1.994 0 4.432v.37C0 2.363 1.983.368 4.406.368h24.969V0H4.406z","fill-opacity":".2",fill:"#FFF","fill-rule":"nonzero",mask:"url(#doc_logo_svg__k)"}})]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__m",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__l"}})]),o("path",{attrs:{d:"M42.594 64.63H4.406C1.983 64.63 0 62.637 0 60.2v.37C0 63.005 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-.37c0 2.438-1.983 4.433-4.406 4.433z","fill-opacity":".2",fill:"#1A237E","fill-rule":"nonzero",mask:"url(#doc_logo_svg__m)"}})]),o("g",[o("mask",{attrs:{id:"doc_logo_svg__o",fill:"#fff"}},[o("use",{attrs:{"xlink:href":"#doc_logo_svg__n"}})]),o("path",{attrs:{d:"M33.781 17.727c-2.434 0-4.406-1.983-4.406-4.432v.37c0 2.448 1.972 4.432 4.406 4.432H47v-.37H33.781z","fill-opacity":".1",fill:"#1A237E","fill-rule":"nonzero",mask:"url(#doc_logo_svg__o)"}})]),o("path",{attrs:{d:"M29.375 0H4.406C1.983 0 0 1.994 0 4.432v56.136C0 63.006 1.983 65 4.406 65h38.188C45.017 65 47 63.006 47 60.568v-42.84L29.375 0z",fill:"url(#doc_logo_svg__p)","fill-rule":"nonzero"}})])])}),[],!1,null,null,null);e.a=component.exports},414:function(t,e,o){"use strict";var l=o(10),component=Object(l.a)({},(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("svg",t._g({attrs:{xmlns:"http://www.w3.org/2000/svg",width:"284.675",height:"350",viewBox:"0 0 75.32 92.604"}},t.$listeners),[o("path",{staticStyle:{"line-height":"normal","font-variant-ligatures":"normal","font-variant-position":"normal","font-variant-caps":"normal","font-variant-numeric":"normal","font-variant-alternates":"normal","font-feature-settings":"normal","text-indent":"0","text-align":"start","text-decoration-line":"none","text-decoration-style":"solid","text-decoration-color":"#000","text-transform":"none","text-orientation":"mixed","white-space":"normal","shape-padding":"0",isolation:"auto","mix-blend-mode":"normal","solid-color":"#000","solid-opacity":"1"},attrs:{fill:"#ff2116",d:"M9.564 0C4.292 0 0 4.294 0 9.566v73.47c0 5.272 4.292 9.567 9.564 9.567h56.18c5.272 0 9.564-4.294 9.564-9.567V22.624s.15-1.77-.617-3.49c-.72-1.614-1.893-2.737-1.893-2.737a1.571 1.571 0 00-.01-.012L58.85 2.713a1.571 1.571 0 00-.023-.023S57.637 1.557 55.873.8c-2.077-.892-4.218-.798-4.218-.798L51.687 0z",color:"#000","font-family":"sans-serif",overflow:"visible","paint-order":"markers fill stroke"}}),o("path",{staticStyle:{"line-height":"normal","font-variant-ligatures":"normal","font-variant-position":"normal","font-variant-caps":"normal","font-variant-numeric":"normal","font-variant-alternates":"normal","font-feature-settings":"normal","text-indent":"0","text-align":"start","text-decoration-line":"none","text-decoration-style":"solid","text-decoration-color":"#000","text-transform":"none","text-orientation":"mixed","white-space":"normal","shape-padding":"0",isolation:"auto","mix-blend-mode":"normal","solid-color":"#000","solid-opacity":"1"},attrs:{fill:"#f5f5f5",d:"M9.564 3.142h42.123a1.571 1.571 0 00.032 0s1.684.017 2.916.545a7.993 7.993 0 012.038 1.29l13.904 13.64s.838.885 1.244 1.795c.327.734.347 2.078.347 2.078a1.571 1.571 0 00-.002.067v60.48c0 3.585-2.836 6.424-6.422 6.424H9.564c-3.586 0-6.421-2.838-6.421-6.425V9.566c0-3.586 2.835-6.424 6.421-6.424z",color:"#000","font-family":"sans-serif",overflow:"visible","paint-order":"markers fill stroke"}}),o("path",{attrs:{fill:"#ff2116",d:"M18.804 55.135c-2.162-2.162.177-5.133 6.526-8.288l3.994-1.985 1.557-3.405a134.054 134.054 0 002.838-6.79l1.283-3.386-.884-2.506c-1.087-3.08-1.474-7.71-.785-9.374.934-2.255 3.994-2.024 5.205.393.946 1.888.849 5.307-.272 9.618l-.92 3.534.81 1.375c.445.756 1.746 2.55 2.89 3.989l2.152 2.676 2.677-.35c8.503-1.11 11.416.777 11.416 3.48 0 3.413-6.677 3.695-12.284-.243-1.262-.886-2.128-1.767-2.128-1.767s-3.513.716-5.243 1.182c-1.785.48-2.675.782-5.29 1.665 0 0-.918 1.332-1.516 2.301-2.224 3.604-4.821 6.59-6.676 7.677-2.077 1.217-4.254 1.3-5.35.204zm3.393-1.212c1.216-.751 3.676-3.66 5.378-6.361l.69-1.093-3.14 1.578c-4.848 2.438-7.066 4.735-5.913 6.125.648.78 1.423.716 2.985-.25zm31.494-8.84c1.189-.833 1.016-2.51-.328-3.187-1.045-.527-1.888-.635-4.606-.595-1.67.114-4.354.45-4.81.553 0 0 1.476 1.02 2.13 1.394.872.498 2.99 1.422 4.537 1.895 1.526.467 2.409.418 3.077-.06zm-12.663-5.264c-.72-.756-1.943-2.334-2.719-3.507-1.014-1.33-1.523-2.27-1.523-2.27s-.741 2.386-1.35 3.82l-1.898 4.692-.55 1.065s2.925-.96 4.414-1.348c1.576-.412 4.776-1.041 4.776-1.041zm-4.081-16.365c.184-1.54.261-3.078-.233-3.853-1.373-1.5-3.03-.25-2.749 3.318.095 1.2.393 3.25.791 4.515l.725 2.299.51-1.732c.28-.952.71-2.998.956-4.547z"}}),o("path",{staticStyle:{"line-height":"125%","-inkscape-font-specification":"'Franklin Gothic Medium Cond'"},attrs:{fill:"#2c2c2c",d:"M22.481 65.148h3.51q1.683 0 2.732.322 1.049.311 1.765 1.402.717 1.08.717 2.606 0 1.402-.582 2.41-.581 1.007-1.568 1.454-.976.446-3.012.446h-1.215v5.536h-2.347zm2.347 1.817v4.944h1.163q1.558 0 2.15-.582.603-.582.603-1.89 0-.976-.395-1.579-.395-.613-.872-.748-.468-.145-1.486-.145zm8.174-1.817h3.188q2.316 0 3.697.82 1.392.82 2.098 2.44.717 1.62.717 3.594 0 2.077-.644 3.708-.634 1.62-1.953 2.617-1.308.997-3.738.997h-3.365zm2.347 1.88v10.416h.976q2.046 0 2.97-1.412.925-1.423.925-3.791 0-5.214-3.895-5.214zm9.607-1.88h7.872v1.88h-5.525v4.237h4.424v1.88h-4.424v6.179h-2.347z","font-family":"Franklin Gothic Medium Cond","letter-spacing":"0","word-spacing":"4.26"}})])}),[],!1,null,null,null);e.a=component.exports},424:function(t,e,o){"use strict";o(390)},425:function(t,e,o){var l=o(44)(!1);l.push([t.i,".app-upload-file-drop{box-sizing:border-box;max-width:306px;width:100%;height:146px;background:#f8f8f8;border:1px dashed #bcbcbc;border-radius:10px;display:flex;flex-direction:column;flex-wrap:nowrap;justify-content:center;align-items:center}.app-upload-file-drop__title{font-weight:600;font-size:16px;line-height:125%;color:#263043;margin-top:16px;-webkit-user-select:none;-moz-user-select:none;user-select:none}.app-upload-file-drop__icon,.app-upload-file-drop__title{pointer-events:none}.app-upload-file-drop_disabled{background:#d9d9d9}.app-upload-file-drop_disabled .app-upload-file-drop__title{color:#949594}.app-upload-file-drop_disabled .app-upload-file-drop__icon{opacity:.5}",""]),t.exports=l},426:function(t,e,o){"use strict";o(391)},427:function(t,e,o){var l=o(44)(!1);l.push([t.i,".app-upload-file,.app-upload-file__container{width:100%}.app-upload-file__input{display:none}.app-upload-file_disabled .app-upload-file--icon path:first-child,.app-upload-file_disabled .app-upload-file--icon path:nth-child(2){stroke:#afacac}",""]),t.exports=l},450:function(t,e,o){"use strict";o(406)},451:function(t,e,o){var l=o(44)(!1);l.push([t.i,".app-form-media-doc-desktop{max-width:306px}.app-form-media-doc-desktop__container{width:100%;display:flex;flex-direction:column;flex-wrap:nowrap;align-items:center}.app-form-media-doc-desktop__title{font-weight:600;font-size:16px;line-height:20px;color:#9398a1;margin:16px 0;-webkit-user-select:none;-moz-user-select:none;user-select:none}.app-form-media-doc-desktop__file{max-width:306px}",""]),t.exports=l},452:function(t,e,o){"use strict";o(407)},453:function(t,e,o){var l=o(44)(!1);l.push([t.i,".app-form-media-doc-mobile{display:flex;flex-direction:column;flex-wrap:nowrap;align-items:center}.app-form-media-doc-mobile__title{font-weight:700;font-size:18px;line-height:125%;color:#263043}.app-form-media-doc-mobile__files{margin-top:32px}.app-form-media-doc-mobile__file{margin-top:14px}.app-form-media-doc-mobile__file:first-child{margin-top:0}",""]),t.exports=l}}]);