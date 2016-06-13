            <div id="footer">
				<p><?php echo anchor('http://bambooinvoice.org', $this->lang->line('bambooinvoice_logo'), ['title' => 'BambooInvoice']); ?> &copy; <?php echo date('Y'); ?> (<?php echo $this->lang->line('bambooinvoice_version'); ?> <?php echo \CI::Settings()->getSettings('bambooinvoice_version'); ?>)</p>
            </div>
        </div>
    </div>
</div>
<?php if (\CI::Settings()->getSettings('demo_flag') == 'y') :?>
<script src="https://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
</script>
<?php endif; ?>
</body>
</html>
