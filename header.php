        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/assets/css/header_bootstrap.min.css" >

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Магазин</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Shop</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/profile/<?=$_SESSION["currentUser"]["id_user"]?>">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <?php
    $handleRequest();
    ?>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js" ></script>
    <script src="/assets/js/bootstrap.min.js"></script>

<?php foreach ($scriptAssets as $scriptAsset): ?>
<script src="<?= $scriptAsset?>"></script>
<?php endforeach; ?>
    
    </body>
    </html>
   