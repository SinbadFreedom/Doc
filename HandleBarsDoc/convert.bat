@echo off 

for /R "md" %%s in (*) do (
	call markdown2bootstrap -n --outputdir html_handlebars/ %%s 
)

node yamlHandleBarsToHtml.js templateFile.hbs yamlFile.yaml html_handlebars/index.html

pause