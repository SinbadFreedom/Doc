Java基础篇8.字符串类型变量：String
---
##字符串类型简介
字符串类型是对象类型,不属于基础类型.

##字符串赋值
```java
String s1 = "test0";
String s2 = new String("test1");
String s3 = new String(s2);
```

##获取字符串长度
```java
String s0 = "test0";
int size = s0.size();
```

##字符串比较
字符串比较内容,需要通过`equal()`方法.

```java
String s0 = "test0";
String s1 = "test0";
boolean isSame = s0.equal(s1);
```java

##字符相加
通过`+`操作可以将2个字符串组合.
```java
String s0 = "test0";
String s1 = "test1";
String s2 = s0 + s1;
```
