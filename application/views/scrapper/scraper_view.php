<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web Scraper</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
        /* table {
        margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        } */
        img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>

<body>
     <div class="container">
    <a class="btn btn-primary mt-2" href="<?php echo base_url('twitterauth'); ?>">Login with Twitter</a>
     <h1>Web Scraper</h1>

    <form action="<?= base_url('scraper/scrape') ?>" method="post">
       <div class="input-group">
        <input class="form-control" type="url" name="url" id="url" value="<?= $url ?>" required>
        <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Scrape</button>
        </div>
       </div>
    </form>
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
    <?php if (!empty($images)) { ?>
    <table class="table table-striped mt-3">     
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Scraped images</th>
        </tr>
    </thead>
        <?php $count = 0; ?>
        <?php foreach ($images as $key => $image) { ?>
            <tr>
                    <td><?=  $count+=1 ?></td>
                    <td><img src="<?= $image ?>" alt="Image"></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
     </div>
</body>

</html>