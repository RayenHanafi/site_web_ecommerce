$url = "https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox-0.12.6-1.msvc2015-win64.exe"
$output = "wkhtmltopdf_installer.exe"

Write-Host "Downloading wkhtmltopdf..."
Invoke-WebRequest -Uri $url -OutFile $output

Write-Host "Installing wkhtmltopdf..."
Start-Process -FilePath $output -ArgumentList "/S" -Wait

Write-Host "Converting HTML to PDF..."
& 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe' class_diagram.html class_diagram.pdf

Write-Host "Cleaning up..."
Remove-Item $output

Write-Host "Done! The class diagram has been saved as class_diagram.pdf" 