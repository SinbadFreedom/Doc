http2 官方网站

https://http2.github.io/

刚才还在找http1.1配置, 才发现这个http1.1是1999年出的标准了.

刚刚发现2015年5月已经发布了http2的标准。现在越来越多的网站开始配置http2的标准了。

抛弃http1.1，从http2开始。


Why revise HTTP?
HTTP/1.1 has served the Web well for more than fifteen years, but its age is starting to show.

Loading a Web page is more resource intensive than ever (see the HTTP Archive’s page size statistics), and loading all of those assets efficiently is difficult, because HTTP practically only allows one outstanding request per TCP connection.

In the past, browsers have used multiple TCP connections to issue parallel requests. However, there are limits to this; if too many connections are used, it’s both counter-productive (TCP congestion control is effectively negated, leading to congestion events that hurt performance and the network), and it’s fundamentally unfair (because browsers are taking more than their share of network resources).

At the same time, the large number of requests means a lot of duplicated data “on the wire”.

Both of these factors means that HTTP/1.1 requests have a lot of overhead associated with them; if too many requests are made, it hurts performance.

This has led the industry to a place where it’s considered Best Practice to do things like spriting, data: inlining, domain sharding and concatenation. These hacks are indications of underlying problems in the protocol itself, and cause a number of problems on their own when used.



Who made HTTP/2?
HTTP/2 was developed by the IETF’s HTTP Working Group, which maintains the HTTP protocol. It’s made up of a number of HTTP implementers, users, network operators and HTTP experts.


In February 2015, Google announced its plans to remove support for SPDY in favor of HTTP/2.


What are the key differences to HTTP/1.x?
At a high level, HTTP/2:

is binary, instead of textual
is fully multiplexed, instead of ordered and blocking
can therefore use one connection for parallelism
uses header compression to reduce overhead
allows servers to “push” responses proactively into client caches