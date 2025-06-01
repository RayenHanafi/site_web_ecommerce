Write-Host "Conversion du diagramme de classe en PDF..."
& 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe' diagramme_classe.html diagramme_classe.pdf

Write-Host "Terminé! Le diagramme de classe a été enregistré sous diagramme_classe.pdf" 