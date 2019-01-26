import time
print(time.localtime())


print(time.time())

print(time.gmtime())

print(time.ctime())

t = time.localtime()
print(time.mktime(t))
print(time.ctime(time.mktime(t)))

lctime = time.localtime()
strftime = time.strftime("%Y-%m-%d %H: %M: %S", lctime)
print(strftime)
