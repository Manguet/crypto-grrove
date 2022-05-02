<?php

namespace App\Traits\File;

trait FileUploaderTrait
{
    /**
     * @param object $entity
     * @param string $property
     *
     * @return void
     */
    protected function insertFilePath(object $entity, string $property): void
    {
        if (isset($form['upload_file'])) {

            $file = $form['upload_file']->getData();

            if ($file) {
                $fileName = $this->fileUploader->upload($file);

                if (null !== $fileName) {
                    $directory = $this->fileUploader->getTargetDirectory();
                    $fullPath  = $directory . '/' . $fileName;

                    $entity->{'set' . ucfirst($property)}($this->fileUploader->getSiteBase($fullPath));
                }
            }
        }
    }
}