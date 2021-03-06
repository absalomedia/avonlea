<?php pageHeader(lang('page_form')) ?>

<?php echo form_open('admin/pages/form/'.$optn); ?>

<div class="row">
    <div class="col-md-3">
        <div class="pure-control-group">
            <label for="title"><?php echo lang('title'); ?></label>
            <?php echo form_input(['name' => 'title', 'value' => assign_value('title', $title), 'class' => 'form-control']); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="pure-control-group">
            <label for="menu_title"><?php echo lang('menu_title'); ?></label>
            <?php echo form_input(['name' => 'menu_title', 'value' => assign_value('menu_title', $menu_title), 'class' => 'form-control']); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="pure-control-group">
            <label for="seo_title"><?php echo lang('seo_title'); ?></label>
            <?php echo form_input(['name' => 'seo_title', 'value' => assign_value('seo_title', $seo_title), 'class' => 'form-control']); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="pure-control-group">
            <label for="slug"><?php echo lang('slug'); ?></label>
            <?php echo form_input(['name' => 'slug', 'value' => assign_value('slug', $slug), 'class' => 'form-control']); ?>
        </div>
    </div>
</div>

<div class="pure-control-group">
    <div class="pure-control-group">
        <label for="content"><?php echo lang('content'); ?></label>
        <?php echo form_textarea(['name' => 'content', 'value' => assign_value('content', $content), 'class' => 'form-control trumb']); ?>
    </div>
</div>


<div class="row">
    <div class="col-md-3">
        <div class="pure-control-group">
            <label for="parent_id"><?php echo lang('parent_id'); ?></label>
            <?php
            $options = [];
            $options[-1] = lang('hidden');
            $options[0] = lang('top_level');
            function pageLooper($pages, $dash = '', $optn = 0)
            {
                $options = [];
                foreach ($pages as $page) {
                    //this is to stop the whole tree of a particular link from showing up while editing it
                    if ($optn != $page->id) {
                        $options[$page->id] = $dash.' '.$page->title;
                        $options = $options + pageLooper($page->children, $dash.'-', $optn);
                    }
                }

                return $options;
            }
            $options = $options + pageLooper($pages, '', $optn);
            echo form_dropdown('parent_id', $options, assign_value('parent_id', $parent_id), 'class="form-control"');
            ?>
        </div>

        <div class="pure-control-group">
            <label for="sequence"><?php echo lang('sequence'); ?></label>
            <?php echo form_input(['name' => 'sequence', 'value' => assign_value('sequence', $sequence), 'class' => 'form-control']); ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="pure-control-group">
            <label><?php echo lang('meta'); ?></label>
            <?php echo form_textarea(['rows' => '3', 'name' => 'meta', 'value' => assign_value('meta', html_entity_decode($meta)), 'class' => 'form-control']); ?>
            <span id="helpBlock" class="help-block"><?php echo lang('meta_data_description'); ?></span>
        </div>
    </div>
</div>



<div class="form-actions">
    <button type="submit" class="pure-button pure-button-primary"><?php echo lang('save'); ?></button>
</div>  
</form>
