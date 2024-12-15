import{d as v,T as b,i as h,g as u,b as o,t as V,a as t,u as a,w as c,l as y,f as S,o as p,e as x,h as M}from"./app-EfI8tAPd.js";import{a as l,_ as r}from"./InputLabel.vue_vue_type_script_setup_true_lang-CAHAGpzW.js";import{_ as w}from"./Dropdown.vue_vue_type_script_setup_true_lang-CT7jl1uk.js";import{_ as N,I as k}from"./CountryTypeahead.vue_vue_type_script_setup_true_lang-D2-6dmh3.js";import{G as A}from"./GradientButton-CHDTSXkY.js";import{t as B}from"./toast-B0inzv-z.js";const T={class:"text-lg font-medium text-gray-900"},U={class:"grid md:grid-cols-2 md:gap-6"},$={class:"flex items-center gap-4"},C={key:0,class:"text-sm text-gray-600"},G=v({__name:"AddSubmissionForm",props:{contestant:{},disabledMonths:{}},setup(f){var d;const m=f,e=b({contestant:(d=m.contestant)==null?void 0:d.id,month:"",destination:"",image:null}),g=h(()=>["January","February","March","April","May","June","July","August","September","October","November","December"].filter(i=>{var s;return!((s=m.disabledMonths)!=null&&s.includes(i))})),_=()=>{e.post(route("contestants.submissions.store",{contestant:e.contestant}),{preserveScroll:!0,onSuccess:()=>{e.reset("month","destination","image"),B.addToast("Submission added","success")},onError:()=>{}})};return(i,s)=>(p(),u("section",null,[o("header",null,[o("h2",T," Add a submission to "+V(i.contestant.username),1)]),o("form",{onSubmit:S(_,["prevent"]),class:"mt-6 space-y-6"},[o("div",U,[o("div",null,[t(r,{for:"destination",value:"Destination",required:""}),t(N,{modelValue:a(e).destination,"onUpdate:modelValue":s[0]||(s[0]=n=>a(e).destination=n),class:"w-full"},null,8,["modelValue"]),t(l,{message:a(e).errors.destination,class:"mt-2"},null,8,["message"])]),o("div",null,[t(r,{for:"month",value:"Month",required:""}),t(w,{id:"month",modelValue:a(e).month,"onUpdate:modelValue":s[1]||(s[1]=n=>a(e).month=n),options:g.value,class:"mt-1 block w-full"},null,8,["modelValue","options"]),t(l,{message:a(e).errors.month,class:"mt-2"},null,8,["message"])])]),o("div",null,[t(r,{for:"image",value:"Image"}),t(k,{modelValue:a(e).image,"onUpdate:modelValue":s[2]||(s[2]=n=>a(e).image=n),class:"mt-1"},null,8,["modelValue"]),t(l,{message:a(e).errors.image,class:"mt-2"},null,8,["message"])]),o("div",$,[t(A,{disabled:a(e).processing},{default:c(()=>s[3]||(s[3]=[x("Save")])),_:1},8,["disabled"]),t(y,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:c(()=>[a(e).recentlySuccessful?(p(),u("p",C," Saved. ")):M("",!0)]),_:1})])],32)]))}});export{G as _};