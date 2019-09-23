$(document).ready(function () {
  $('#tabela').DataTable( {
    dom: 'Blfrtip',
    "scrollX": true,
    buttons: ['copy', 'csv', 'excel'],
    "language": {
      "decimal": "",
      "buttons":{
        "copy":           "Copiar",
        "copyTitle":      "Copiado!",
        "copySuccess":{
          _: '%d linhas copiadas',
          1: '1 linha copiada',
        },
        "csv":            "CSV",
        "excel":          "XLSX",
      },
      "emptyTable":     "Nenhum dado disponível!",
      "info":           "Mostrando de _START_ a _END_ em um total de _TOTAL_ resultados",
      "infoEmpty":      "Mostrando de 0 a 0 em um total de 0 resultados",
      "infoFiltered":   "(filtrado de _MAX_ resultados)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     "Visualizar: _MENU_",
      "loadingRecords": "Carregando...",
      "processing":     "Processando...",
      "search": "_INPUT_",
      "searchPlaceholder": "Procurar...",
      "zeroRecords":    "Nenhum resultado encontrado",
      "paginate": {
          "first":      "Primeiro",
          "last":       "Último",
          "next":       "Próximo",
          "previous":   "Anterior"
      },
      "aria": {
          "sortAscending":  ": ordem crescente",
          "sortDescending": ": ordem decrescente"
      }
    }
  });
});
