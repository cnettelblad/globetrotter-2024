import{d as b,i as y,j as h,v as x,o as m,g as k,C as V,c,w as i,a,u as o,m as C,t as B,h as p,b as r,P as $,e as f,n as P,f as N}from"./app-DTqmi5Mx.js";import{_ as U}from"./GuestLayout.vue_vue_type_script_setup_true_lang-DNtYCPdI.js";import{_ as g,a as w}from"./InputLabel.vue_vue_type_script_setup_true_lang-CQjhF8bx.js";import{_}from"./TextInput.vue_vue_type_script_setup_true_lang-B-7V-XBC.js";import{G as q}from"./GradientButton-D4P26be9.js";import"./ApplicationLogo-CXSGmcd3.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const L=["value"],R=b({__name:"Checkbox",props:{checked:{type:Boolean},value:{}},emits:["update:checked"],setup(d,{emit:s}){const n=s,l=d,e=y({get(){return l.checked},set(t){n("update:checked",t)}});return(t,u)=>h((m(),k("input",{type:"checkbox",value:t.value,"onUpdate:modelValue":u[0]||(u[0]=v=>e.value=v),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,L)),[[x,e.value]])}}),j={key:0,class:"mb-4 font-medium text-sm text-green-600"},D={class:"mt-4"},E={class:"block mt-4"},F={class:"flex items-center"},G={class:"flex items-center justify-end mt-4"},J=b({__name:"Login",props:{canResetPassword:{type:Boolean},status:{}},setup(d){const s=V({email:"",password:"",remember:!1}),n=()=>{s.post(route("login"),{onFinish:()=>{s.reset("password")}})};return(l,e)=>(m(),c(U,null,{default:i(()=>[a(o(C),{title:"Log in"}),l.status?(m(),k("div",j,B(l.status),1)):p("",!0),r("form",{onSubmit:N(n,["prevent"])},[r("div",null,[a(g,{for:"email",value:"Email"}),a(_,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:o(s).email,"onUpdate:modelValue":e[0]||(e[0]=t=>o(s).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(w,{class:"mt-2",message:o(s).errors.email},null,8,["message"])]),r("div",D,[a(g,{for:"password",value:"Password"}),a(_,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:o(s).password,"onUpdate:modelValue":e[1]||(e[1]=t=>o(s).password=t),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(w,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),r("div",E,[r("label",F,[a(R,{name:"remember",checked:o(s).remember,"onUpdate:checked":e[2]||(e[2]=t=>o(s).remember=t)},null,8,["checked"]),e[3]||(e[3]=r("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1))])]),r("div",G,[l.canResetPassword?(m(),c(o($),{key:0,href:l.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:i(()=>e[4]||(e[4]=[f(" Forgot your password? ")])),_:1},8,["href"])):p("",!0),a(q,{class:P(["ms-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:i(()=>e[5]||(e[5]=[f(" Log in ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{J as default};
