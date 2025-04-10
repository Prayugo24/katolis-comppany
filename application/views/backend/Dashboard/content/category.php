<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Menu / Kategori</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Konten</a>
                    </li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>
            </div>

        </div>

        <div class="row" id="foot">
            <div class="col-12">
                <div class="card">

                    <div class="contact-page-aside">

                        <div class="left-aside">
                            <form class="p-r-30" id="categoryForm">
                                <div class="row">
									<div class="col-12">
                                        <h6 class="m-t-20">Nama Menu / Kategori</h6>
										<input type="text" id="menuName" name="menu_name" class="form-control" placeholder="Menu / Kategori" />

                                    </div>
                                    <div class="col-12">
                                        <h6 class="m-t-20">Pilih Level</h6>
                                        <select id="levelSelect" name="level" class="selectpicker" data-style="form-control btn-secondary custom-select" >
                                            <option value="Level 1">Level 1</option>
                                            <option value="Level 2">Level 2</option>
                                            <option value="Level 3">Level 3</option>
                                        </select>
                                    </div>
                                    <div class="col-12" id="parentSelectContainer" style="display:none;">
                                        <h6 class="m-t-20">Parent Menu / Kategori</h6>
                                        <select id="parentSelect" name="parentSelect" style="width: 100%" class="select2 form-control custom-select" >
											<?php foreach ($categories as $index => $category): ?>
												<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
											<?php endforeach; ?>
                                        </select>
                                    </div>
									
									

									<div class="col-12">
                                        <h6 class="m-t-20"></h6>
                                        <div class="box-label">
                                            <button type="submit" class="btn btn-info text-white save-btn" style="font-size: 13px; width:100%;">
                                                + Buat Menu / Kategori
                                            </button>
                                        </div>
                                    </div>

                            </div>

                        </form>

                    </div>

                    <div class="right-aside">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h4 class="card-title m-t-10">
                                        List Menu / Kategori
                                    </h4>
                                </div>
                                <div class="ml-auto">
                                    <input
                                        type="text"
                                        id="demo-input-search2"
                                        placeholder="search contacts"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                id="demo-foo-addrow"
                                class=" table table-bordered m-t-30 no-wrap table-hover contact-list"
                                data-paging="true"
                                data-paging-size="3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu / Kategori</th>
                                        <th>Level</th>
                                        <th>Parent</th>
                                        <th>Total Kontent</th>
										<th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $index => $category): ?>
									<tr>
										<td><?= $index + 1 ?></td>
										<td><?= htmlspecialchars($category['name']) ?></td>
										<td>Level <?= $category['level'] ?></td>
										<td>
											<?php 
												if($category['parent_id']) {
													$parent = $this->CategoryModel->get_by_id($category['parent_id']);
													echo htmlspecialchars($parent['name'] ?? '-');
												} else {
													echo '-';
												}
											?>
										</td>
										<td><?= $this->CategoryModel->count_articles($category['id']) ?></td>
										<td>
											<button class="btn btn-sm btn-danger delete-btn" 
												data-id="<?= $category['id'] ?>"
												 data-name="<?= htmlspecialchars($category['name']) ?>"
                        						 data-content="<?= $this->CategoryModel->count_articles($category['id']) ?>">
												<i class="fa fa-trash"></i> Hapus
											</button>
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
    </div>

</div>
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteCategoryModalLabel">Hapus Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="deleteCategoryForm">
                <div class="modal-body">
                    <input type="hidden" id="categoryToDelete" name="category_id">
                    <div id="contentAlert" class="alert alert-info d-none">
                        Kategori ini memiliki <strong><span id="contentCount">0</span> konten</strong>.
                    </div>
                    <div id="moveForm">
                        <div class="form-group">
                            <label for="newCategory">Pindahkan semua konten ke:</label>
                            <select id="newCategory" name="new_category_id" class="form-control select2" style="width: 100%">
                                <option value="">Pilih Kategori Tujuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Proses</button>
                </div>
            </form>
		</div>
	</div>
