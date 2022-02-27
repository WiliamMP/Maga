const openModal = () => document.getElementById('modal')
    .classList.add('active')

function change() {
    document.getElementById('cadastrarPessoa').addEventListener('click', openModal)

}

const closeModal = () => document.getElementById('modal')
    .classList.remove('active')

function close() {
    document.getElementById('modalClose')
        .addEventListener('click', closeModal)
}
