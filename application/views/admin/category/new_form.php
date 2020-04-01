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
						<h1 class="h3 mb-0 text-gray-800">Add category</h1>
					</div>

					<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php endif; ?>

					<div class="card mb-3">
						<div class="card-header">
							<a href="<?php echo site_url('admin/categories/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
						</div>
						<div class="card-body">

							<form action="<?php base_url('admin/categories/add') ?>" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label for="category_name">Name*</label>
									<input class="form-control <?php echo form_error('category_name') ? 'is-invalid':'' ?>"
									type="text" name="category_name" placeholder="Category name" />
									<div class="invalid-feedback">
										<?php echo form_error('category_name') ?>
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
