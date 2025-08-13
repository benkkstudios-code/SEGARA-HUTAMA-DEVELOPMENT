<?php

namespace App\Libraries;

use Exception;

class ThumbnailCreator
{
    public $image;
    public $image_type;

    public function __construct($filename = null)
    {
        if (!empty($filename)) {
            $this->load($filename);
        }
    }

    public function getLoadedImage()
    {
        ob_start();
        imagepng($this->image);
        return (ob_get_clean());
    }
    public function load($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];

        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        } else {
            throw new Exception("The file you're trying to open is not supported");
        }
    }

    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }

        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    public function output($image_type = IMAGETYPE_JPEG, $quality = 80)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            //header("Content-type: image/jpeg");
            // start buffering
            ob_start();
            // output jpeg (or any other chosen) format & quality
            imagejpeg($this->image, NULL, 85);
            // capture output to string
            $contents = ob_get_contents();
            // end capture
            ob_end_clean();
            // be tidy; free up memory
            imagedestroy($this->image);
            $data = base64_encode($contents);
            echo '<img src="data:image/jpg;base64,' . $data . '" />';
        } elseif ($image_type == IMAGETYPE_GIF) {
            //header("Content-type: image/gif");
            // start buffering
            ob_start();
            // output gif (or any other chosen) format & quality
            imagegif($this->image);
            // capture output to string
            $contents = ob_get_contents();
            // end capture
            ob_end_clean();
            // be tidy; free up memory
            imagedestroy($this->image);
            $data = base64_encode($contents);
            echo '<img src="data:image/gif;base64,' . $data . '" />';
        } elseif ($image_type == IMAGETYPE_PNG) {
            //header("Content-type: image/png");
            // start buffering
            ob_start();
            // output png (or any other chosen) format & quality
            imagepng($this->image);
            // capture output to string
            $contents = ob_get_contents();
            // end capture
            ob_end_clean();
            // be tidy; free up memory
            imagedestroy($this->image);
            $data = base64_encode($contents);
            echo '<img src="data:image/png;base64,' . $data . '" />';
        }
    }
    public function getWidth()
    {
        return imagesx($this->image);
    }

    public function getHeight()
    {
        return imagesy($this->image);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = round($this->getWidth() * $ratio);
        $this->resize($width, $height);
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = round($this->getHeight() * $ratio);
        $this->resize($width, $height);
    }

    public function square($size)
    {
        $new_image = imagecreatetruecolor($size, $size);

        if ($this->getWidth() > $this->getHeight()) {
            $this->resizeToHeight($size);

            imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            imagecopy($new_image, $this->image, 0, 0, ($this->getWidth() - $size) / 2, 0, $size, $size);
        } else {
            $this->resizeToWidth($size);

            imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            imagecopy($new_image, $this->image, 0, 0, 0, ($this->getHeight() - $size) / 2, $size, $size);
        }

        $this->image = $new_image;
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);

        imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    public function cut($x, $y, $width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);

        imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        imagecopy($new_image, $this->image, 0, 0, $x, $y, $width, $height);

        $this->image = $new_image;
    }

    public function maxarea($width, $height = null)
    {
        $height = $height ? $height : $width;

        if ($this->getWidth() > $width) {
            $this->resizeToWidth($width);
        }
        if ($this->getHeight() > $height) {
            $this->resizeToheight($height);
        }
    }

    public function minarea($width, $height = null)
    {
        $height = $height ? $height : $width;

        if ($this->getWidth() < $width) {
            $this->resizeToWidth($width);
        }
        if ($this->getHeight() < $height) {
            $this->resizeToheight($height);
        }
    }

    public function cutFromCenter($width, $height)
    {

        if ($width < $this->getWidth() && $width > $height) {
            $this->resizeToWidth($width);
        }
        if ($height < $this->getHeight() && $width < $height) {
            $this->resizeToHeight($height);
        }

        $x = ($this->getWidth() / 2) - ($width / 2);
        $y = ($this->getHeight() / 2) - ($height / 2);

        return $this->cut($x, $y, $width, $height);
    }

    public function maxareafill($width, $height, $red = 0, $green = 0, $blue = 0)
    {
        $this->maxarea($width, $height);
        $new_image = imagecreatetruecolor($width, $height);
        $color_fill = imagecolorallocate($new_image, $red, $green, $blue);
        imagefill($new_image, 0, 0, $color_fill);
        imagecopyresampled(
            $new_image,
            $this->image,
            floor(($width - $this->getWidth()) / 2),
            floor(($height - $this->getHeight()) / 2),
            0,
            0,
            $this->getWidth(),
            $this->getHeight(),
            $this->getWidth(),
            $this->getHeight()
        );
        $this->image = $new_image;
    }
}
