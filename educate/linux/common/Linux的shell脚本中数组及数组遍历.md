1 linux声明数组
===
linux声明数组是用圆括号包数组元素包起来，数组元素之间用空格隔开。

示例:
```
array=(element1 element2 element3 .... elementN)  
```

2 linux数据的读取
===

```
#echo ${array[0]}  
#echo ${array[index]}  
```

3 数组的遍历
===

获取数组全部数据：
```
${array[@]}  
```
遍历数组数据:
```
for data in ${array[@]}  
do  
    echo ${data}  
done  
```

注:
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