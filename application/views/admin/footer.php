    <hr/>
    <footer></footer>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.3.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/pickadate/picker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/pickadate/picker.date.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.table.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/trumb/trumbowyg.uploadcare.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/spin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mustache.min.js'); ?>"></script>
<?php
    $_js = new JSCrunch();
    $_js->addFile('barba.min');
    $_js->addFile('flatpickr.min');

if (true) { //Dev Mode
    //in development mode keep all the css files separate
    $_js->crunch(true);
} else {
    //combine all css files in live mode
    $_js->crunch();
}
?>




<script type="text/javascript">
$(document).ready(function(){

    var base = "<?php echo base_url(); ?>";

    flatpickr('.datepicker', { altInput: true,  minDate: "today", data-altFormat: "F j, Y" });

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
