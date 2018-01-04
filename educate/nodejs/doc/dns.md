
> 稳定性: 2 - 稳定的

`dns`模块包含两个类型的函数：

1) 使用底层操作系统工具进行域名解析的函数，并不须要进行网络通信。这类函数只有一个：[`dns.lookup()`][]。**如果希望在相同系统中与其他应用程序执行域名解析的行为一致，请使用[`dns.lookup()`][]函数**

例如，查找`iana.org`

```js
const dns = require('dns');

dns.lookup('nodejs.org', (err, addresses, family) => {
  console.log('addresses:', addresses);
});
// address: "192.0.43.8" family: IPv4
```

2) 连接到实际DNS服务器进行域名解析的函数，并且始终使用网络执行DNS查询。这类函数包含除[`dns.lookup()`][]以外的所有`dns`模块中的函数。这类函数并未使用与[`dns.lookup()`][]相同的配置文件(例如： `/etc/hosts`)。 这类函数适合于那些不想使用底层操作系统工具进行域名解析，而是想使用网络执行DNS查询的开发者。

下面有一个解析`'archive.org'`的示例，然后反向解析返回的IP地址。

```js
const dns = require('dns');

dns.resolve4('archive.org', (err, addresses) => {
  if (err) throw err;

  console.log(`addresses: ${JSON.stringify(addresses)}`);

  addresses.forEach((a) => {
    dns.reverse(a, (err, hostnames) => {
      if (err) {
        throw err;
      }
      console.log(`reverse for ${a}: ${JSON.stringify(hostnames)}`);
    });
  });
});
```

两者之间的选择会产生微妙的结果，更多信息请查询[Implementation considerations section][]章节。



<!-- YAML
added: v0.11.3
-->

Returns an array of IP address strings that are being used for name
resolution.



Under the hood, [`dns.lookup()`][] uses the same operating system facilities
as most other programs. For instance, [`dns.lookup()`][] will almost always
resolve a given name the same way as the `ping` command. On most POSIX-like
operating systems, the behavior of the [`dns.lookup()`][] function can be
modified by changing settings in nsswitch.conf(5) and/or resolv.conf(5),
but note that changing these files will change the behavior of _all other
programs running on the same operating system_.

Though the call to `dns.lookup()` will be asynchronous from JavaScript's
perspective, it is implemented as a synchronous call to getaddrinfo(3) that
runs on libuv's threadpool. Because libuv's threadpool has a fixed size, it
means that if for whatever reason the call to getaddrinfo(3) takes a long
time, other operations that could run on libuv's threadpool (such as filesystem
operations) will experience degraded performance. In order to mitigate this
issue, one potential solution is to increase the size of libuv's threadpool by
setting the `'UV_THREADPOOL_SIZE'` environment variable to a value greater than
`4` (its current default value). For more information on libuv's threadpool, see
[the official libuv documentation][].


<!-- YAML
added: v0.11.14
-->

Resolves the given `address` and `port` into a hostname and service using
the operating system's underlying `getnameinfo` implementation.

If `address` is not a valid IP address, a `TypeError` will be thrown.
The `port` will be coerced to a number. If it is not a legal port, a `TypeError`
will be thrown.

The callback has arguments `(err, hostname, service)`. The `hostname` and
`service` arguments are strings (e.g. `'localhost'` and `'http'` respectively).

On error, `err` is an [`Error`][] object, where `err.code` is the error code.

```js
const dns = require('dns');
dns.lookupService('127.0.0.1', 22, (err, hostname, service) => {
  console.log(hostname, service);
  // Prints: localhost ssh
});
```



Under the hood, [`dns.lookup()`][] uses the same operating system facilities
as most other programs. For instance, [`dns.lookup()`][] will almost always
resolve a given name the same way as the `ping` command. On most POSIX-like
operating systems, the behavior of the [`dns.lookup()`][] function can be
modified by changing settings in nsswitch.conf(5) and/or resolv.conf(5),
but note that changing these files will change the behavior of _all other
programs running on the same operating system_.

