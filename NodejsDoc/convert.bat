@echo off 
for /R "md" %%s in (*) do (
	call markdown2bootstrap -n --outputdir html/ %%s 
)
