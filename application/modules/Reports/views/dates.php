<?php
$this->load->view('header');
?>
<h2><?php echo $this->lang->line('bambooinvoice_logo'); ?> <?php echo $page_title; ?></h2>

<p><?php echo anchor('reports', $this->lang->line('reports_back_to_reports')); ?></p>

<h3><?php echo $report_dates; ?></h3>

<?php
/**
 * This will be added into Bamboo in the next iteration,
 * I just simply didn't have time for it this time around.
*/
?>
<?php echo $data_table; ?>

<p><?php echo anchor('reports', $this->lang->line('reports_back_to_reports')); ?></p>

<?php
$this->load->view('footer');
?>