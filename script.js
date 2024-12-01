document.addEventListener('DOMContentLoaded', () => {  // Espera até que a página esteja completamente carregada
    const form = document.querySelector('#formChamado');  // Seleciona o formulário com o ID 'formChamado'

    form.addEventListener('submit', (e) => {  // Adiciona um ouvinte de evento para quando o formulário for enviado
        e.preventDefault();  // Impede o envio tradicional do formulário (não recarrega a página)

        // Captura os valores dos campos do formulário
        const nome = document.querySelector('#nome').value;
        const setor = document.querySelector('#setor').value;
        const descricao = document.querySelector('#descricao').value;
        const observacoes = document.querySelector('#observacoes').value;

        // Cria um objeto com os dados coletados do formulário
        const chamado = {
            nome: nome,  // Nome do usuário
            setor: setor,  // Setor do usuário
            descricao: descricao,  // Descrição do chamado
            observacoes: observacoes,  // Observações adicionais
            data_criacao: new Date().toLocaleString()  // Data de criação do chamado no formato local
        };

        // Verifica se já existe um chamado salvo no localStorage
        let chamadosSalvos = JSON.parse(localStorage.getItem('chamados')) || [];  // Se não existir, inicializa como um array vazio

        // Adiciona o novo chamado à lista existente
        chamadosSalvos.push(chamado);

        // Salva a lista de chamados atualizada no localStorage
        localStorage.setItem('chamados', JSON.stringify(chamadosSalvos));

        // Exibe uma mensagem de sucesso para o usuário
        alert('Chamado enviado com sucesso!');

        // Limpa o formulário após o envio
        form.reset();  // Limpa todos os campos do formulário
    });
});
