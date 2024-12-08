import{_ as l}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{o,g as r,r as a,b as n,d as p,c as $,w as u,a as h,t as f,h as v,u as d,k as g,m as y,q as b,s as w,j as _,H as m}from"./app-BgzXHyT0.js";const x={},k={class:"w-full text-sm text-left text-gray-500"};function C(t,e){return o(),r("table",k,[a(t.$slots,"header"),n("tbody",null,[a(t.$slots,"default")]),a(t.$slots,"footer")])}const J=l(x,[["render",C]]),T={},z={scope:"col",class:"text-xs text-gray-700 uppercase bg-gray-50"};function B(t,e){return o(),r("thead",z,[n("tr",null,[a(t.$slots,"default")])])}const K=l(T,[["render",B]]),E={},M={scope:"col",class:"px-4 py-3"};function H(t,e){return o(),r("th",M,[a(t.$slots,"default")])}const P=l(E,[["render",H]]),N={},S={class:"border-b border-gray-200"};function V(t,e){return o(),r("tr",S,[a(t.$slots,"default")])}const Q=l(N,[["render",V]]),A={},D={class:"px-4 py-3"};function L(t,e){return o(),r("td",D,[a(t.$slots,"default")])}const O=l(A,[["render",L]]),j=["src"],q={class:"text-gray-900"},R={key:0,class:"text-gray-500 text-xs"},W=p({__name:"ContestantCell",props:{contestant:{}},setup(t){return(e,c)=>(o(),$(O,null,{default:u(()=>[h(d(g),{class:"flex items-center gap-2",href:e.route("contestants.edit",e.contestant.id)},{default:u(()=>[n("img",{src:e.contestant.avatar,alt:"Avatar",class:"h-8 w-8 rounded-md"},null,8,j),n("strong",q,f(e.contestant.nickname??e.contestant.username),1),e.contestant.nickname?(o(),r("span",R,f(e.contestant.username),1)):v("",!0)]),_:1},8,["href"])]),_:1}))}});function U(t=!1){const e=y(t),c=s=>{e&&s.key==="Escape"&&(e.value=!1)};return b(()=>document.addEventListener("keydown",c)),w(()=>document.removeEventListener("keydown",c)),e}const F={class:"relative"},X=p({__name:"TableActions",setup(t){const e=U();return(c,s)=>(o(),r("div",F,[n("button",{class:"inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none",type:"button",onClick:s[0]||(s[0]=i=>e.value=!d(e))},s[3]||(s[3]=[n("svg",{class:"w-5 h-5","aria-hidden":"true",fill:"currentColor",viewbox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[n("path",{d:"M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"})],-1)])),_(n("div",{class:"fixed inset-0 z-10",onClick:s[1]||(s[1]=i=>e.value=!1)},null,512),[[m,d(e)]]),_(n("div",{class:"absolute z-20 left-auto right-0 w-44 bg-white rounded divide-y divide-gray-100 shadow",onClick:s[2]||(s[2]=i=>e.value=!1)},[a(c.$slots,"default")],512),[[m,d(e)]])]))}});export{O as T,X as _,K as a,P as b,W as c,Q as d,J as e};
