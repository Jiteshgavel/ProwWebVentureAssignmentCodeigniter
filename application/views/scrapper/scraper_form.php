<!-- application/views/scraper_form.php -->
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <title>Web Scraper Form</title>
   
</head>

<body>
    <div class="container">
         <a class="btn btn-primary mt-2" href="<?php echo base_url('twitterauth'); ?>">Login with Twitter</a>
        <h3>Web Scraper Form</h3>
    <form class="" action="<?= base_url('scraper/scrape') ?>" method="post">
    <div class="input-group">
            <input class="form-control " type="url" name="url" id="url" required>
            <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Scrape</button>
            </div>
    </div>
        </form>

    </div>
    
</body>

</html>