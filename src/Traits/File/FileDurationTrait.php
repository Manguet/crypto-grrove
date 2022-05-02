<?php

namespace App\Traits\File;

trait FileDurationTrait
{
    public function calculateFileSize(string $file): int
    {
        $ratio = 16000;

        $file_size = filesize($file);
        $duration  = ($file_size / $ratio);

        return ceil($duration);
    }
}