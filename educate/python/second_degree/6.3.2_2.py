lt = ["1010", "10.10", "Python"]
print(lt)

ls = ["1010", [1000, "1000"]]

lt = lt + ls
print(lt)

lt = ["1010", "10.10", "Python"]
lt.insert(1, 1000)
print(lt)

lt.clear()
print(lt)

lt = ["1010", "10.10", "Python"]
print(lt.pop(2))
print(lt)

lt = ["1010", "10.10", "Python"]
lt.remove("10.10")
print(lt)

lt = ["1010", "10.10", "Python"]
del lt[1]
print(lt)

lt = ["1010", "10.10", "Python"]
del lt[1:]
print(lt)

#这个方法输出和教材上的输出结果不同
#教材上的输出为['10.10',1010] 
#自己跑程序的输出为['1010', 'Python', 1111]
#如果将教材示例中的lt[1:5:2] 改为lt[0:5:2]能够输出教材中的结果
lt = ["1010", "10.10", "Python", 1010, 1111]
del lt[1:5:2]
print(lt)

lt = ["1010", "10.10", "Python"]
lt.reverse()
print(lt)

lt = ["1010", "10.10", "Python"]
ls = lt.copy()
lt.clear()
print(lt)
print(ls)

lt = ["1010", "10.10", "Python"]
ls = lt
lt.clear()
print(lt)
print(ls)

lt = ["1010", "10.10", "Python"]
lt[2] = "a"
print(lt)

lt = ["1010", "10.10", "Python"]
lt[1:2] = [1010,10.10,0x1010]
print(lt)
lt[1:4] = [1010]
print(lt)


