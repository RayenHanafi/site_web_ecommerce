Write-Host "Téléchargement de PlantUML..."
$plantumlUrl = "https://github.com/plantuml/plantuml/releases/download/v1.2024.0/plantuml-1.2024.0.jar"
$plantumlJar = "plantuml.jar"
Invoke-WebRequest -Uri $plantumlUrl -OutFile $plantumlJar

Write-Host "Génération du diagramme UML..."
java -jar plantuml.jar diagramme_uml.puml

Write-Host "Terminé! Le diagramme UML a été généré sous diagramme_uml.png" 