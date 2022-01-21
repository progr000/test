<?php
/*
Задание 3 PHP

Есть три расширения файлов (txt, doc, xml, yaml, xlsx, ini).
Необходимо написать ООП-код, который в зависимости от типа файлов,
имел бы свою логику его обработки (саму логику писать не нужно).
*/

/**
 * Class opFile
 * @property string ext;
 */
class opFile {

    private $ext;

    /**
     * opFile constructor.
     * @param string $file_name
     */
    public function __construct($file_name)
    {
        $path_info = pathinfo($file_name);
        $this->ext = $path_info['extension'];
    }

    /**
     * @return string
     */
    public function processFile()
    {
        $method = 'process_' . $this->ext;
        if (method_exists($this, $method)) {
            return $this->{$method}();
        } else {
            return "For this extension &lt;&lt;{$this->ext}&gt;&gt; method not fond";
        }
    }

    /**
     * @return string
     */
    protected function process_txt()
    {
        return "start processing file with extension &lt;&lt;{$this->ext}&gt;&gt;";
    }

    /**
     * @return string
     */
    protected function process_doc()
    {
        return "start processing file with extension &lt;&lt;{$this->ext}&gt;&gt;";
    }

    /**
     * @return string
     */
    protected function process_xml()
    {
        return "start processing file with extension &lt;&lt;{$this->ext}&gt;&gt;";
    }

    /**
     * @return string
     */
    protected function process_ini()
    {
        return "start processing file with extension &lt;&lt;{$this->ext}&gt;&gt;";
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Задание 3 PHP</title>
</head>
<body>
<?php
$op = new opFile('test.doc');
echo $op->processFile();
?>
</body>
</html>
