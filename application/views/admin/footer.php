    <hr/>
    <footer></footer>
</div>



<?php
    $_js2 = new JSCrunch();
    $_js2->addFile('barba.min');
    $_js2->addFile('flatpickr.min');

    if (true) { //Dev Mode
        //in development mode keep all the css files separate
        $_js2->crunch(true);
    } else {
        //combine all css files in live mode
        $_js2->crunch();
    }
?>

<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.table.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.uploadcare.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/spin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mustache.min.js'); ?>"></script>


<script type="text/javascript">
$(document).ready(function(){

    var base = "<?php echo base_url(); ?>";

var nav = responsiveNav(".nav-collapse", { // Selector
  animate: true, // Boolean: Use CSS3 transitions, true or false
  transition: 284, // Integer: Speed of the transition, in milliseconds
  label: "Menu", // String: Label for the navigation toggle
  insert: "before", // String: Insert the toggle before or after the navigation
});


    flatpickr('.datepicker');

    $('.trumb').trumbowyg({
    fullscreenable: false,
    autogrow: true,
        lang: 'en',
        svgPath: base+'/themes/default/assets/img/icons.svg',
    btnsDef: {
                // Customizables dropdowns
                image: {
                    dropdown: ['insertImage','uploadcare'],
                    ico: 'insertImage'
                },
                linkImproved: {
                    dropdown: ['createLink', 'unlink'],
                    ico: 'link'
                },
                newTable: {
                    dropdown: ['table'],
                    ico: 'table'
                }
            },
            btns: ['viewHTML','formatting','btnGrp-design','linkImproved', 'image', 'newTable','btnGrp-justify','btnGrp-lists','horizontalRule']
  });

});
</script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {

  Barba.Pjax.Dom.wrapperId = 'main';
  Barba.Pjax.Dom.containerClass = 'content';
  Barba.Pjax.init();

  Barba.Prefetch.init();


  });
  </script>
</body>
</html>
