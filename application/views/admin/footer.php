    <hr/>
    <footer></footer>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/pickadate/picker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/pickadate/picker.date.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/redactor.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/imagemanager.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/spin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mustache.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/redactor_lang/'.config_item('language').'.js'); ?>"></script>
<?php
    $_js = new JSCrunch();
    $_js->addFile('barba.min');

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
    $('.datepicker').pickadate({formatSubmit:'yyyy-mm-dd', hiddenName:true, format:'mm/dd/yyyy'});
    //$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});

    $('.redactor').redactor({
        lang: '<?php echo config_item('language'); ?>',
        minHeight: 200,
        pastePlainText: true,
        linebreaks:true,
        imageUpload: '<?php echo site_url('admin/wysiwyg/upload_image'); ?>',
        imageManagerJson: '<?php echo site_url('admin/wysiwyg/get_images'); ?>',
        imageUploadErrorCallback: function(json)
        {
            alert(json.error);
        },
        plugins: ['imagemanager']
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