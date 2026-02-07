import { Requests } from "./Requests.js";
const tabela = new $('#tabela').DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    stateSave: true,
    select: true,
    processing: true,
    serverSide: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        searchPlaceholder: 'Digite sua pesquisa...'
    },
    ajax: {
        url: '/produto/listproduto',
        type: 'POST'
    },
    columnDefs: [
        {
            targets: [5, 6],
            render: function (data, type, row) {
                if (type === 'display') {
                    return parseFloat(data).toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                }
                return data;
            }
        }
    ]
});

async function Delete(id) {
    // ... restante do seu código de delete igual ...
    document.getElementById('id').value = id;
    const response = await Requests.SetForm('form').Post('/produto/delete');
    // (Swal fire, etc...)
    tabela.ajax.reload();
}
window.Delete = Delete;