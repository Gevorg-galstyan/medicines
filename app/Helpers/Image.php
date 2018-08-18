<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image as InterventionImage;

class Image extends BaseType
{
    public function handle()
    {
        if ($this->request->hasFile($this->files)) {
            $file = $this->request->file($this->files);

            $path = $this->slug . DIRECTORY_SEPARATOR . $this->path . date('FY') . DIRECTORY_SEPARATOR;

            $filename = $this->generateFileName($file, $path);

            $image = InterventionImage::make($file);

            if (!empty($this->request->watermark)) {
                $width = $image->width();
                $watermark = InterventionImage::make(storage_path('app/public/' . $this->request->watermark))->opacity(50);
                $watermark = $watermark->resize($width,null);
                $image = $image->insert($watermark, 'center');
            }
            $fullPath = $path . $filename . '.' . $file->getClientOriginalExtension();

            $resize_quality = 75;

            $image = $image->encode($file->getClientOriginalExtension(), $resize_quality);


            Storage::disk('public')->put($fullPath, (string)$image, 'public');

            return $fullPath;
        }
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param $path
     *
     * @return string
     */
    protected function generateFileName($file, $path)
    {
        if (isset($this->options->preserveFileUploadName) && $this->options->preserveFileUploadName) {
            $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension());
            $filename_counter = 1;

            // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
            while (Storage::disk(config('voyager.storage.disk'))->exists($path . $filename . '.' . $file->getClientOriginalExtension())) {
                $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension()) . (string)($filename_counter++);
            }
        } else {
            $filename = Str::random(20);

            // Make sure the filename does not exist, if it does, just regenerate
            while (Storage::disk(config('voyager.storage.disk'))->exists($path . $filename . '.' . $file->getClientOriginalExtension())) {
                $filename = Str::random(20);
            }
        }

        return $filename;
    }

}
