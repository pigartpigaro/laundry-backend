import{Q as V}from"./QSpace-CMevY34W.js";import{bt as h,r as q,w as _,W as p,X as w,Y as S,Z as o,f as t,aY as Q,aX as m,$ as d,a1 as y,a2 as g,aT as R,aN as x}from"./index-C65Hd5S6.js";import{Q as U}from"./QForm-DoygxfT4.js";import{u as C}from"./FormPage-BzcaZts_.js";import"./notifs-C5sbblO4.js";import"./list-CF7jxGWo.js";const F={class:"row q-col-gutter-md justify-around"},B={class:"row q-col-gutter-md"},D={class:"col-12"},X={__name:"DialogRinci",setup(I){const u=C(),i=h(),a=q({no_nota:null,kodeproduk:null,produk:null,satuan:null,kategori:null,kuantitas:null,harga:null,subtotal:null,keterangan:null});_(()=>u.activeRinciIndex,n=>{n!==null?a.value={...u.form.rincians[n]}:a.value={no_nota:null,kodeproduk:null,produk:null,satuan:null,kategori:null,kuantitas:null,harga:null,subtotal:null,keterangan:null}},{immediate:!0});function f(n){const l=i==null?void 0:i.items.find(s=>(s==null?void 0:s.produk)===n);a.value.kodeproduk=l==null?void 0:l.kodeproduk,a.value.harga=l==null?void 0:l.harga,a.value.satuan=l==null?void 0:l.satuan,a.value.kategori=l==null?void 0:l.kategori}const c=()=>{u.dialogrincis=!1,u.activeRinciIndex=null,a.value={produk:null,satuan:null,kuantitas:null,harga:null,subtotal:null,keterangan:null}};function k(){if(!a.value.produk||!a.value.kuantitas||!a.value.harga||!a.value.subtotal){alert("Harap Lengkapi Semua Field Rincian!");return}u.activeRinciIndex!==null?u.form.rincians[u.activeRinciIndex]={...a.value}:u.form.rincians.push({...a.value}),u.save().then(()=>{console.log("Data berhasil disimpan!"),c()}).catch(n=>{console.error("Gagal menyimpan:",n)})}return(n,l)=>{const s=p("app-select"),r=p("app-input"),b=p("app-btn");return S(),w(x,{class:"full-width q-mt-lg","backdrop-filter":"blur(4x)",persistent:""},{default:o(()=>[t(Q,{style:{width:"80vw","max-width":"80vw"}},{default:o(()=>[t(m,{class:"row items-center q-pb-none"},{default:o(()=>[l[8]||(l[8]=d("div",{class:"full-width full-height q-pb-sm text-center text-h6"}," Rincian Order ",-1)),t(V),t(y,{class:"absolute-top-right",icon:"close",flat:"",round:"",dense:"",onClick:c})]),_:1}),t(m,{class:"q-pt-none"},{default:o(()=>[t(U,{class:"full-height",onSubmit:k},{default:o(()=>[t(m,{class:"full-height q-pa-lg scroll"},{default:o(()=>{var v;return[d("div",F,[d("div",B,[t(s,{class:"col-12",modelValue:a.value.produk,"onUpdate:modelValue":[l[0]||(l[0]=e=>a.value.produk=e),l[1]||(l[1]=e=>f(e))],label:"Pilih Produk",options:(v=g(i))==null?void 0:v.items,"option-label":"produk","option-value":"produk"},null,8,["modelValue","options"]),t(r,{class:"col-6",modelValue:a.value.harga,"onUpdate:modelValue":l[2]||(l[2]=e=>a.value.harga=e),label:"Harga",readonly:"",valid:{required:!0}},null,8,["modelValue"]),t(r,{class:"col-6",modelValue:a.value.satuan,"onUpdate:modelValue":l[3]||(l[3]=e=>a.value.satuan=e),label:"Satuan",readonly:"",valid:{required:!0}},null,8,["modelValue"]),t(r,{class:"col-12",modelValue:a.value.kuantitas,"onUpdate:modelValue":[l[4]||(l[4]=e=>a.value.kuantitas=e),l[5]||(l[5]=e=>{a.value.subtotal=parseFloat(a.value.harga)*parseFloat(e)})],label:"Kuantitas",valid:{required:!0}},null,8,["modelValue"]),t(r,{class:"col-12",modelValue:a.value.subtotal,"onUpdate:modelValue":l[6]||(l[6]=e=>a.value.subtotal=e),label:"Subtotal",readonly:"",valid:{required:!0}},null,8,["modelValue"]),t(r,{class:"col-12",modelValue:a.value.keterangan,"onUpdate:modelValue":l[7]||(l[7]=e=>a.value.keterangan=e),label:"Keterangan",valid:{required:!0}},null,8,["modelValue"]),d("div",D,[t(R,{class:"q-my-md"}),t(b,{loading:g(u).loading,type:"submit",dense:!1,label:"Simpan"},null,8,["loading"])])])])]}),_:1})]),_:1})]),_:1})]),_:1})]),_:1})}}};export{X as default};
