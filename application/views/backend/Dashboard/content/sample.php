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
                            <form id="categoryForm" class="p-r-30">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="m-t-20">Nama Menu / Kategori</h6>
                                        <input type="text" id="menuName" name="menu_name" class="form-control" placeholder="Menu / Kategori" required/>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="m-t-20">Pilih Level</h6>
                                        <select id="levelSelect" name="level" class="selectpicker" data-style="form-control btn-secondary custom-select" required>
                                            <option value="Level 1">Level 1</option>
                                            <option value="Level 2">Level 2</option>
                                            <option value="Level 3">Level 3</option>
                                        </select>
                                    </div>
                                    <div class="col-12" id="parentSelectContainer" style="display:none;">
                                        <h6 class="m-t-20">Parent Menu / Kategori</h6>
                                        <select id="parentSelect" name="parent" style="width: 100%" class="select2 form-control custom-select" required>
                                            <option value="">Pilih Parent</option>
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
                                        <h4 class="card-title m-t-10">List Menu / Kategori</h4>
                                    </div>
                                    <div class="ml-auto">
                                        <input type="text" id="demo-input-search2" placeholder="search contacts" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="categoryTable" class="table table-bordered m-t-30 no-wrap table-hover contact-list" data-paging="true" data-paging-size="3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu / Kategori</th>
                                            <th>Level</th>
                                            <th>Parent</th>
                                            <th>Total Kontent</th>
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
                                            <td>0</td> <!-- Anda bisa menambahkan logika hitung konten di sini -->
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const levelSelect = document.getElementById('levelSelect');
    const parentSelect = document.getElementById('parentSelect');
    const parentSelectContainer = document.getElementById('parentSelectContainer');
    const categoryForm = document.getElementById('categoryForm');
    const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    // Inisialisasi select2
    $(parentSelect).select2();

    // Fungsi untuk load parent options
    function loadParentOptions(level) {
        if (level === 'Level 1') return;
        
        const parentLevel = level === 'Level 2' ? 1 : 2;
        
        fetch(`<?php echo base_url('CategoryController/get_by_level'); ?>?level=${parentLevel}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            parentSelect.innerHTML = '<option value="">Pilih Parent</option>';
            
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.text;
                parentSelect.appendChild(option);
            });
            
            $(parentSelect).trigger('change');
        });
    }

    // Handle perubahan level
    levelSelect.addEventListener('change', function() {
        if (this.value === 'Level 2' || this.value === 'Level 3') {
            parentSelectContainer.style.display = 'block';
            loadParentOptions(this.value);
            parentSelect.setAttribute('required', 'required');
        } else {
            parentSelectContainer.style.display = 'none';
            parentSelect.removeAttribute('required');
        }
    });

    // Handle form submission
    categoryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append(csrfName, csrfHash);
        
        fetch('<?php echo base_url('CategoryController/save'); ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan data'
            });
        });
    });
});
</script>
