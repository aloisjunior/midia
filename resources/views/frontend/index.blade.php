@extends('layouts.frontend.master')

@section('page-title', 'Akhena - Ampliando Resultados com Tecnologia')

@section('page-meta')
<meta property="og:locale" content="pt_BR" />

<link rel="canonical" href="{{route('inicio')}}" />
<meta property="og:url" content="{{route('inicio')}}" />
<meta name="twitter:domain" content="{{route('inicio')}}" />

<meta property="og:title" content="Akhena - Ampliando Resultados com Tecnologia" />
<meta name="twitter:title" content="Akhena - Ampliando Resultados com Tecnologia" />
<meta property="og:site_name" content="Akhena - Ampliando Resultados com Tecnologia" />

<meta name="description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor.">
<meta property="og:description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor." />
<meta name="twitter:description" content="A Akhena possui pontos para anúncios em Mídia Digital Indoor de alto impacto, além de produtos como Tv Corporativa, Vitrine Digital e Rádio Indoor." />
<meta property="og:type" content="website">
<meta property="fb:app_id" content="144291826259901" />

<meta property="og:image" content="{{asset('img/atonmidia/atonmidia-servicos.jpg')}}" />
<meta name="twitter:image:src" content="{{asset('img/atonmidia/atonmidia-servicos1x1.jpg')}}" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@atonmidia" />
<meta name="twitter:creator" content="@atonmidia" />
@endsection


@section('page-css')
    {{--<link rel='stylesheet' id='ls-google-fonts-css'--}}
          {{--href='https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900,400%7COpen+Sans:300,400%7CIndie+Flower:regular%7COswald:300,regular,700%7CPoppins:300,regular,500,600,700%7CYanone+Kaffeesatz:300%7CMontserrat:regular,700,900,100,200,300%7CRoboto+Slab:100,300,regular,700%7CLibre+Baskerville:regular,italic,700%7CRoboto:regular%7CRoboto+Condensed:300,regular,700:400%7CDancing+Script:regular,700%7CNunito:300,regular,200,600%7CHandlee:regular%7CPacifico:regular%7CRaleway:100,200,300,500%7CHoltwood+One+SC:regular%7CMarko+One:regular%7CCaveat:regular%7CCuprum:regular%7CSlabo+27px:regular:400%7CVarela+Round:regular%7CShadows+Into+Light+Two:regular&#038;subset=latin%2Clatin-ext'--}}
          {{--type='text/css' media='all'/>--}}

    <link rel='stylesheet' id='layerslider-css'
          href={{ getCDN('_frontend/js/plugins/layerslider/css/layerslider.css', 'cdn2') }}
          type='text/css' media='all'/>

@endsection

