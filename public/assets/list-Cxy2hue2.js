import{aW as l,ac as o}from"./index-C65Hd5S6.js";import{n,a as h}from"./notifs-C5sbblO4.js";const c=l("master-kategori-store",{state:()=>({meta:null,items:[],inisial:[],isError:!1,loading:!1,params:{q:null,page:0,per_page:15}}),actions:{async getList(){this.params.page=1,this.isError=!1,this.loading=!0;const a={params:this.params};try{const{data:s}=await o.get("/xy/master/kategori/listdata",a);this.meta=s,this.items=s==null?void 0:s.data,this.loading=!1}catch(s){console.log(s),this.isError=!0,this.loading=!1}},loadMore(a,s){this.isError=!1,this.params.page=a;const r={params:this.params};return console.log("load more",a),new Promise(t=>{o.get("/xy/master/kategori/listdata",r).then(({data:e})=>{this.meta=e,this.items.push(...e.data),console.log("ITEMS",this.items),s(),t()}).catch(()=>{this.isError=!0,s(!0),t()})})},async deleteItem(a){var r;this.items=this.items.filter(t=>t.id!==a);const s={id:a};try{if((await o.post("/xy/master/kategori/deletedata",s)).status===200){const e=(r=this.items)==null?void 0:r.filter(i=>(i==null?void 0:i.id)!==a);this.items=e,n("Data berhasil dihapus")}}catch(t){console.log("del Brand error",t),h("Terjadi Kesalahan")}}}});export{c as u};
