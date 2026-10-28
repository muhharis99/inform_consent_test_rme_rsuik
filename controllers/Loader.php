<?php
/**
 * loader.php
 */

load_class('cssmin', false);
load_class('jsmin', false);

class Loader extends Controller {

    var $asset_output;
    var $type;
    var $files;
    var $asset_path;
    var $ext;
    var $content_type;
    var $modified_time;

    function Loader()
    {
        parent::Controller();
        $this->modified_time = 0;
    }

    function js($files)
    {
        $this->type = 'js';
        $this->files = $files;
        $this->asset_path = $this->config->item('js_path');
        $this->ext = '.js';
        $this->content_type = 'text/javascript';

        $this->_output();
    }

    function css($files)
    {
        $this->type = 'css';
        $this->files = $files;
        $this->asset_path = $this->config->item('css_path');
        $this->ext = '.css';
        $this->content_type = 'text/css';

        $this->_output();
    }

    function _output()
    {
        $files_array = explode("|", $this->files);
        foreach ($files_array as $key => $file)
        {
            //replace chars for folder separation, replace ~ with /
            $file = str_replace('~', '/', $file);
            if (file_exists($this->asset_path . $file . $this->ext))
            {
                $this->asset_output .= file_get_contents($this->asset_path . $file . $this->ext)."\n";
                $this->modified_time = max(filemtime($this->asset_path . $file . $this->ext), $this->modified_time);
            }
        }

        //replace occurrences of /assets/ with asset_url()
        //$this->asset_output = str_replace("/assets/", asset_url(), $this->asset_output);

        switch ($this->type)
        {
            case 'js':
                $this->asset_output = JSMin::minify($this->asset_output);
                break;
            case 'css':
                $this->asset_output = CSSMin::minify($this->asset_output);
                break;
            default:
                throw new LoaderException("Unknown file type.");
                break;
        }

        //gzip
        if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
            if (stristr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
                $this->asset_output = gzencode($this->asset_output);
                header('Content-encoding: gzip');
            } else if (stristr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate') !== false) {
                $this->asset_output = gzdeflate($this->asset_output);
                header('Content-encoding: deflate');
            }
        }

        //headers
        header('Content-type: ' . $this->content_type);
        header('Last-modified: ' . date('r', $this->modified_time));
        header('Expires: ' . date('r', time() + 2592000));
        header('Content-length: ' . strlen($this->asset_output));

        echo $this->asset_output;
    }
}

/* End of file loader.php */
/* Location: ./system/application/controllers/loader.php */