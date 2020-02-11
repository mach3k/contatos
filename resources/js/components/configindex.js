var table = $('#tabela').DataTable({
    "paging": true,
    "responsive": true,
    "processing": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": {
        "decimal":        "",
        "emptyTable":     "A tabela está vazia",
        "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty":      "Mostrando de 0 a 0 de 0 registros",
        "infoFiltered":   "(filtrado do total _MAX_ de registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrar até _MENU_ registros",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Procurar:",
        "zeroRecords":    "Nenhum registro encontrado",
        "paginate": {
            "first":      "Primeira",
            "previous":   "Anterior",
            "next":       "Próxima",
            "last":       "Última"
        },
        "aria": {
            "sortAscending":  ": organiza a coluna de modo ascendente",
            "sortDescending": ": organiza a coluna de modo descendente"
        }

    }
});

$(document).on('shown.bs.modal', function (e) {
$('[autofocus]', e.target).focus();
});

$('#tabela tbody').on( 'click', 'tr', function () {
window.location.assign(document.URL.concat('/', table.row( this ).data()[0]));
} );
