<div class="url" data-attr="<?=$url; ?>"></div>
<div class="urlProfile" data-attr="<?=$urlProfile; ?>"></div>

<div class="container">

        <ul class="pagination">
            <?php if ($page >= 1): ?>
                <li class="page-previous">
               
                    <span
                        class="page-link"
                        data-page="<?= $page ?>"
                        data-limit="<?= $limit ?>"\
                        >
                
                    Previous
                    </span>
                </li>
            <?php endif ?>
          
            <?php for ($i = $page - 3; $i < $page + 3; $i++): ?>
                <?php if ($i >= 0): ?>
                    <li class="page-item">
                    
                        <span class="page-link"
                            data-page="<?=$i?>" 
                            data-limit="<?= $limit ?>"
                        >
                        <?=$i + 1?>
                        </span>
                
                <?php endif; ?>
            <?php endfor; ?>
            </li>

            <li class="page-next">
                
                <span
                    class="page-link"
                    data-page="<?= $page ?>"
                    data-limit="<?= $limit ?>"
                    >
                   
                 Next
                </span>
            </li>
        </ul>
    </nav>
</div>

<div id='users-list' class='row'></div>
