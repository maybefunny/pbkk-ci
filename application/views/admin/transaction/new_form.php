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
						<h1 class="h3 mb-0 text-gray-800">Add transaction</h1>
					</div>

					<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php endif; ?>

					<div class="card mb-3">
						<div class="card-header">
							<a href="<?php echo site_url('transactions/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
						</div>
						<div class="card-body">
						Transaction Summary
							<button class="btn btn-sm btn-primary float-right mb-1" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add Item</button>
							<form id="myForm" action="" method="post">
								<div class="table-responsive">
									<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Item</th>
												<th>Amount</th>
												<th>Price</th>
												<th>Sub Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-sm-6 float-right">
									</div>
									<div class="col-sm-6 float-right">
										<p class="float-left">
											Total
										</p>
										<p id="total_price-view" class="float-right">0</p>
										<p class="float-right">
											Rp
										</p>
										<input id="total_price" type="hidden" name="total_price" value="">
										<input id="user_id" type="hidden" name="user_id" value="<?php echo $this->session->user_logged->user_id ?>">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 float-right">
									</div>
									<div class="col-sm-6 float-right">
										<p class="float-left">
											Bayar
										</p>
										<input id="amount_paid" class="float-right form-control-sm w-50" type="number" name="amount_paid" value="">
										<p class="float-right mr-2">
											Rp
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 float-right">
									</div>
									<div class="col-sm-6 float-right">
										<p class="float-left">
											Kembali
										</p>
										<p id="change-view" class="float-right">0</p>
										<p class="float-right mr-2">
											Rp
										</p>
										<input id="change" type="hidden" name="change" value="">
									</div>
								</div>
							</form>
							<br>
							<div class="col-sm-6 float-right">
								<button class="btn btn-success form-control" name="btn" onclick="submitForm()">Save</button>
							</div>
						</div>
					</div>

				</div>
			</div>
			<?php $this->load->view("admin/_partials/footer.php") ?>
		</div>
	</div>
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambahkan Barang</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<select class="form-control mb-3" name="category" id="selectCategory">
					<option value="*">Semua</option>
						<?php foreach ($categories as $cat): ?>
							<option value="<?php echo $cat->id; ?>"><?php echo $cat->category_name; ?></option>
						<?php endforeach; ?>
					</select>
					<div id="myMenu">
						<?php foreach ($products as $prod): ?>
							<button id="menu-<?php echo $prod->product_id ?>" class="btn mr-2 bg-info text-white w-25" value="<?php echo $prod->category_id; ?>" onclick="addItem(this)">
								<input type="hidden" value="<?php echo $prod->product_id?>">
								<input id="price-<?php echo $prod->product_id?>" type="hidden" value="<?php echo $prod->price?>">
								<input type="hidden" value="<?php echo $prod->name?>">
								<input type="hidden" value="<?php echo $prod->image?>">
								<img src="<?php echo base_url('upload/product/'.$prod->image) ?>" width="128" /><br>
								<b><?php echo $prod->name; ?></b><br>
								<b>Rp <?php echo $prod->price; ?></b><br>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" data-dismiss="modal" id="closeModal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>
	<script src="<?php echo base_url("/assets/js/modal.js"); ?>"></script>
	<script>
		$('#selectCategory').change(() => {
			cat_id = $('#selectCategory').val()
			$("#myMenu").children('button').each((i, obj) => {
				obj = $(obj)
				if(cat_id != obj.val() && cat_id != "*"){
					obj.hide()
				}else{
					obj.show()
				}
			})
		})

		$("#amount_paid").change(() => {
			updateSummary()
		})

		function addItem(prod){
			prod_id = $($(prod).children('input')[0]).val()
			price = $($(prod).children('input')[1]).val()
			name = $($(prod).children('input')[2]).val()
			image = $($(prod).children('input')[3]).val()
			$(prod).attr('disabled', true)
			$("#dataTable").append(`
				<tr id="row-${prod_id}" class="cart">
					<td>
						<img src="<?php echo base_url('upload/product/') ?>${image}" width="64" />
						${name}
						<input id="product_id-${prod_id}" type="hidden" name="product_id-${prod_id}" value="${prod_id}">
						<input id="product_name-${name}" type="hidden" name="product_name-${name}" value="${name}">
					</td>
					<td>
					<div class="row mt-2">
						<a class="btn btn-primary btn-circle btn mr-3" onclick="decAmount('${prod_id}')">
							<span class="icon text-white">
								<i class="fas fa-minus"></i>
							</span>
						</a>
						<input id="amount-${prod_id}" type="text" class="form-control w-25 text-center" name="amount-${prod_id}" value="1">
						<a class="btn btn-primary btn-circle btn ml-3" onclick="incAmount('${prod_id}')">
							<span class="icon text-white">
								<i class="fas fa-plus"></i>
							</span>
						</a>
						</div>
					</td>
					<td>
						Rp ${price}
					</td>
					<td>
						<p id="subprice-view-${prod_id}"> Rp ${price}</p>
						<input class="subprices" id="subprice-${prod_id}" type="hidden" name="subprice-${prod_id}" value="${price}">
					</td>
				</tr>
			`)
			updateSummary()
			$("#closeModal").click()
		}

		function updateSummary(){
			total = 0
			$(".subprices").each((i, obj) => {
				obj = $(obj)
				total += Number(obj.val())
			})
			$("#total_price").val(total)
			$("#total_price-view").html(total)
			$("#change-view").html(Number($("#amount_paid").val())-total)
			$("#change").val(Number($("#amount_paid").val())-total)
		}

		function decAmount(id){
			prod_amount = Number($("#amount-"+id).val())
			if(prod_amount < 2){
				delConf(id)
			}
			prod_amount -= 1
			$("#amount-"+id).val(prod_amount)
			subprice = $("#price-"+id).val()*prod_amount
			$("#subprice-"+id).val(subprice)
			$("#subprice-view-"+id).html("Rp "+subprice)
			updateSummary()
		}

		function incAmount(id){
			prod_amount = Number($("#amount-"+id).val())
			prod_amount += 1
			$("#amount-"+id).val(prod_amount)
			subprice = Number($("#price-"+id).val())*prod_amount
			$("#subprice-"+id).val(subprice)
			$("#subprice-view-"+id).html("Rp "+subprice)
			updateSummary()
		}

		function delConf(id){
            makeModal(
                `Konfirmasi Hapus Barang`,
                `Apakah anda yakin akan menghapus barang dengan id ${id}?`,
                [
                    {
                        action:`delAct('${id}');`,
                        value:`Hapus`,
                        class:`btn-danger" data-dismiss="modal"`
                    },
                    {
                        action:`incAmount('${id}');`,
                        value:`Kembali`,
                        class:`btn-primary" data-dismiss="modal"`
                    }
                ]
			);
		}

		function delAct(id){
			$("#row-"+id).remove()
			$("#menu-"+id).attr('disabled', false)
		}
		
		function submitForm(){
			formData = ($("#myForm").serializeArray());
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('transactions/addutil') ?>',
				data: formData,
			}).done((data, status) => {
				if(data.length == 0){
					console.log('wadaw')
					console.log(data)
				}else{
					console.log(data)
					myItem = '';
					data = JSON.parse(data)
					myItem += `<tbody>`;
					data.transDetails.forEach((item) => {
						console.log(item)
						myItem += `<tr>`;
						myItem += `<td>`;
						myItem += `${item.transaction_id}`;
						myItem += `</td>`;
						myItem += `<td>`;
						myItem += `${item.prod_name}`;
						myItem += `</td>`;
						myItem += `<td>`;
						myItem += `${item.amount}`;
						myItem += `</td>`;
						myItem += `<td>`;
						myItem += `${item.subprice}`;
						myItem += `</td>`;
						myItem += `</tr>`;
					})
					myItem += `</tbody>`;
					myItem += `</table>`;
					myItem2 = ``;
					myItem2 += `<div class="colfloat-right" width=50%>`;
					myItem2 += `<p>Total: Rp ${data.total_price}</p>`;
					myItem2 += `<p>Bayar: Rp ${data.amount_paid}</p>`;
					myItem2 += `<p>Kembali: Rp ${data.change}</p>`;
					myItem2 += `</div>`;
					myItem2 += `</div>`;

					makeModal(
						`Transaction Summary`,
						`<div id="printArea">
							<b>Gerai Boba <sup>2</sup></b><br>
							Jl jalan kemana no 21<br>No HP: 0812 1212 1212<br>
							--------------------------------------------------
							<table>
								<thead>
									<tr>
										<th>
											id
										</th>
										<th>
											name
										</th>
										<th>
											qty
										</th>
										<th>
											subprice
										</th>
									</tr>
								</thead>`
						+myItem
						+`--------------------------------------------------`
						+myItem2,
						[
							{
								action:`printSummary();`,
								value:`Cetak`,
								class:`btn-primary`
							},
							{
								action:`noAction('');`,
								value:`Batal`,
								class:`btn-danger`
							}
						]
					)
				}
			})
		}

		function printSummary(){
			var mywindow = window.open('', 'PRINT', 'height=400,width=600');

			mywindow.document.write('<html><head><title>' + document.title  + '</title>');
			mywindow.document.write('</head><body >');
			mywindow.document.write('<h1>' + document.title  + '</h1>');
			mywindow.document.write(document.getElementById("printArea").innerHTML);
			mywindow.document.write('</body></html>');

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10*/

			mywindow.print();

			return true;
		}
	</script>
	
</body>
