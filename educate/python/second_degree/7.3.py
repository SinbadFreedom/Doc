ls = ["北京", "上海","广州"]
f = open("city.csv", "w")
f.write(",".join(ls)+"\n")
f.close()


f = open("city.csv", "r")
ls = f.read().strip("\n").split(",")
f.close()
print(ls)
