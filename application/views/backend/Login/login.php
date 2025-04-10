<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href=<?php echo base_url()."assets/css/mdb.min.css"?> />
	<link rel="stylesheet" href=<?php echo base_url()."assets/css/login.css"?> />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
	<title>Document</title>
	
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src=<?php echo base_url()."assets/img/draw2.webp"?>
          class="img-fluid" alt="Sample image"/>
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
			<?php if(!empty($this->session->flashdata('error_login'))): ?>
				
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error_login'); ?></div>
    	 <?php endif; ?>
			 <form action=<?php echo base_url()."auth"; ?> method="post" enctype="multipart/form-data">

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Sign in with</p>
          </div>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
					<input name="username" id="form3Example3" class="form-control form-control-lg" placeholder="Enter username" />
					<label class="form-label" for="form3Example3">Username</label>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
            <label class="form-label" for="form3Example4">Password</label>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button  type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2020. All rights reserved.
    </div>
  </div>
</section>


<script type="text/javascript" src=<?php echo base_url()."assets/js/mdb.umd.min.js"?>></script>
</body>
</html>
