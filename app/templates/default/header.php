<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<title><?php echo $data['title'].' - '.SITETITLE; ?></title>

	<!-- CSS -->
	<?php
		helpers\assets::css(array(
			'//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
			helpers\url::template_path() . 'css/style.css',
		))
	?>

</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Раскрыть</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo DIR ?>">Прокат авто</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if ($data['nav_page'] == 'deals') echo 'class="active"' ?>><a href="<?php echo DIR ?>deals">Заказы</a></li>
                <li <?php if ($data['nav_page'] == 'cars') echo 'class="active"' ?>><a href="<?php echo DIR ?>cars">Автомобили</a></li>
                <li <?php if ($data['nav_page'] == 'clients') echo 'class="active"' ?>><a href="<?php echo DIR ?>clients">Клиенты</a></li>
                <li <?php if ($data['nav_page'] == 'statistic') echo 'class="active"' ?>><a href="<?php echo DIR ?>statistic">Статистика</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