@section('content')
    {{--<main>--}}
    <div class="slider">
        <div id="layerslider_50" class="ls-wp-container fitvidsignore layerslider"
             style="width:1500px;height:100vh;margin:0 auto;margin-bottom: 0px;">

            {{--<div class="ls-slide" data-ls="duration:7500;kenburnsscale:1.2;">--}}
                {{--<div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:152px;" class="ls-l" data-ls="offsetxin:-300;durationin:1500;scalexin:0.5;scaleyin:0.2;offsetyout:500;durationout:400;startatout:transitioninend + 1000;easingout:easeInQuart;parallaxlevel:0;">SEMPRE</div>--}}
                {{--<div style="font-weight:100; text-align:center; text-shadow:rgba(255, 255, 255, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#1c1c1c;background:rgba(255, 255, 255, 0.68);top:468px;left:637px;" class="ls-l" data-ls="offsetxin:300;durationin:1500;scalexin:0.5;scaleyin:0.2;offsetyout:-300;durationout:400;startatout:transitioninend + 5000;easingout:easeInQuart;parallaxlevel:0;">INOVANDO</div>--}}
                {{--<div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:152px;" class="ls-l" data-ls="offsetyin:-300;durationin:1500;delayin:2000;scalexin:0.5;scaleyin:0.2;offsetyout:500;durationout:400;startatout:transitioninend + 1000;easingout:easeInQuart;parallaxlevel:0;">SUA MARCA</div>--}}
                {{--<div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:82px;" class="ls-l" data-ls="offsetyin:-300;durationin:1500;delayin:4000;scalexin:0.5;scaleyin:0.2;offsetxout:-80;durationout:400;parallaxlevel:0;">SEU PRODUTO</div>--}}
                {{--<div style="font-weight:100; text-align:center; text-shadow:rgba(255, 255, 255, 0.4) -1px 1px;width:554px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#1c1c1c;background:rgba(255, 255, 255, 0.68);top:468px;left:637px;" class="ls-l" data-ls="offsetyin:300;durationin:1500;delayin:6000;scalexin:0.5;scaleyin:0.2;offsetxout:200;durationout:400;rotateout:90;rotatexout:180;scalexout:0.3;scaleyout:0.3;parallaxlevel:0;">SENDO VISTO</div>--}}
            {{--</div>--}}
            <div class="ls-slide"
                 data-ls="bgcolor:#000000;kenburnsscale:1.2;parallaxtype:3d;parallaxaxis:x;parallaxrotate:-10;">
                <div style="top:0px;left:0px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;width:100%;height:100%;opacity:1;background:#ffffff;"
                     class="ls-l"
                     data-ls="offsetyin:-100%;fadein:false;offsetxout:-100sw;durationout:1;startatout:transitioninend + 5000;easingout:easeInExpo;fadeout:false;position:fixed;"></div>



                <div style="background: rgba(0,0,0,1); background: -moz-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(92,107,63,1) 100%); background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0,0,0,1)), color-stop(100%, rgba(92,107,63,1))); background: -webkit-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(92,107,63,1) 100%); background: -o-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(92,107,63,1) 100%); background: -ms-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(92,107,63,1) 100%); background: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(92,107,63,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#5c6b3f', GradientType=0 );top:0px;left:0px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;width:100%;height:100%;opacity:1;"
                     class="ls-l"
                     data-ls="offsetyin:-100%;delayin:4600;fadein:false;offsetxout:-100sw;easingout:easeInExpo;fadeout:false;position:fixed;"></div>
                <div style="background: rgba(0,0,0,.5);top:0px;left:0px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;width:100%;height:100%;opacity:1;"
                     class="ls-l"
                     data-ls="offsetyin:-100%;delayin:4600;fadein:false;offsetxout:-100sw;easingout:easeInExpo;fadeout:false;position:fixed;"></div>
                <p style="top:40%;left:50%;text-align:initial;font-weight:300;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:75px;color:#333333;"
                   class="ls-l"
                   data-ls="offsetyin:-50%;durationin:1500;delayin:500;easingin:easeOutQuint;rotatexin:60;scalexin:.65;scaleyin:.8;texttransitionout:true;texttypeout:chars_asc;textshiftout:25;textdurationout:600;textstartatout:allinend - 500;textrotatexout:90;texttransformoriginout:50% 50% 30px;">
                    Bem-vindo a AtonMidia</p>
                <p style="top:40%;left:50%;text-align:initial;font-weight:300;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:75px;color:#333333;"
                   class="ls-l"
                   data-ls="transitionin:false;texttransitionin:true;texttypein:chars_asc;textshiftin:25;textdurationin:600;textstartatin:transitioninstart + 1400;textrotatexin:-90;texttransformoriginin:50% 50% 30px;texttransitionout:true;texttypeout:chars_asc;textshiftout:25;textdurationout:600;textstartatout:textinend + 500;textrotatexout:90;texttransformoriginout:50% 50% 30px;">
                    Uma nova forma de pensar</p>
                <p style="top:55%;left:50%;text-align:initial;font-weight:20;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Lato;color:rgba(232, 31, 0, 0.93);font-size:120px;height:370px;line-height:340px;"
                   class="ls-l"
                   data-ls="offsetyin:-100lh;durationin:1200;delayin:2000;easingin:easeOutQuint;clipin:100% 0 0 0;offsetyout:20sh;startatout:transitioninend + 800;easingout:easeInQuint;scalexout:.5;scaleyout:2;transformoriginout:50% -50% 0;">
                    Mídia Digital Indoor</p>
                <p style="left:50%;text-align:initial;font-weight:300;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:60px;color:#333333;top:70%;height:55px;line-height:45px;"
                   class="ls-l"
                   data-ls="offsetyin:-100lh;durationin:1200;delayin:2500;easingin:easeOutQuint;clipin:100% 0 0 0;startatout:slidechangeonly + 0;texttransitionout:true;texttypeout:chars_center;textoffsetyout:10sh;textdurationout:750;texteasingout:easeInQuint;textrotateout:0|-5|5|-10|10|-15|15;textscaleyout:4;texttransformoriginout:50% 0% 0;">
                    Conheça!</p>
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-daiane.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-daiane.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:10%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-20sw;easingout:easeInBack;rotateout:-1;skewxout:6;loop:true;loopoffsety:140sh;loopduration:12750;loopstartat:allinend + 4000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:10;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde1.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde1.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:90%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-30sw;easingout:easeInBack;rotateout:-2;skewxout:9;loop:true;loopoffsety:140sh;loopduration:12250;loopstartat:allinend + 5000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:10;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-ats.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-ats.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:90%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-30sw;easingout:easeInBack;rotateout:-2;skewxout:9;loop:true;loopoffsety:140sh;loopduration:12250;loopstartat:allinend + 7000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:10;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-viasatelite.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-viasatelite.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:80%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-30sw;easingout:easeInBack;rotateout:-2;skewxout:9;loop:true;loopoffsety:140sh;loopduration:12250;loopstartat:allinend + 9000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:10;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde2.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde2.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:20%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-40sw;easingout:easeInBack;rotateout:-2;skewxout:12;loop:true;loopoffsety:140sh;loopduration:12500;loopstartat:allinend + 2000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:15;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-vitaquali.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-vitaquali.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:20%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-40sw;easingout:easeInBack;rotateout:-2;skewxout:12;loop:true;loopoffsety:140sh;loopduration:12500;loopstartat:allinend + 6000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:15;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde3.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-mundoverde3.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:80%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-50sw;easingout:easeInBack;rotateout:-3;skewxout:15;loop:true;loopoffsety:140sh;loopduration:13750;loopstartat:allinend + 1000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:15;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-ipa.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-ipa.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:30%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-60sw;easingout:easeInBack;rotateout:-3;skewxout:18;loop:true;loopoffsety:140sh;loopduration:14000;loopstartat:allinend + 8000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:20;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-panvel2.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-panvel2.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:70%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-70sw;easingout:easeInBack;rotateout:-4;skewxout:21;loop:true;loopoffsety:140sh;loopduration:13250;loopstartat:allinend + 3000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:20;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-panvel3.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-panvel3.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:40%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-80sw;easingout:easeInBack;rotateout:-4;skewxout:24;loop:true;loopoffsety:140sh;loopduration:13500;loopstartat:allinend + 6000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:25;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-turismo.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-turismo.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:60%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 10px 30px rgba(0,0,0,.4);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-90sw;easingout:easeInBack;rotateout:-5;skewxout:27;loop:true;loopoffsety:140sh;loopduration:12000;loopstartat:allinend + 7000;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:25;position:fixed;">
                <img width="600" height="338"
                     src={{ getCDN("img/atonmidia/cliente-atonmidia-panvel1.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset="{{ getCDN("img/atonmidia/cliente-atonmidia-panvel1.jpg", 'cdn2') }} 600w"
                     sizes="(max-width: 600px) 100vw, 600px"
                     style="box-shadow: 0 10px 30px rgba(0,0,0,.4);top:-20%;left:50%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:10px;style:box-shadow: 0 0 50px rgba(0,0,0,.2);;"
                     data-ls="durationin:0;delayin:2000;offsetxout:-100sw;easingout:easeInBack;rotateout:-5;skewxout:30;loop:true;loopoffsety:140sh;loopduration:13000;loopstartat:allinend + 0;looprotate:random(-60,60);loopcount:-1;looptransformperspective:2000;parallax:true;parallaxlevel:30;position:fixed;">
                <div style="background: -moz-linear-gradient(left, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 40%, rgba(0,0,0,0) 60%, rgba(0,0,0,1) 100%); background: -webkit-linear-gradient(left, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 40%,rgba(0,0,0,0) 60%,rgba(0,0,0,1) 100%); background: linear-gradient(to right, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 40%,rgba(0,0,0,0) 60%,rgba(0,0,0,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000',GradientType=1 ); ;top:0px;left:0px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;width:100%;height:100%;"
                     class="ls-l"
                     data-ls="offsetyin:-100%;delayin:4600;fadein:false;offsetxout:-100sw;easingout:easeInExpo;fadeout:false;texttransitionin:true;texttypein:chars_asc;position:fixed;"></div>
                <div style="top:500px;left:250px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:500px;background:rgba(255,255,255,.9);;border-radius:5px;width:1000px;"
                     class="ls-l"
                     data-ls="offsetyin:-120lh;delayin:5000;rotatexin:10;clipin:100% 0 0 0;startatout:slidechangeonly + 0;parallax:true;parallaxlevel:-26;parallaxtype:2d;parallaxevent:scroll;parallaxaxis:both;"></div>
                <p style="top:564px;left:50%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;color:#333333;font-size:75px;"
                   class="ls-l"
                   data-ls="transitionin:false;texttransitionin:true;texttypein:words_center;textoffsetxin:0|-100|100;textstartatin:transitioninend + 5600;textrotateyin:0|-50|50;textscalexin:0|1|1;textscaleyin:0|1|1;parallax:true;parallaxlevel:-26;parallaxtype:2d;parallaxevent:scroll;parallaxaxis:both;">
                    Anúncios de Alto Impacto</p>
                <p style="letter-spacing: -1px;top:675px;left:50%;text-align:initial;font-weight:300;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;color:#555555;font-size:40px;"
                   class="ls-l"
                   data-ls="offsetyin:-100lh;delayin:6000;fadein:false;rotatexin:90;clipin:100% 0 0 0;parallax:true;parallaxlevel:-26;parallaxtype:2d;parallaxevent:scroll;parallaxaxis:both;">
                Muitas empresas já se beneficiam da Mídia Digital Indoor!</p>
                <p style="letter-spacing: -1px;top:765px;left:50%;text-align:initial;font-weight:300;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;color:#333;font-size:40px;"
                   class="ls-l"
                   data-ls="offsetyin:-100lh;delayin:6200;fadein:false;rotatexin:90;clipin:100% 0 0 0;parallax:true;parallaxlevel:-26;parallaxtype:2d;parallaxevent:scroll;parallaxaxis:both;">
                    Valorize você também seu produto ou marca!</p>
                <a style="" class="ls-l" href="#next" target="_self"
                   data-ls="offsetyin:-50lh;durationin:1500;delayin:6400;rotatexin:30;hover:true;hoveropacity:1;hoverscalex:1.05;hoverscaley:1.05;parallax:true;parallaxlevel:-26;parallaxtype:2d;parallaxevent:scroll;parallaxaxis:both;">
                    <p style="top:860px;left:50%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;color:#ffffff;background:#c7784b;border-radius:50px;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;"
                       class="">Saiba mais!</p>
                </a>
            </div>
            <div class="ls-slide" data-ls="bgcolor:#000000;timeshift:-1000;kenburnsscale:1.2;">
                {{--<img width="1200" height="800"--}}
                     {{--src={{ getCDN( "img/atonmidia/teste-fundo7.jpg" class="ls-bg"--}}
                     {{--alt=""--}}
                     {{--srcset={{ getCDN( "img/atonmidia/teste-fundo7.jpg 1500w"--}}
                     {{--sizes="(max-width: 1500px) 100vw, 1500px"/>--}}
                <img width="900" height="600"
                     src={{ getCDN("img/atonmidia/shoppingtotal3.jpg", 'cdn2') }}
                     class="ls-l" alt=""
                     srcset=" {{ getCDN("img/atonmidia/shoppingtotal3.jpg", 'cdn2') }} 820w,
                     {{ getCDN("img/atonmidia/shoppingtotal3.jpg", 'cdn2') }} 246w,
                     {{ getCDN("img/atonmidia/shoppingtotal3.jpg", 'cdn2') }} 768w"
                     sizes="(max-width: 600px) 100vw, 320px"
                     style="left:730px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;top:250px;"
                     data-ls="offsetxin:right;delayin:500;easingin:easeOutBack;skewxin:-25;offsetxout:left;easingout:easeInBack;skewxout:25;">
                <p style="top:371px;left:170px;text-align:initial;font-weight:400;font-style:italic;text-decoration:none;wordwrap:false;opacity:1;color:#ccd3f5;font-size:40px;font-family:Handlee;"
                   class="ls-l"
                   data-ls="transitionin:false;startatout:slidechangeonly + 1000;filterout:brightness(200%);texttransitionin:true;texttypein:chars_asc;textshiftin:25;textdurationin:750;textstartatin:transitioninend + 1000;rotation:-2;">
                    Excelente Retorno!</p>
                <p style="white-space: normal;top:200px;left:62px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;font-family:Nunito;color:rgba(255,255,255,.9);;font-size:54px;padding-right:0px;width:600px;"
                   class="ls-l"
                   data-ls="durationin:1;delayin:500;clipin:100% 0 0 0;offsetyout:-200lh;texttransitionin:true;texttypein:words_asc;textshiftin:100;textoffsetyin:-100lh;texteasingin:easeOutBack;textstartatin:transitioninstart + 0;">
                    Mídia Digital Indoor em</p>
                <p style="white-space: normal;top:274px;left:70px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;font-family:Nunito;color:#8392d4;padding-right:0px;font-size:72px;width:600px;"
                   class="ls-l"
                   data-ls="durationin:1;delayin:500;clipin:100% 0 0 0;offsetyout:-100lh;texttransitionin:true;texttypein:words_desc;textshiftin:100;textoffsetyin:100lh;texteasingin:easeOutBack;textstartatin:transitioninstart + 0;">
                    Shopping Center</p>
                <p style="white-space: normal;top:550px;left:74px;text-align:left;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;font-family:Nunito;color:#d1d7ff;width:550px;font-size:30px;"
                   class="ls-l"
                   data-ls="delayin:3500;clipin:0 0 0 100%;scalexout:.5;scaleyout:0;transformoriginout:0% 100% 0;texttransitionin:true;texttypein:lines_asc;textshiftin:30;textoffsetyin:-30;textstartatin:transitioninend - 700;">
                    A rede de Mídia Digital Indoor da Akhena já conta com mais de 1 milhão de pessoas por mês como público impactado, permitindo que seu produto ou marca esteja em evidencia. Nossa rede está no melhor lugar para publicidade,
                 dentro de Shopping Centers no sul do Brasil </p>
                <a style="" class="ls-l" href="#next" target="_self"
                   data-ls="durationin:2000;delayin:4000;rotatexin:60;scalexin:.8;scaleyin:.8;rotatexout:60;scalexout:.8;scaleyout:.8;loop:true;loopoffsetx:15;loopduration:800;loopeasing:easeInQuint;loopcount:-1;loopyoyo:true;hover:true;hoveropacity:1;hoverscalex:1.05;hoverscaley:1.05;">
                    <p style="top:1157px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;color:#ffffff;background:rgba(255, 33, 48, 0.67);border-radius:50px;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;left:50px;"
                       class="">Conheça melhor</p>
                </a>
                <div style="text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:.3;background:rgba(255,255,255,0.33);width:100px;height:100px;border-radius:100px;top:371px;left:170px;"
                     class="ls-l"
                     data-ls="durationin:250;delayin:3600;easingin:linear;fadein:false;rotatein:-10;rotatexin:20;rotateyin:-30;scalexin:0;scaleyin:0;durationout:250;startatout:transitioninend + 0;easingout:linear;rotateout:-10;rotatexout:20;rotateyout:-30;scalexout:2;scaleyout:2;rotation:-10;rotationX:20;rotationY:-30;"></div>
            </div>




            <div class="ls-slide" data-ls="bgposition:50% 0%;bgcolor:#000000;transition2d:5;kenburnsscale:1.2;">
                <img width="1200" height="800"
                     src="{{asset('_frontend/js/plugins/layerslider/overlays/gradient-1.png')}}" class="ls-bg"
                     alt=""
                     srcset="{{ getCDN('_frontend/js/plugins/layerslider/overlays/gradient-1.png', 'cdn2') }} 1500w"
                     sizes="(max-width: 1500px) 100vw, 1500px"/>
                {{--<img width="1500" height="1500"--}}
                     {{--src="https://cdn6.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad.jpg" class="ls-bg"--}}
                     {{--alt=""--}}
                     {{--srcset="https://cdn6.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad.jpg 1500w, https://cdn5.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad-150x150.jpg 150w, https://cdn8.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad-300x300.jpg 300w, https://cdn6.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad-768x768.jpg 768w, https://cdn7.kreaturamedia.com/wp-content/uploads/2016/10/api-bg-grad-1024x1024.jpg 1024w"--}}
                     {{--sizes="(max-width: 1500px) 100vw, 1500px"/>--}}
                <img width="1400" height="850"
                     src={{ getCDN("img/atonmidia/tela-branco.png", 'cdn2') }} class="ls-l" alt=""
                     srcset="{{ getCDN('img/atonmidia/tela-branco.png', 'cdn2') }} 544w"
                     sizes="(max-width: 1200px) 100vw, 720px"
                     style="top:70px;left:40px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;"
                     data-ls="offsetxin:100;offsetyin:-300;durationin:1500;delayin:100;easingin:easeOutQuart;rotatein:30;offsetxout:100;offsetyout:-300;easingout:easeInQuart;rotateout:30;rotation:0;">

                <div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:252px;" class="ls-l" data-ls="offsetxin:-300;durationin:1500;scalexin:0.5;scaleyin:0.2;offsetyout:500;durationout:400;startatout:transitioninend + 1000;easingout:easeInQuart;parallaxlevel:0;">SEMPRE</div>
                <div style="font-weight:100; text-align:center; text-shadow:rgba(255, 255, 255, 0.4) -1px 1px;width:445px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#1c1c1c;background:rgba(255, 255, 255, 0.68);top:468px;left:737px;" class="ls-l" data-ls="offsetxin:300;durationin:1500;scalexin:0.5;scaleyin:0.2;offsetyout:-300;durationout:400;startatout:transitioninend + 5000;easingout:easeInQuart;parallaxlevel:0;">INOVANDO</div>
                <div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:450px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:247px;" class="ls-l" data-ls="offsetyin:-300;durationin:1500;delayin:2000;scalexin:0.5;scaleyin:0.2;offsetyout:500;durationout:400;startatout:transitioninend + 1000;easingout:easeInQuart;parallaxlevel:0;">SUA MARCA</div>
                <div style="font-weight:100; text-align:center; text-shadow:rgba(0,0,0, 0.4) -1px 1px;width:515px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#ffffff;background:rgba(0, 0, 0, 0.68);top:468px;left:182px;" class="ls-l" data-ls="offsetyin:-300;durationin:1500;delayin:4000;scalexin:0.5;scaleyin:0.2;offsetxout:-80;durationout:400;parallaxlevel:0;">SEU PRODUTO</div>
                <div style="font-weight:100; text-align:center; text-shadow:rgba(255, 255, 255, 0.4) -1px 1px;width:554px;padding-right:20px;padding-left:20px;font-family:Lato;font-size:77px;line-height:135px;color:#1c1c1c;background:rgba(255, 255, 255, 0.68);top:468px;left:737px;" class="ls-l" data-ls="offsetyin:300;durationin:1500;delayin:6000;scalexin:0.5;scaleyin:0.2;offsetxout:200;durationout:400;rotateout:90;rotatexout:180;scalexout:0.3;scaleyout:0.3;parallaxlevel:0;">SENDO VISTO</div>
                <p style="text-shadow: 0 10px 15px rgba(0,0,0,.4);white-space: normal;left:545px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;font-family:Nunito;color:#1b3f0a;font-size:56px;padding-right:0px;top:149px;"
                   class="ls-l"
                   data-ls="offsetyin:100lh;durationin:1500;delayin:500;clipin:0 0 100% 0;offsetyout:-200lh;">
                    Alta Visibilidade</p>
                <div style="box-shadow: 0 20px 50px rgba(0,0,0,.5);top:224px;left:577px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;width:333px;height:69px;font-size:11px;"
                     class="ls-l" data-ls="durationin:750;delayin:1500;easingin:easeInOutQuad;"></div>
                <p style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;top:223px;left:781px;text-align:initial;font-weight:600;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;color:#ffffff;width:120px;padding-right:20px;padding-left:20px;background:#f07400;height:70px;line-height:70px;"
                   class="ls-l"
                   data-ls="durationin:750;delayin:1500;easingin:easeOutQuint;rotateyin:90;transformoriginin:0% 50% 0;scalexout:.5;scaleyout:0;transformoriginout:-80% 0% 0;">
                    Center</p>
                <p style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;top:223px;left:557px;text-align:right;font-weight:600;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;color:#ffffff;width:184px;padding-right:20px;padding-left:20px;background:#0092bc;height:70px;line-height:70px;"
                   class="ls-l"
                   data-ls="durationin:750;delayin:1500;easingin:easeOutQuint;rotateyin:-90;transformoriginin:100% 50% 0;scalexout:.5;scaleyout:0;transformoriginout:0% 0% 0;">
                    Shopping</p>
                {{--<a style="" class="ls-l" href="#reverse-replay" target="_self"--}}
                   {{--data-ls="transitionin:false;offsetxout:100;offsetyout:-300;easingout:easeInQuart;rotateout:30;texttransitionin:true;texttypein:chars_asc;textshiftin:30;textdurationin:1500;textstartatin:transitioninend + 2600;loop:true;loopduration:150;loopeasing:easeInQuint;loopscalex:1.4;loopscaley:1.4;loopcount:1;loopyoyo:true;rotation:0;">--}}
                    {{--<p style="cursor: pointer;top:700px;left:500px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;color:#7b72bc;font-family:Pacifico;font-size:40px;"--}}
                       {{--class="">23 Pontos dentro de Shoppings!</p>--}}
                {{--</a>--}}
                <a style="" class="ls-l" href="#next" target="_self"
                   data-ls="durationin:500;delayin:4000;rotatexin:60;scalexin:.8;scaleyin:.8;rotatexout:60;scalexout:.8;scaleyout:.8;loop:true;loopoffsetx:15;loopduration:800;loopeasing:easeInQuint;loopcount:-1;loopyoyo:true;hover:true;hoveropacity:1;hoverscalex:1.05;hoverscaley:1.05;">
                    <p style="top:1009px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;color:#ffffff;background:#f07400;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;left:1192px;border-radius:50px;"
                       class="">Continuar</p>
                </a>
            </div>
            <div class="ls-slide"
                 data-ls="duration:10000;transition2d:4;kenburnsscale:1.2;parallaxtype:3d;parallaxdistance:3;parallaxrotate:3;">
                <div style="top:0px;left:0px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;"
                     class="ls-l"
                     data-ls="backgroundvideo:true;overlay:{{asset('_frontend/js/plugins/layerslider/overlays/gradient-1.png')}};">
                    <video width="640" height="360" preload="metadata" controls>
                        <source src={{ getCDN("img/atonmidia/fundo_fim_1.mp4", 'cdn2') }}
                                type="video/mp4"/>
                    </video>
                </div>
                <img width="400" height="400"
                     src="{{ getCDN('img/atonmidia/happy-girl.jpg', 'cdn2') }}" class="ls-l"
                     alt=""
                     srcset="{{ getCDN('img/atonmidia/happy-girl.jpg', 'cdn2') }} 400w"
                     sizes="(max-width: 400px) 100vw, 400px"
                     style="border: 10px solid rgba(255,255,255,.45);top:480px;left:520px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:200px;height:300px;"
                     data-ls="offsetxin:-50lw;easingin:easeOutBack;scalexin:1.5;transformoriginin:100% 50% 0;startatout:slidechangeonly + 0;rotateout:-90;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:14;">
                <img width="400" height="400"
                     src="{{ getCDN('img/atonmidia/happy-guy.jpg', 'cdn2') }}" class="ls-l"
                     alt=""
                     srcset="{{ getCDN('img/atonmidia/happy-guy.jpg', 'cdn2') }} 400w"
                     sizes="(max-width: 400px) 100vw, 400px"
                     style="border: 10px solid rgba(255,255,255,.45);top:700px;left:660px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;border-radius:200px;height:300px;"
                     data-ls="offsetxin:50lw;delayin:50;easingin:easeOutBack;scalexin:1.5;transformoriginin:0% 50% 0;startatout:slidechangeonly + 0;rotateout:-90;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:16;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:510px;left:438px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:500;rotatein:360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-10;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:510px;left:388px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:600;rotatein:360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-30;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:510px;left:338px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:700;rotatein:360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-60;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:510px;left:288px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:800;rotatein:360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-100;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:510px;left:238px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:900;rotatein:360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-150;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:732px;left:1227px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:900;rotatein:-360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-150;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:732px;left:1177px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:800;rotatein:-360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-100;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:732px;left:1127px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:700;rotatein:-360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-60;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:732px;left:1077px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:600;rotatein:-360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-30;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <img width="100" height="95"
                     src="{{ getCDN('img/atonmidia/star.png', 'cdn2') }}" class="ls-l" alt=""
                     style="top:732px;left:1027px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;height:40px;"
                     data-ls="delayin:500;rotatein:-360;scalexin:0;scaleyin:0;startatout:slidechangeonly + 0;rotateout:-10;scalexout:0;scaleyout:0;transformoriginout:slidercenter slidermiddle 0;parallax:true;parallaxlevel:20;">
                <p style="white-space: normal;top:570px;left:50px;text-align:right;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;width:430px;border-top:2px solid #ff7700;padding-top:10px;font-family:Nunito;font-size:28px;color:rgba(222, 225, 255, 0.99);line-height:40px;"
                   class="ls-l"
                   data-ls="offsetxin:100lw;durationin:800;delayin:1250;easingin:easeOutQuint;fadein:false;clipin:0 100% 0 0;offsetxout:-100lw;transformoriginout:slidercenter slidermiddle 0;texttransitionin:true;texttypein:lines_asc;textshiftin:30;textoffsetyin:-30;textstartatin:transitioninend - 700;parallax:true;parallaxlevel:18;">
                    "Anunciamos continuamente com a Akhena, quem frequenta um Shopping Center é exatamente o público que buscamos."</p>
                <p style="white-space: normal;top:792px;left:1030px;text-align:left;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;width:430px;border-top:2px solid #ff7700;padding-top:10px;font-family:Nunito;font-size:28px;color:#e3e6ff;line-height:40px;"
                   class="ls-l"
                   data-ls="offsetxin:-100lw;durationin:800;delayin:1300;easingin:easeOutQuint;fadein:false;clipin:0 0 0 100%;offsetxout:100lw;transformoriginout:slidercenter slidermiddle 0;texttransitionin:true;texttypein:lines_asc;textshiftin:30;textoffsetyin:-30;textstartatin:transitioninend - 700;parallax:true;parallaxlevel:18;">
                    "A facilidade em realizar a troca de produtos dentro de uma mesma campanha nos conquistou,
                    temos campanhas dinâmicas com atualizações frequentes, em pouco tempo nosso novo vídeo já está no ar!"</p>
                <p style="top:170px;left:50%;text-align:center;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:64px;padding-right:0px;color:rgba(255,255,255,.9);;width:900px;"
                   class="ls-l test"
                   data-ls="durationin:1;delayin:500;clipin:100% 0 0 0;offsetyout:-200lh;rotateout:-30;transformoriginout:slidercenter slidermiddle 0;texttransitionin:true;texttypein:words_asc;textshiftin:100;textoffsetyin:-100lh;texteasingin:easeOutBack;textstartatin:transitioninstart + 0;parallax:true;parallaxlevel:9;">
                    Quem já anuncia diz</p>
                <p style="white-space: normal;top:240px;left:50%;text-align:center;font-weight:400;font-style:normal;text-decoration:none;wordwrap:true;opacity:1;font-family:Nunito;color:#ff7700;padding-right:0px;font-size:56px;width:600px;"
                   class="ls-l"
                   data-ls="durationin:1;delayin:500;clipin:100% 0 0 0;offsetyout:-100lh;rotateout:30;transformoriginout:slidercenter slidermiddle 0;texttransitionin:true;texttypein:words_desc;textshiftin:100;textoffsetyin:100lh;texteasingin:easeOutBack;textstartatin:transitioninstart + 0;parallax:true;parallaxlevel:8;">
                    porque faz a diferença</p>


                <a style="" class="ls-l" href="sliderbottom" target="ls-scroll"
                   data-ls="offsetxin:100;durationin:2000;delayin:2000;clipin:0;offsetyout:100lh;rotateout:-30;transformoriginout:slidercenter slidermiddle 0;hover:true;hovereasingin:easeInOutQuad;hoveropacity:1;hoverbgcolor:rgba(134, 199, 36, 0.98);parallax:true;parallaxlevel:5;">
                    <p style="cursor: pointer;top:1200px;left:900px;text-align:center;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;border-radius:50px;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;background:rgba(136, 199, 36, 0.76);color:#ffffff;width:420px;"
                       class="">Continuar navegando</p>
                </a>

                {{--<div style="cursor: pointer;top:1200px;left:900px;text-align:center;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;border-radius:50px;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;background:rgba(136, 199, 36, 0.76);color:#ffffff;width:420px;"--}}
                     {{--class="ls-l"--}}
                     {{--data-ls="offsetxin:100;durationin:2000;delayin:2000;clipin:0;offsetyout:100lh;rotateout:-30;transformoriginout:slidercenter slidermiddle 0;hover:true;hovereasingin:easeInOutQuad;hoveropacity:1;hoverbgcolor:rgba(134, 199, 36, 0.98);parallax:true;parallaxlevel:5;"--}}
                     {{--data-showme-link="purchase-inside-slider"--}}
                     {{--data-showme-settings="margin: 15; horizontal: center; vertical: top; theme: light; effect: flip;"--}}
                     {{--data-showme-trigger="hover">Continuar navegando--}}
                {{--</div>--}}



                <a style="" class="ls-l" href="{{ route('midiaindoor') }}" target="_self"
                   data-ls="offsetxin:-100;durationin:2000;delayin:2000;clipin:0;offsetyout:100lh;rotateout:30;transformoriginout:slidercenter slidermiddle 0;hover:true;hovereasingin:easeInOutQuad;hoveropacity:1;hoverbgcolor:#ff7700;parallax:true;parallaxlevel:5;">
                    <p style="top:1200px;left:100px;text-align:center;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;opacity:1;font-family:Nunito;font-size:36px;border-radius:50px;padding-top:10px;padding-bottom:10px;padding-right:40px;padding-left:40px;background:rgba(255, 123, 0, 0.75);style:border: 3px solid rgba(255,255,255,.9);;color:#ffffff;width:650px;"
                       class="">Mais informações sobre Mídia Indoor</p>
                </a>
                <a style="" class="ls-l" href="#1" target="_self"
                   data-ls="durationin:1500;delayin:2500;rotatein:-540;scalexin:0;scaleyin:0;rotateout:360;scalexout:0;scaleyout:0;loop:true;loopduration:1500;loopstartat:allinend + 2000;loopeasing:easeInOutQuint;looprotate:360;loopcount:-1;looprepeatdelay:1000;parallax:true;parallaxlevel:3;">
                    <img width="156" height="156"
                         src="{{asset('img/atonmidia/restart-slider.png') }}" class=""
                         alt=""
                         srcset="{{ getCDN('img/atonmidia/restart-slider.png', 'cdn2') }} 156w, {{ getCDN('img/atonmidia/restart-slider.png', 'cdn2') }} 150w"
                         sizes="(max-width: 156px) 100vw, 156px"
                         style="left:1375px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;top:198px;height:65px;opacity:.3;">
                </a>
                <a style="" class="ls-l" href="#1" target="_self"
                   data-ls="durationin:1;delayin:2500;scalexout:0;scaleyout:0;hover:true;hoveroffsety:-20;hoveropacity:.65;parallax:true;parallaxlevel:3;">
                    <p style="top:193px;left:1322px;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;color:#ffffff;padding-right:0px;font-family:Nunito;font-size:20px;opacity:0;"
                       class="">
                        <br>
                        <br>
                        <br>
                        <br>Reiniciar Apresentação
                    </p>
                </a>
                <div style="margin-top:-11px; z-index: 1001;top:90%;left:50%;border-top:2px solid white;border-bottom:2px solid white;border-radius:15px;background:#ffffff;height:8px;width:6px;"
                     class="ls-l ls-mouse ls-hide-phone"
                     data-ls="offsetyin:50;delayin:4000;offsetyout:-50;durationout:400;loop:true;loopoffsety:4;loopduration:600;loopeasing:easeInOutSine;looprotatex:60;looptransformorigin:50% 50% 5px;loopcount:-1;loopyoyo:true;parallaxlevel:0;rotationX:-30;position:fixed;"></div>
                <div style="border: 3px solid white; z-index: 1002;top:90%;left:50%;width:40px;border-radius:30px;height:70px;"
                     class="ls-l ls-mouse ls-hide-phone"
                     data-ls="offsetyin:50;delayin:4000;offsetyout:-50;durationout:400;parallaxlevel:0;position:fixed;"></div>
                <a style="" class="ls-l" href="sliderbottom" target="ls-scroll"
                   data-ls="offsetyin:100;delayin:4000;offsetyout:-100;durationout:400;parallaxlevel:0;position:fixed;">
                    <p style="font-weight: normal; z-index: 1003;padding-top:100px;font-family:Nunito;font-size:16px;color:#ffffff;top:91%;left:50%;"
                       class=" ls-hide-phone">Navegar</p>
                </a>
            </div>
        </div>

    </div>
    {{--</main>--}}

    <!-- ABOUT -->
    <section>
        <div class="container">
            <h1 class="fs-19">Bem-vindo a <span>Akhena</span>, neste site você encontra informações sobre

                    <a href="{{ route('midiaindoor')  }}"><span>Mídia Digital Indoor</span></a>
                    ,
                    <a href="{{ route('tvcorporativa')  }}"><span> TV Corporativa</span></a>
                    ,
                    <a href="{{ route('vitrinedigital')  }}"><span> Vitrine Digital</span></a>
                    e
                    <a href="{{ route('radioindoor')  }}"><span> Rádio Indoor</span></a>
                .
                Veja como ter sucesso na sua campanha de publicidade anunciando no Shopping Total de Porto Alegre e mais 75 pontos da rede de parceiros.</h1>

            <div class="row">


                <div class="col-lg-6 push-lg-6">
                    <div class="heading-title heading-border heading-color mt-0">
                        <h2 class="fs-18 fw-400">A melhor alternativa em publicidade</h2>
                        <p class="fs-13">Alta visibilidade e ecologicamente correta</p>
                    </div>
                    <p class="lead">O principal público consumir de conteúdo e produtos está dentro de Shopping Centers e esta é nossa especialidade.</p>


                    <p>Conheça nossa rede de Shoppings e anuncie seu produto ou marca, alta visibilidade a um custo excelente.</p>
                    <p>Os principais Shoppings do sul do Brasil para você expandir seus canais de veiculação de publicidade.</p>

                    <div class="row">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-8">
                            <a href="{{ route('midiaindoor') }}" class="btn btn-featured btn-danger">
                                <span>CONHECER MÍDIA DIGITAL INDOOR</span>
                                <i class="et-desktop"></i>
                            </a>
                        </div>
                        <div class="col-sm-2">

                        </div>
                    </div>
                </div>


                <div class="col-lg-6 pull-lg-6">

                    <!--
                        controlls-over		= navigation buttons over the image
                        buttons-autohide 	= navigation buttons visible on mouse hover only

                        data-plugin-options:
                            "singleItem": true
                            "autoPlay": true (or ms. eg: 4000)
                            "navigation": true
                            "pagination": true
                            "transitionStyle":"fadeUp" (fade,backSlide,goDown,fadeUp)
                    -->
                    <div class="owl-carousel buttons-autohide controlls-over" data-plugin-options='{"singleItem": true, "autoPlay": true, "navigation": false, "pagination": true, "transitionStyle":"fade"}'>
                        <div>
                            <img class="img-fluid" src={{ getCDN("img/atonmidia/shoppingtotal3.jpg", 'cdn2') }} alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src={{ getCDN("img/atonmidia/shoppingtotal2.jpg", 'cdn2') }} alt="">
                        </div>
                        <div>
                            <img class="img-fluid" src={{ getCDN("img/atonmidia/shoppingtotal1.jpg",'cdn2') }} alt="">
                        </div>
                    </div>

                    <div class="relative clearfix">

                        <!-- social icons -->
                        <a target="_blank" href="https://www.facebook.com/AtonMidia" class="social-icon social-icon-border social-icon-sm social-icon-transparent float-left social-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>

                        <a target="_blank" href="https://twitter.com/AtonMidia" class="social-icon social-icon-border social-icon-sm social-icon-transparent  float-left social-twitter" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>

                        <a target="_blank" href="https://www.instagram.com/atonmidia/" class="social-icon social-icon-border social-icon-sm social-icon-transparent float-left social-instagram" data-toggle="tooltip" data-placement="top" title="Instagram">
                            <i class="icon-instagram"></i>
                            <i class="icon-instagram"></i>
                        </a>

                        <a target="_blank" href="https://www.youtube.com/channel/UCpMRcdMkNT5ZdLC4o5CbiRQ?sub_confirmation=1" class="social-icon social-icon-border social-icon-sm social-icon-transparent  float-left social-youtube" data-toggle="tooltip" data-placement="top" title="Youtube">
                            <i class="icon-youtube"></i>
                            <i class="icon-youtube"></i>
                        </a>

                        <a target="_blank" href="https://plus.google.com/u/0/106473949254029025814" class="social-icon social-icon-border social-icon-sm social-icon-transparent  float-left social-gplus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                            <i class="icon-google-plus"></i>
                            <i class="icon-google-plus"></i>
                        </a>

                        <a target="_blank" href="https://www.linkedin.com/company/atonm%C3%ADdia-tecnologia-e-comunica%C3%A7%C3%A3o" class="social-icon social-icon-border social-icon-sm social-icon-transparent  float-left social-linkedin" data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>


                    </div>


                </div>


            </div>



        </div>
    </section>
    <!-- /ABOUT -->


    <!-- -->
    <aton-clientes-info></aton-clientes-info>
    <!-- / -->
    {{--<aton-form-captura1></aton-form-captura1>--}}


@endsection

@section('page-scripts')




    {{--<script type='text/javascript' data-cfasync="false"--}}
            {{--src='_frontend/js/plugins/layerslider/js/greensock.js'></script>--}}
    {{--<script type='text/javascript' data-cfasync="false"--}}
    {{--src='_frontend/js/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js'></script>--}}
    {{--<script type='text/javascript' data-cfasync="false"--}}
    {{--src='_frontend/js/plugins/layerslider/js/layerslider.transitions.js'></script>--}}



    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/greensock.js', 'cdn2') }}></script>
    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js', 'cdn2') }}></script>
    <script type='text/javascript' data-cfasync="false" src={{ getCDN('/_frontend/js/plugins/layerslider/js/layerslider.transitions.js', 'cdn2') }}></script>

    <script>

        var lsjQuery = jQuery;
        lsjQuery(document).ready(function () {
            if (typeof lsjQuery.fn.layerSlider == "undefined") {
                if (window._layerSlider && window._layerSlider.showNotice) {
                    window._layerSlider.showNotice('layerslider_50', 'jquery');
                }
            } else {
                lsjQuery("#layerslider_50").layerSlider({
                    sliderVersion: '6.5.0',
                    type: 'fullsize',
                    autoStart: false,
                    globalBGColor: '#000000',
                    globalBGAttachment: 'fixed',
                    navPrevNext: false,
                    hoverPrevNext: false,
                    navStartStop: false,
                    showCircleTimer: false,
                    thumbnailNavigation: 'disabled',
                    popupWidth: 640,
                    popupHeight: 360,
                    skinsPath: "{{ getCDN('_frontend/js/plugins/layerslider/skins/', 'cdn2')}}",
                    height: 1500
                });
            }
        });


    </script>


@endsection
