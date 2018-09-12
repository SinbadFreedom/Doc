d = {"201801":"小明", "201802":"小红", "201803":"小白"}
print(len(d))

print(min(d))
print(max(d))

d = dict()
print(d)

d = {"201801":"小明", "201802":"小红", "201803":"小白"}
print(d.keys())
print(type(d.keys()))
ls = list(d.keys())
print(ls)

print(d.values())
ls = list(d.values())
print(ls)

print(d.items())
print(type(d.items()))
ls = list(d.items())
print(ls)

print(d.get("201802"))
print(d.get("201804"))
print(d.get("201804", "不存在"))

print(d.pop("201802"))
print(d)
print(d.get("201804"))
print(d.pop("201804", "不存在"))

d.clear()
print(d)

d = {"201801":"小明", "201802":"小红", "201803":"小白"}
del d['201803']
print(d)

d = {"201801":"小明", "201802":"小红", "201803":"小白"}
print("201801" in d)
print("201804" in d)

for k in d:
    print("字典的键和值分别是{}和{}".format(k, d.get(k)))
