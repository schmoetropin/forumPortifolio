<?php
declare(strict_types=1);

namespace Src\Core;

trait CheckFileTrait
{
    /**
     * @param array $file
     * @param string $condValue
     * @return bool
     */
    public function checkMaxSize(array $file = [], string $condValue): bool
    {
        if ($file['size'] > 0) {
            if ($file['size'] <= (int)$condValue) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * @param array $file
     * @param string $condValue
     * @return bool
     */
    public function checkExtension(array $file = [], string $condValue): bool
    {
        $array = explode('|', $condValue);
        if ($file['size'] > 0) {
            $extension = $this->getExtension($file);
            if (in_array($extension, $array)) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * @param array $file
     * @return string|null
     */
    public function getExtension(array $file): ?string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $finfoFile = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        $array = ['image/', 'video/'];
        return str_replace($array, '', $finfoFile);
    }

    /**
     * @param array $file
     * @return bool
     */
    public function checkRequiredFile(array $file): bool
    {
        if ($file['size'] > 0) {
            return true;
        }
        return false;
    }
}