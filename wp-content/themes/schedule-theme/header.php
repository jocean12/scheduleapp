<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
	
		
		<!-- Date time picker stylesheet file -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/jquery.datetimepicker.min.css"/>
		
		
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-2.2.4/dt-1.10.13/af-2.1.3/b-1.2.4/b-print-1.2.4/datatables.min.css"/>
 
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-2.2.4/dt-1.10.13/af-2.1.3/b-1.2.4/b-print-1.2.4/datatables.min.js"></script>
		
		<script src="https://use.fontawesome.com/e926455fad.js"></script>
		
		<script type="text/javascript">var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
		
		<?php wp_head(); ?>
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
		
		<!-- Date time picker js file -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.datetimepicker.full.js"></script>
		
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
		
	</head>
	<body <?php body_class(); ?>>
		
	<nav class="navbar navbar-default wrapper" role="navigation">
     <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/just-logo-dot.png" style="width:18px;float:left;margin-right:7px;"/><?php bloginfo( 'name' ); ?></a>
      </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse">

       <?php wp_nav_menu( array('menu' => 'Main', 'menu_class' => 'nav navbar-nav navbar-left', 'depth'=> 3, 'container'=> false, 'walker'=> new Bootstrap_Walker_Nav_Menu)); ?>
       
      <form class="navbar-form navbar-left search" method="get" action="<?php echo home_url(); ?>" role="search">
         <div class="form-group">
			<input class="search-input form-control" type="search" name="s" placeholder="<?php _e( 'Search', 'html5blank' ); ?>">
         </div>
			<button class="btn btn-default search-submit" type="submit" role="button"><?php _e( 'Search', 'html5blank' ); ?></button>
	  </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logout <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
      </div><!-- /.navbar-collapse -->
	</div>
</nav>