Though the call to `dns.lookup()` will be asynchronous from JavaScript's
perspective, it is implemented as a synchronous call to getaddrinfo(3) that
runs on libuv's threadpool. Because libuv's threadpool has a fixed size, it
means that if for whatever reason the call to getaddrinfo(3) takes a long
time, other operations that could run on libuv's threadpool (such as filesystem
operations) will experience degraded performance. In order to mitigate this
issue, one potential solution is to increase the size of libuv's threadpool by
setting the `'UV_THREADPOOL_SIZE'` environment variable to a value greater than
`4` (its current default value). For more information on libuv's threadpool, see
[the official libuv documentation][].


<!-- YAML
added: v0.1.90
-->

Resolves a hostname (e.g. `'nodejs.org'`) into the first found A (IPv4) or
AAAA (IPv6) record. `options` can be an object or integer. If `options` is
not provided, then IPv4 and IPv6 addresses are both valid. If `options` is
an integer, then it must be `4` or `6`.

Alternatively, `options` can be an object containing these properties:

* `family` {Number} - The record family. If present, must be the integer
  `4` or `6`. If not provided, both IP v4 and v6 addresses are accepted.
* `hints`: {Number} - If present, it should be one or more of the supported
  `getaddrinfo` flags. If `hints` is not provided, then no flags are passed to
  `getaddrinfo`. Multiple flags can be passed through `hints` by bitwise
  `OR`ing their values.
  See [supported `getaddrinfo` flags][] for more information on supported
  flags.
* `all`: {Boolean} - When `true`, the callback returns all resolved addresses
  in an array, otherwise returns a single address. Defaults to `false`.

All properties are optional.

The `callback` function has arguments `(err, address, family)`. `address` is a
string representation of an IPv4 or IPv6 address. `family` is either the
integer `4` or `6` and denotes the family of `address` (not necessarily the
value initially passed to `lookup`).

With the `all` option set to `true`, the arguments change to
`(err, addresses)`, with `addresses` being an array of objects with the
properties `address` and `family`.

On error, `err` is an [`Error`][] object, where `err.code` is the error code.
Keep in mind that `err.code` will be set to `'ENOENT'` not only when
the hostname does not exist but also when the lookup fails in other ways
such as no available file descriptors.

`dns.lookup()` does not necessarily have anything to do with the DNS protocol.
The implementation uses an operating system facility that can associate names
with addresses, and vice versa. This implementation can have subtle but
important consequences on the behavior of any Node.js program. Please take some
time to consult the [Implementation considerations section][] before using
`dns.lookup()`.

Example usage:

```js
const dns = require('dns');
const options = {
  family: 6,
  hints: dns.ADDRCONFIG | dns.V4MAPPED,
};
dns.lookup('example.com', options, (err, address, family) =>
  console.log('address: %j family: IPv%s', address, family));
// address: "2606:2800:220:1:248:1893:25c8:1946" family: IPv6

// When options.all is true, the result will be an Array.
options.all = true;
dns.lookup('example.com', options, (err, addresses) =>
  console.log('addresses: %j', addresses));
// addresses: [{"address":"2606:2800:220:1:248:1893:25c8:1946","family":6}]
```


<!-- YAML
added: v0.1.16
-->

Uses the DNS protocol to resolve a IPv4 addresses (`A` records) for the
`hostname`. The `addresses` argument passed to the `callback` function
will contain an array of IPv4 addresses (e.g.
`['74.125.79.104', '74.125.79.105', '74.125.79.106']`).


<!-- YAML
added: v0.1.16
-->

Uses the DNS protocol to resolve a IPv6 addresses (`AAAA` records) for the
`hostname`. The `addresses` argument passed to the `callback` function
will contain an array of IPv6 addresses.


<!-- YAML
added: v0.3.2
-->

Uses the DNS protocol to resolve `CNAME` records for the `hostname`. The
`addresses` argument passed to the `callback` function
will contain an array of canonical name records available for the `hostname`
(e.g. `['bar.example.com']`).


<!-- YAML
added: v0.1.27
-->

Uses the DNS protocol to resolve mail exchange records (`MX` records) for the
`hostname`. The `addresses` argument passed to the `callback` function will
contain an array of objects containing both a `priority` and `exchange`
property (e.g. `[{priority: 10, exchange: 'mx.example.com'}, ...]`).


<!-- YAML
added: v0.9.12
-->

