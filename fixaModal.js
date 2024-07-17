 /* const openModalButton = document.getElementById('open-modal');
  const closeModalButton = document.getElementById('close-modal');

  const modal = document.getElementById('modal');

  openModalButton.addEventListener('click', () => {
    modal.style.display = 'block';
  });
       
  closeModalButton.addEventListener('click', () => {
     modal.style.display = 'none';
  });
       
       // Optional: Close the modal by clicking outside the modal content
  window.addEventListener('submit', (event) => {
    modal.style.display = 'none';
    form.reset();
  });
   */
  const openModalButton = document.getElementById('open-modal');
  const closeModalButton = document.getElementById('close-modal');
  const modal = document.getElementById('modal');
  const form = document.getElementById('ContatoForms'); // Referência ao formulário
  
  openModalButton.addEventListener('click', () => {
    modal.style.display = 'block';
  });
  
  closeModalButton.addEventListener('click', () => {
    modal.style.display = 'none';
  });
  
  // Fechar o modal ao clicar fora do conteúdo do modal
  window.addEventListener('submit', (event) => {
    if (event.target === modal) {
      modal.style.display = 'none';
      form.reset();
    }
    location.reload(); // Recarrega a página
  });
  
  // Ação ao submeter o formulário
 /* form.addEventListener('submit', async (event) => {
    event.preventDefault(); // Evita o envio padrão do formulário
  
    // Simulação de envio para o Google Forms
    // Aqui você pode adicionar código para enviar os dados do formulário via AJAX, se necessário
  
    // Limpar o formulário

  
    // Fechar o modal após limpar o formulário
    modal.style.display = 'none';
  
    // Recarregar a página após um curto período de tempo (simulação)
    await new Promise(resolve => setTimeout(resolve, 1000)); // Espera 1 segundo antes de recarregar
  });*/
  

       