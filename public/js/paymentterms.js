import { Requests } from "./Requests.js";
const insertPaymentoTermsButton = document.getElementById('insertPaymentoTermsButton');
const insertInstallmentButton = document.getElementById('insertInstallmentButton');
const Action = document.getElementById('acao');
async function insertPaymentTerms() {
    try {
        const response = (Action.value === 'c') ?
            await Requests.SetForm('form').Post('/pagamento/insert')
            :
            await Requests.SetForm('form').Post('/pagamento/update');
        if (!response.status) {
            Swal.fire({
                icon: "error",
                title: "Restrição",
                text: response.msg,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
        Swal.fire({
            icon: "success",
            title: "Sucesso",
            text: response.msg,
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            }
        }).then((result) => {

        });
    } catch (error) {
        console.log(error)
    }
}
async function loadDataInstallments(params) {
    try {
        const response
            = await Requests.SetForm('form').Post('/pagamento/loaddatainstallment');
        let trs = '';
        response.data.forEach(item => {
            trs += `
            <tr id="trinstallment%{item.id}">
                <td>${item.id}<td/>
                <td>${item.parcela}<td/>
                <td>${item.intervalo}(Dias)<td/>
                <td>${item.alterar_vencimento_conta}(Dias)<td/>
                <td> 
                    <button clas="btn-danger" onclick="deleteInstallment(${item.id})">Ecxcluir</button>
                </td>
            </tr>
            `
        });
        document.getElementById('tbInstallments').innerHTML= '';
        document.getElementById('tbInstallments').innerHTML= trs;
    } catch (error){
        console.log(error)
    }

}

insertPaymentoTermsButton.addEventListener('click', async () => {
    await insertPaymentTerms();
});
insertInstallmentButton.addEventListener('click', async () => {
    alert('Inserir parcelamento');
});

