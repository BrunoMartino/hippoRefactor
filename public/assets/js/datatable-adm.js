/* Receita gerada por clientes */
$(".datatable-receita-clientes tfoot th").each(function () {
    var title = $(this).text();
    $(this).html(
        '<input type="text" class="form-control" placeholder="Search ' +
        title +
        '" />'
    );
});

// DataTable
var tableSearching = $(".datatable-receita-clientes").DataTable({
    // scrollY: "300px",
    // scrollCollapse: true,
    // paging: false,
    "order": [], // Desativa a ordenação padrão
    pageLength: 14,
    language: {
        url:"https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
      }
  });



