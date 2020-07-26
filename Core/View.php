<?php
namespace Core;

class View
{
    const RENDER_TYPE_NATIVE = 1;
    const RENDER_TYPE_TWIG = 2;

    protected $_data;
    private $renderType;
    /** @var \Twig\Environment */
    private $_twig;


    public function __set($name, $value)
    {
        $this->_data[$name] = $value;

    }

    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
        return '';
    }

    public function setRenderType(int $renderType=self::RENDER_TYPE_NATIVE)
    {
        $this->renderType = $renderType;
    }

    /**
     * @return \Twig\Environment
     */
    public function getTwig()
    {
        if (!$this->_twig) {
            $path = trim('App/Templates/User', DIRECTORY_SEPARATOR);
            $loader = new \Twig\Loader\FilesystemLoader($path);
            $this->_twig = new \Twig\Environment(
                $loader
            );
        }
        return $this->_twig;
    }

    public function render(string $tpl)
    {

        if ($this->renderType !== self::RENDER_TYPE_TWIG) {
            ob_start();
            include 'App/Templates/' . $tpl;
        } else {
            $twig = $this->getTwig();
            ob_start();
            echo $twig->render($tpl, $this->_data + ['view' => $this]);

        }
        return ob_get_clean();
    }
}