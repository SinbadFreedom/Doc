f = open("a.txt", "rt")  #t表示文本方式
print(f.readline())
f.close()

f = open("a.txt", "rb") #b表示二进制方式
print(f.readline())
f.close()
