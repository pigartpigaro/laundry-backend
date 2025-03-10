import{l as te,am as p,C as oe,al as ae,E as ne,g as ie,r as C,c as f,an as le,H as se,ao as re,K as ue,ap as ce,w as E,P as k,p as x,v as H,au as de,h as A,ax as fe,m as he,B as ve}from"./index-C65Hd5S6.js";import{v as me,a as q,e as ge,p as D,b as pe,c as Te,d as ye,r as M,s as Se}from"./position-engine-DybSInmw.js";import{c as j}from"./selection-B7CkVjym.js";const Oe=te({name:"QTooltip",inheritAttrs:!1,props:{...ge,...ne,...p,maxHeight:{type:String,default:null},maxWidth:{type:String,default:null},transitionShow:{...p.transitionShow,default:"jump-down"},transitionHide:{...p.transitionHide,default:"jump-up"},anchor:{type:String,default:"bottom middle",validator:q},self:{type:String,default:"top middle",validator:q},offset:{type:Array,default:()=>[14,14],validator:me},scrollTarget:ae,delay:{type:Number,default:0},hideDelay:{type:Number,default:0},persistent:Boolean},emits:[...oe],setup(e,{slots:L,emit:T,attrs:h}){let i,l;const v=ie(),{proxy:{$q:o}}=v,s=C(null),c=C(!1),B=f(()=>D(e.anchor,o.lang.rtl)),Q=f(()=>D(e.self,o.lang.rtl)),W=f(()=>e.persistent!==!0),{registerTick:N,removeTick:R}=le(),{registerTimeout:d}=se(),{transitionProps:_,transitionStyle:I}=re(e),{localScrollTarget:y,changeScrollEvent:K,unconfigureScrollTarget:U}=pe(e,w),{anchorEl:a,canShow:V,anchorEvents:r}=Te({showing:c,configureAnchorEl:Y}),{show:$,hide:m}=ue({showing:c,canShow:V,handleShow:F,handleHide:G,hideOnRouteChange:W,processOnMount:!0});Object.assign(r,{delayShow:J,delayHide:X});const{showPortal:S,hidePortal:b,renderPortal:z}=ce(v,s,ee,"tooltip");if(o.platform.is.mobile===!0){const t={anchorEl:a,innerRef:s,onClickOutside(n){return m(n),n.target.classList.contains("q-dialog__backdrop")&&ve(n),!0}},g=f(()=>e.modelValue===null&&e.persistent!==!0&&c.value===!0);E(g,n=>{(n===!0?ye:M)(t)}),k(()=>{M(t)})}function F(t){S(),N(()=>{l=new MutationObserver(()=>u()),l.observe(s.value,{attributes:!1,childList:!0,characterData:!0,subtree:!0}),u(),w()}),i===void 0&&(i=E(()=>o.screen.width+"|"+o.screen.height+"|"+e.self+"|"+e.anchor+"|"+o.lang.rtl,u)),d(()=>{S(!0),T("show",t)},e.transitionDuration)}function G(t){R(),b(),P(),d(()=>{b(!0),T("hide",t)},e.transitionDuration)}function P(){l!==void 0&&(l.disconnect(),l=void 0),i!==void 0&&(i(),i=void 0),U(),x(r,"tooltipTemp")}function u(){Se({targetEl:s.value,offset:e.offset,anchorEl:a.value,anchorOrigin:B.value,selfOrigin:Q.value,maxHeight:e.maxHeight,maxWidth:e.maxWidth})}function J(t){if(o.platform.is.mobile===!0){j(),document.body.classList.add("non-selectable");const g=a.value,n=["touchmove","touchcancel","touchend","click"].map(O=>[g,O,"delayHide","passiveCapture"]);H(r,"tooltipTemp",n)}d(()=>{$(t)},e.delay)}function X(t){o.platform.is.mobile===!0&&(x(r,"tooltipTemp"),j(),setTimeout(()=>{document.body.classList.remove("non-selectable")},10)),d(()=>{m(t)},e.hideDelay)}function Y(){if(e.noParentEvent===!0||a.value===null)return;const t=o.platform.is.mobile===!0?[[a.value,"touchstart","delayShow","passive"]]:[[a.value,"mouseenter","delayShow","passive"],[a.value,"mouseleave","delayHide","passive"]];H(r,"anchor",t)}function w(){if(a.value!==null||e.scrollTarget!==void 0){y.value=de(a.value,e.scrollTarget);const t=e.noParentEvent===!0?u:m;K(y.value,t)}}function Z(){return c.value===!0?A("div",{...h,ref:s,class:["q-tooltip q-tooltip--style q-position-engine no-pointer-events",h.class],style:[h.style,I.value],role:"tooltip"},he(L.default)):null}function ee(){return A(fe,_.value,Z)}return k(P),Object.assign(v.proxy,{updatePosition:u}),z}});export{Oe as Q};
