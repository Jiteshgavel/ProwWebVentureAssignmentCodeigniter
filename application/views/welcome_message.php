
<?php $this->load->view('includes/header.php') ?>
<?php  $this->load->view('includes/nav.php') ?>



  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container">
     
      <h1 class="text-center">Web Image Scraper</h1>

    <form action="<?= base_url('scraper/scrape') ?>" method="post">
        <div class="input-group">
          <input class="form-control" type="url" placeholder="Enter web url to get images" name="url" id="url" value="<?= $url ?? '' ?>" required>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Scrape</button>
          </div>
        </div>
      </form>
    </div>
  </section><!-- End Hero Section -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">
<?php if (isset($error)) { ?>
          <p><?= $error ?></p>
  <?php } ?>
        <div class="row gy-4 justify-content-center">
          <?php if (isset($images) && count($images)) { ?>
            <?php foreach ($images as $key => $image) { ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                      <div class="gallery-item h-100 ">
                        <img src="<?= $image ?>" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                          <a href="<?= $image ?>"  class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                          <!-- <a href="#" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                        </div>
                      </div>
                    </div><!-- End Gallery Item -->
              <?php } ?>
        <?php } ?>

        </div>

      </div>
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

  <?php $this->load->view('includes/footer.php') ?>

  