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