Uses the DNS protocol to resolve regular expression based records (`NAPTR`
records) for the `hostname`. The `callback` function has arguments
`(err, addresses)`.  The `addresses` argument passed to the `callback` function
will contain an array of objects with the following properties:

* `flags`
* `service`
* `regexp`
* `replacement`
* `order`
* `preference`

For example:

```js
{
  flags: 's',
  service: 'SIP+D2U',
  regexp: '',
  replacement: '_sip._udp.example.com',
  order: 30,
  preference: 100
}
```


<!-- YAML
added: v0.1.90
-->

Uses the DNS protocol to resolve name server records (`NS` records) for the
`hostname`. The `addresses` argument passed to the `callback` function will
contain an array of name server records available for `hostname`
(e.g. `['ns1.example.com', 'ns2.example.com']`).


<!-- YAML
added: v6.0.0
-->

Uses the DNS protocol to resolve pointer records (`PTR` records) for the
`hostname`. The `addresses` argument passed to the `callback` function will
be an array of strings containing the reply records.


<!-- YAML
added: v0.11.10
-->

Uses the DNS protocol to resolve a start of authority record (`SOA` record) for
the `hostname`. The `addresses` argument passed to the `callback` function will
be an object with the following properties:

* `nsname`
* `hostmaster`
* `serial`
* `refresh`
* `retry`
* `expire`
* `minttl`

```js
{
  nsname: 'ns.example.com',
  hostmaster: 'root.example.com',
  serial: 2013101809,
  refresh: 10000,
  retry: 2400,
  expire: 604800,
  minttl: 3600
}
```


<!-- YAML
added: v0.1.27
-->

Uses the DNS protocol to resolve service records (`SRV` records) for the
`hostname`. The `addresses` argument passed to the `callback` function will
be an array of objects with the following properties:

* `priority`
* `weight`
* `port`
* `name`

```js
{
  priority: 10,
  weight: 5,
  port: 21223,
  name: 'service.example.com'
}
```


<!-- YAML
added: v0.1.27
-->

Uses the DNS protocol to resolve text queries (`TXT` records) for the
`hostname`. The `addresses` argument passed to the `callback` function is
is a two-dimensional array of the text records available for `hostname` (e.g.,
`[ ['v=spf1 ip4:0.0.0.0 ', '~all' ] ]`). Each sub-array contains TXT chunks of
one record. Depending on the use case, these could be either joined together or
treated separately.



These functions are implemented quite differently than [`dns.lookup()`][]. They
do not use getaddrinfo(3) and they _always_ perform a DNS query on the
network. This network communication is always done asynchronously, and does not
use libuv's threadpool.

As a result, these functions cannot have the same negative impact on other
processing that happens on libuv's threadpool that [`dns.lookup()`][] can have.

They do not use the same set of configuration files than what [`dns.lookup()`][]
uses. For instance, _they do not use the configuration from `/etc/hosts`_.

[DNS error codes]: #dns_error_codes
[`dns.lookup()`]: #dns_dns_lookup_hostname_options_callback
[`dns.resolveSoa()`]: #dns_dns_resolvesoa_hostname_callback
[`Error`]: errors.html#errors_class_error
[Implementation considerations section]: #dns_implementation_considerations
[supported `getaddrinfo` flags]: #dns_supported_getaddrinfo_flags
[the official libuv documentation]: http://docs.libuv.org/en/latest/threadpool.html


These functions are implemented quite differently than [`dns.lookup()`][]. They
do not use getaddrinfo(3) and they _always_ perform a DNS query on the
network. This network communication is always done asynchronously, and does not
use libuv's threadpool.

As a result, these functions cannot have the same negative impact on other
processing that happens on libuv's threadpool that [`dns.lookup()`][] can have.

They do not use the same set of configuration files than what [`dns.lookup()`][]
uses. For instance, _they do not use the configuration from `/etc/hosts`_.

[DNS error codes]: #dns_error_codes
[`dns.lookup()`]: #dns_dns_lookup_hostname_options_callback
[`dns.resolveSoa()`]: #dns_dns_resolvesoa_hostname_callback
[`Error`]: errors.html#errors_class_error
[Implementation considerations section]: #dns_implementation_considerations
[supported `getaddrinfo` flags]: #dns_supported_getaddrinfo_flags
[the official libuv documentation]: http://docs.libuv.org/en/latest/threadpool.html

