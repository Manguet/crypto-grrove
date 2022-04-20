<?php

namespace App\Services\File;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    public function __construct(private ?string $targetDirectory, private ?SluggerInterface $slugger,
                                private ?KernelInterface $kernel) {}

    /**
     * @param UploadedFile $file
     *
     * @return string|null
     */
    public function upload(UploadedFile $file): ?string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename     = $this->slugger->slug($originalFilename);

        $fileName = $safeFilename . '-' . uniqid('groove', true) . '.' . $file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            return 'error';
        }

        return $fileName;
    }

    /**
     * @return string|null
     */
    public function getTargetDirectory(): ?string
    {
        return $this->targetDirectory;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    public function getSiteBase(string $fileName): string
    {
        return str_replace(
            $this->kernel->getProjectDir() . '/public',
            'http://127.0.0.1:8000',
            $fileName
        );
    }
}