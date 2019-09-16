var ctxGeneral = document.getElementsByClassName("generalChart");
var chartGeneral = new Chart(ctxGeneral, {
  type: 'bar',
  data:{
    labels:descriptors,
    datasets:[{
      label: "Acertos",
      data:hit,
      backgroundColor:'rgba(29, 196, 40, 0.7)',
      datalabels: {
        align: 'end',
        anchor: 'end',
	      borderRadius: 1,
	      borderColor: 'rgb(144, 255, 151)',
        borderWidth: 1,
        backgroundColor: 'rgba(144, 255, 151, 0.7)',
	      color: 'rgb(50, 50, 50)',
        display: 'true',
      }
    },
  {
    label: "Erros",
    data:miss,
    backgroundColor:'rgba(249, 37, 37, 0.7)',
    datalabels: {
        align: 'end',
        anchor: 'end',
      	borderRadius: 1,
      	borderColor: 'rgb(255, 148, 148)',
        borderWidth: 1,
        backgroundColor: 'rgba(255, 148, 148, 0.7)',
      	color: 'rgb(50, 50, 50)',
        display: 'auto',
      }
  }]
  },
  options:{
    title:{
      display: true,
      fontSize: 20,
      text:"Resultado geral"
    },
    scales:{
      yAxes:[{
        ticks:{
          min:0,
          max: amount,
          stepSize: 500
        }
      }]
    }
  }
  });