<!-- YAML
added: v0.1.27
-->

Uses the DNS protocol to resolve a hostname (e.g. `'nodejs.org'`) into an
array of the record types specified by `rrtype`.

Valid values for `rrtype` are:

 * `'A'` - IPV4 addresses, default
 * `'AAAA'` - IPV6 addresses
 * `'MX'` - mail exchange records
 * `'TXT'` - text records
 * `'SRV'` - SRV records
 * `'PTR'` - PTR records
 * `'NS'` - name server records
 * `'CNAME'` - canonical name records
 * `'SOA'` - start of authority record
 * `'NAPTR'` - name authority pointer record

The `callback` function has arguments `(err, addresses)`. When successful,
`addresses` will be an array, except when resolving an SOA record which returns
an object structured in the same manner as one returned by the
[`dns.resolveSoa()`][] method. The type of each item in `addresses` is
determined by the record type, and described in the documentation for the
corresponding lookup methods.

On error, `err` is an [`Error`][] object, where `err.code` is
one of the error codes listed [here](#dns_error_codes).


<!-- YAML
added: v0.1.16
-->

Performs a reverse DNS query that resolves an IPv4 or IPv6 address to an
array of hostnames.

The `callback` function has arguments `(err, hostnames)`, where `hostnames`
is an array of resolved hostnames for the given `ip`.

On error, `err` is an [`Error`][] object, where `err.code` is
one of the [DNS error codes][].


<!-- YAML
added: v0.11.3
-->

Sets the IP addresses of the servers to be used when resolving. The `servers`
argument is an array of IPv4 or IPv6 addresses.

If a port specified on the address it will be removed.

An error will be thrown if an invalid address is provided.

The `dns.setServers()` method must not be called while a DNS query is in
progress.



Each DNS query can return one of the following error codes:

- `dns.NODATA`: DNS server returned answer with no data.
- `dns.FORMERR`: DNS server claims query was misformatted.
- `dns.SERVFAIL`: DNS server returned general failure.
- `dns.NOTFOUND`: Domain name not found.
- `dns.NOTIMP`: DNS server does not implement requested operation.
- `dns.REFUSED`: DNS server refused query.
- `dns.BADQUERY`: Misformatted DNS query.
- `dns.BADNAME`: Misformatted hostname.
- `dns.BADFAMILY`: Unsupported address family.
- `dns.BADRESP`: Misformatted DNS reply.
- `dns.CONNREFUSED`: Could not contact DNS servers.
- `dns.TIMEOUT`: Timeout while contacting DNS servers.
- `dns.EOF`: End of file.
- `dns.FILE`: Error reading file.
- `dns.NOMEM`: Out of memory.
- `dns.DESTRUCTION`: Channel is being destroyed.
- `dns.BADSTR`: Misformatted string.
- `dns.BADFLAGS`: Illegal flags specified.
- `dns.NONAME`: Given hostname is not numeric.
- `dns.BADHINTS`: Illegal hints flags specified.
- `dns.NOTINITIALIZED`: c-ares library initialization not yet performed.
- `dns.LOADIPHLPAPI`: Error loading iphlpapi.dll.
- `dns.ADDRGETNETWORKPARAMS`: Could not find GetNetworkParams function.
- `dns.CANCELLED`: DNS query cancelled.



Although [`dns.lookup()`][] and the various `dns.resolve*()/dns.reverse()`
functions have the same goal of associating a network name with a network
address (or vice versa), their behavior is quite different. These differences
can have subtle but significant consequences on the behavior of Node.js
programs.



The following flags can be passed as hints to [`dns.lookup()`][].

- `dns.ADDRCONFIG`: Returned address types are determined by the types
of addresses supported by the current system. For example, IPv4 addresses
are only returned if the current system has at least one IPv4 address
configured. Loopback addresses are not considered.
- `dns.V4MAPPED`: If the IPv6 family was specified, but no IPv6 addresses were
found, then return IPv4 mapped IPv6 addresses. Note that it is not supported
on some operating systems (e.g FreeBSD 10.1).


