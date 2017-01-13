</main>

<footer>
    <div class="container">
        <nav>
            <?php pageLooper(0, 'class="nav nav-center"'); ?>
        </nav>

    </div>
</footer>

<?php 

$_js = new JSCrunch();
$_js->addFile('jquery-3.0.0.min');
$_js->addFile('jquery-migrate-3.0.0');
$_js->addFile('jquery.spin');
$_js->addFile('barba');

if (true) { //Dev Mode
//in development mode keep all the css files separate
    $_js->crunch(true);
} else {
    //combine all css files in live mode
    $_js->crunch();
}

    //with this I can put additional scripts in the footer instead of in the body.
if (isset($additional_footer_info)) {
    echo $additional_footer_info;
} ?>



<script>
setInterval(function(){
    resizeCategories();
}, 200);

function updateItemCount(items)
{
    $('#itemCount').text(items);
}

function resizeCategories()
{
    $('.categoryItem').each(function(){
        $(this).height($(this).width());
        var look = $(this).find('.look');
        var margin = 0-look.height()/2;
        look.css('margin-top', margin);
    });
}
</script>

</body>
</html>
