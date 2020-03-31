<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<?php $this->load->view("admin/_partials/sidebar.php") ?>
	<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<?php $this->load->view("admin/_partials/navbar.php") ?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Edit product</h1>
					</div>

					<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php endif; ?>

					<!-- Card  -->
					<div class="card mb-3">
						<div class="card-header">

							<a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>
								Back</a>
						</div>
						<div class="card-body">

							<form action="<?php base_url(" admin/product/edit") ?>" method="post"
								enctype="multipart/form-data" >

								<input type="hidden" name="id" value="<?php echo $product->product_id?>" />

								<div class="form-group">
									<label for="name">Name*</label>
									<input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
									type="text" name="name" placeholder="Product name" value="<?php echo $product->name ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('name') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="price">Price</label>
									<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
									type="number" name="price" min="0" placeholder="Product price" value="<?php echo $product->price ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('price') ?>
									</div>
								</div>


								<div class="form-group">
									<label for="name">Photo</label>
									<input class="form-control-file <?php echo form_error('image') ? 'is-invalid':'' ?>"
									type="file" name="image" />
									<input type="hidden" name="old_image" value="<?php echo $product->image ?>" />
									<div class="invalid-feedback">
										<?php echo form_error('image') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="name">Description*</label>
									<textarea class="form-control <?php echo form_error('description') ? 'is-invalid':'' ?>"
									name="description" placeholder="Product description..."><?php echo $product->description ?></textarea>
									<div class="invalid-feedback">
										<?php echo form_error('description') ?>
									</div>
								</div>

								<input class="btn btn-success" type="submit" name="btn" value="Save" />
							</form>

						</div>

						<div class="card-footer small text-muted">
							* required fields
						</div>


					</div>
				</div>
			</div>
			<?php $this->load->view("admin/_partials/footer.php") ?>
		</div>
	</div>
	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>
	
</body>
