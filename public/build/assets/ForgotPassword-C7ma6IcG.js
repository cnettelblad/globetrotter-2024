import{d as u,T as d,c as p,w as r,o as m,a as t,u as a,Z as f,b as o,g as c,t as _,h as w,e as g,n as y,f as b}from"./app-EfI8tAPd.js";import{_ as k}from"./GuestLayout.vue_vue_type_script_setup_true_lang-BoIHoWM3.js";import{_ as x,a as V}from"./InputLabel.vue_vue_type_script_setup_true_lang-CAHAGpzW.js";import{P as v}from"./PrimaryButton-Bw2w2NA-.js";import{_ as B}from"./TextInput.vue_vue_type_script_setup_true_lang-dHWUsbGo.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const N={key:0,class:"mb-4 font-medium text-sm text-green-600"},P={class:"flex items-center justify-end mt-4"},j=u({__name:"ForgotPassword",props:{status:{}},setup(C){const e=d({email:""}),i=()=>{e.post(route("password.email"))};return(l,s)=>(m(),p(k,null,{default:r(()=>[t(a(f),{title:"Forgot Password"}),s[2]||(s[2]=o("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1)),l.status?(m(),c("div",N,_(l.status),1)):w("",!0),o("form",{onSubmit:b(i,["prevent"])},[o("div",null,[t(x,{for:"email",value:"Email"}),t(B,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:a(e).email,"onUpdate:modelValue":s[0]||(s[0]=n=>a(e).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(V,{class:"mt-2",message:a(e).errors.email},null,8,["message"])]),o("div",P,[t(v,{class:y({"opacity-25":a(e).processing}),disabled:a(e).processing},{default:r(()=>s[1]||(s[1]=[g(" Email Password Reset Link ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{j as default};
