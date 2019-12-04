<?php

// __autoload();
// spl_auto_load_register(); 

/**
 *
 */
namespace Application\Autoload;


class Loader
{
    static protected $reqistered = 0;

    static protected $dirs = [];

    const UNABLE_TO_LOAD = '无法加载类';

    // 初始化时： 将类的目录加入
    public function __construct ($dirs = array())
    {
        self::init($dirs);
    }

    // 自动加载器
    public static function init ($dirs = array())
    {
        if ($dirs) {
            self::addDirs($dirs);
        }
        if (self::$reqistered == 0) {
            // 将当前类的 __autoload 注册为自动加载器
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$reqistered++;
        }
    }

    // 加载类
    // @param $class ==  Application\Test\TestClass
    public static function autoload ($class)
    {
        $success = false;
        // 'class\\tools\\class_name.php' 替换成系统的分隔符
        $fn      = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        foreach (self::$dirs as $start) {
            // 目录 + 文件名 拼接
            $file = $start . DIRECTORY_SEPARATOR . $fn;
            if (self::loadFile($file)) {
                $success = true;
                break;
            }
        }

        // 如果在目录中都没有找到，则尝试在当前目录下加载目标文件
        if (!$success) {
            // 如果文件引入失败，则抛出一个异常
            if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR . $fn)) {
                throw new \Exception(self::UNABLE_TO_LOAD . '' . $class);
            }
        }

        return $success;
    }

    // 类文件目录
    // 增加更多子目录
    public static function addDirs ($dirs)
    {
        if (is_array($dirs)) {
            self::$dirs = array_merge(self::$dirs, $dirs);
        } else {
            self::$dirs[] = $dirs;
        }
    }

    // 加载文件
    protected static function loadFile ($file)
    {
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }
}