PATH = "D:\\workplace\\git\\Doc\\educate\\python\\second_degree\\"
f = open(PATH + "a.txt", "rt")
print(f.readline())
f.close()
#print(f.readline())

f = open(PATH + "halmlet.txt", "rt")
print(f.read())
f.close()

f = open(PATH + "halmlet.txt", "rt")
ls = f.readlines()
print(ls)
f.close()

f = open(PATH + "halmlet.txt", "rt")
ls = f.read()
print(ls)
ls = f.readlines()
print(ls)
f.close()


f = open(PATH + "halmlet.txt", "rt")
ls = f.read()
print(ls)
f.seek(0)
ls = f.readlines()
print(ls)
f.close()

f = open(PATH + "halmlet.txt", "rt")
for line in f:
    print(line)
f.close()


f = open(PATH + "c.txt", "w")
f.write("唐伯虎\n")
f.write("点\n")
f.write("秋香")
f.close()

ls = ["他人笑我太疯癫\n", "我笑他人看不穿"]
f = open(PATH + "c.txt", "w")
f.writelines(ls)
f.close()