</div>
<script>
	$(function () {
		$("#demo-foo-addrow").footable();
		$(".select2").select2({
			dropdownParent: $('.modal') 
		});
		$(".selectpicker").selectpicker();
	});
	$(document).ready(function() {
		// Inisialisasi Select2
		$('.select2').select2();

		// Handle tombol delete
		$(document).on('click', '.delete-btn', function() {
			const categoryId = $(this).data('id');
			const categoryName = $(this).data('name');
			const contentCount = $(this).data('content');

			if (contentCount == 0) {
				Swal.fire({
					title: 'Hapus Kategori?',
					text: `Yakin menghapus kategori ${categoryName}?`,
					icon: 'question',
					showCancelButton: true,
					confirmButtonText: 'Ya, Hapus',
					cancelButtonText: 'Batal'
				}).then((result) => {
					if (result.isConfirmed) {
						deleteCategory(categoryId);
					}
				});
			} else {
				// Jika ada konten
				$('#categoryToDelete').val(categoryId);
				$('#contentCount').text(contentCount);
				$('#contentAlert').removeClass('d-none');
				$('#moveForm').show();
				
				// Load kategori tujuan
				$.ajax({
					url: '<?= base_url("category/get-categories-exclude/") ?>' + categoryId,
					type: 'GET',
					beforeSend: function() {
						$('#newCategory').html('<option value="">Loading...</option>');
					},
					success: function(response) {
						$('#newCategory').html('<option value="">Pilih Kategori Tujuan</option>');
						$.each(response, function(key, category) {
							$('#newCategory').append($('<option>', {
								value: category.id,
								text: category.name
							}));
						});
						$('#deleteCategoryModal').modal('show');
					}
				});
			}
		});

		$('#deleteCategoryForm').submit(function(e) {
			e.preventDefault();
			const formData = $(this).serialize();
			
			Swal.fire({
				title: 'Konfirmasi',
				text: 'Apakah Anda yakin ingin menghapus kategori dan memindahkan semua konten?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Proses',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("category/delete-with-move") ?>',
						type: 'POST',
						data: formData + '&<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>',
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								Swal.fire({
									title: 'Berhasil',
									text: response.message,
									icon: 'success'
								}).then(() => {
									$('#deleteCategoryModal').modal('hide');
									location.reload();
								});
							} else {
								Swal.fire('Gagal', response.message, 'error');
							}
						}
					});
				}
			});
		});

		// Fungsi hapus kategori tanpa konten
		function deleteCategory(categoryId) {
			$.ajax({
				url: '<?= base_url("category/delete/") ?>' + categoryId,
				type: 'POST',
				data: {
					'<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
				},
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						Swal.fire({
							title: 'Berhasil',
							text: response.message,
							icon: 'success'
						}).then(() => location.reload());
					} else {
						Swal.fire('Gagal', response.message, 'error');
					}
				}
			});
		}
	});

	// $(document).on('click', '.delete-btn', function() {
	// 	const categoryId = $(this).data('id');
	// 	$('#categoryToDelete').val(categoryId);
	// 	console.log("test")
		
	// 	$.ajax({
	// 		url: '<?= base_url("category/get-categories-exclude/") ?>' + categoryId,
	// 		type: 'GET',
	// 		dataType: 'json',
	// 		success: function(response) {
	// 			$('#newCategory').empty();
	// 			$('#newCategory').append('<option value="">Pilih Kategori</option>');
				
	// 			$.each(response, function(key, category) {
	// 				$('#newCategory').append('<option value="'+category.id+'">'+category.name+'</option>');
	// 			});
				
	// 			$('#newCategory').trigger('change');
	// 		}
	// 	});
		
	// 	$('#deleteCategoryModal').modal('show');
	// });

	// $('#deleteCategoryForm').submit(function(e) {
	// 	e.preventDefault();
		
	// 	const formData = $(this).serialize();
		
	// 	Swal.fire({
	// 		title: 'Apakah Anda yakin?',
	// 		text: "Kategori akan dihapus dan semua artikel akan dipindahkan!",
	// 		icon: 'warning',
	// 		showCancelButton: true,
	// 		confirmButtonColor: '#3085d6',
	// 		cancelButtonColor: '#d33',
	// 		confirmButtonText: 'Ya, hapus!',
	// 		cancelButtonText: 'Batal'
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			$.ajax({
	// 				url: '<?= base_url("category/delete-with-move") ?>',
	// 				type: 'POST',
	// 				data: formData + '&<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>',
	// 				dataType: 'json',
	// 				success: function(response) {
	// 					if (response.success) {
	// 						Swal.fire({
	// 							icon: 'success',
	// 							title: 'Berhasil',
	// 							text: response.message,
	// 							timer: 2000,
	// 							showConfirmButton: false
	// 						}).then(() => {
	// 							$('#deleteCategoryModal').modal('hide');
	// 							window.location.reload();
	// 						});
	// 					} else {
	// 						Swal.fire({
	// 							icon: 'error',
	// 							title: 'Gagal',
	// 							text: response.message
	// 						});
	// 					}
	// 				},
	// 				error: function(xhr, status, error) {
	// 					Swal.fire({
	// 						icon: 'error',
	// 						title: 'Error',
	// 						text: 'Terjadi kesalahan saat menghapus data'
	// 					});
	// 				}
	// 			});
	// 		}
	// 	});
	// });

	const levelSelect = document.getElementById('levelSelect');
	
	levelSelect.addEventListener('change', function() {
		const selectedValue = this.value;
		const parentSelectContainer = document.getElementById('parentSelectContainer');
		if (selectedValue === 'Level 2' || selectedValue === 'Level 3') {
            parentSelectContainer.style.display = 'block';
        } else {
            parentSelectContainer.style.display = 'none';
        }
		
		console.log('Level yang dipilih:', selectedValue);
	});

	$('#categoryForm').submit(function(e) {
		e.preventDefault();
		const formData = new FormData(this);
		const menuName = $('#menuName').val();
		const levelMenu = $('#levelSelect').val();
		const parent = (levelMenu === 'Level 1') ? null : levelMenu;
		const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
		const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		let menuParent = null;
		if(!menuName){
			Swal.fire({
				icon: 'warning',
				title: 'Error',
				text: 'Nama Menu harus diisi'
			});
			process.exit();
		}
		if(!levelMenu){
			Swal.fire({
				icon: 'warning',
				title: 'Error',
				text: 'Level Menu harus dipilih'
			});
			process.exit();
		}
		
		if(levelMenu === 'Level 2' || levelMenu === 'Level 3'){
			menuParent = $('#parentSelect').val();
		};
		if(levelMenu && !menuParent){
			Swal.fire({
				icon: 'warning',
				title: 'Error',
				text: 'Parent harus dipilih'
			});
			process.exit();
		}

		formData.append(csrfName, csrfHash);
		formData.append('level', levelMenu);
		formData.append('parent', menuParent);
		formData.append('menu_name', menuName);
		console.log('menuParent', menuParent);
		$.ajax({
			url: '<?= base_url("category/save") ?>',
			type: 'POST',
			
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: response.message,
						timer: 2000,
						showConfirmButton: false
					}).then(() => {
						window.location.reload();
					});
				} else {
					console.error('Error:', response.message);
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: response.message
					});
				}
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Terjadi kesalahan saat menghapus data'
				})
			}
			
		})

	});

</script>
