def getHTMLlines(htmlpath):
    f = open(htmlpath, "r", encoding='utf-8')
    ls = f.readlines()
    f.close()
    return ls

def extractImageUrls(htmllist):
    urls =[]
    for line in htmllist:
        if "img" in line:
            temp = line.split("src=")[-1]
            if len(temp) > 0 :
                print("temp: {}".format(temp))
                url = temp.split('"')[1]
                if 'http' in url:
                    urls.append(url)
    return urls

def showResults(urls):
    count = 0
    for url in urls:
        print("第{:2}个url:{}".format(count, url))
        count += 1


def saveResult(filepath, urls):
    f = open(filepath, "w")
    for url in urls:
        f.write(url + "\n")
    f.close()

def main():
    inputfile = "www.ngchina.com.cn.txt"
    outputfile = "www.ngchina.com.cn._url.txt"
    htmllines = getHTMLlines(inputfile)
    imageUrls = extractImageUrls(htmllines)
    showResults(imageUrls)
    saveResult(outputfile, imageUrls)

main()
