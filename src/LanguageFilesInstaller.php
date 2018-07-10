<?php

namespace PawelMysior\LaravelLocalize;

class LanguageFilesInstaller
{
    protected $files = [
        'auth.php',
        'pagination.php',
        'passwords.php',
        'validation.php',
    ];
    
    protected $lang;
    
    public function __construct($lang)
    {
        $this->lang = $lang;
        
        $this->files[] = $lang . '.json';
    }

    public function languageExists()
    {
        return $this->fileExists($this->files[0]);
    }

    public function createLanguageDirectory()
    {
        if (!file_exists($this->getLanguageDirectoryPath())) {
            mkdir($this->getLanguageDirectoryPath(), 0777, true);
        }
    }

    public function downloadLanguageFiles()
    {
        foreach ($this->files as $file) {
            $this->downloadLanguageFile($file);
        }
    }

    protected function downloadLanguageFile($file)
    {
        if ($this->fileExists($file)) {
            $contents = $this->getLanguageFileContents($file);

            $this->createLanguageFile($file, $contents);
        }
    }

    protected function fileExists($file)
    {
        $httpStatus = get_headers($this->getGithubRepositoryLanguageDirectoryPath() . '/' . $file)[0];

        return (bool)strpos($httpStatus, '200');
    }

    protected function getLanguageFileContents($file)
    {
        return file_get_contents($this->getGithubRepositoryLanguageDirectoryPath() . '/' . $file);
    }

    protected function createLanguageFile($file, $contents)
    {
        file_put_contents($this->getLanguageDirectoryPath() . DIRECTORY_SEPARATOR . $file, $contents);
    }

    protected function getGithubRepositoryLanguageDirectoryPath()
    {
        return 'https://raw.githubusercontent.com/caouecs/Laravel-lang/master/src/' . $this->lang;
    }

    protected function getLanguageDirectoryPath()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $this->lang;
    }
}
