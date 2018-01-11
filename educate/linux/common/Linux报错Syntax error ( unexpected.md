linux执行shell遍历数组的时候报错Syntax error: "(" unexpected

脚本示例:
```
#!/bin/sh 
a=(1 2 3) 
for number in a[@]doechonumber 
done 
```

原因:
sh被重定向到dash，因此，如果执行./example.sh，则使用的是dash.
dash不支持数组.

解决方案:

1 将脚本第一行改为 #!/bin/bash
2 通过bash example.sh执行