Java基础篇5.程序入口：main方法
---

##程序入口是什么
就像一个城堡的大门,程序运行时,从这个方法开始.   
这个方法的写法是固定的,就像1+1=2,现在需要先记住这些.不要花时间纠结.  

##HelloWorld为例:

    public class HelloWorld {
		public static void main(String[] args) {
			System.out.println("HelloWorld.");
		}
	}
	
##类(class)的基本组成

1.类修饰词public.
2.类标识符class.
3.类名HelloWorld.(首字母大写)
4.类体.以`{`标记方法体开始,以`}`标记结束.
	public class HelloWorld {
		···
	}

##方法的组成

1.修饰词`public`.
2.静态标识`static`.
3.返回值`void`.
4.方法名`main`.
5.参数`String[] args`.以`(`标记方法参数开始,以`)`标记结束
6.方法体.以`{`标记方法体开始,以`}`标记结束.

	public static void main(String[] args) {
		···
	}

##本讲完成
继续行动, 下节会有关于方法修饰词和返回值的介绍.   