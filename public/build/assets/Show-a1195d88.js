import{_ as c}from"./AppLayout-1341f1ba.js";import p from"./DeleteUserForm-767ce680.js";import l from"./LogoutOtherBrowserSessionsForm-db7bbc1f.js";import{S as s}from"./SectionBorder-4421dcd0.js";import f from"./TwoFactorAuthenticationForm-45522952.js";import u from"./UpdatePasswordForm-1fbfcccf.js";import _ from"./UpdateProfileInformationForm-d6287a13.js";import{o,c as d,w as n,a as i,e as r,b as t,f as a,F as h}from"./app-0b70888d.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./DialogModal-dd96b96c.js";import"./SectionTitle-de6e6830.js";import"./DangerButton-29e84974.js";import"./TextInput-872ff77a.js";import"./SecondaryButton-40264881.js";import"./ActionMessage-701a8bd5.js";import"./PrimaryButton-333a973e.js";import"./InputLabel-fa74e6c8.js";import"./FormSection-dd563f50.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},z={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,x)=>(o(),d(c,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(h,{key:3},[t(s),t(p,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{z as default};
