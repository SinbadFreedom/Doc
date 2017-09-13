24 Java常量：final
===

<div class="jumbotron">
	<p>final在Java中是一个保留的关键字. 可以声明成员变量、方法、类以及本地变量. 一旦赋值无法改变.  如果试图改变final变量, 编译器会报错.
	</p>
</div>

24.1 final变量
---

变量前边用final修饰的都叫作final变量. final变量经常和static关键字一起使用,作为常量.

```java
public static final int ONE_DAY_HOURS = 24;
```

24.2 final方法
---

方法前面加上final关键字, 代表这个方法不可以被子类的方法重写. final方法比非final方法要快, 因为在编译的时候已经静态绑定了, 不需要在运行时再动态绑定.

```java
public void final eat() {
	...
}
```

24.2 final类
---

使用final来修饰的类叫作final类, 不能被继承. Java SDK中有许多类是final的, 如String,  Interger, System等.
下面是final类的实例：

```java
public final class System {
	...
}
```

24.3 final关键字的优点
---

1. final关键字提高了性能. JVM和Java应用都会缓存final变量.
2. final变量可以安全的在多线程环境下进行共享, 而不需要额外的同步开销.
3. 使用final关键字, JVM会对方法、变量及类进行优化.

<div class="bs-callout bs-callout-warning">
    <h4>java的继承与多态</h4>
	<p>final里面涉及到了java的继承和多态, 相关概念在<a href="http://localhost/article/java/advance/index.html">Java进阶篇</a>里有详细介绍</p>
</div>