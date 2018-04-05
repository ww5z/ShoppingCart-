<?php
//header.php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inventory Management System</title>
		<script src="js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>		
		
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h2 align="center">Inventory Management System</h2>

			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav">
					<?php
					if($_SESSION['type'] == 'master')
					{
					?>
						<li><a href="user.php">المستخدمين</a></li>
						<li><a href="category.php">الفائة</a></li>
						<li><a href="brand.php">العلامة التجارية</a></li>
						<li><a href="product.php">المنتجات</a></li>
					<?php
					}
					?>
						<li><a href="order.php">الطلبات</a></li>
						<li><a href="products.php">إضافة وتحرير المنتجات</a></li>
						<li><a href="multi_tab_shopping_cart.php">نقطة البيع</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <?php echo $_SESSION["user_name"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
			