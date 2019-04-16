<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title><?= $title ? $title . ' - 留言板' : '留言板' ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
		<a class="navbar-brand" href="/">留言版</a>
		<?php if (App\Models\User::isAuthenticated()): ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
			<div class="collapse navbar-collapse" id="navbarToggler">
		    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
		    	
		    		<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <?= htmlspecialchars($user->nickname); ?>
			        </a>
			        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="/logout">登出</a>
			      </li>     
		    </ul>
		  </div>
	  <?php endif; ?>	 
  </nav>
	<?php require($file); ?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="public/js/moment-with-locales.js"></script>
	<script type="text/javascript">
		let postsPerPage = <?= App\Core\App::get('config')['POSTS_PER_PAGE']; ?>;
	</script>
	<script type="text/javascript" src="public/js/script.js"></script>
</body>
</html>