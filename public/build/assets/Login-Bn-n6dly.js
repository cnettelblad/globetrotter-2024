import{d as k,i as y,j as h,v as x,o as m,g as b,T as V,c,w as i,a,u as o,Z as B,t as C,h as p,b as r,k as $,e as f,n as P,f as N}from"./app-BgzXHyT0.js";import{_ as U}from"./GuestLayout.vue_vue_type_script_setup_true_lang-DLKNSFcv.js";import{_ as g,a as w}from"./InputLabel.vue_vue_type_script_setup_true_lang-LXHF5S7j.js";import{P as q}from"./PrimaryButton-ByWfOpmU.js";import{_}from"./TextInput.vue_vue_type_script_setup_true_lang-C2IawAid.js";import"./ApplicationLogo-CWuFB-ws.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const L=["value"],R=k({__name:"Checkbox",props:{checked:{type:Boolean},value:{}},emits:["update:checked"],setup(d,{emit:s}){const n=s,l=d,e=y({get(){return l.checked},set(t){n("update:checked",t)}});return(t,u)=>h((m(),b("input",{type:"checkbox",value:t.value,"onUpdate:modelValue":u[0]||(u[0]=v=>e.value=v),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,L)),[[x,e.value]])}}),j={key:0,class:"mb-4 font-medium text-sm text-green-600"},D={class:"mt-4"},E={class:"block mt-4"},F={class:"flex items-center"},M={class:"flex items-center justify-end mt-4"},I=k({__name:"Login",props:{canResetPassword:{type:Boolean},status:{}},setup(d){const s=V({email:"",password:"",remember:!1}),n=()=>{s.post(route("login"),{onFinish:()=>{s.reset("password")}})};return(l,e)=>(m(),c(U,null,{default:i(()=>[a(o(B),{title:"Log in"}),l.status?(m(),b("div",j,C(l.status),1)):p("",!0),r("form",{onSubmit:N(n,["prevent"])},[r("div",null,[a(g,{for:"email",value:"Email"}),a(_,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:o(s).email,"onUpdate:modelValue":e[0]||(e[0]=t=>o(s).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(w,{class:"mt-2",message:o(s).errors.email},null,8,["message"])]),r("div",D,[a(g,{for:"password",value:"Password"}),a(_,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:o(s).password,"onUpdate:modelValue":e[1]||(e[1]=t=>o(s).password=t),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(w,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),r("div",E,[r("label",F,[a(R,{name:"remember",checked:o(s).remember,"onUpdate:checked":e[2]||(e[2]=t=>o(s).remember=t)},null,8,["checked"]),e[3]||(e[3]=r("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1))])]),r("div",M,[l.canResetPassword?(m(),c(o($),{key:0,href:l.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:i(()=>e[4]||(e[4]=[f(" Forgot your password? ")])),_:1},8,["href"])):p("",!0),a(q,{class:P(["ms-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:i(()=>e[5]||(e[5]=[f(" Log in ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{I as default};