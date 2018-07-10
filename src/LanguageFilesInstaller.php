<?php

namespace PawelMysior\LaravelLocalize;

class LanguageFilesInstaller
{
    const FILES = [
        'auth',
        'pagination',
        'passwords',
        'validation',
    ];
    
    protected $lang;
    
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function languageExists()
    {
        $httpStatus = get_headers($this->getGithubRepositoryLanguageDirectoryPath() . '/' . self::FILES[0]. '.php')[0];
        
        return (bool)strpos($httpStatus, '200');
    }

    public function createLanguageDirectory()
    {
        if (!file_exists($this->getLanguageDirectoryPath())) {
            mkdir($this->getLanguageDirectoryPath(), 0777, true);
        }
    }

    public function downloadLanguageFiles()
    {
        foreach (self::FILES as $file) {
            $this->downloadLanguageFile($file);
        }
    }

    protected function downloadLanguageFile($file)
    {
        $contents = $this->getLanguageFileContents($file);
        
        $this->createLanguageFile($file, $contents);
    }

    protected function getLanguageFileContents($file)
    {
        return file_get_contents($this->getGithubRepositoryLanguageDirectoryPath() . '/' . $file . '.php');
    }

    protected function createLanguageFile($file, $contents)
    {
        file_put_contents($this->getLanguageDirectoryPath() . DIRECTORY_SEPARATOR . $file . '.php', $contents);
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
