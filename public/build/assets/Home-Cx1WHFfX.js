import{M as h}from"./MainLayout-CvKgPRd7.js";import{P as k,j as y,f as n,o as t,g as i,t as d,b as l,F as m,k as _,c as g,w as c,e as u,a as f}from"./app-ChSpXaRD.js";import{_ as L}from"./_plugin-vue_export-helper-DlAUqK2U.js";const b={name:"Index",components:{Link:k},layout:h,props:["posts","pagination"],data(){return{errors:null}}},v={key:0},M={key:1},H={key:2,class:"blog",cellpadding:"0",cellspacing:"0"},T={valign:"top"},p={class:"contentpaneopen"},B={class:"contentheading"},N={class:"article-content"},V=["innerHTML"],C={key:0,class:"jcomments-links"},j={key:0},w={valign:"top",align:"center"},F={class:"pagination"},P=["innerHTML"],$={key:1};function x(a,s,r,D,E,I){const o=y("Link");return t(),n(m,null,[a.category?(t(),n("h2",v,d(a.$category.title),1)):(t(),n("h2",M,"Главная")),r.posts?(t(),n("table",H,[l("tr",T,[l("td",null,[(t(!0),n(m,null,_(r.posts,e=>(t(),n("div",null,[l("div",p,[l("h2",B,[e.category?(t(),g(o,{key:0,href:a.route("item.name",[e.category.slug,e.id,e.slug]),class:"contentpagetitle"},{default:c(()=>[u(d(e.title),1)]),_:2},1032,["href"])):i("",!0)]),l("div",N,[l("span",{innerHTML:e.introtext},null,8,V),e.category?(t(),n("div",C,[f(o,{class:"readmore-link",href:a.route("item.name",[e.category.slug,e.id,e.slug]),title:e.title},{default:c(()=>s[0]||(s[0]=[u("Подробнее...")])),_:2},1032,["href","title"]),e.comments.length>0?(t(),g(o,{key:0,href:`${a.route("item.name",[e.category.slug,e.id,e.slug])}#comments`,class:"comments-link"},{default:c(()=>[u("Комментарии ("+d(e.comments.length)+")",1)]),_:2},1032,["href"])):(t(),g(o,{key:1,href:`${a.route("item.name",[e.category.slug,e.id,e.slug])}#addcomments`,class:"comments-link"},{default:c(()=>s[1]||(s[1]=[u("Добавить комментарий")])),_:2},1032,["href"]))])):i("",!0)])]),s[2]||(s[2]=l("span",{class:"article_separator"}," ",-1))]))),256))])]),r.pagination&&r.pagination.length>3?(t(),n("tr",j,[l("td",w,[s[3]||(s[3]=l("br",null,null,-1)),s[4]||(s[4]=l("br",null,null,-1)),l("table",F,[l("tr",null,[(t(!0),n(m,null,_(r.pagination,(e,S)=>(t(),n("td",null,[e.active==1?(t(),n("span",{key:0,innerHTML:e.label},null,8,P)):(t(),n("strong",$,[f(o,{href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])]))]))),256))])])])])):i("",!0)])):i("",!0)],64)}const G=L(b,[["render",x]]);export{G as default};
