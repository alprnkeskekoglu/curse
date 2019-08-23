<?php

namespace Curse\App;

class Curse
{
    /**
     * Kelimelerin ait olduğu dil aynı zamanda klasör ismi
     *
     * @var string
     */
    protected $language = "tr";

    /**
     * Soft kelimelerin bulunduğu dosya yolu
     *
     * @var string
     */
    protected $soft_file_path = "";

    /**
     * Hard kelimelerin bulunduğu dosya yolu
     *
     * @var string
     */
    protected $hard_file_path = "";

    /**
     * Filtrelenecek cümle, kelime vs.
     *
     * @var string
     */
    protected $text = "";
    protected $replacement_text = "***";

    /**
     * Soft kelimeler için kullanılacak regex
     *
     * @var string
     */
    protected $soft_regex = '/(\b)+(%s)+(\b)/ui';
    protected $hard_regex = '/(%s)/ui';

    /**
     * Curse contruct.
     *
     */
    public function __construct()
    {
        $this->setDefaultFilePaths();
    }

    private function setDefaultFilePaths()
    {
        $this->soft_file_path = __DIR__ . "/../Files/" . $this->language . "/soft.txt";
        $this->hard_file_path = __DIR__ . "/../Files/" . $this->language . "/hard.txt";
    }

    /**
     * Kelimelerin ait olduğu dili ayarlar.
     *
     * @param string $language_code
     * @return Curse
     */
    public function setLanguage($language_code): Curse
    {
        $this->language = $language_code;
        return $this;
    }

    /**
     * Soft kelimelerinin bulunduğu dosyanın içeriğini döndürür.
     *
     * @return array
     */
    public function getSoftFile(): array
    {
        $file = file_get_contents($this->soft_file_path);
        return explode("\n", trim($file));
    }

    /**
     * Soft kelimelerin olduğu farklı bir dosyayı ayarlamaya yarar.
     * Kelimeler satırlar ile ayrılmalıdır.
     *
     * @param string $file_path
     * @return Curse
     */
    public function setSoftFile(string $file_path): Curse
    {
        $this->soft_file_path = $file_path;
        return $this;
    }

    /**
     * Hard kelimelerinin bulunduğu dosyanın içeriğini döndürür.
     *
     * @return array
     */
    public function getHardFile(): array
    {
        $file = file_get_contents($this->hard_file_path);
        return explode("\n", trim($file));
    }

    /**
     * Hard kelimelerin olduğu farklı bir dosyayı ayarlamaya yarar.
     * Kelimeler satırlar ile ayrılmalıdır.
     *
     * @param string $file_path
     * @return Curse
     */
    public function setHardFile(string $file_path): Curse
    {
        $this->hard_file_path = $file_path;
        return $this;
    }

    /**
     * Filtrelenecek cümle, kelime vs. set etme işlevini görür.
     *
     * @param string $text
     * @return Curse
     */
    public function setText(string $text): Curse
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Saptanan kelimelerin yerine gelecek text'i set etme işlevi görür.
     *
     * @param string $text
     * @return Curse
     */
    public function setReplacementText(string $text): Curse
    {
        $this->replacement_text = $text;
        return $this;
    }

    /**
     * Soft filter için kullanılacak regex ifadeyi set eder.
     *
     * @param string $soft_regex
     * @return Curse
     */
    public function setSoftRegex(string $soft_regex): Curse
    {
        $this->soft_regex = $soft_regex;
        return $this;
    }

    /**
     * Hard filter için kullanılacak regex ifadeyi set eder.
     *
     * @param string $hard_regex
     * @return Curse
     */
    public function setHardRegex(string $hard_regex): Curse
    {
        $this->soft_regex = $hard_regex;
        return $this;
    }

    /**
     * Filtrelenecek cümle, kelime vs. değişkeni içerisinde belirtilen filtre türüne göre işlem yapar.
     * Eğer tür belirtilmezse önce soft sonra hard olmak filtre uygular.
     *
     * @param string $type
     * @return string
     */
    public function init(string $type = null): string
    {
        if ($type === 'soft') {
            return $this->initSoft();
        }

        if ($type === 'hard') {
            return $this->initHard($this->text);
        }


        $soft_text = $this->initSoft();
        return $this->initHard($soft_text);
    }

    private function initSoft() {
        $soft_file = implode("|", $this->getSoftFile());
        $soft_regex = sprintf($this->soft_regex, $soft_file);

        return preg_replace($soft_regex, $this->replacement_text, $this->text);
    }

    private function initHard($hard_text) {
        $hard_file = implode("|", $this->getHardFile());
        $hard_regex = sprintf($this->hard_regex, $hard_file);

        return preg_replace($hard_regex, $this->replacement_text, $hard_text);
    }
}
