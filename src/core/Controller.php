<?php
declare(strict_types=1);

namespace Src\Core;

class Controller
{
    use CheckFileTrait;
    
    /**
     * @var Session
     */
    private Session $session;

    /**
     * @var View
     */
    private View $view;

    /**
     * @var Query
     */
    private Query $query;

    public function __construct()
    {
        $this->view = new View();
        $this->session = new Session();
        $this->query = new Query();
    }

    /**
     * @param string $content
     * @param array $data
     * @return string
     */
    public function view(string $content, array $data = []): string
    {
        return $this->view->getFullPage($content, $data);
    }

    /**
     * @param string $name
     * @param string $tableName
     * @return string
     */
    public function createUniqueName(string $name, string $tableName): string
    {
        $this->query->tableName = $tableName;
        return $this->query->uniqueName($name);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setSession(string $key, $value): void
    {
        $this->session->setSession($key, $value);
    }

    /**
     * @param string $key
     * @return void
     */
    public function unsetSession(string $key): void
    {
        $this->session->unsetSession($key);
    }

    /**
     * @param array $file
     * @param string $user
     * @return string
     */
    public function createFile(array $file, int $user): string
    {
        $extension = $this->getExtension($file);
        $fileName = $user.date('Y-m-d H:i:s').uniqid();
        $fileName = preg_replace('/[^a-zA-Z0-9]/', '', $fileName);
        return $fileName.'.'.$extension;
    }

    /**
     * @param array $file
     * @param string $fileName
     * @return void
     */
    public function moveFile(array $file, string $fileName): void
    {
        move_uploaded_file($file['tmp_name'], UPLOAD_PATH.$fileName);
    }

    /**
     * @param string|null $file
     * @return void
     */
    public function deleteFile(?string $file): void
    {
        if (!is_null($file)) {
            if (file_exists(UPLOAD_PATH.$file)) {
                unlink(UPLOAD_PATH.$file);
            }
        }
    }
}