<?php  
    $total_records = $commons->getCount($paginatecount,$params) ;
    $total_pages = ceil($total_records / $limit); 
    /* echo  $total_pages; */
    // echo "<br>";
    // echo $total_records;
    // echo "<br>";
    // echo $limit;
    if($total_records>$limit):
?>

<nav aria-label="Page navigation example">
  <ul class="pagination m-0">
        <li class="page-item <?= ($page >= 2)?'':'disabled'?>">
            <a class="page-link" href="<?= $page_url.($page - 1)?>">Previous</a>
        </li>
    <?php for ($i=1; $i<=$total_pages; $i++): ?>
        <li class="page-item <?= $i==$page?'active':'' ?>">
            <a class="page-link" href="<?= $page_url.$i?>"><?=$i?></a>
        </li>
    <?php endfor; ?>
        <li class="page-item <?= ($page<$total_pages)?'':'disabled'?>">
            <a class="page-link" href="<?= $page_url.($page + 1)?>">Next</a>
        </li>
  </ul>
</nav>
<?php endif; ?>