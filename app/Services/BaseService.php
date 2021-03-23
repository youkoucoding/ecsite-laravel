<?php

namespace App\Services;

class BaseService
{
    //使用单例模式
    // 三个私有，protected实例变量，私有的构造函数，私有的克隆方法
    // 一个公有， 公有的 getInstance
    //两个静态， 静态的单例变量，静态的 getInstance() 
    // 封装以下方法，然后继承这个封装的类
    // 基类中，不能用self ： 实例化当前类（self）, static 表示当前类
    protected static $instance;
    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance instanceof static) {
            return static::$instance;
        }
        static::$instance = new static();
        return static::$instance;
    }

    //防止外部调用构造函数
    private function __construct()
    {
    }
    private function __clone()
    {
    }
}
