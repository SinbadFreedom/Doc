import os

rootFolder = "D:\\workplace\\git\\node-api-cn\\"
outFolder = "D:\\workplace\\git\\Doc\\NodejsDoc\\md\\"

fileList = {}


# get all files from the directory
def getFiles(directory):
    if os.path.isdir(directory):
        for fileName in os.listdir(directory):
            newDir = os.path.join(directory, fileName)
            if os.path.isfile(newDir):
                if fileName.find(".gitattributes") == -1 and fileName.find("README.md") == -1:
                    fileList[directory].append(newDir)
            elif os.path.isdir(newDir):
                if newDir.find(".git") == -1:
                    fileList[newDir] = []
                    getFiles(newDir)


getFiles(rootFolder)

for folder, files in fileList.items():
    print("Folder: ", folder)

    folderNameArr = folder.split("\\")

    newFileName = folderNameArr[len(folderNameArr) - 1]

    newFile = open(outFolder + newFileName + ".md", 'w')

    for fileName in files:
        fileNameArr = fileName.split("\\")
        newTitleName = fileNameArr[len(fileNameArr) - 1]

        # newFile.write('\n')
        # newFile.write("##" + newTitleName)
        # newFile.write('\n')
        # read file
        f = open(fileName, 'r')
        allLines = []
        useTab = False

        for line in f:
            # for code area start and end
            if line.startswith("```"):
                useTab = not useTab
                allLines.append("\t\n")
            else:
                # for code content
                if useTab:
                    line = "    " + line
                allLines.append(line)

        newFile.writelines(allLines)
        newFile.write('\n')
