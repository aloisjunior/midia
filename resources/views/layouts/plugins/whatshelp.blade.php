<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "676933469107425", // Facebook page ID
            whatsapp: "+5551996638988", // WhatsApp number
            company_logo_url: "//storage.whatshelp.io/widget/79/7980/7980d336854cf4635e6e5224812cac3b/20638327_1080181272115974_7880088114315707585_n.png", // URL of company logo (png, jpg, gif)
            greeting_message: "Olá, diga-nos como ajudar! Envie sua dúvida e respondemos para você.", // Text of greeting message
            call_to_action: "Consultores Online", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,whatsapp" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->