import{d as v,o as r,g as l,b as e,t as u,a as g,w as h,e as m,i as D,m as w,h as $,n as y,j as F,H as V,F as _,p as C,c as f,u as x,I as j,Z as S,k as b}from"./app-BgzXHyT0.js";import{E as k}from"./Emoji-RnlleTvG.js";import{_ as B}from"./TextInput.vue_vue_type_script_setup_true_lang-C2IawAid.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const L={class:"flex items-center justify-between py-4 pl-3 pr-4 text-sm relative"},N={class:"absolute text-gray-500 transform -translate-y-5 scale-75 top-2 z-10 origin-[0] bg-gray-50 px-2 peer-placeholder-shown:scale-100 start-1"},A={class:"ml-4 flex-shrink-0"},E={key:0,class:"font-medium text-gray-900"},H={key:1,class:"font-medium text-gray-400"},I=v({__name:"SubmissionItem",props:{month:{},destination:{}},setup(p){return(a,i)=>(r(),l("li",L,[e("span",N,u(a.month),1),e("div",A,[a.destination?(r(),l("p",E,[g(k,null,{default:h(()=>[m(u(a.destination.emoji),1)]),_:1}),m(" "+u(a.destination.name),1)])):(r(),l("p",H,[g(k,null,{default:h(()=>i[0]||(i[0]=[m("🏳️")])),_:1}),i[1]||(i[1]=m(" - "))]))])]))}}),J={class:"relative bg-white shadow overflow-hidden sm:rounded-lg"},z={class:"absolute top-1 right-2"},M={class:"inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-sky-900 text-gray-100"},T={class:"flex flex-row items-center px-4 py-5 sm:px-6"},W=["src"],G={class:"px-4 py-5 sm:px-6 overflow-hidden"},O={class:"text-lg font-medium leading-6 truncate text-gray-900"},R={key:0,class:"mt-1 max-w-2xl text-sm text-gray-500 truncate"},U={class:"border-t border-gray-200"},Z={class:"text-sm text-gray-900 sm:col-span-2"},q={role:"list",class:"divide-y divide-gray-200 rounded-md border border-gray-200 mx-4"},K=v({__name:"SubmissionCard",props:{nickname:{},username:{},avatar:{},submissions:{}},setup(p){const a=p,i=["January","February","March","April","May","June","July","August","September","October","November","December"],c=D(()=>i.map(s=>{var d;const t=(d=a.submissions)==null?void 0:d.find(o=>o.month===s);return{month:s,submission:t==null?void 0:t.destination}})),n=w(!1);return(s,t)=>{var d;return r(),l("div",{class:y(["transition",n.value?"row-span-4":null])},[e("div",J,[e("div",z,[e("span",M,u(((d=a.submissions)==null?void 0:d.length)??0)+" / 12 ",1)]),e("div",T,[e("img",{src:a.avatar,alt:"",class:"h-16 w-16 my-4 rounded-full ring-1 ring-gray-900"},null,8,W),e("div",G,[e("h3",O,u(a.nickname??a.username),1),a.nickname?(r(),l("p",R,u(a.username),1)):$("",!0)])]),e("div",U,[e("dl",null,[e("div",{class:y(["bg-gray-50",n.value?"pb-4":null])},[e("button",{onClick:t[0]||(t[0]=o=>n.value=!n.value),class:"text-sm font-medium w-full py-5 text-gray-500"},u(n.value?"- Hide":"+ Show")+" Submissions ",1),e("dd",Z,[F(e("ul",q,[(r(!0),l(_,null,C(c.value,o=>(r(),f(I,{month:o.month,destination:o==null?void 0:o.submission,key:o.month},null,8,["month","destination"]))),128))],512),[[V,n.value]])])],2)])])])],2)}}}),P={class:"bg-gray-50"},Q={class:"relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white"},X={class:"relative w-full max-w-2xl px-6 lg:max-w-7xl"},Y={class:"grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"},ee={class:"flex lg:justify-start lg:col-start-1"},se={key:0,class:"-mx-3 flex flex-1 justify-end"},te={class:"mt-6"},ae={class:"grid gap-6 grid-cols-2 lg:grid-cols-4 auto-rows-auto grid-flow-dense"},ie=v({__name:"Home",props:{canLogin:{type:Boolean},canRegister:{type:Boolean},contestants:{}},setup(p){const a=p;function i(){return a.contestants?a.contestants.filter(n=>{var t,d,o;if(c.value.length===0)return!0;const s=c.value.toLowerCase();if((t=n.nickname)!=null&&t.toLowerCase().includes(s)||(d=n.username)!=null&&d.toLowerCase().includes(s)||(o=n.discord_id)!=null&&o.toString().includes(s))return!0}):[]}const c=w("");return(n,s)=>(r(),l(_,null,[g(x(S),{title:"Welcome"}),e("div",P,[e("div",Q,[e("div",X,[e("header",Y,[e("div",ee,[g(B,{modelValue:c.value,"onUpdate:modelValue":s[0]||(s[0]=t=>c.value=t),placeholder:"Search by nickname, username, or Discord ID",class:"w-full"},null,8,["modelValue"])]),s[3]||(s[3]=e("div",{class:"flex lg:justify-center lg:col-start-2"}," Wanderlust Globetrotter 2024 ",-1)),n.canLogin?(r(),l("nav",se,[n.$page.props.auth.user?(r(),f(x(b),{key:0,href:n.route("dashboard"),class:"rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"},{default:h(()=>s[1]||(s[1]=[m(" Dashboard ")])),_:1},8,["href"])):(r(),f(x(b),{key:1,href:n.route("login"),class:"rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"},{default:h(()=>s[2]||(s[2]=[m(" Admin ")])),_:1},8,["href"]))])):$("",!0)]),e("main",te,[e("div",ae,[(r(!0),l(_,null,C(i(),t=>(r(),f(K,{key:t.id,nickname:t.nickname,username:t.username,avatar:t.avatar,submissions:t.submissions},null,8,["nickname","username","avatar","submissions"]))),128))])]),s[4]||(s[4]=j('<footer class="py-16 text-center text-sm text-black"> Built by <a href="https://github.com/cnettelblad" class="text-black font-bold">Carl</a> with <a href="https://vuejs.org/" class="text-teal-600 font-bold">Vue</a>, <a href="https://laravel.com/" class="text-red-400 font-bold">Laravel</a> and <a href="https://tailwindcss.com/" class="text-blue-600 font-bold">Tailwind CSS</a>. </footer>',1))])])])],64))}});export{ie as default};
