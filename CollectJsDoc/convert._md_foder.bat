@echo off 

python ConnectFile.py

for /R "md" %%s in (*) do (
	call markdown2bootstrap -n --outputdir html_collectjs/ %%s 
)
