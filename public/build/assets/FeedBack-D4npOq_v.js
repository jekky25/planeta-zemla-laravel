import{M as C}from"./MainLayout-BivB0Q3v.js";import{f as r,o as i,r as v,j,i as _,k as M,h as T,v as I,l as d,b as o,a as n,P as S,w as h,e as f,g as x,p as w,d as L,F as B}from"./app-DBkbaeVX.js";import{G as E}from"./GoogleCaptcha-CLVF2FOr.js";import{_ as b}from"./_plugin-vue_export-helper-DlAUqK2U.js";const N={},U={class:"button validate bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",type:"submit"};function z(s,e){return i(),r("button",U,[v(s.$slots,"default")])}const F=b(N,[["render",z]]),P=["value"],y={__name:"TextInput",props:{modelValue:{type:String}},emits:["update:modelValue"],setup(s){return(e,u)=>(i(),r("input",{size:"30",class:"shadow appearance-none border inputbox rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",value:s.modelValue,onInput:u[0]||(u[0]=l=>e.$emit("update:modelValue",l.target.value))},null,40,P))}},G={__name:"Textarea",props:{modelValue:{type:String,required:!0},modelModifiers:{}},emits:["update:modelValue"],setup(s){const e=j(s,"modelValue");return(u,l)=>_((i(),r("textarea",{class:"inputbox required rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-transparent focus:border-transparent","onUpdate:modelValue":l[0]||(l[0]=t=>e.value=t)},null,512)),[[M,e.value]])}},H=["value"],q={__name:"Checkbox",props:{checked:{type:[Array,Boolean],required:!0},value:{default:null}},emits:["update:checked"],setup(s,{emit:e}){const u=e,l=s,t=T({get(){return l.checked},set(c){u("update:checked",c)}});return(c,p)=>_((i(),r("input",{type:"checkbox",value:s.value,"onUpdate:modelValue":p[0]||(p[0]=m=>t.value=m),class:"mr-2 border inputbox rounded focus:text-blue-600 ring-offset-0"},null,8,H)),[[I,t.value]])}},D={name:"LabelInput",components:{TextInput:y},data(){return{inputName:"",data:Object}},props:{id:{type:String,default:null},type:{type:String,default:null},name:{type:String,default:null},model:{type:String,default:null}},methods:{get(){return this.inputName}}},O={class:"mb-4"},R=["for"];function A(s,e,u,l,t,c){const p=d("TextInput");return i(),r("div",O,[o("label",{for:this.id},[v(s.$slots,"default")],8,R),e[1]||(e[1]=o("br",null,null,-1)),n(p,{modelValue:t.inputName,"onUpdate:modelValue":e[0]||(e[0]=m=>t.inputName=m),type:this.type,name:this.name,id:this.id,ref:"InputField"},null,8,["modelValue","type","name","id"])])}const J=b(D,[["render",A]]),K={name:"Page",components:{Link:S,GoogleCaptcha:E,SubmitButton:F,TextInput:y,Textarea:G,Checkbox:q,LabelInput:J},layout:C,props:[],data(){return{errors:"",success:"",regexpEmail:/^(?:[a-z0-9._]+(?:[-_.]?[a-z0-9._]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i,name:"",subject:"",email:"",message:"",proba:"",recaptcha_response:"",visible:!0,data:Object}},methods:{clearParams(){this.$data.errors="",this.$data.success=""},reloadCaptcha(){this.$refs.googleCaptcha.initReCaptcha()},checkName(){this.$refs.name.get().length<2&&(this.$data.errors+="<p>Имя не введено</p>")},checkEMail(){this.$refs.email.get().match(this.$data.regexpEmail)||(this.$data.errors+="<p>Некорректно введен е-майл</p>")},checkSubject(){this.$refs.subject.get().length<2&&(this.$data.errors+="<p>Тема не введена</p>")},checkMessage(){this.message.length<2&&(this.$data.errors+="<p>Не введено сообщение</p>")},isError(){return this.$data.errors!=""},getData(){this.$data.name=this.$refs.name.get(),this.$data.email=this.$refs.email.get(),this.$data.subject=this.$refs.subject.get(),this.$data.message=document.getElementById("contact_message").value,this.$data._token=this.csrf_field,this.recaptcha_response=document.getElementById("recaptchaResponse").value},send(){return this.clearParams(),this.checkName(),this.checkSubject(),this.checkEMail(),this.checkMessage(),this.isError()||(this.getData(),this.ajax()),!1},ajax(){return axios.post(route("feedback",this.$data)).then(s=>{s.data.success==1&&(this.success="<p>Ваше сообщение было успешно отправлено!</p>",this.reloadCaptcha(),this.$data.visible=!1)}).catch(s=>{this.$data.errors+="<p>"+s.response.data.message+"</p>",this.reloadCaptcha()}),!1}}},Q={id:"component-contact"},W={class:"contentheading"},X={width:"100%",cellpadding:"0",cellspacing:"0",border:"0",class:"contentpaneopen"},Y={colspan:"2"},Z={action:"javascript:void(null);",method:"post",name:"emailForm",id:"emailForm",class:"form-validate"},ee=["value"],te=["innerHTML"],se=["innerHTML"],oe={class:"contact_email"},ae={class:"mb-4"},ne={class:"mb-4"};function le(s,e,u,l,t,c){const p=d("Link"),m=d("GoogleCaptcha"),g=d("LabelInput"),k=d("Textarea"),$=d("Checkbox"),V=d("SubmitButton");return i(),r(B,null,[e[15]||(e[15]=o("div",{class:"componentheading"},null,-1)),o("div",Q,[e[14]||(e[14]=o("div",{class:"componentheading"},null,-1)),o("h2",W,[n(p,{href:s.route("feedback"),class:"contentpagetitle"},{default:h(()=>e[6]||(e[6]=[f("Обратная связь")])),_:1},8,["href"])]),o("table",X,[o("tr",null,[o("td",Y,[o("form",Z,[o("input",{type:"hidden",name:"_token",autocomplete:"off",value:s.$attrs.csrf_field},null,8,ee),t.success?(i(),r("div",{key:0,class:"success-text",innerHTML:t.success},null,8,te)):x("",!0),t.errors?(i(),r("div",{key:1,class:"error-text",innerHTML:t.errors},null,8,se)):x("",!0),n(m,{ref:"googleCaptcha"},null,512),_(o("div",oe,[n(g,{ref:"name",modelValue:t.name,"onUpdate:modelValue":e[0]||(e[0]=a=>t.name=a),type:"text",name:"name",id:"contact_name"},{default:h(()=>e[7]||(e[7]=[f(" Введите ваше имя:")])),_:1},8,["modelValue"]),n(g,{ref:"email",modelValue:t.email,"onUpdate:modelValue":e[1]||(e[1]=a=>t.email=a),type:"text",name:"name",id:"contact_email"},{default:h(()=>e[8]||(e[8]=[f(" E-mail адрес:")])),_:1},8,["modelValue"]),n(g,{ref:"subject",modelValue:t.subject,"onUpdate:modelValue":e[2]||(e[2]=a=>t.subject=a),type:"text",name:"subject",id:"contact_subject"},{default:h(()=>e[9]||(e[9]=[f(" Тема сообщения:")])),_:1},8,["modelValue"]),o("div",ae,[e[10]||(e[10]=o("label",{id:"contact_textmsg",for:"contact_text"}," Введите текст вашего сообщения:",-1)),e[11]||(e[11]=o("br",null,null,-1)),n(k,{modelValue:t.message,"onUpdate:modelValue":e[3]||(e[3]=a=>t.message=a),cols:"50",rows:"10",name:t.message,id:"contact_message"},null,8,["modelValue","name"])]),o("div",ne,[n($,{name:"copy",modelValue:s.copy,"onUpdate:modelValue":e[4]||(e[4]=a=>s.copy=a),id:"contact_email_copy",value:"1"},null,8,["modelValue"]),e[12]||(e[12]=o("label",{for:"contact_email_copy"},"Отправить копию этого сообщения на ваш адрес",-1))]),o("div",null,[n(V,{onClick:e[5]||(e[5]=L(a=>{c.send()},["prevent"]))},{default:h(()=>e[13]||(e[13]=[f("Отправить")])),_:1})])],512),[[w,t.visible]])])])])])])],64)}const pe=b(K,[["render",le]]);export{pe as default};
