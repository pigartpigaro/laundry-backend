import{aW as b,ac as k,c as V,o as q,W as d,a4 as S,Y as y,$ as r,f as n,Z as f,aX as w,a6 as P,a2 as m,aT as C,aY as Q}from"./index-C65Hd5S6.js";import{Q as x}from"./QForm-DoygxfT4.js";import{n as M,u as N}from"./notifs-C5sbblO4.js";import{u as $}from"./list-CAT0HFlA.js";const B=b("form-master-pelanggan-store",{state:()=>({form:{id:null,kodepelanggan:null,pelanggan:null,alamat:null,nohp:null,flag:null},loading:!1}),actions:{initReset(t){if(t)return new Promise(u=>{for(const c in this.form)this.form[c]=t[c];this.form.kodepelanggan=t==null?void 0:t.kodepelanggan,console.log(this.form),u()});for(const u in this.form)this.form[u]=null},async save(t){return this.loading=!0,new Promise((u,c)=>{k.post("/xy/master/pelanggan/savedata",this.form).then(({data:e})=>{var s;console.log("saved",e),this.loading=!1;const a=$();t?a!=null&&a.items&&((s=e==null?void 0:e.result)!=null&&s.id)&&(a.items=a.items.map(i=>(i==null?void 0:i.id)===e.result.id?{...i,...e.result}:i)):a.items.unshift(e==null?void 0:e.result),M("Data berhasil disimpan"),this.initReset(null),u(e)}).catch(e=>{this.loading=!1,c(e)})})}}}),F={class:"fit column"},R={class:"col-auto"},U={class:"row items-center q-pa-lg"},W={class:"col-grow"},Y={class:"col full-height q-px-lg q-pb-lg"},Z={class:"row q-col-gutter-md justify-around"},z={class:"col-12"},T={__name:"FormPage",props:{data:{type:Object,default:null}},emits:["back"],setup(t,{emit:u}){const c=u,e=N(),a=V(()=>e.screen.lt.sm),s=B(),i=t;q(()=>{s.initReset(i.data)});function g(){s.save(i.data)}return(A,l)=>{const h=d("app-btn-back"),p=d("app-input"),_=d("app-btn");return y(),S("div",F,[r("div",R,[r("div",U,[r("div",W,[n(h,{onClick:l[0]||(l[0]=o=>c("back"))})]),l[5]||(l[5]=r("div",{class:"col-auto"},null,-1))])]),r("div",Y,[n(Q,{flat:"",class:"col full-height"},{default:f(()=>[n(x,{class:"full-height",onSubmit:g},{default:f(()=>[n(w,{class:"full-height q-pa-lg scroll"},{default:f(()=>[r("div",Z,[r("div",{class:P([`col-${a.value?12:6}`,"row q-col-gutter-md"])},[n(p,{class:"col-12",modelValue:m(s).form.pelanggan,"onUpdate:modelValue":l[1]||(l[1]=o=>m(s).form.pelanggan=o),label:"Nama Pelanggan",valid:{required:!1}},null,8,["modelValue"]),n(p,{class:"col-12",modelValue:m(s).form.alamat,"onUpdate:modelValue":l[2]||(l[2]=o=>m(s).form.alamat=o),label:"Alamat",valid:{required:!1}},null,8,["modelValue"]),n(p,{class:"col-12",modelValue:m(s).form.nohp,"onUpdate:modelValue":[l[3]||(l[3]=o=>m(s).form.nohp=o),l[4]||(l[4]=o=>{const v=o==null?void 0:o.replace(/^0+/,"");o>1&&(m(s).form.harga=v)})],label:"Nomer HP",valid:{number:!0}},null,8,["modelValue"]),r("div",z,[n(C,{class:"q-my-md"}),n(_,{loading:m(s).loading,type:"submit",dense:!1,label:"Simpan"},null,8,["loading"])])],2)])]),_:1})]),_:1})]),_:1})])])}}};export{T as default};
