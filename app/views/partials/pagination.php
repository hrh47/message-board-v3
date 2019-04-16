<nav aria-label="..." class="d-flex justify-content-center">
  <ul class="pagination">
  	<?php if ($prevUrl): ?>
	    <li class="page-item">
	      	<a class="page-link" href="<?= $prevUrl; ?>" tabindex="-1">前一頁</a>
	    </li>
	  <?php else: ?>
	  	<li class="page-item disabled">
	      	<a class="page-link" href="#" tabindex="-1" onclick="return false">前一頁</a>
	    </li>
	  <?php endif; ?>

    <?php if ($nextUrl): ?>
	    <li class="page-item">
	      	<a class="page-link" href="<?= $nextUrl; ?>" tabindex="-1">下一頁</a>
	    </li>
	  <?php else: ?>
	  	<li class="page-item disabled">
	      	<a class="page-link" href="#" tabindex="-1" onclick="return false">下一頁</a>
	    </li>
	  <?php endif; ?>
  </ul>
</nav>