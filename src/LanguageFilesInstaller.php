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
    }

    public function languageExists()
    {
        return $this->fileExists('/src/' . $this->lang . '/' . $this->files[0]);
    }

    public function createLanguageDirectory()
    {
        if (!file_exists($this->getSpecificLanguageDirectoryPath())) {
            mkdir($this->getSpecificLanguageDirectoryPath(), 0777, true);
        }
    }

    public function downloadPhpLanguageFiles()
    {
        foreach ($this->files as $file) {
            $this->downloadLanguageFile($this->lang . '/' . $file, $this->lang . '/' . $file);
        }
    }

    public function downloadJsonLanguageFile()
    {
        $this->downloadLanguageFile($this->lang.'/'.$this->lang . '.json', $this->lang . '.json');
    }

    protected function downloadLanguageFile($sourceFile, $destinationFile)
    {
        var_dump($sourceFile);
        if ($this->fileExists($sourceFile)) {
            $contents = $this->getLanguageFileContents($sourceFile);

            $this->createLanguageFile($destinationFile, $contents);
        }
    }

    protected function fileExists($file)
    {
        $httpStatus = get_headers($this->getGithubRepositoryPath() . '/' . $file)[0];

        return (bool)strpos($httpStatus, '200') || (bool)strpos($httpStatus, '301');
    }

    protected function getLanguageFileContents($file)
    {
        return file_get_contents($this->getGithubRepositoryPath() . '/' . $file);
    }

    protected function createLanguageFile($file, $contents)
    {
        file_put_contents($this->getLanguagesDirectoryPath() . DIRECTORY_SEPARATOR . $file, $contents);
    }

    protected function getGithubRepositoryPath()
    {
        return 'https://raw.githubusercontent.com/Laravel-Lang/lang/master/locales';
    }

    protected function getSpecificLanguageDirectoryPath()
    {
        return $this->getLanguagesDirectoryPath() . DIRECTORY_SEPARATOR . $this->lang;
    }

    protected function getLanguagesDirectoryPath()
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang';
    }
}
