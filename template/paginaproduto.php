<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="./index.php">Início</a></li>
							<li><a href="./categorias.php">Categorias</a></li>
							<li><a href="./produtos.php?categoria={InserirIdCategoria}">{InserirCategoriaProduto}</a></li>
							<li class="active">{InserirNomeProduto}</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product">
							<div class="product-preview">
								<img src="{InserirImagemProduto}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->
					 
					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{InserirNomeProduto}</h2>
							<div>
								<h3 class="product-price">R${InserirPrecoProduto} </h3>
							</div>

							<div class="add-to-cart">
								<form method="GET" action="comprar.php">
								<input type="hidden" name="id" value="{InserirIdProduto}">
								<div class="qty-label">
									Quantidade
									<div class="input-number">
										<input type="number" value="1" min="1" name="qtd">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<br>
								<br>
								<button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i>Comprar</button>
							</div>

							<ul class="product-links">
								<li>Categoria:</li>
								<li><a href="./produtos.php?categoria={InserirIdCategoria}">{InserirCategoriaProduto}</a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Descrição</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>{InserirDescricaoProduto}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Produtos relacionados</h3>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<!-- product -->
							{InserirProdutosRelacionados}
							<!-- /product -->
						</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->