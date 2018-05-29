项目开发和维护的过程中, 有时会需要svn更新到指定的版本.来测试对应版本的内容。可以通过命令行和SVN客户端TortoiseSVN来实现。

1 查看svn版本信息命令
===

通过svn info命令可以查看版本信息，包含版本号，最后一次提交记录，svn版本库url等。


2 svn更新到指定版本命令
===

通过"svn update -r 版本号"的命令可以实现。

示例:

```
svn update -r 668
```

将svn版本更新到668。


3 通过SVN客户端TortoiseSVN更新到指定版本
===

在svn工作目录中点右键-> 选择update to reversion  -> 点击 show log -> 在log目录中选择要更新到的版本 -> 点击确定。