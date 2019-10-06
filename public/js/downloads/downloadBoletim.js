function downloadBoletimPNG(){
  var obj = document.getElementById("boletim");
  var width = obj.offsetWidth;
  var height = obj.offsetHeight;
  var pngName = name+"_"+exam+".png";
  html2canvas(obj).then(function(canvas) {
    // Export canvas as a blob
    canvas.toBlob(function(blob) {
    // Generate file download
    saveAs(blob, pngName);
    });
  });
}
