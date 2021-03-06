## 读取大文件

PHP 标准库( SPL : Standard PHP Library )中的 SplFileObject::class 

[SPL-大文件读取和写入数据库](./chaper02/chap_02_uploading_csv_to_database.php)


## 抽象语法树 Abstract Syntax Tree AST

dereference 复用： 是指立刻获取对象的属性，运行对象中的某个方法，访问数组中的某个元素，调用某个回调函数的操作。


## 错误和异常
PHP7 已经改变了处理错误的方式。在某些情况中，一些类似的错误会被划分到同一个异常类别中，
而且这些异常能够捕捉到！

Error 和 Exception 类都实现了 Throwable 接口。如果你想要捕捉 ERROR 或 Exception 异常，可捕捉Throwable 接口。


## 其他

[代码同时运行在多个版本的PHP](https://3v4l.org/)

[PHPUnit的使用](https://phpunit.de)

- 抽象语法树 Abstract Syntax Tree 简称 AST
    - 语法一致性
    - 复引用 dereferencing
- PHP5 和 PHP7的区别
    - 解析 $$foo['key']  和 $foo->$bar['key']的方式
    - PHP5 从右往左
    - PHP7 从左往右
- 了解foreach()处理过程中的差异 p/53
    - 使用 current()，next() 时
    - 使用了&时
- PHP7 性能提升
    - 在PHP5中，参数传递的方式，在7中已经优化
    - 保留了已有的功能，增加了许多省时和高效的功能
    - 仅是对数组处理方式的一项改进，就获得了大幅度的性能提升，同时还大幅度减少了占用的内存
    - 去除PHP中2/3的扩展（进入裁剪名单），这减少了运行PHP程序时的额外开销，并提高了PHP项目的整体开发速度
- 遍历含有大数据的文件

## PHPUnit

window下使用composer安装

> $:  phpunit --verbose [filename]

`composer require psr/http-message`

## 过滤和验证

过滤和验证操作之间的差别，是过滤操作可能会除掉或转换某些值。而验证操作会使用与数据特点匹配的标准测试数据，并返回布尔型的结果。

1. 攻击防护和灵活性的要求-以一系列回调函数为基础的，更灵活的机制来执行过滤和验证的操作。
2. 为增加灵活性，应减轻过滤器和验证器基类的量级。


## 命令行

`php -S localhost:8080` 快速启动项目
`php -S localhost:8080 -t ./chaper02` 启动项目，同时指定根目录


## TODO

| 迭代器             |                                      |      |
| ------------------ | ------------------------------------ | ---- |
| ArrayIterator      | 专门用于通过面向对象的方式遍历数组。 |      |
| DirectoryIterator  | 专门用于扫描文件系统                 |      |
| 辅助其他迭代器 | 辅助其他迭代器和增强其他迭代器的功能 |      |
| FilterIterator     | 可以从父类迭代器中去除你不想要的值 |      |
| LimitIterator | 限定遍历范围，能够为应用程序添加基本的页码 |  |
| 递归迭代器 | 能反复调用父迭代器 | |
| RecursiveDirectoryIterator | 可以扫描目录树中的全部内容 | |
| 其他 |  | |
| CallbackFilterIterator | 为已存在的迭代器添加值是一种很好的处理方式 | |

* 在使用LimitIterator对象时应小心谨慎。为了获取限定范围中的结果，该实例会通过将整个数据集合都加载到内存中来遍历内容。因此，在遍历较大的数据集合时，这不是一个好工具。






