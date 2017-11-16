JDK8新特性

===


JDK8 是一个重要的版本. 这个文档介绍了Java SE 8和JDK 8 的主要特性和加强的地方. 文档是基于了Oracle发布的官方Java SE 8.

1. Java 编程语法加强
---

* Lambda表达式

新的语法特性.使你能够将功能视为方法参数，或将代码作为数据处理。lambda表达式允许更紧凑地表示单个方法接口（称为功能接口）的实例。

* 方法引用为已经有名称的方法提供了易于阅读的lambda表达式。

* 默认方法允许将新功能添加到库接口，并确保与这些接口的旧版本编写的代码具有二进制兼容性。

* 重复注释提供了将同一注释类型多次应用于同一声明或类型使用的能力。

* 类型注释提供了在任何使用类型的地方应用注释的能力，而不仅仅是在声明上。 与可插入类型系统一起使用，此功能支持对代码进行改进的类型检查。

* 改进型inference

* 方法参数反射

相关文章:
[Java Programming Language Enhancements](https://docs.oracle.com/javase/8/docs/technotes/guides/language/enhancements.html#javase8)

2. 集合类
---


* 在新的java.util.stream包中的类提供了一个`Stream API`来支持对元素流进行函数式类型的操作。`Stream API`被集成到集合API中，它允许对集合进行批量操作，例如顺序或并行map减少转换。

* 提高有键值冲突时HashMap的性能

相关文章:

[Collections Framework Enhancements in Java SE 8](http://docs.oracle.com/javase/8/docs/technotes/guides/collections/changes8.html)


3. Java运行环境优化
---

紧凑的配置文件包含的`java SE`平台预定义的子集，使运行在小型设备上的应用不需要部署整个平台。


4. 安全相关
---

* 客户端默认支持`TLS 1.2`.

* New variant of AccessController. doPrivileged that enables code to assert a subset of its privileges, without preventing the full traversal of the stack to check for other permissions

* 基于密码加密的算法加强

* JSSE服务器支持SSL/TLS服务器名称指示（SNI）扩展

* Support for AEAD algorithms: The SunJCE provider is enhanced to support AES/GCM/NoPadding cipher implementation as well as GCM algorithm parameters. And the SunJSSE provider is enhanced to support AEAD mode based cipher suites. See Oracle Providers Documentation, JEP 115.

* KeyStore enhancements, including the new Domain KeyStore type java.security.DomainLoadStoreParameter, and the new command option -importpassword for the keytool utility

* SHA-224 Message Digests

* Enhanced Support for NSA Suite B Cryptography

* Better Support for High Entropy Random Number Generation

* New java.security.cert.PKIXRevocationChecker class for configuring revocation checking of X.509 certificates

* 64-bit PKCS11 for Windows

* New rcache Types in Kerberos 5 Replay Caching

* Support for Kerberos 5 Protocol Transition and Constrained Delegation

* Kerberos 5 weak encryption types disabled by default

* Unbound SASL for the GSS-API/Kerberos 5 mechanism

* SASL service for multiple host names

* JNI bridge to native JGSS on Mac OS X

* Support for stronger strength ephemeral DH keys in the SunJSSE provider

* Support for server-side cipher suites preference customization in JSSE

5. JavaFX
---


The new Modena theme has been implemented in this release. For more information, see the blog at fxexperience.com.

The new SwingNode class enables developers to embed Swing content into JavaFX applications. See the SwingNode javadoc and Embedding Swing Content in JavaFX Applications.

The new UI Controls include the DatePicker and the TreeTableView controls.

The javafx.print package provides the public classes for the JavaFX Printing API. See the javadoc for more information.

The 3D Graphics features now include 3D shapes, camera, lights, subscene, material, picking, and antialiasing. The new Shape3D (Box, Cylinder, MeshView, and Sphere subclasses), SubScene, Material, PickResult, LightBase (AmbientLight and PointLight subclasses) , and SceneAntialiasing API classes have been added to the JavaFX 3D Graphics library. The Camera API class has also been updated in this release. See the corresponding class javadoc for javafx.scene.shape.Shape3D, javafx.scene.SubScene, javafx.scene.paint.Material, javafx.scene.input.PickResult, javafx.scene.SceneAntialiasing, and the Getting Started with JavaFX 3D Graphics document.

The WebView class provides new features and improvements. Review Supported Features of HTML5 for more information about additional HTML5 features including Web Sockets, Web Workers, and Web Fonts.

Enhanced text support including bi-directional text and complex text scripts such as Thai and Hindi in controls, and multi-line, multi-style text in text nodes.

Support for Hi-DPI displays has been added in this release.

The CSS Styleable* classes became public API. See the javafx.css javadoc for more information.

The new ScheduledService class allows to automatically restart the service.

JavaFX is now available for ARM platforms. JDK for ARM includes the base, graphics and controls components of JavaFX.



6. Tools
---

* The `jjs` command is provided to invoke the Nashorn engine.

* The `java` command launches JavaFX applications.

* The `java` man page has been reworked.

* The `jdeps` command-line tool is provided for analyzing class files.

* Java Management Extensions (JMX) provide remote access to diagnostic commands.

* The `jarsigner` tool has an option for requesting a signed time stamp from a Time Stamping Authority (TSA).







1. 相关文章
---

📖 [Java从入门到精通索引](http://localhost/article/java/basic/index.html)




1. 参考文章
---

[http://www.oracle.com/technetwork/java/javase/8-whats-new-2157071.html](http://www.oracle.com/technetwork/java/javase/8-whats-new-2157071.html)

