import{d as c,C as p,i as g,c as y,w as o,o as a,a as i,u as t,m as v,b as n,g as b,h as x,e as r,n as h,P as k,f as _}from"./app-DTqmi5Mx.js";import{_ as w}from"./GuestLayout.vue_vue_type_script_setup_true_lang-DNtYCPdI.js";import{P as V}from"./PrimaryButton-DnFLY9TC.js";import"./ApplicationLogo-CXSGmcd3.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const B={key:0,class:"mb-4 font-medium text-sm text-green-600"},C={class:"mt-4 flex items-center justify-between"},S=c({__name:"VerifyEmail",props:{status:{}},setup(d){const l=d,s=p({}),m=()=>{s.post(route("verification.send"))},u=g(()=>l.status==="verification-link-sent");return(f,e)=>(a(),y(w,null,{default:o(()=>[i(t(v),{title:"Email Verification"}),e[2]||(e[2]=n("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1)),u.value?(a(),b("div",B," A new verification link has been sent to the email address you provided during registration. ")):x("",!0),n("form",{onSubmit:_(m,["prevent"])},[n("div",C,[i(V,{class:h({"opacity-25":t(s).processing}),disabled:t(s).processing},{default:o(()=>e[0]||(e[0]=[r(" Resend Verification Email ")])),_:1},8,["class","disabled"]),i(t(k),{href:f.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:o(()=>e[1]||(e[1]=[r("Log Out")])),_:1},8,["href"])])],32)]),_:1}))}});export{S as default};
