#CalHamlet.py
def getText():
    txt = open("halmlet.txt", "r").read()
    txt = txt.lower()
    for ch in "!@#$%^&*()<>:\"{}|~,.;<>=-":
        txt = txt.replace(ch, " ")
    return txt

hamletTxt = getText()

words = hamletTxt.split()

counts = {}

for word in words:
    counts[word] = counts.get(word, 0) + 1

items = list(counts.items())
items.sort(key = lambda x:x[1], reverse=True)

for i in range(10):
    word, count = items[i]
    print("{0:<20}{1:>2}".format(word, count))