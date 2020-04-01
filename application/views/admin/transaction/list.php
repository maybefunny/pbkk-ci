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
						<h1 class="h3 mb-0 text-gray-800">Transaction List</h1>
					</div>

					<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="<?php echo site_url('transactions/add') ?>"><i class="fas fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>id</th>
											<th>Total Price</th>
											<th>User id</th>
											<th>Created at</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($transactions as $transaction): ?>
										<tr>
											<td width="150">
												<?php echo $transaction->id ?>
											</td>
											<td>
												<?php echo $transaction->total_price ?>
											</td>
											<td>
												<?php echo $transaction->user_id ?>
											</td>
											<td class="small">
												<?php echo $transaction->created_at ?>
											<td width="250">
												<a onclick="deleteConfirm('<?php echo $transaction->id ?>')"
												href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
											</td>
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
        	window.location.href = `/transactions/delete/${id}`
		}
	</script>
	
</body>
