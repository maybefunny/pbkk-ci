<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
	<link href="<?php echo base_url("/assets/vendor/datatables/dataTables.bootstrap4.min.css")?>" rel="stylesheet"></link>
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
						<h1 class="h3 mb-0 text-gray-800">Category List</h1>
					</div>

					<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="<?php echo site_url('admin/categories/add') ?>"><i class="fas fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>id</th>
											<th>Name</th>
<?php if( $this->session->user_logged->role === "admin" ){ ?>
											<th>Action</th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($categories as $category): ?>
										<tr>
											<td width="150">
												<?php echo $category->id ?>
											</td>
											<td width="150">
												<?php echo $category->category_name ?>
											</td>
<?php if( $this->session->user_logged->role === "admin" ){ ?>
											<td width="250">
												<a href="<?php echo site_url('admin/categories/edit/'.$category->id) ?>"
												class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
												<a onclick="deleteConfirm('<?php echo $category->id ?>')"
												href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
											</td>
<?php } ?>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
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
	<script src="<?php echo base_url("/assets/js/modal.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/vendor/datatables/jquery.dataTables.min.js"); ?>"></script>
	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable();
		} );
		function deleteConfirm(id){
            makeModal(
                `Konfirmasi Hapus Produk`,
                `Apakah anda yakin akan menghapus produk dengan id ${id}?`,
                [
                    {
                        action:`deleteAction('${id}');`,
                        value:`Hapus`,
                        class:`btn-danger`
                    },
                    {
                        action:`noAction();`,
                        value:`Batal`,
                        class:`btn-primary`
                    }
                ]
			);
		}

		function deleteAction(id){
        	window.location.href = `/admin/categories/delete/${id}`
		}
	</script>
	
</body>
