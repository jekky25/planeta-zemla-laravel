import{f as o,o as n,b as e,g as m,F as r,j as h,r as f,t as a,e as p}from"./app-Da72fLSE.js";import{_ as l}from"./_plugin-vue_export-helper-DlAUqK2U.js";const v={name:"MainLayout",data(){return{menuH:[],errors:null}},mounted(){this.getMenuH()},methods:{getMenuH(){return axios.get("/api/get/menu_h").then(t=>{this.menuH=t.data}).catch(t=>{this.errors=t}),!1}}},g={id:"overhtm"},k={id:"overhtm1"},y={id:"overhtm2"},$={id:"header"},b=["href"],H={key:0,id:"hmenu"},x={class:"moduletable_menu"},M={class:"menu"},B={key:0,class:"item{{ item.id }}"},L=["href"],N={key:1,class:"item{{ item.id }}"},P=["href"],V={class:"main"},w={class:"main1 clearfix"},A={id:"main_content",class:"clearfix"},F={id:"main_content1"},S={id:"footer"},j={id:"feedback"},C={class:"moduletable"},D={class:"menu"},E={class:"item3"},I=["href"];function T(t,s,u,_,i,c){return n(),o("div",g,[e("div",k,[e("div",y,[e("div",$,[e("h1",null,[e("a",{href:t.route("home"),title:"На главную"},s[0]||(s[0]=[e("img",{alt:"На главную",src:"../images/logo.png"},null,-1)]),8,b)])]),i.menuH?(n(),o("div",H,[e("div",x,[e("ul",M,[(n(!0),o(r,null,h(i.menuH,d=>(n(),o(r,null,[d.home==!0?(n(),o("li",B,[e("a",{href:t.route("home")},[e("span",null,a(d.name),1)],8,L)])):(n(),o("li",N,[e("a",{href:t.route("category.name",d.slug)},[e("span",null,a(d.name),1)],8,P)]))],64))),256))])])])):m("",!0),e("div",V,[e("div",w,[e("div",A,[e("div",F,[f(t.$slots,"default")])])])]),e("div",S,[s[2]||(s[2]=e("div",{id:"rights"},[e("p",null,"копирование материалов разрешено только с установкой обратной ссылки на наш сайт"),e("p",null,"© 2010 все права защищены")],-1)),e("div",j,[e("div",C,[e("ul",D,[e("li",E,[e("a",{href:t.route("feedback")},s[1]||(s[1]=[e("span",null,"Обратная связь",-1)]),8,I)])])])]),s[3]||(s[3]=e("div",{id:"counters"},null,-1))])])])])}const q=l(v,[["render",T]]),z={name:"Index",layout:q,props:["Posts"]};function G(t,s,u,_,i,c){return n(),o("div",null,s[0]||(s[0]=[e("link",{class:"bg-sky-500 rounded-full text-white"},null,-1),p("Add Post222dasdadfdsdsfdsfdsf "),e("a",{href:"3333",class:"bg-sky-500 rounded-full text-white"},"Add Post222dasdadfdsdsfdsfdsf",-1)]))}const O=l(z,[["render",G]]);export{O as default};
