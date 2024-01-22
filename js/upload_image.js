var fileInput = document.getElementById('fileInput');
var file = fileInput.files[0];

var formData = new FormData();
formData.append('file', file);

var xhr = new XMLHttpRequest();
xhr.open('POST', '/upload');
xhr.onload = function() {
  if (xhr.status === 200) {
    console.log('Imagen subida correctamente.');
  } else {
    console.log('Error al subir la imagen.');
  }
};
xhr.send(formData);