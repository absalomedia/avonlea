<?php if ($page_title) :?>
    <div class="page-header">
        <h1><?php echo $page_title; ?></h1>
    </div>
<?php endif; ?>

<?php
echo(new ContentFilter($page->content))->display();
?>