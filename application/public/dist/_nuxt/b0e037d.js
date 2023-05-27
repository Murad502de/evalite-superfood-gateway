(window.webpackJsonp=window.webpackJsonp||[]).push([[61,14,15],{367:function(e,t,r){"use strict";r.d(t,"a",(function(){return l}));var n=r(147);var o=r(187),c=r(112);function l(e){return function(e){if(Array.isArray(e))return Object(n.a)(e)}(e)||Object(o.a)(e)||Object(c.a)(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}},377:function(e,t,r){"use strict";r.r(t);r(256);t.default={components:{},props:{color:{type:String,default:"#0082DE"},disabled:{type:Boolean,default:!1},styles:{type:Object,default:function(){return{}}},outlined:{type:Boolean,default:!1},elevation:{type:Number,default:0},loading:{type:Boolean,default:!1}},data:function(){return{defaultStyle:{color:"#FFFFFF",fontWeight:"700",fontSize:"14px",lineHeight:"125%",letterSpacing:"unset",borderRadius:"8px"}}},computed:{},watch:{},methods:{click:function(){this.$emit("click")}},created:function(){},mounted:function(){}}},557:function(e,t,r){"use strict";var n=r(8),o=(r(62),r(75),r(181),r(27),r(6),r(14),r(84),r(177),r(19),r(15),r(33),r(34),r(175)),c=r(432),l=r(437);function d(object,e){var t=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),t.push.apply(t,r)}return t}function m(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?d(Object(source),!0).forEach((function(t){Object(n.a)(e,t,source[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):d(Object(source)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(source,t))}))}return e}t.a=Object(o.a)(c.a,Object(l.b)("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(e){var t=Object.values(e).includes(!0);this.$emit("input",!t)},deep:!0,immediate:!0}},methods:{watchInput:function(input){var e=this,t=function(input){return input.$watch("hasError",(function(t){e.$set(e.errorBag,input._uid,t)}),{immediate:!0})},r={_uid:input._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?r.shouldValidate=input.$watch("shouldValidate",(function(n){n&&(e.errorBag.hasOwnProperty(input._uid)||(r.valid=t(input)))})):r.valid=t(input),r},validate:function(){return 0===this.inputs.filter((function(input){return!input.validate(!0)})).length},reset:function(){this.inputs.forEach((function(input){return input.reset()})),this.resetErrorBag()},resetErrorBag:function(){var e=this;this.lazyValidation&&setTimeout((function(){e.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(input){return input.resetValidation()})),this.resetErrorBag()},register:function(input){this.inputs.push(input),this.watchers.push(this.watchInput(input))},unregister:function(input){var e=this.inputs.find((function(i){return i._uid===input._uid}));if(e){var t=this.watchers.find((function(i){return i._uid===e._uid}));t&&(t.valid(),t.shouldValidate()),this.watchers=this.watchers.filter((function(i){return i._uid!==e._uid})),this.inputs=this.inputs.filter((function(i){return i._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(e){var t=this;return e("form",{staticClass:"v-form",attrs:m({novalidate:!0},this.attrs$),on:{submit:function(e){return t.$emit("submit",e)}}},this.$slots.default)}})},574:function(e,t,r){"use strict";r.r(t),t.default={components:{},props:{},data:function(){return{}},computed:{},watch:{},methods:{},created:function(){},mounted:function(){}}},770:function(e,t,r){var content=r(797);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(45).default)("770aeac6",content,!0,{sourceMap:!1})},796:function(e,t,r){"use strict";r(770)},797:function(e,t,r){var n=r(44)(!1);n.push([e.i,".ruqi-settings{padding:32px 24px;-webkit-user-select:none;-moz-user-select:none;user-select:none}.ruqi-settings__container{max-width:800px}.ruqi-settings--top-bar{display:flex;flex-direction:row;flex-wrap:nowrap;justify-content:flex-end;align-items:center}.ruqi-settings--form{margin-top:14px}.ruqi-settings--percentage-levels__title{font-weight:600;font-size:16px;line-height:125%;color:#263043}.ruqi-settings--percentage-levels__levels{margin-top:14px}.ruqi-settings--percentage-levels__level{display:flex;flex-direction:row;flex-wrap:nowrap;justify-content:space-between;align-items:center}.ruqi-settings--percentage-levels__level-delete{margin-top:-30px;margin-left:16px;cursor:pointer}.ruqi-settings--percentage-levels__level-delete:hover{color:#eb4d3d}",""]),e.exports=n},821:function(e,t,r){"use strict";r.r(t);var n=r(3),o=(r(29),r(27),r(6),r(371)),c=r(768),l=r(769),d=r(582),m=r(370),f={components:{AppCard:d.a,AppButton:m.a},props:{},data:function(){return{valid:!0,loading:!1,fetching:!1,amocrmSubdomain:"",amocrmSubdomainRules:[o.k()],amocrmRedirectUri:"",amocrmRedirectUriRules:[o.k(),o.l()],amocrmClientSecret:"",amocrmClientSecretRules:[o.k()],amocrmUtmSourceId:"",amocrmUtmSourceIdRules:[o.k(),o.c()],personalLinkHost:"",personalLinkHostRules:[o.k(),o.l()],minPayout:"",minPayoutRules:[o.k(),o.c()],percentage:"",percentageRules:[o.k(),o.c()],percentageLevels:[]}},computed:{},watch:{},methods:{deletePercentageLevel:function(e){this.percentageLevels=this.percentageLevels.filter((function(t){return t.uuid!==e}))},addPercentageLevel:function(){this.percentageLevels.push({uuid:(new Date).getTime(),percentage:0})},save:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(!e.$refs.form.validate()){t.next=9;break}return e.loading=!0,r={amocrmSubdomain:e.amocrmSubdomain,amocrmRedirectUri:e.amocrmRedirectUri,amocrmClientSecret:e.amocrmClientSecret,amocrmUtmSourceId:e.amocrmUtmSourceId,personalLinkHost:e.personalLinkHost,minPayout:e.minPayout,percentage:e.percentage,percentageLevels:e.percentageLevels},t.next=5,Object(l.a)(r);case 5:n=t.sent,console.debug("configurationsCreateResponse",n),200!==n.status&&alert("Ошибка сохранения настроек"),e.loading=!1;case 9:case"end":return t.stop()}}),t)})))()}},created:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){var r,data;return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.fetching=!0,t.next=3,Object(c.a)();case 3:r=t.sent,console.debug("configurationsReadResponse",r),200===r.status||201===r.status?(data=r.data.data,e.amocrmSubdomain=data.amocrm_subdomain,e.amocrmRedirectUri=data.amocrm_redirect_uri,e.amocrmClientSecret=data.amocrm_client_secret,e.amocrmUtmSourceId=data.amocrm_utm_source_id,e.personalLinkHost=data.personal_link_host,e.minPayout=data.min_payout,e.percentage=data.percentage,e.percentageLevels=data.percentage_levels,e.fetching=!1):alert("Ошибка получения текущих настроек");case 6:case"end":return t.stop()}}),t)})))()},mounted:function(){}},v=(r(796),r(10)),h=r(95),_=r.n(h),y=r(557),x=r(609),w=r(556),component=Object(v.a)(f,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"ruqi-settings"},[r("div",{staticClass:"ruqi-settings__container"},[r("AppCard",[r("div",{staticClass:"ruqi-settings--top-bar"},[r("AppButton",{staticClass:"ruqi-settings--save",attrs:{loading:e.loading,disabled:e.fetching},on:{click:e.save}},[e._v("сохранить изменения")])],1),r("v-form",{ref:"form",staticClass:"ruqi-settings--form",attrs:{"lazy-validation":""},model:{value:e.valid,callback:function(t){e.valid=t},expression:"valid"}},[r("v-text-field",{attrs:{rules:e.amocrmSubdomainRules,disabled:e.loading||e.fetching,label:"amocrm субдомен",required:"",outlined:""},model:{value:e.amocrmSubdomain,callback:function(t){e.amocrmSubdomain=t},expression:"amocrmSubdomain"}}),r("v-text-field",{attrs:{rules:e.amocrmRedirectUriRules,disabled:e.loading||e.fetching,label:"amocrm адрес редиректа",required:"",outlined:""},model:{value:e.amocrmRedirectUri,callback:function(t){e.amocrmRedirectUri=t},expression:"amocrmRedirectUri"}}),r("v-text-field",{attrs:{rules:e.amocrmClientSecretRules,disabled:e.loading||e.fetching,label:"amocrm секретный ключ интеграции",required:"",outlined:""},model:{value:e.amocrmClientSecret,callback:function(t){e.amocrmClientSecret=t},expression:"amocrmClientSecret"}}),r("v-text-field",{attrs:{rules:e.amocrmUtmSourceIdRules,disabled:e.loading||e.fetching,label:"amocrm id поля utm_source",required:"",outlined:""},model:{value:e.amocrmUtmSourceId,callback:function(t){e.amocrmUtmSourceId=t},expression:"amocrmUtmSourceId"}}),r("v-text-field",{attrs:{rules:e.personalLinkHostRules,disabled:e.loading||e.fetching,label:"хост персональной ссылки реферала",required:"",outlined:""},model:{value:e.personalLinkHost,callback:function(t){e.personalLinkHost=t},expression:"personalLinkHost"}}),r("v-text-field",{attrs:{rules:e.minPayoutRules,disabled:e.loading||e.fetching,label:"минимальная сумма вывода",required:"",outlined:""},model:{value:e.minPayout,callback:function(t){e.minPayout=t},expression:"minPayout"}}),r("v-text-field",{attrs:{rules:e.percentageRules,disabled:e.loading||e.fetching,label:"процентаж прямых продаж",required:"",outlined:""},model:{value:e.percentage,callback:function(t){e.percentage=t},expression:"percentage"}}),r("div",{staticClass:"ruqi-settings--percentage-levels"},[r("div",{staticClass:"ruqi-settings--percentage-levels__title"},[e._v("Процентаж связанных продаж")]),r("div",{staticClass:"ruqi-settings--percentage-levels__levels"},e._l(e.percentageLevels,(function(t,n){return r("div",{key:t.uuid,staticClass:"ruqi-settings--percentage-levels__level"},[r("v-text-field",{staticClass:"ruqi-settings--percentage-levels__level-field",attrs:{rules:e.percentageRules,disabled:e.loading||e.fetching,label:"процентаж уровня "+(n+1),required:"",outlined:""},model:{value:t.percentage,callback:function(r){e.$set(t,"percentage",r)},expression:"percentageLevel.percentage"}}),r("v-icon",{staticClass:"ruqi-settings--percentage-levels__level-delete",attrs:{disabled:e.loading||e.fetching},on:{click:function(r){return e.deletePercentageLevel(t.uuid)}}},[e._v("mdi-delete")])],1)})),0),r("AppButton",{staticClass:"ruqi-settings--percentage-levels__add",attrs:{disabled:e.loading||e.fetching},on:{click:e.addPercentageLevel}},[e._v("Добавить")])],1)],1)],1)],1)])}),[],!1,null,null,null);t.default=component.exports;_()(component,{AppButton:r(377).default,AppCard:r(574).default}),_()(component,{VForm:y.a,VIcon:x.a,VTextField:w.a})}}]);