import{d as f,T as c,c as w,w as n,o as _,a as o,u as s,Z as g,b as l,e as d,k as V,n as v,f as y}from"./app-BgzXHyT0.js";import{_ as b}from"./GuestLayout.vue_vue_type_script_setup_true_lang-DLKNSFcv.js";import{_ as t,a as m}from"./InputLabel.vue_vue_type_script_setup_true_lang-LXHF5S7j.js";import{P as x}from"./PrimaryButton-ByWfOpmU.js";import{_ as i}from"./TextInput.vue_vue_type_script_setup_true_lang-C2IawAid.js";import"./ApplicationLogo-CWuFB-ws.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const k={class:"mt-4"},q={class:"mt-4"},B={class:"mt-4"},C={class:"flex items-center justify-end mt-4"},A=f({__name:"Register",setup(N){const e=c({name:"",email:"",password:"",password_confirmation:""}),u=()=>{e.post(route("register"),{onFinish:()=>{e.reset("password","password_confirmation")}})};return(p,a)=>(_(),w(b,null,{default:n(()=>[o(s(g),{title:"Register"}),l("form",{onSubmit:y(u,["prevent"])},[l("div",null,[o(t,{for:"name",value:"Name"}),o(i,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).name=r),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),o(m,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),l("div",k,[o(t,{for:"email",value:"Email"}),o(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).email=r),required:"",autocomplete:"username"},null,8,["modelValue"]),o(m,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),l("div",q,[o(t,{for:"password",value:"Password"}),o(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[2]||(a[2]=r=>s(e).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),l("div",B,[o(t,{for:"password_confirmation",value:"Confirm Password"}),o(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=r=>s(e).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),l("div",C,[o(s(V),{href:p.route("login"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:n(()=>a[4]||(a[4]=[d(" Already registered? ")])),_:1},8,["href"]),o(x,{class:v(["ms-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>a[5]||(a[5]=[d(" Register ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{A as default};
