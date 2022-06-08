<nav>
    <ul class="pagination justify-content-center">
        <?php if ($total_pages > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo '1' . '&limit=' . $limit;
                if(isset($params)) echo $params ?>">Перша</a>
            </li>
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page - 1) . '&limit=' . $limit ;
                                                    if(isset($params)) echo $params?>">Попередня</a>
                </li>
            <?php endif; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page + 1) . '&limit=' . $limit;
                                                    if(isset($params)) echo $params?>">Наступна</a>
                </li>
            <?php endif; ?>

            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $total_pages . '&limit=' . $limit ;
                                                if(isset($params)) echo $params ?>">Остання</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
