<html>
<head>
    <title><?php echo $title ?></title>
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<header id="header">
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		        </button>
		        <a class="brand" href="/">CI Sample Project</a>
		        <div class="nav-collapse collapse">
		        	<ul class="nav">
		        		<li class="active"><a href="/">Home</a></li>
		        		<li><a href="#">Link2</a></li>
		        		<li><a href="#">Link3</a></li>
		        		<li><a href="#">Link4</a></li>
		        		<li><a href="#">Link5</a></li>
		        	</ul>
		        </div>
			</div>
		</div>
	</div>
</header>
<div style="padding-top:45px;height:540px">

    <div id="contents" style ="width:510px;float:left;border:1px solid green;"><?php echo $contents ?></div>	
	
</body>
</html>