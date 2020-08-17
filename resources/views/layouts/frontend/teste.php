
<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>LayerSlider 6 | Fullsize Popup Example</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Nunito:300,400|Holtwood+One+SC" rel="stylesheet">

    <!-- Styles of this template -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- LayerSlider styles -->
    <link rel="stylesheet" href="../layerslider/css/layerslider.css" type="text/css">

    <!-- External libraries: jQuery & GreenSock -->
    <script src="../layerslider/js/jquery.js" type="text/javascript"></script>
    <script src="../layerslider/js/greensock.js"></script>

    <!-- LayerSlider script files -->
    <script src="../layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
    <script src="../layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

    <!-- LayerSlider Popup plugin files -->
    <link rel="stylesheet" href="../layerslider/plugins/popup/layerslider.popup.css" type="text/css">
    <script src="../layerslider/plugins/popup/layerslider.popup.js" type="text/javascript"></script>

</head>
<body>

<div class="ls-popup">
    <div id="layerslider" style="width: 1000px; height: 750px; margin: 0 auto;">
        <div class="ls-slide" data-ls="kenburnsscale:1.2;parallaxtype:3d;">
            <img width="2000" height="1500" src="images/fullsize_popup/bg.jpg" class="ls-bg">
            <img width="756" height="1187" src="images/fullsize_popup/watch.png" class="ls-l" style="top:86px;left:727px;width:427px;height:671px;" data-ls="offsetxin:400;offsetyin:400;durationin:1500;easingin:easeOutQuint;rotatein:5;">
            <img width="987" height="731" src="images/fullsize_popup/box1.png" class="ls-l" style="top:-105px;left:-222px;width:568px;height:421px;" data-ls="offsetxin:-100;offsetyin:-150;durationin:1500;delayin:900;easingin:easeOutQuint;rotatein:5;">
            <img width="572" height="732" src="images/fullsize_popup/tape.png" class="ls-l" style="top:-67px;left:763px;width:324px;height:414px;" data-ls="offsetxin:400;offsetyin:-200;durationin:1500;delayin:200;easingin:easeOutQuint;rotatein:90;">
            <img width="832" height="670" src="images/fullsize_popup/envelope1.png" class="ls-l" style="top:562px;left:542px;width:452px;height:364px;" data-ls="offsetxin:300;offsetyin:200;durationin:1500;delayin:400;easingin:easeOutQuint;rotatein:-3;">
            <img width="973" height="643" src="images/fullsize_popup/envelope2.png" class="ls-l" style="top:653px;left:350px;width:554px;height:366px;" data-ls="offsetxin:300;offsetyin:200;durationin:1500;delayin:600;easingin:easeOutQuint;rotatein:-10;">
            <img width="642" height="646" src="images/fullsize_popup/box2.png" class="ls-l" style="top:653px;left:218px;width:324px;height:326px;" data-ls="offsetxin:-200;offsetyin:200;durationin:1500;delayin:800;easingin:easeOutQuint;rotatein:-40;">
            <img width="1181" height="1208" src="images/fullsize_popup/folder.png" class="ls-l" style="top:455px;left:-193px;width:492px;height:504px;" data-ls="offsetxin:-100;offsetyin:200;durationin:1500;delayin:1000;easingin:easeOutQuint;rotatein:5;">
            <img width="1213" height="1418" src="images/fullsize_popup/box3.png" class="ls-l" style="top:-211px;left:175px;width:595px;height:695px;" data-ls="offsetyin:-250;durationin:1500;delayin:600;easingin:easeOutQuint;rotatein:-15;">
            <img width="953" height="976" src="images/fullsize_popup/book.png" class="ls-l" style="top:188px;left:-364px;width:582px;height:596px;" data-ls="offsetxin:-200;offsetyin:300;durationin:1500;delayin:1200;easingin:easeOutQuint;rotatein:5;">
            <img width="397" height="463" src="images/fullsize_popup/stamp.png" class="ls-l" style="top:262px;left:-10px;width:183px;height:214px;" data-ls="offsetxin:-200;offsetyin:300;durationin:1500;delayin:1200;easingin:easeOutQuint;rotatein:-200;"><p style="top:390px;left:50%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;mix-blend-mode:normal;font-family:'Holtwood One SC';color:rgba(0,0,0,.5);;font-size:40px;opacity:.7;filter:blur(5px);" class="ls-l" data-ls="durationin:750;delayin:1500;easingin:easeOutBack;parallax:true;parallaxlevel:2;">CLOSE ME</p><p style="cursor: pointer;top:380px;left:50%;text-align:initial;font-weight:400;font-style:normal;text-decoration:none;wordwrap:false;mix-blend-mode:normal;font-family:'Holtwood One SC';color:rgba(255, 255, 255, 0.99);font-size:38px;opacity:.7;" class="ls-l ls-close-popup" data-ls="durationin:750;delayin:1500;easingin:easeOutBack;hover:true;hoveropacity:1;parallax:true;parallaxlevel:4;">CLOSE ME</p>
        </div>
    </div>
</div>

<div id="description">
    <h1>LayerSlider <span>6</span> | Fullsize Popup Example</h1>
    <p class="largemargin">
        This example demonstrates how you can use LayerSlider as an overlay with the Popup feature.
    </p>
    <p class="text-center">
        <button id="open-fullsize-popup-example" class="button">Open Fullsize Popup</button>
    </p>
</div>

<!-- Initializing the slider -->
<script>
    jQuery("#layerslider").layerSlider({
        type: 'popup',
        skin: 'noskin',
        skinsPath: '../layerslider/skins/',
        navPrevNext: false,
        hoverPrevNext: false,
        navStartStop: false,
        navButtons: false,
        showCircleTimer: false,
        popupShowOnClick: '#open-fullsize-popup-example',
        popupShowOnce: false,
        popupDisableOverlay: true,
        popupShowCloseButton: false,
        popupOverlayClickToClose: false,
        popupWidth: 1000,
        popupHeight: 750,
        popupFitWidth: true,
        popupFitHeight: true,
        popupDistanceLeft: 0,
        popupDistanceRight: 0,
        popupDistanceTop: 0,
        popupDistanceBottom: 0,
        popupDelayIn: 0,
        popupTransitionIn: 'slidefrombottom',
        popupTransitionOut: 'slidetobottom',
        popupOverlayDurationIn: 4000,
        popupOverlayTransitionIn: 'slidefrombottom',
        plugins:['popup']
    });
</script>

</body>
</html>
