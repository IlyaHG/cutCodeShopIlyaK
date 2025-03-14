<?php

declare(strict_types=1);

namespace App\Traits\Models;

use Faker\Core\File;

trait HasThumbnail
{

    abstract protected function thumbnailDir(): string;
    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail' , [
            'size' => $size,
            'dir' => $this->thumbnailDir(),
            'method' => $method,
            'file' => File::basename($this->{$this->thumbnailColumn()})
        ]);
    }

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
