<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <meta name="author" content="">
    <title><?php echo $metatitle;?></title>
    <meta name="description" content="<?php echo $metadescription;?>">
    <link rel="shortcut icon" sizes="196x196" href="<?php echo base_url('/assets/images/favicon.svg');?>">
    <link rel="canonical" href="<?php echo current_url();?>" />
    <?php if(($this->uri->segment(1)=='businessideas') && ($this->uri->segment(2)=='idea')){
        $ind= $bussinessIdeas[0]['industry_id'];
        $filename = "assets/images/industries/".$ind.".jpg";		
        $metadescription = strip_tags($bussinessIdeas[0]['description']);
        $pageurl = base_url(uri_string());
    ?>
        <meta name="author" content="">
        <meta property="og:url" content="<?php echo $pageurl; ?>" />
        <meta property="fb:app_id" content="2796541780571274" />
        <meta property="og:site_name" content="Viewham " />		
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $bussinessIdeas[0]['idea_title']; ?>" />
        <meta property="og:description" content="<?php echo substr($metadescription, 0, 50); ?>" />
        <meta property="og:image" content="<?php echo base_url('').$filename; ?>" />
    <?php } ?>
    
	  <!-- Owl  -->
	  <!-- Owl Stylesheets -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/owlcarousel/owl.carousel.min.css">
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/owlcarousel/owl.carousel.min.css">
  
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/ideas.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/owlcarousel/owl.carousel.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/star-rating.min.js"></script>
    
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Plugin CSS -->
    <link href="<?php echo base_url();?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="<?php echo base_url();?>assets/css/creative.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<!-- File upload Start -->		
	<link href="<?php echo base_url(); ?>assets/file/jquery.growl.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/file/src/fileup.css" rel="stylesheet" type="text/css">
	
	<!-- File upload end -->
    <link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet"/>
    <script src="<?php echo base_url();?>assets/js/select2.js"></script>
    <!--slider-->
    <script src="<?php echo base_url();?>assets/material/material.min.js"></script>
    <script src="<?php echo base_url();?>assets/material/magicsuggest.js"></script>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/material/material.indigo-pink.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/star-rating.min.css">
    <!-- Material Design Lite -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!------------Fox push Code ----->
	<script src="<?php echo base_url(); ?>assets/js/standalone/selectize.js"></script>  
	<link href="<?php echo base_url(); ?>assets/css/selectize.default.css" rel="stylesheet">
	

    <?php if(ENVIRONMENT=='LIVE'){?>
    <script type="text/javascript" data-cfasync="false">
    var _foxpush = _foxpush || [];
    _foxpush.push(['_setDomain', 'viewhamcom']);
    (function(){
        var foxscript = document.createElement('script');
        foxscript.src = '//cdn.foxpush.net/sdk/foxpush_SDK_min.js';
        foxscript.type = 'text/javascript';
        foxscript.async = 'true';
        var fox_s = document.getElementsByTagName('script')[0];
        fox_s.parentNode.insertBefore(foxscript, fox_s);})();
    </script>
    <!------------Facebook pixel code ----->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '226306268312868');
        fbq('track', 'PageView');
      </script>
      <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=226306268312868&ev=PageView&noscript=1"
      /></noscript>
    <!-- End Facebook Pixel Code -->

    
<!-- Hotjar Tracking Code for https://viewham.com/ -->

<script>

(function(h,o,t,j,a,r){

h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};

h._hjSettings={hjid:1183286,hjsv:6};

a=o.getElementsByTagName('head')[0];

r=o.createElement('script');r.async=1;

r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;

a.appendChild(r);

})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112767933-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112767933-1');
</script>
    <?php } ?>
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<!--<meta name="google-signin-client_id" content="1065634207818-68lv9scrd8rc2tu67sodoc1ohounh2gq.apps.googleusercontent.com">    -->
<meta name="google-signin-client_id" content="361485157382-l6ble94gqesec44dnqnojtqva406352i.apps.googleusercontent.com">
	
	</head>