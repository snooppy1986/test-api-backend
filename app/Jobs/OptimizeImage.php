<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\Queue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Image;

class OptimizeImage
{
    use Queueable;
    use InteractsWithQueue;
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $file,
        private string $path,
        private string $fileName,
        private string $fileExt='jpg',
        private int $width = 70,
        private int $heigth = 70
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Image::load($this->file)
            ->optimize()
            ->crop(position: CropPosition::Center, width: $this->width, height: $this->heigth)
            ->resize(width: $this->width, height: $this->heigth)
            ->format($this->fileExt)
            ->save($this->path.$this->fileName.'.'.$this->fileExt);
    }
}
