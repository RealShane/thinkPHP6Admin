author：Shane
===============

> 运行环境建议PHP7.4（目前最新）。
> 数据库建议MYSQL8（目前最新）。
> 服务器软件建议Nginx（注意重写pathinfo否则不支持/模块/控制器/方法 访问模式）。
> 目录绑定为 /项目/public/（否则js/css/图片路径失效）。
> Redis建议 Redis5（目前最新）。

## 架构变更
    
    *由原来的MVC--模型、视图、控制器三层架构
    变更为模型、视图、控制器、Business、Validate五层+中间件架构
    *其大致解释与对应关系为：
        *解释：
            *控制器 -> API接口数据输入与返回
            *Business -> 主要程序处理数据拼装
            *模型 -> 操作数据库
            *Validate -> 数据验证
            *视图 -> WEB端返回
            *中间件 -> 鉴权
        *对应关系(画的不好，凑活看)：
                     中间件
                    /     \
                   /       \
            用户<->视图 <-> 控制器 <-> Business <-> 模型 <-> 数据库
                   \        \           \
                    \        \           \
                     \______Validate    数据库
    
## 新增

    *在线命令
        *可对任意表进行CRUD生成提升后台高扩展性
        *二级目录对生成的CRUD功能进行分类
        *数据可导出Excel
            *可全部导出
            *可查询导出
    *权限管理
        *管理员CRUD
        *管理员权限分配
        *管理员权限组设置
            *自带超级权限组，二级权限组（建议超级权限组仅超级管理员一人）
            *可自定义权限组
    *可更改后台地址入口
        *修改.env中的ADMIN.FILE
        *修改/assets/js/admin/route.json中的FILE        

## 反作弊机制
    
    *后台服务器请求进行中间件+Session鉴权
    *控制器拒绝一切非POST请求
    *Auth提取header头中的Token与Redis中的Token进行匹配鉴权
        *Token生成
            $字符串：当前时间精确到微秒
            Token = SHA1(MD5(uniqid(MD5($字符串))))
    *Validate层对输入数据全面验证
    *验证码
    *密码生成
        $5位密码盐:
            字符集：abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789
        $用户设置的密码
        密码 = MD5($5位密码盐.$用户设置的密码.$5位密码盐)
        