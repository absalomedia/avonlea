<?php  if (! defined('BASEPATH')) {
     exit('No direct script access allowed');
}

class MY_Image_lib extends CI_Image_lib
{
    
    //stop images from enlarging
    public function image_reproportion()
    {
        if (!is_numeric($this->width) || !is_numeric($this->height) or $this->width === 0 or $this->height === 0) {
            return;
        }

        if (!is_numeric($this->orig_width) || !is_numeric($this->orig_height) || $this->orig_width === 0 || $this->orig_height === 0) {
            return;
        }

        // STEP 1: Are new measures needed?
        if ($this->orig_width <= $this->width && $this->orig_height <= $this->height) {
            // Image is smaller
            $this->width    = $this->orig_width;
            $this->height    = $this->orig_height;
        }

        // STEP 2: Calculate new measurements
        // <!-- Original code from here -->

        $new_width    = ceil($this->orig_width*$this->height/$this->orig_height);
        $new_height    = ceil($this->width*$this->orig_height/$this->orig_width);

        $ratio        = (($this->orig_height/$this->orig_width) - ($this->height/$this->width));

        if ($this->master_dim != 'width' && $this->master_dim != 'height') {
            $this->master_dim    = ($ratio < 0) ? 'width' : 'height';
        }

        if (($this->width != $new_width) && ($this->height != $new_height)) {
            if ($this->master_dim    === 'height') {
                $this->width    = $new_width;
            } else {
                $this->height    = $new_height;
            }
        }
    }
}
