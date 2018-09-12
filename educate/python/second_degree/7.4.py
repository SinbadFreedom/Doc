ls =[
    ["北京","上海","广州"],
    ["天津","深圳"]
    ]

f = open("cpi.csv", "w")
for row in ls:
    f.write(",".join(row) + "\n")

f.close()


f = open("cpi.csv", "r")
ls = []
for line in f:
    ls.append(line.strip("\n").split(","))
f.close()
print(ls)
