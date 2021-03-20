<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<!-- <p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel code style

Laravel follows the PSR-2 coding standard and the PSR-4 autoloading standard.


## 编码设计规范
- 短函数，不超过80行，最好40以内，只做一件事，有明确的输入输出
- 有意义的函数命名，加必要的注释
- 常量--全部大写，用下划线分词
- 属性--小驼峰式
- 类函数--小驼峰式
- 路由规范--只用get和post
- 响应格式规范
- 异常需记录日志、
  - ```bash
    Content-Type: application/json;charset=UTF-8
    {
      body
    }
  - ```bash
    # body-正常信息
    {
      errno: **,
      errmsg: **,
      data: {}
    }

    # 异常情况
    {
      errno: **,
      ermsg: **
    }

## 数据库规范

- 表名，字段名 全小写，下划线分词
- 默认存在，``id, add_time, update_time, deleted`` 四个字段
- 不使用 *存储过程，视图， 触发器， Event*

> 计算应交给服务层

- 禁止使用外键？ 如有外键完整性约束，应使用程序控制
  - 外键会导致表与表之间耦合，影响sql性能
- 禁止使用 *ENUM*， 可用 **TINYINT**代替
- 使用查询构造器进行语句构建

> [MySQL 数据库开发的33 条军规-阿里云开发者社区](https://developer.aliyun.com/article/766254)

> [58到家数据库30条军规解读_w3cschool](https://www.w3cschool.cn/architectroad/architectroad-58-home-database-rules.html)