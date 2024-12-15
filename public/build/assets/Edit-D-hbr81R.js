import{d as V,T as h,m as p,g as f,a as e,u as l,w as i,F as $,o as b,Z as y,b as t,f as C,e as _,h as x}from"./app-EfI8tAPd.js";import{_ as N}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-Dc-SQWBO.js";import{G as v}from"./GradientButton-CHDTSXkY.js";import{_ as d}from"./TextInput.vue_vue_type_script_setup_true_lang-dHWUsbGo.js";import{_ as m,a as S}from"./InputLabel.vue_vue_type_script_setup_true_lang-CAHAGpzW.js";import{_ as U}from"./ContestantSubmisssionsTable.vue_vue_type_script_setup_true_lang-TEz5gySy.js";import{_ as B}from"./AddSubmissionForm.vue_vue_type_script_setup_true_lang-C4u_6xUC.js";import"./toast-B0inzv-z.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./TableActions.vue_vue_type_script_setup_true_lang-Cbbqj2YG.js";import"./SubmissionActionsCell.vue_vue_type_script_setup_true_lang-D1IJzEHf.js";import"./EditSubmissionForm.vue_vue_type_script_setup_true_lang-BhTCKo76.js";import"./CountryTypeahead.vue_vue_type_script_setup_true_lang-D2-6dmh3.js";import"./Emoji-BtpdRTQV.js";import"./Dropdown.vue_vue_type_script_setup_true_lang-CT7jl1uk.js";const E={class:"py-8"},F={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},A={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},D={class:"flex gap-4"},G=["src"],T={class:"columns-1 sm:columns-2"},j={class:"flex justify-between items-center"},I={key:0,class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},M={class:"bg-white shadow sm:rounded-lg"},es=V({__name:"Edit",props:{contestant:{}},setup(w){const u=w,a=h({nickname:u.contestant.nickname??""}),g=()=>{a.put(route("contestants.update",u.contestant.id),{onSuccess:()=>{a.reset()},replace:!0,preserveScroll:!0})},k=p(!0),r=p(!1);return(o,s)=>(b(),f($,null,[e(l(y),{title:`Editing ${o.contestant.username}`},null,8,["title"]),e(N,null,{default:i(()=>{var c;return[t("div",E,[t("div",F,[s[8]||(s[8]=t("h2",{class:"text-xl"},"Contestant",-1)),t("section",A,[t("div",D,[t("img",{src:o.contestant.avatar,alt:"avatar",class:"w-24 h-24 rounded-lg shadow-md"},null,8,G),t("form",{onSubmit:C(g,["prevent"]),class:"space-y-6 grow"},[t("div",null,[e(m,{for:"nickname",value:"Nickname"}),e(d,{modelValue:l(a).nickname,"onUpdate:modelValue":s[0]||(s[0]=n=>l(a).nickname=n),id:"nickname",label:"Nickname",name:"nickname",class:"mt-1 block w-full",error:l(a).errors.nickname},null,8,["modelValue","error"]),e(S,{error:l(a).errors.nickname},null,8,["error"])]),t("div",T,[e(m,{for:"username",value:"Username"}),e(d,{id:"username",label:"username",name:"username",class:"mt-1 block w-full bg-gray-100 cursor-not-allowed",modelValue:o.contestant.username,"onUpdate:modelValue":s[1]||(s[1]=n=>o.contestant.username=n),disabled:!0},null,8,["modelValue"]),e(m,{for:"discord_id",value:"Discord ID"}),e(d,{id:"discord_id",label:"discord_id",name:"discord_id",class:"mt-1 block w-full bg-gray-100 cursor-not-allowed",modelValue:o.contestant.discord_id,"onUpdate:modelValue":s[2]||(s[2]=n=>o.contestant.discord_id=n),disabled:!0},null,8,["modelValue"])]),e(v,{disabled:!k.value},{default:i(()=>s[5]||(s[5]=[_(" Update ")])),_:1},8,["disabled"])],32)])]),t("div",j,[s[7]||(s[7]=t("h2",{class:"text-xl"},"Submissions",-1)),e(v,{onClick:s[3]||(s[3]=n=>r.value=!r.value)},{default:i(()=>s[6]||(s[6]=[_(" Add Submission ")])),_:1})]),r.value?(b(),f("div",I,[e(B,{contestant:o.contestant,"disabled-months":(c=o.contestant.submissions)==null?void 0:c.map(n=>n.month),onClose:s[4]||(s[4]=n=>r.value=!1)},null,8,["contestant","disabled-months"])])):x("",!0),t("div",M,[e(U,{submissions:o.contestant.submissions??[]},null,8,["submissions"])])])])]}),_:1})],64))}});export{es as default};
