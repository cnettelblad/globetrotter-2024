import{d as n,B as r,m as d,q as i,j as m,y as c,g as f,o as p}from"./app-BgzXHyT0.js";const _=n({__name:"TextInput",props:{modelValue:{required:!0},modelModifiers:{}},emits:["update:modelValue"],setup(t,{expose:a}){const s=r(t,"modelValue"),u=d(null);return i(()=>{var e,o;(e=u.value)!=null&&e.hasAttribute("autofocus")&&((o=u.value)==null||o.focus())}),a({focus:()=>{var e;return(e=u.value)==null?void 0:e.focus()}}),(e,o)=>m((p(),f("input",{class:"border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm","onUpdate:modelValue":o[0]||(o[0]=l=>s.value=l),ref_key:"input",ref:u},null,512)),[[c,s.value]])}});export{_};
