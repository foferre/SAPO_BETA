function downloadChart(){
  var obj = document.getElementById("generalChart");
  var width = obj.offsetWidth;
  var height = obj.offsetHeight;
  var pngName = chartName;
  test = html2canvas(obj);
  html2canvas(obj).then(function(canvas) {
    canvas.toBlob(function(blob) {
    saveAs(blob, pngName);
    });
  });
}
